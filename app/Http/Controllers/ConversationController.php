<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function index()
    {
        $conversations = Conversation::latest()->get();
        return view('conversations.index', compact('conversations'));
    }

    public function create()
    {
        return view('conversations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'desc' => 'required|string',
        ]);

        Conversation::create([
            'title'   => $request->title,
            'desc'    => $request->desc,
            'user_id' => Auth::id(),
        ]);


        return redirect()->route('conversations.index')->with('success', 'Percakapan berhasil ditambahkan!');
    }

    public function show($id)
    {
        $conversation = Conversation::with('contents')->findOrFail($id);
        return view('conversations.show', compact('conversation'));
    }

    public function edit($id)
    {
        $conversation = Conversation::findOrFail($id);
        return view('conversations.edit', compact('conversation'));
    }

    public function update(Request $request, $id)
    {
        $conversation = Conversation::findOrFail($id);

        $request->validate([
            'title' => 'required|string',
            'desc' => 'required|string',
        ]);

        $data = $request->only(['title', 'desc']);
        $data['user_id'] = $conversation->user_id;

        $conversation->update($data);

        return redirect()->route('conversations.index')->with('success', 'Percakapan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $conversation = Conversation::findOrFail($id);
        $conversation->delete();

        return redirect()->route('conversations.index')->with('success', 'Percakapan berhasil dihapus!');
    }
}
