<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\ConversationContent;
use Illuminate\Http\Request;

class ConversationContentController extends Controller
{
    public function index()
    {
        $contents = ConversationContent::with('conversationGroup')->paginate(10);
        return view('conversations.index', compact('contents'));
    }

    public function show($id)
{
    $conversation = Conversation::with('contents')->findOrFail($id);
    return view('conversations.show', compact('conversation'));
}


public function create(Request $request)
{
    $conversationId = $request->get('conversation_id');
    $conversation = Conversation::findOrFail($conversationId);
    return view('conversation-contents.create', compact('conversation'));
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

        ConversationContent::create([
            'text_ksa' => $request->text_ksa,
            'text_idn' => $request->text_idn,
            'audio' => $audioPath,
            'speaker' => $request->speaker,
            'conversations_id' => $request->conversations_id,
        ]);

        return redirect()->route('conversations.index')->with('success', 'Conversation berhasil dibuat!');
    }

    public function edit($id)
    {
        $content = ConversationContent::findOrFail($id);
        $conversationGroups = Conversation::all();
        return view('conversation-contents.edit', compact('content', 'conversationGroups'));
    }

    public function update(Request $request, $id)
    {
        $content = ConversationContent::findOrFail($id);

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

        return redirect()->route('conversations.index')->with('success', 'Conversation berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $content = ConversationContent::findOrFail($id);
        $content->delete();

        return redirect()->route('conversations.index')->with('success', 'Conversation berhasil dihapus!');
    }
}
