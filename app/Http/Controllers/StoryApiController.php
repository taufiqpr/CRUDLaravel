<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoryApiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $stories = Story::where('user_id', Auth::id())->get();
        return response()->json(['stories' => $stories], 200);
    }

    public function show($id)
    {
        $story = Story::with('contents')->where('user_id', Auth::id())->find($id);
        if (!$story) {
            return response()->json(['message' => 'Story tidak ditemukan'], 404);
        }
        return response()->json(['story' => $story], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'desc'  => 'required|string',
        ]);

        $story = Story::create([
            'title'   => $request->title,
            'desc'    => $request->desc,
            'user_id' => Auth::id(),
        ]);

        return response()->json(['message' => 'Story berhasil dibuat!', 'story' => $story], 201);
    }

    public function update(Request $request, $id)
    {
        $story = Story::where('user_id', Auth::id())->find($id);
        if (!$story) {
            return response()->json(['message' => 'Story tidak ditemukan'], 404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'desc'  => 'required|string',
        ]);

        $story->update([
            'title' => $request->title,
            'desc'  => $request->desc,
        ]);

        return response()->json(['message' => 'Story berhasil diperbarui!', 'story' => $story], 200);
    }

    public function destroy($id)
    {
        $story = Story::where('user_id', Auth::id())->find($id);
        if (!$story) {
            return response()->json(['message' => 'Story tidak ditemukan'], 404);
        }

        $story->delete();

        return response()->json(['message' => 'Story berhasil dihapus!'], 200);
    }
}
