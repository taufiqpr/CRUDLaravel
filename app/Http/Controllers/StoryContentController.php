<?php

namespace App\Http\Controllers;

use App\Models\StoryContent;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryContentController extends Controller
{
    public function index()
    {
        $stories = StoryContent::with('storyGroup')->paginate(10);
        return view('story-contents.index', compact('stories'));
    }

    public function create($storyId)
    {
        $story = Story::findOrFail($storyId);
        return view('story-contents.create', compact('story'));
    }

    public function store(Request $request, $storyId)
    {
        $request->validate([
            'text_ksa' => 'required',
            'text_idn' => 'required',
            'audio' => 'file|mimes:mp3,wav,ogg',
        ]);

        $audioPath = $request->file('audio')->store('audio', 'public');

        StoryContent::create([
            'text_ksa' => $request->text_ksa,
            'text_idn' => $request->text_idn,
            'audio' => $audioPath,
            'stories_id' => $storyId,
        ]);

        return redirect()->route('stories.show', $storyId)->with('success', 'Story created!');
    }


    public function show($id)
    {
        $story = StoryContent::with('storyGroup')->findOrFail($id);
        return view('story_contents.show', compact('story'));
    }

    public function edit($id)
    {
        $story = StoryContent::findOrFail($id);
        return view('story-contents.edit', compact('story'));
    }


    public function update(Request $request, $id)
    {
        $story = StoryContent::findOrFail($id);

        $request->validate([
            'text_ksa' => 'required',
            'text_idn' => 'required',
            'audio' => 'nullable|file|mimes:mp3,wav,ogg',
        ]);

        $data = $request->only(['text_ksa', 'text_idn']);
        $data['stories_id'] = $story->stories_id;

        if ($request->hasFile('audio')) {
            $audioPath = $request->file('audio')->store('audio', 'public');
            $data['audio'] = $audioPath;
        }

        $story->update($data);

        return redirect()->route('stories.show', $story->stories_id)->with('success', 'Story updated!');
    }


    public function destroy($id)
    {
        $story = StoryContent::findOrFail($id);
        $story->delete();
        return redirect()->route('stories.index')->with('success', 'Story deleted!');
    }
}
