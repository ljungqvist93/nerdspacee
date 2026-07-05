<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Friend;
use App\Events\FriendRequestReceived;
use App\Events\FriendRequestResponded;
use App\Models\Bff;
use App\Events\QuickSmashCreated;
use App\Models\GradientColor;
use App\Models\QuickSmashName;

use App\Models\User;
use App\Models\Smash;

use Illuminate\Support\Facades\Log;

class FriendsController extends Controller
{
    // 🔍 Search users
    public function findFriends(Request $request)
    {
        $query = $request->query('q');

        if (!$query || strlen($query) < 2) {
            return response()->json([]);
        }

        $users = User::where('username', 'like', "%{$query}%")
            ->where('id', '!=', Auth::id())
            ->limit(10)
            ->get(['id', 'name', 'image']);

        return response()->json($users);
    }

    // ➕ Send friend request
    public function sendFriendRequest(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $senderId = Auth::id();

        $receiverId = $request->user_id;

        if ($senderId == $receiverId) {

            return response()->json([
                'error' => 'Cannot add yourself'
            ], 400);
        }

        // Prevent duplicate requests/friendships
        $existing = Friend::where(function ($q) use ($senderId, $receiverId) {

            $q->where('sender_id', $senderId)
                ->where('receiver_id', $receiverId);

        })->orWhere(function ($q) use ($senderId, $receiverId) {

            $q->where('sender_id', $receiverId)
                ->where('receiver_id', $senderId);

        })->exists();

        if ($existing) {

            return response()->json([
                'error' => 'Friendship already exists'
            ], 400);
        }

        // Create request
        $friend = Friend::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'status' => 'pending',
        ]);

        $sender = Auth::user();

        broadcast(new FriendRequestReceived(
            $receiverId,
            [
                'friend_id' => $friend->id,
                'id' => $sender->id,
                'name' => $sender->name,
                'image' => $sender->image,
            ]
        ));

        return response()->json([
            'message' => 'Friend request sent',
            'friend' => $friend,
        ]);
    }

    public function acceptFriendRequest(Request $request)
    {
        $request->validate([
            'friend_id' => 'required|exists:friends,id',
        ]);

        $friend = Friend::findOrFail($request->friend_id);

        // Security:
        // only receiver can accept
        if ($friend->receiver_id !== Auth::id()) {

            return response()->json([
                'error' => 'Unauthorized'
            ], 403);
        }

        $friend->status = 'accepted';

        $friend->save();

        $receiver = Auth::user();

        // Notify original sender
        broadcast(new FriendRequestResponded(
            $friend->sender_id,
            [
                'id' => $receiver->id,
                'name' => $receiver->name,
                'image' => $receiver->image,
            ],
            'accepted'
        ));

        return response()->json([
            'message' => 'Friend request accepted'
        ]);
    }

    public function fetchFriends()
    {
        $userId = Auth::id();

        // Accepted friends
        $friends = Friend::where('status', 'accepted')
            ->where(function ($q) use ($userId) {
                $q->where('sender_id', $userId)
                    ->orWhere('receiver_id', $userId);
            })
            ->latest()
            ->get()
            ->map(function ($friend) use ($userId) {

                $otherUser = $friend->sender_id === $userId
                    ? $friend->receiver
                    : $friend->sender;

                return [
                    'id' => $otherUser->id,
                    'name' => $otherUser->name,
                    'image' => $otherUser->image,
                ];
            });

        // Incoming pending requests
        $pendingRequests = Friend::where('receiver_id', $userId)
            ->where('status', 'pending')
            ->with('sender')
            ->get()
            ->map(function ($friend) {

                return [
                    'friend_id' => $friend->id,
                    'id' => $friend->sender->id,
                    'name' => $friend->sender->name,
                    'image' => $friend->sender->image,
                ];
            });

        // Sent requests
        $sentRequests = Friend::where('sender_id', $userId)
            ->where('status', 'pending')
            ->with('receiver')
            ->get()
            ->map(function ($friend) {

                return [
                    'friend_id' => $friend->id,
                    'id' => $friend->receiver->id,
                    'name' => $friend->receiver->name,
                    'image' => $friend->receiver->image,
                ];
            });

        $bffs = Bff::where('user_id', $userId)
            ->with('friend')
            ->get()
            ->map(function ($bff) {

                return [
                    'id' => $bff->friend->id,
                    'name' => $bff->friend->name,
                    'image' => $bff->friend->image,
                ];

            });

        return response()->json([
            'friends' => $friends,
            'pending_requests' => $pendingRequests,
            'sent_requests' => $sentRequests,
            'bffs' => $bffs,
        ]);
    }

    public function bffs(Request $request)
    {
        $bff = Bff::where('user_id', $request->user()->id)
            ->where('friend_id', $request->friend_id)
            ->first();

        if ($bff) {

            $bff->delete();

        } else {

            Bff::create([
                'user_id' => $request->user()->id,
                'friend_id' => $request->friend_id,
            ]);

        }

        return response()->json([
            'success' => true
        ]);
    }


    private function determineGradientColor(
        array $participantIds
    ) {
        $usedColorIds = Smash::query()
            ->where('is_quick_smash', true)
            ->where(
                'heartbeat',
                '>=',
                now()->subHours(2)
            )
            ->whereHas('users', function ($q) use ($participantIds) {
                $q->whereIn(
                    'users.id',
                    $participantIds
                );
            })
            ->pluck('gradient_color_id')
            ->filter()
            ->unique();

        $availableColors = GradientColor::query()
            ->whereNotIn('id', $usedColorIds)
            ->get();

        if ($availableColors->isNotEmpty()) {
            return $availableColors->random();
        }

        return GradientColor::query()
            ->inRandomOrder()
            ->first();
    }

    private function determineQuickSmashName(
        array $participantIds
    ) {
        $usedNames = Smash::query()
            ->where('is_quick_smash', true)
            ->where(
                'heartbeat',
                '>=',
                now()->subHours(2)
            )
            ->whereHas('users', function ($q) use ($participantIds) {
                $q->whereIn(
                    'users.id',
                    $participantIds
                );
            })
            ->pluck('name')
            ->filter()
            ->unique();

        $availableNames = QuickSmashName::query()
            ->whereNotIn('name', $usedNames)
            ->get();

        if ($availableNames->isNotEmpty()) {
            return $availableNames->random()->name;
        }

        return QuickSmashName::query()
            ->inRandomOrder()
            ->value('name');
    }

    public function quickBffSmash(Request $request)
    {
        Log::info('🚀 quickBffSmash START');

        $userId = Auth::id();

        $userIds = collect($request->user_ids)
            ->unique()
            ->filter(fn($id) => $id != $userId)
            ->values();

        /*
        |--------------------------------------------------------------------------
        | VERIFY FRIENDSHIP
        |--------------------------------------------------------------------------
        */

        foreach ($userIds as $friendId) {

            $isFriend = Friend::where('status', 'accepted')
                ->where(function ($q) use ($userId, $friendId) {

                    $q->where(function ($query) use ($userId, $friendId) {
                        $query->where('sender_id', $userId)
                            ->where('receiver_id', $friendId);
                    })

                        ->orWhere(function ($query) use ($userId, $friendId) {
                            $query->where('sender_id', $friendId)
                                ->where('receiver_id', $userId);
                        });

                })
                ->exists();

            if (!$isFriend) {

                return response()->json([
                    'message' => 'Not friends',
                    'friend_id' => $friendId,
                ], 403);

            }

        }

        /*
        |--------------------------------------------------------------------------
        | DETERMINE NAME + COLOR
        |--------------------------------------------------------------------------
        */

        $participants = [
            $userId,
            ...$userIds->toArray()
        ];

        $gradientColor =
            $this->determineGradientColor(
                $participants
            );

        $name =
            $this->determineQuickSmashName(
                $participants
            );

        /*
        |--------------------------------------------------------------------------
        | CREATE QUICK SMASH
        |--------------------------------------------------------------------------
        */

        $smash = Smash::create([
            'is_quick_smash' => true,
            'heartbeat' => now(),
            'owner' => $userId,
            'gradient_color_id' => $gradientColor->id,
            'name' => $name,
        ]);

        /*
        |--------------------------------------------------------------------------
        | ADD USERS
        |--------------------------------------------------------------------------
        */

        $smash->users()->attach(
            $participants
        );

        /*
        |--------------------------------------------------------------------------
        | LOAD RELATIONS
        |--------------------------------------------------------------------------
        */

        $smash->load(
            'gradientColor',
            'users'
        );

        $smash->members = $smash->users;
        unset($smash->users);

        /*
        |--------------------------------------------------------------------------
        | BROADCAST
        |--------------------------------------------------------------------------
        */

        foreach ($userIds as $friendId) {

            broadcast(
                new QuickSmashCreated(
                    $smash,
                    $friendId
                )
            );

        }

        /*
        |--------------------------------------------------------------------------
        | RESPONSE
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,
            'smash' => $smash
        ]);
    }
}