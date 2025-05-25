<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StoryContent;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryContentApiController extends Controller
{
    public function index()
    {
        $stories = StoryContent::with('storyGroup')->paginate(10);
        return response()->json($stories);
    }

    public function show($id)
    {
        $story = StoryContent::with('storyGroup')->find($id);

        if (!$story) {
            return response()->json(['message' => 'Story content not found'], 404);
        }

        return response()->json($story);
    }

    public function store(Request $request, $storyId)
    {
        $request->validate([
            'text_ksa' => 'required|string',
            'text_idn' => 'required|string',
            'audio' => 'required|file|mimes:mp3,wav,ogg',
        ]);

        $story = Story::find($storyId);
        if (!$story) {
            return response()->json(['message' => 'Story not found'], 404);
        }

        $audioPath = $request->file('audio')->store('audio', 'public');

        $storyContent = StoryContent::create([
            'text_ksa' => $request->text_ksa,
            'text_idn' => $request->text_idn,
            'audio' => $audioPath,
            'stories_id' => $storyId,
        ]);

        return response()->json([
            'message' => 'Story content created successfully',
            'data' => $storyContent
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $story = StoryContent::find($id);

        if (!$story) {
            return response()->json(['message' => 'Story content not found'], 404);
        }

        $request->validate([
            'text_ksa' => 'required|string',
            'text_idn' => 'required|string',
            'audio' => 'nullable|file|mimes:mp3,wav,ogg',
        ]);

        $data = $request->only(['text_ksa', 'text_idn']);
        $data['stories_id'] = $story->stories_id;

        if ($request->hasFile('audio')) {
            $audioPath = $request->file('audio')->store('audio', 'public');
            $data['audio'] = $audioPath;
        }

        $story->update($data);

        return response()->json([
            'message' => 'Story content updated successfully',
            'data' => $story
        ]);
    }

    public function destroy($id)
    {
        $story = StoryContent::find($id);

        if (!$story) {
            return response()->json(['message' => 'Story content not found'], 404);
        }

        $story->delete();

        return response()->json(['message' => 'Story content deleted successfully']);
    }
}
