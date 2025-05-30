<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoryConversation;

class HistoryConversationController extends Controller
{
    public function index()
    {
        $histories = HistoryConversation::with('conversation')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('history_conversations.index', compact('histories'));
    }

    public function destroy($id)
    {
        $history = HistoryConversation::where('user_id', auth()->id())->findOrFail($id);
        $history->delete();

        return redirect()->back()->with('success', 'Riwayat percakapan berhasil dihapus.');
    }
}
