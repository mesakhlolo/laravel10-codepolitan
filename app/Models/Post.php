<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    // secara default menggunakan table posts (karena eloquent)

    public function comments()
    {
        // SELECT * FROM comments WHERE post_id=$this->id
        return $this->hasMany(Comment::class);
    }

    public function total_comments()
    {
        return $this->comments()->count();
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }


}
