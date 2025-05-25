<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ConversationContent;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConversationContentApiController extends Controller
{
    public function index()
    {
        $contents = ConversationContent::with('conversationGroup')->paginate(10);
        return response()->json($contents);
    }

    public function show($id)
    {
        $content = ConversationContent::with('conversationGroup')->find($id);

        if (!$content) {
            return response()->json(['message' => 'Konten tidak ditemukan'], 404);
        }

        return response()->json($content);
    }

    public function store(Request $request)
    {
        $request->validate([
            'text_ksa' => 'required',
            'text_idn' => 'required',
            'audio' => 'required|file|mimes:mp3,wav',
            'speaker' => 'required|in:A,B',
            'conversations_id' => 'required|exists:conversations,id'
        ]);

        $audioPath = $request->file('audio')->store('audios', 'public');

        $content = ConversationContent::create([
            'text_ksa' => $request->text_ksa,
            'text_idn' => $request->text_idn,
            'audio' => $audioPath,
            'speaker' => $request->speaker,
            'conversations_id' => $request->conversations_id,
        ]);

        return response()->json([
            'message' => 'Konten percakapan berhasil ditambahkan!',
            'data' => $content
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $content = ConversationContent::find($id);

        if (!$content) {
            return response()->json(['message' => 'Konten tidak ditemukan'], 404);
        }

        $request->validate([
            'text_ksa' => 'required',
            'text_idn' => 'required',
            'speaker' => 'required|in:A,B',
            'audio' => 'nullable|file|mimes:mp3,wav'
        ]);

        if ($request->hasFile('audio')) {
            if ($content->audio && Storage::disk('public')->exists($content->audio)) {
                Storage::disk('public')->delete($content->audio);
            }

            $audioPath = $request->file('audio')->store('audios', 'public');
            $content->audio = $audioPath;
        }

        $content->text_ksa = $request->text_ksa;
        $content->text_idn = $request->text_idn;
        $content->speaker = $request->speaker;
        $content->save();

        return response()->json([
            'message' => 'Konten percakapan berhasil diperbarui!',
            'data' => $content
        ]);
    }

    public function destroy($id)
    {
        $content = ConversationContent::find($id);

        if (!$content) {
            return response()->json(['message' => 'Konten tidak ditemukan'], 404);
        }

        if ($content->audio && Storage::disk('public')->exists($content->audio)) {
            Storage::disk('public')->delete($content->audio);
        }

        $content->delete();

        return response()->json(['message' => 'Konten percakapan berhasil dihapus!']);
    }
}
