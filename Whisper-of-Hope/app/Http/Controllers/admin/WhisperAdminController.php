<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Whisper;
use App\Models\Color;

class WhisperAdminController extends Controller
{
    public function index()
    {
        return view('admin.whisper_admin');
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
                'created_at' => $whisper->created_at->toISOString()
            ];
        });

        return response()->json($whispers);
    }

    public function getColors()
    {
        $colors = Color::all()->map(function ($color) {
            return [
                'id' => $color->id,
                'name' => $color->name,
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
                'created_at' => $whisper->created_at->toISOString()
            ]
        ]);
    }
    
    public function destroy($id)
    {
        try {
            $whisper = Whisper::findOrFail($id);
            $whisper->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Whisper deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete whisper.'
            ], 500);
        }
    }
}
