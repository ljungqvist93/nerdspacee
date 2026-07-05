<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Icon;
use Illuminate\Http\Request;

class IconsColorsController extends Controller
{
    public function index()
    {
        return response()->json([
            'colors' => Color::orderBy('name')->get(),
            'icons' => Icon::orderBy('category')
                ->orderBy('name')
                ->get(),
        ]);
    }
}
