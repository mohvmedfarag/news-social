<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($slug)
    {
        $category = Category::active()->whereSlug($slug)->first();
        if (!$category) {
            return redirect()->back()->with('warning', 'Try again later');
        }
        $posts = $category->posts()->paginate(9);
        return view('frontend.posts-category', ['posts' => $posts, 'category' => $category]);
    }
}
