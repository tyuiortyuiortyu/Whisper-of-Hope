<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Whisper;
use App\Models\Color;

class WhisperController extends Controller
{
    public function index()
    {
        return view('user.whisper');
    }

    public function getWhispers()
    {
        $whispers = Whisper::with('color')->get()->map(function ($whisper) {
            return [
                'id' => $whisper->id,
                'to' => $whisper->to,
                'message' => $whisper->content,
                'color' => $whisper->color->hex_value,
                'font_color' => $whisper->color->font_color,
                'color_id' => $whisper->color_id,
                'created_at' => $whisper->created_at->toISOString()
            ];
        });

        return response()->json($whispers);
    }

    public function getColors()
    {
        $colors = Color::all()->map(function ($color) {
            // Get localized color name
            $localizedName = __('whisper.colors.' . $color->name, [], app()->getLocale());
            // If translation doesn't exist, fallback to original name
            $displayName = ($localizedName === 'whisper.colors.' . $color->name) ? $color->name : $localizedName;
            
            return [
                'id' => $color->id,
                'name' => $color->name, // Keep original name for JavaScript lookups
                'display_name' => $displayName, // Localized name for display
                'hex_value' => $color->hex_value,
                'font_color' => $color->font_color
            ];
        });

        return response()->json($colors);
    }

    public function store(Request $request)
    {
        $request->validate([
            'to' => 'required|string|max:50',
            'message' => 'required|string|max:500',
            'color_id' => 'required|exists:colors,id'
        ]);

        $whisper = Whisper::create([
            'to' => $request->to,
            'content' => $request->message,
            'color_id' => $request->color_id,
        ]);

        $whisper->load('color');

        return response()->json([
            'success' => true,
            'message' => 'Whisper posted successfully!',
            'whisper' => [
                'id' => $whisper->id,
                'to' => $whisper->to,
                'message' => $whisper->content,
                'color' => $whisper->color->hex_value,
                'font_color' => $whisper->color->font_color,
                'color_id' => $whisper->color_id,
                'created_at' => $whisper->created_at->toISOString()
            ]
        ]);
    }
}
