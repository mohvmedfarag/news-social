<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function getPosts(){
        $query = Post::query()->with(['user', 'category', 'admin'])->activeUser()->activeCategory()->active();

        $posts = clone $query->get();
        $latest_posts        = $this->latestPosts(clone $query);
        $oldest_posts        = $this->latestPosts(clone $query);
        $popular_posts       = $this->latestPosts(clone $query);
        $most_read_posts     = $this->latestPosts(clone $query);
        $category_with_posts = $this->latestPosts( $query);

        return response()->json([
            'all_posts' => PostResource::collection($posts),
            'latest_posts' => $latest_posts,
            'oldest_posts' => $oldest_posts,
            'popular_posts' => $popular_posts,
            'most_read_posts' => $most_read_posts,
            'category_with_posts' => $category_with_posts,
        ]);
    }

    public function latestPosts($query){
        $latest_posts = $query->latest()->take(4)->get();
        return $latest_posts;
    }

    public function oldestPosts($query){
        $oldest_posts = $query->oldest()->take(4)->get();
        return $oldest_posts;
    }

    public function popularPosts($query){
        $popular_posts = $query->withCount('comments')->orderBy('comments_count', 'desc')->take(3)->get();
        return $popular_posts;
    }

    public function mostReadPosts($query){
        $most_read_posts = $query->orderBy('num_of_views', 'desc')->take(4)->get();
        return $most_read_posts;
    }

    public function categoryWithPosts($query){
        $categories = Category::get();

        $category_with_posts = $categories->map(function($category){
            $category->posts = $category->posts()->active()->limit(4)->get();
            return $category;
        });

        return $category_with_posts;
    }
}
