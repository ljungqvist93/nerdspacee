<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Friend;
use App\Models\Bff;
use App\Models\Smash;
use App\Models\Icon;
use App\Models\Color;
use App\Models\GradientColor;
use App\Models\SmashArchive;
use App\Models\QuickSmashName;

use Illuminate\Support\Facades\Log;

class BootstrapController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        /*
        |--------------------------------------------------------------------------
        | FRIENDS
        |--------------------------------------------------------------------------
        */

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

        /*
        |--------------------------------------------------------------------------
        | PENDING REQUESTS
        |--------------------------------------------------------------------------
        */

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

        /*
        |--------------------------------------------------------------------------
        | SENT REQUESTS
        |--------------------------------------------------------------------------
        */

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

        /*
        |--------------------------------------------------------------------------
        | BFFS
        |--------------------------------------------------------------------------
        */

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

        /*
        |--------------------------------------------------------------------------
        | SMASHES
        |--------------------------------------------------------------------------
        */

        $smashes = Smash::whereHas(
            'users',
            fn($q) => $q->where('user_id', $userId)
        )
            ->with([
                'users' => fn($q) => $q->select([
                    'users.id',
                    'users.name',
                    'users.image',
                ]),
                'gradientColor'
            ])
            ->latest()
            ->get()
            ->map(function ($smash) use ($userId) {

                return array_merge([
                    'id' => $smash->id,
                    'name' => $smash->name,
                    'color' => $smash->color,
                    'icon' => $smash->icon,
                    'owner' => $smash->owner,
                    'pinned' => $smash->users
                        ->firstWhere('id', $userId)
                        ?->pivot
                            ?->pinned ?? false,
                    'is_quick_smash' => $smash->is_quick_smash,
                    'shopping' => $smash->shopping,
                    'gradient_color' => $smash->gradientColor,
                    'expanded' => $smash->expanded,

                    'members' => $smash->users->map(fn($user) => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'image' => $user->image,
                    ]),

                ], $smash->is_quick_smash ? [] : []);

            });

        /*
        |--------------------------------------------------------------------------
        | SMASH ARCHIVES
        |--------------------------------------------------------------------------
        */

        $smashArchives = SmashArchive::whereHas(
            'smash.users',
            fn($q) => $q->where('user_id', $userId)
        )
            ->orderByDesc('created_at')
            ->get([
                'smash_id',
                'created_at',
            ]);

        /*
        |--------------------------------------------------------------------------
        | ICONS
        |--------------------------------------------------------------------------
        */

        $icons = Icon::select([
            'id',
            'name',
        ])
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | COLORS
        |--------------------------------------------------------------------------
        */

        $colors = Color::select([
            'id',
            'name',
        ])
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | RESPONSE
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'redirect' => $request->user()->redirect,

            'friends' => $friends,

            'pending_requests' => $pendingRequests,

            'sent_requests' => $sentRequests,

            'bffs' => $bffs,

            'smashes' => $smashes,

            'smash_archives' => $smashArchives,

            'icons' => $icons,

            'colors' => $colors,

        ]);
    }
}