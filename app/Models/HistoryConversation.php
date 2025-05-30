<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryConversation extends Model
{
    use HasFactory;

    protected $table = 'history_conversations';

    protected $fillable = [
        'user_id',
        'conversation_id',
        'room_id',
        'similarity_percentage',
        'audio',
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}
