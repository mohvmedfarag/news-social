<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate(['search' => 'nullable|string']);
        $keyword = strip_tags($request->search);
        $posts = Post::active()->where('title', 'like', "%$keyword%")
        ->orWhere('desc', 'like', "%$keyword%")
        ->paginate(9);
        return view('frontend.search', compact('posts'));
        
    }
}
