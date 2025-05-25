<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = ['title', 'desc', 'user_id'];

    public function contents()
    {
        return $this->hasMany(StoryContent::class, 'stories_id');
    }
}
