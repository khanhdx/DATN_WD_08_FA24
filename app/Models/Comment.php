<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = ['post_id', 'user_id', 'content','parent_id', 'is_approved', 'status'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Bình luận con
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // Một bình luận thuộc về một bình luận cha (nếu là trả lời)
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

}