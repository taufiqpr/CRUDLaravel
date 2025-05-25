<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationApiController extends Controller
{
    public function index()
    {
        $conversations = Conversation::latest()->get();
        return response()->json($conversations);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'desc' => 'required|string',
        ]);

        $conversation = Conversation::create([
            'title'   => $request->title,
            'desc'    => $request->desc,
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'message' => 'Percakapan berhasil ditambahkan!',
            'data' => $conversation,
        ], 201);
    }

    public function show($id)
    {
        $conversation = Conversation::with('contents')->find($id);

        if (!$conversation) {
            return response()->json(['message' => 'Percakapan tidak ditemukan'], 404);
        }

        return response()->json($conversation);
    }

    public function update(Request $request, $id)
    {
        $conversation = Conversation::find($id);

        if (!$conversation) {
            return response()->json(['message' => 'Percakapan tidak ditemukan'], 404);
        }

        $request->validate([
            'title' => 'required|string',
            'desc' => 'required|string',
        ]);

        $conversation->update([
            'title' => $request->title,
            'desc'  => $request->desc,
        ]);

        return response()->json([
            'message' => 'Percakapan berhasil diperbarui!',
            'data' => $conversation,
        ]);
    }

    public function destroy($id)
    {
        $conversation = Conversation::find($id);

        if (!$conversation) {
            return response()->json(['message' => 'Percakapan tidak ditemukan'], 404);
        }

        $conversation->delete();

        return response()->json(['message' => 'Percakapan berhasil dihapus!']);
    }
}
