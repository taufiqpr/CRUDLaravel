<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConversationContent extends Model
{
    protected $table = 'conversation';

    protected $fillable = ['text_ksa', 'text_idn', 'audio', 'speaker', 'conversations_id'];

    public function conversationGroup()
    {
        return $this->belongsTo(Conversation::class, 'conversations_id');
    }
}

