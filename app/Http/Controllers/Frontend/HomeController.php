<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::active()->with('images')->latest()->paginate(9);
        $greatest = Post::active()->orderBy('num_of_views', 'desc')->take(3)->get();
        $oldest_news = Post::active()->oldest()->take(3)->get();
        $greatest_posts_comments = Post::active()->withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(3)
            ->get();
        $categories = Category::has('posts', '>=', '2')->active()->get();
        $categories_with_posts = $categories->map(function ($category){
            $category->posts = $category->posts()->active()->limit(4)->get();
            return $category;
        });

        // return $categories_with_posts;

        return view('frontend.index', [
            'posts' => $posts,
            'greatest' => $greatest,
            'oldest_news' => $oldest_news,
            'greatest_posts_comments' => $greatest_posts_comments,
            'categories_with_posts' => $categories_with_posts,
        ]);
    }
}
