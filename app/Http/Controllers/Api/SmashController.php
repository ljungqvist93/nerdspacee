<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Smash;
use App\Models\SmashUser;
use App\Models\Item;
use App\Models\Amount;
use App\Models\SmashArchive;
use App\Events\SmashArchived;
use App\Events\SmashRestored;
use App\Events\UserLeftSmash;
use App\Events\UserRemovedFromSmash;
use App\Models\User;
use App\Events\MemberRemovedFromSmash;
use App\Events\SmashShared;
use App\Events\SmashUpdated;

use App\Events\UserJoinedSmash;

use Illuminate\Support\Facades\Log;

class SmashController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string'],
            'color' => ['nullable', 'string'],
        ]);

        $smash = Smash::create([
            'name' => $data['name'],
            'icon' => $data['icon'] ?? null,
            'color' => $data['color'] ?? null,
            'owner' => Auth::id(),
            'is_quick_smash' => false,
        ]);

        $smash->users()->attach(
            Auth::id()
        );

        $smash->load([
            'members',
        ]);

        return response()->json([
            'success' => true,
            'smash' => $smash,
        ]);
    }

    public function reset(
        Smash $smash
    ) {

        Item::where(
            'smash_id',
            $smash->id
        )
            ->where(
                'locked',
                false
            )
            ->delete();

        Amount::where(
            'smash_id',
            $smash->id
        )
            ->where(
                'locked',
                false
            )
            ->delete();

        return response()->json([
            'success' => true
        ]);

    }

    public function archive(Smash $smash)
    {
        if (
            !$smash->users()
                ->where('users.id', auth()->id())
                ->exists()
        ) {
            abort(403);
        }

        SmashArchive::firstOrCreate([
            'smash_id' => $smash->id,
        ]);

        $participantIds = $smash->users()
            ->pluck('users.id');

        foreach ($participantIds as $userId) {

            Log::info('Broadcasting SmashArchived', [
                'smash' => $smash->id,
                'user' => $userId,
            ]);

            broadcast(
                new SmashArchived(
                    $smash->id,
                    $userId
                )
            );

        }

        return response()->json([
            'success' => true
        ]);
    }

    public function restore(Smash $smash)
    {
        if (
            !$smash->users()
                ->where('users.id', auth()->id())
                ->exists()
        ) {
            abort(403);
        }

        SmashArchive::where(
            'smash_id',
            $smash->id
        )->delete();

        $smash->update([
            'heartbeat' => now(),
        ]);

        $participantIds = $smash->users()
            ->pluck('users.id');

        foreach ($participantIds as $userId) {

            Log::info('Broadcasting SmashRestored', [
                'smash' => $smash->id,
                'user' => $userId,
            ]);

            broadcast(
                new SmashRestored(
                    $smash->id,
                    $userId
                )
            );

        }

        return response()->json([
            'success' => true
        ]);
    }

    public function toggleShopping(
        Smash $smash,
        Request $request
    ) {
        if (
            !$smash->users()
                ->where('users.id', auth()->id())
                ->exists()
        ) {
            abort(403);
        }

        $data = $request->validate([
            'shopping' => ['required', 'boolean'],
        ]);

        $smash->update([
            'shopping' => $data['shopping'],
        ]);

        return response()->json([
            'success' => true,
            'shopping' => $smash->shopping,
        ]);
    }

    public function leave(Smash $smash)
    {
        $userId = auth()->id();

        if (
            !$smash->users()
                ->where('users.id', $userId)
                ->exists()
        ) {
            abort(403);
        }

        $recipients = $smash->users()
            ->where('users.id', '!=', $userId)
            ->get();

        foreach ($recipients as $recipient) {

            broadcast(new UserLeftSmash(
                $smash->id,
                $userId,
                $recipient->id
            ));

        }
        SmashUser::where([
            'smash_id' => $smash->id,
            'user_id' => $userId,
        ])->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function fetchMembers(
        Smash $smash
    ) {
        if (
            !$smash->users()
                ->where('users.id', auth()->id())
                ->exists()
        ) {
            abort(403);
        }

        $members = $smash->users()
            ->select(
                'users.id',
                'users.name',
                'users.email'
            )
            ->get();

        return response()->json([
            'success' => true,
            'members' => $members,
        ]);
    }

    public function removeUserFromSmash(
        Smash $smash,
        User $user
    ) {
        if (
            !$smash->users()
                ->where('users.id', auth()->id())
                ->exists()
        ) {
            abort(403);
        }

        if (
            !$smash->users()
                ->where('users.id', $user->id)
                ->exists()
        ) {
            abort(404);
        }

        SmashUser::where([
            'smash_id' => $smash->id,
            'user_id' => $user->id,
        ])->delete();

        $smash->load('users');

        broadcast(new UserRemovedFromSmash(
            $smash->id,
            $user->id
        ));

        foreach ($smash->users as $member) {

            broadcast(new MemberRemovedFromSmash(
                $smash->id,
                $user->id,
                $member
            ));
        }

        return response()->json([
            'success' => true
        ]);
    }

    public function shareSmash(Request $request)
    {
        $smash = Smash::findOrFail($request->smash_id);

        if ($smash->owner !== $request->user()->id) {

            return response()->json([
                'success' => false
            ], 403);
        }

        $exists = $smash->users()
            ->where('user_id', $request->user_id)
            ->exists();

        if (!$exists) {

            $smash->users()->attach(
                $request->user_id
            );
        }

        $targetUser = User::findOrFail(
            $request->user_id
        );

        $smash->load('users');

        broadcast(new SmashShared(
            $smash,
            $request->user(),
            $targetUser
        ));

        foreach ($smash->users as $user) {

            if ($user->id === $targetUser->id) {
                continue;
            }

            broadcast(new UserJoinedSmash(
                $smash,
                $targetUser,
                $user
            ));
        }

        return response()->json([
            'success' => true
        ]);
    }

    public function expandShopping(
        Smash $smash,
        Request $request
    ) {
        if (
            !$smash->users()
                ->where('users.id', auth()->id())
                ->exists()
        ) {
            abort(403);
        }

        $data = $request->validate([
            'expanded' => ['required', 'boolean'],
        ]);

        $smash->update([
            'expanded' => $data['expanded'],
        ]);

        return response()->json([
            'success' => true,
            'expanded' => $smash->shopping_expanded,
        ]);
    }

    public function update(
        Smash $smash,
        Request $request
    ) {
        if (
            !$smash->users()
                ->where('users.id', auth()->id())
                ->exists()
        ) {
            abort(403);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string'],
            'color' => ['nullable', 'string'],
        ]);

        $smash->update([
            'name' => $data['name'],
            'icon' => $data['icon'] ?? null,
            'color' => $data['color'] ?? null,
        ]);

        $smash->refresh();

        foreach ($smash->users as $user) {

            broadcast(
                new SmashUpdated(
                    $smash,
                    $user->id
                )
            );

        }

        return response()->json([
            'success' => true,
            'smash' => $smash,
        ]);
    }

    public function togglePin(
        Smash $smash,
        Request $request
    ) {
        if (
            !$smash->users()
                ->where('users.id', auth()->id())
                ->exists()
        ) {
            abort(403);
        }

        $data = $request->validate([
            'pinned' => ['required', 'boolean'],
        ]);

        $smash->users()->updateExistingPivot(
            auth()->id(),
            [
                'pinned' => $data['pinned'],
            ]
        );

        return response()->json([
            'success' => true,
            'pinned' => $data['pinned'],
        ]);
    }
}