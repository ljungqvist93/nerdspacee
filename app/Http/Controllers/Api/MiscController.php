<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MiscController extends Controller
{
    public function toggleRedirect(Request $request)
    {
        $request->validate([
            'redirect' => ['required', 'boolean']
        ]);

        $user = $request->user();

        $user->redirect = $request->redirect;

        $user->save();

        return response()->json([
            'success' => true
        ]);
    }
}