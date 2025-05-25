<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryContent extends Model
{
    protected $table = 'story';

    protected $fillable = ['text_ksa', 'text_idn', 'audio', 'stories_id'];

    public function storyGroup()
    {
        return $this->belongsTo(Story::class, 'stories_id');
    }
}
