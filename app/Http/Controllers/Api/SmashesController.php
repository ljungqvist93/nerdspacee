<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class SmashesController extends Controller
{
    public function fetchSmashes(Request $request)
    {
        $smashes = $request->user()
            ->smashes()
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'smashes' => $smashes
        ]);
    }
}