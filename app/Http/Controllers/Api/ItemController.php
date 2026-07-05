<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Item;
use App\Models\Smash;
use App\Models\SmashUser;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    public function index(string $smashId)
    {
        $user = auth()->user();

        $hasAccess = SmashUser::where(
            'user_id',
            $user->id
        )
            ->where(
                'smash_id',
                $smashId
            )
            ->exists();

        if (!$hasAccess) {

            return response()->json([
                'message' => 'Unauthorized'
            ], 403);

        }

        $items = Item::where(
            'smash_id',
            $smashId
        )
            ->orderByDesc('id')
            ->get();

        return response()->json([
            'items' => $items,
        ]);
    }

    public function bulkStore(Request $request)
    {
        $user = auth()->user();

        $items = $request->items;

        if (!$items || !is_array($items)) {

            return response()->json([
                'message' => 'Invalid items payload'
            ], 422);

        }

        /*
        |--------------------------------------------------------------------------
        | CHECK ACCESS
        |--------------------------------------------------------------------------
        */

        $smashId = $items[0]['smash_id'] ?? null;

        $hasAccess = SmashUser::where(
            'user_id',
            $user->id
        )

            ->where(
                'smash_id',
                $smashId
            )

            ->exists();

        if (!$hasAccess) {

            return response()->json([
                'message' => 'Unauthorized'
            ], 403);

        }

        /*
        |--------------------------------------------------------------------------
        | SANITIZE ITEMS
        |--------------------------------------------------------------------------
        */

        $sanitizedItems = collect($items)

            ->map(function ($item) use ($smashId) {

                return [
                    'uuid' => $item['uuid'],
                    'smash_id' => $smashId,
                    'name' => '',
                    'amount' => null,
                    'quantity' => 1,
                    'excluded' => false,
                    'locked' => false,
                    'created_at' => now(),
                    'updated_at' => now()
                ];

            })

            ->toArray();

        /*
        |--------------------------------------------------------------------------
        | INSERT
        |--------------------------------------------------------------------------
        */

        Item::insert($sanitizedItems);

        /*
        |--------------------------------------------------------------------------
        | UPDATE ACTIVITY
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true
        ]);
    }

    public function destroy(string $uuid)
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | FIND ITEM
        |--------------------------------------------------------------------------
        */

        $item = Item::where(
            'uuid',
            $uuid
        )->first();

        if (!$item) {

            return response()->json([
                'message' => 'Item not found'
            ], 404);

        }

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
                $item->smash_id
            )

            ->exists();

        if (!$hasAccess) {

            return response()->json([
                'message' => 'Unauthorized'
            ], 403);

        }

        $item->delete();

        return response()->json([
            'success' => true
        ]);
    }


    public function updateQuantity(
        Request $request,
        string $uuid
    ) {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | FIND ITEM
        |--------------------------------------------------------------------------
        */

        $item = Item::where(
            'uuid',
            $uuid
        )->first();

        if (!$item) {

            return response()->json([
                'message' => 'Item not found'
            ], 404);

        }

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
                $item->smash_id
            )

            ->exists();

        if (!$hasAccess) {

            return response()->json([
                'message' => 'Unauthorized'
            ], 403);

        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE QUANTITY ONLY
        |--------------------------------------------------------------------------
        */

        $item->update([
            'quantity' => max(
                1,
                (int) $request->quantity
            )
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function updateName(
        Request $request,
        string $uuid
    ) {

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | FIND ITEM
        |--------------------------------------------------------------------------
        */

        $item = Item::where(
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
                $item->smash_id
            )

            ->exists();

        if (!$hasAccess) {

            return response()->json([
                'message' => 'Unauthorized'
            ], 403);

        }

        $request->validate([
            'name' => 'nullable|string|max:255'
        ]);

        $item->update([
            'name' => $request->name
        ]);

        return response()->json([
            'success' => true
        ]);

    }

    public function updateAmount(
        Request $request,
        string $uuid
    ) {

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | FIND ITEM
        |--------------------------------------------------------------------------
        */

        $item = Item::where(
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
                $item->smash_id
            )

            ->exists();

        if (!$hasAccess) {

            return response()->json([
                'message' => 'Unauthorized'
            ], 403);

        }

        $request->validate([
            'amount' => 'nullable|numeric'
        ]);

        /*
        |--------------------------------------------------------------------------
        | UPDATE ITEM
        |--------------------------------------------------------------------------
        */

        $item->update([
            'amount' => $request->amount
        ]);

        return response()->json([
            'success' => true
        ]);

    }

    public function updateExcluded(
        Request $request,
        string $uuid
    ) {

        $user = auth()->user();

        $item = Item::where(
            'uuid',
            $uuid
        )->firstOrFail();

        $hasAccess = SmashUser::where(
            'user_id',
            $user->id
        )

            ->where(
                'smash_id',
                $item->smash_id
            )

            ->exists();

        if (!$hasAccess) {

            return response()->json([
                'message' => 'Unauthorized'
            ], 403);

        }

        $item->update([
            'excluded' => $request->excluded
        ]);

        return response()->json([
            'success' => true
        ]);

    }

    public function toggleLocked(
        Request $request,
        string $uuid
    ) {

        $user = auth()->user();

        $item = Item::where(
            'uuid',
            $uuid
        )->firstOrFail();

        $hasAccess = SmashUser::where(
            'user_id',
            $user->id
        )

            ->where(
                'smash_id',
                $item->smash_id
            )

            ->exists();

        if (!$hasAccess) {

            return response()->json([
                'message' => 'Unauthorized'
            ], 403);

        }

        $item->update([
            'locked' => !$item->locked
        ]);

        return response()->json([
            'success' => true,
            'locked' => $item->locked
        ]);

    }

    public function updateFinished(
        Request $request,
        string $uuid
    ) {

        $user = auth()->user();

        $item = Item::where(
            'uuid',
            $uuid
        )->firstOrFail();

        $hasAccess = SmashUser::where(
            'user_id',
            $user->id
        )

            ->where(
                'smash_id',
                $item->smash_id
            )

            ->exists();

        if (!$hasAccess) {

            return response()->json([
                'message' => 'Unauthorized'
            ], 403);

        }

        $item->update([
            'finished' => (bool) $request->finished
        ]);

        return response()->json([
            'success' => true,
            'finished' => $item->finished
        ]);

    }

    public function deleteShoppingItem(
        Request $request,
        string $uuid
    ) {

        Log::info('deleteShoppingItem called with uuid: ' . $uuid);
        $user = auth()->user();

        $item = Item::where(
            'uuid',
            $uuid
        )->firstOrFail();

        $hasAccess = SmashUser::where(
            'user_id',
            $user->id
        )

            ->where(
                'smash_id',
                $item->smash_id
            )

            ->exists();

        if (!$hasAccess) {

            return response()->json([
                'message' => 'Unauthorized'
            ], 403);

        }

        $item->delete();

        return response()->json([
            'success' => true
        ]);

    }
}