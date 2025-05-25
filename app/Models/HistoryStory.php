<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryStory extends Model
{
    protected $table = 'history_story';

    protected $fillable = [
        'similarity_percentage',
        'audio',
        'user_id',
        'story_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function story()
    {
        return $this->belongsTo(Story::class, 'story_id');
    }
}
