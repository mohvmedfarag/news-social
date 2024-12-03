<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['post_id', 'path'];
    public function post(){
        $this->belongsTo(Post::class, 'post_id');
    }
}
