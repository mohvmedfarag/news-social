<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = [];

    public function user(){
       return $this->belongsTo(User::class, 'user_id');
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class, 'post_id');
    }
    public function images(){
        return $this->hasMany(Image::class, 'post_id');
    }

    // Define the sluggable configuration
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }

    public function scopeActive($query){
        $query->where('status', 1);
    }
}
