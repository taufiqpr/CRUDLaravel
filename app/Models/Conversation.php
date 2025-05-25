<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['title', 'desc', 'user_id'];

    public function contents()
    {
        return $this->hasMany(ConversationContent::class, 'conversations_id');
    }
}

