<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Smash;
use App\Models\SmashUser;
use App\Models\GradientColor;
use App\Models\QuickSmashName;

use Illuminate\Support\Facades\Log;

class QuickSmashController extends Controller
{
    private function determineQuickSmashName($user)
    {
        $usedNames = Smash::query()
            ->where('is_quick_smash', true)
            ->where(
                'heartbeat',
                '>=',
                now()->subHours(2)
            )
            ->whereHas('users', function ($q) use ($user) {
                $q->where('users.id', $user->id);
            })
            ->pluck('name')
            ->filter()
            ->unique();

        $availableNames = QuickSmashName::query()
            ->whereNotIn('name', $usedNames)
            ->pluck('name');

        if ($availableNames->isNotEmpty()) {

            return $availableNames->random();

        }

        return QuickSmashName::query()
            ->inRandomOrder()
            ->value('name');
    }
    private function determineGradientColor($user)
    {
        $usedColorIds = Smash::query()
            ->where('is_quick_smash', true)
            ->where(
                'heartbeat',
                '>=',
                now()->subHours(2)
            )
            ->whereHas('users', function ($q) use ($user) {
                $q->where('users.id', $user->id);
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

    public function createQuickSmash(Request $request)
    {
        $gradientColor = $this->determineGradientColor(
            $request->user()
        );

        $name = $this->determineQuickSmashName(
            $request->user()
        );

        $smash = Smash::create([
            'owner' => $request->user()->id,
            'is_quick_smash' => true,
            'heartbeat' => now(),
            'name' => $name,
            'gradient_color_id' => $gradientColor->id,
        ]);

        $smash->users()->attach(
            $request->user()->id
        );

        $smash->load([
            'gradientColor',
            'members',
        ]);

        return response()->json([
            'success' => true,
            'smash' => $smash
        ]);
    }

    public function heartBeat(
        Smash $smash
    ) {

        if (!$smash->is_quick_smash) {

            return response()->json([
                'message' => 'Not a quick smash'
            ], 403);

        }

        $isMember =
            SmashUser::where(
                'smash_id',
                $smash->id
            )
                ->where(
                    'user_id',
                    auth()->id()
                )
                ->exists();

        if (!$isMember) {

            return response()->json([
                'message' => 'Unauthorized'
            ], 403);

        }

        if (
            $smash->heartbeat &&
            $smash->heartbeat->gt(
                now()->subMinutes(10)
            )
        ) {

            return response()->json([
                'success' => true
            ]);

        }

        $smash->update([
            'heartbeat' => now()
        ]);

        return response()->json([
            'success' => true
        ]);

    }
}