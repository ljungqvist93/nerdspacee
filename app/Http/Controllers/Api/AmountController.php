<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Amount;
use App\Models\SmashUser;

class AmountController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | FETCH AMOUNTS
    |--------------------------------------------------------------------------
    */

    public function fetchAmounts(
        Request $request,
        string $smash
    ) {

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | CHECK ACCESS
        |--------------------------------------------------------------------------
        */

        $hasAccess = SmashUser::where(
            'user_id',
            $user->id
        )

            ->where(
                'smash_id',
                $smash
            )

            ->exists();

        if (!$hasAccess) {

            return response()->json([
                'message' => 'Unauthorized'
            ], 403);

        }

        /*
        |--------------------------------------------------------------------------
        | FETCH
        |--------------------------------------------------------------------------
        */

        $amounts = Amount::where(
            'smash_id',
            $smash
        )
            ->latest()
            ->get();

        return response()->json(
            $amounts
        );

    }

    /*
    |--------------------------------------------------------------------------
    | CREATE AMOUNT
    |--------------------------------------------------------------------------
    */

    public function createAmount(
        Request $request
    ) {

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | CHECK ACCESS
        |--------------------------------------------------------------------------
        */

        $hasAccess = SmashUser::where(
            'user_id',
            $user->id
        )

            ->where(
                'smash_id',
                $request->smash_id
            )

            ->exists();

        if (!$hasAccess) {

            return response()->json([
                'message' => 'Unauthorized'
            ], 403);

        }

        /*
        |--------------------------------------------------------------------------
        | CREATE
        |--------------------------------------------------------------------------
        */

        $amount = Amount::create([

            'uuid' => $request->uuid,

            'smash_id' => $request->smash_id,

            'amount' => $request->amount,

            'excluded' => false,

            'locked' => false

        ]);

        return response()->json(
            $amount
        );

    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE AMOUNT
    |--------------------------------------------------------------------------
    */

    public function updateAmount(
        Request $request,
        string $uuid
    ) {

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | FIND AMOUNT
        |--------------------------------------------------------------------------
        */

        $amount = Amount::where(
            'uuid',
            $uuid
        )->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | CHECK ACCESS
        |--------------------------------------------------------------------------
        */

        $hasAccess = SmashUser::where(
            'user_id',
            $user->id
        )

            ->where(
                'smash_id',
                $amount->smash_id
            )

            ->exists();

        if (!$hasAccess) {

            return response()->json([
                'message' => 'Unauthorized'
            ], 403);

        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $amount->update([
            'amount' => $request->amount
        ]);

        return response()->json([
            'success' => true
        ]);

    }

    /*
    |--------------------------------------------------------------------------
    | DELETE AMOUNT
    |--------------------------------------------------------------------------
    */

    public function deleteAmount(
        Request $request,
        string $uuid
    ) {

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | FIND AMOUNT
        |--------------------------------------------------------------------------
        */

        $amount = Amount::where(
            'uuid',
            $uuid
        )->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | CHECK ACCESS
        |--------------------------------------------------------------------------
        */

        $hasAccess = SmashUser::where(
            'user_id',
            $user->id
        )

            ->where(
                'smash_id',
                $amount->smash_id
            )

            ->exists();

        if (!$hasAccess) {

            return response()->json([
                'message' => 'Unauthorized'
            ], 403);

        }

        /*
        |--------------------------------------------------------------------------
        | DELETE
        |--------------------------------------------------------------------------
        */

        $amount->delete();

        return response()->json([
            'success' => true
        ]);

    }

    public function updateExcluded(
        Request $request,
        string $uuid
    ) {

        $user = auth()->user();

        $amount = Amount::where(
            'uuid',
            $uuid
        )->firstOrFail();

        $hasAccess = SmashUser::where(
            'user_id',
            $user->id
        )

            ->where(
                'smash_id',
                $amount->smash_id
            )

            ->exists();

        if (!$hasAccess) {

            return response()->json([
                'message' => 'Unauthorized'
            ], 403);

        }

        $request->validate([
            'excluded' => ['required', 'boolean']
        ]);

        $amount->update([
            'excluded' => $request->boolean('excluded')
        ]);

        return response()->json([
            'success' => true
        ]);

    }

    public function updateLocked(
        Request $request,
        string $uuid
    ) {

        $amount = Amount::where(
            'uuid',
            $uuid
        )->firstOrFail();

        $amount->update([
            'locked' => $request->boolean('locked')
        ]);

        return response()->json([
            'success' => true
        ]);

    }

}