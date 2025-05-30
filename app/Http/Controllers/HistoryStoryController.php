<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoryStory;

class HistoryStoryController extends Controller
{
public function index()
{
    $histories = \App\Models\HistoryStory::with('story')
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('histories.index', compact('histories'));
}

public function destroy($id)
{
    $history = HistoryStory::where('user_id', auth()->id())->findOrFail($id);
    $history->delete();

    return redirect()->back()->with('success', 'Riwayat berhasil dihapus.');
}

}
