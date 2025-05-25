<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::all();
        return view('stories.index', compact('stories'));
    }

    public function create()
    {
        return view('stories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
        ]);

        Story::create([
            'title'   => $request->title,
            'desc'    => $request->desc,
            'user_id' => Auth::id(),
        ]);


        return redirect()->route('stories.index')->with('success', 'Story berhasil dibuat!');
    }


    public function show($id)
    {
        $story = Story::with('contents')->findOrFail($id);

        if (auth()->check()) {
            \App\Models\HistoryStory::create([
                'user_id' => auth()->id(),
                'story_id' => $story->id,
                'similarity_percentage' => 0,
                'audio' => '-',
            ]);
        }

        return view('stories.show', compact('story'));
    }


    public function edit($id)
    {
        $story = Story::findOrFail($id);
        return view('stories.edit', compact('story'));
    }

    public function update(Request $request, $id)
    {
        $story = Story::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
        ]);

        $data = $request->only(['title', 'desc']);
        $data['user_id'] = $story->user_id;

        $story->update($data);

        return redirect()->route('stories.index')->with('success', 'Story berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $story = Story::findOrFail($id);
        $story->delete();

        return redirect()->route('stories.index')->with('success', 'Story berhasil dihapus!');
    }
}
