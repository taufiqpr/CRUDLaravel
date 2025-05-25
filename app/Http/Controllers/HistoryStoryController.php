<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoryStory;

class HistoryStoryController extends Controller
{
    public function index()
    {
        $histories = HistoryStory::with('user', 'story')->get();
        return view('history.index', compact('histories'));
    }

    
    public function create()
    {
        return view('history.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'similarity_percentage' => 'required|numeric',
            'audio' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'story_id' => 'required|exists:story,id',
        ]);

        HistoryStory::create($request->all());
        return redirect()->route('history.index')->with('success', 'History added successfully');
    }

    public function show($id)
    {
        $history = HistoryStory::with(['user', 'story'])->findOrFail($id);
        return view('history.show', compact('history'));
    }

    public function edit($id)
    {
        $history = HistoryStory::findOrFail($id);
        return view('history.edit', compact('history'));
    }

    public function update(Request $request, $id)
    {
        $history = HistoryStory::findOrFail($id);

        $request->validate([
            'similarity_percentage' => 'required|numeric',
            'audio' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'story_id' => 'required|exists:story_content,id',
        ]);

        $history->update($request->all());
        return redirect()->route('history.index')->with('success', 'History updated successfully');
    }

    public function destroy($id)
    {
        $history = HistoryStory::findOrFail($id);
        $history->delete();
        return redirect()->route('history.index')->with('success', 'History deleted');
    }
}
