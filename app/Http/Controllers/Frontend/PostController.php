<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Notifications\NewCommentNotify;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug){
        $mainPost = Post::active()->with(['comments' => function($query){
            $query->latest()->limit(3);
        }])->whereSlug($slug)->first();
        if (!$mainPost) {
            return redirect()->route('frontend.index')->withErrors(['message' => 'Post not found.']);
        }
        $mainPost->increment('num_of_views');
        $category = $mainPost->category;
        $postsOfCategory = $category ? $category->posts()->limit(5)->get() : collect([]);
        
        return view('frontend.show', compact('mainPost', 'postsOfCategory', 'category'));
    }

    public function getAllPosts($slug){
        $post = Post::active()->whereSlug($slug)->first();
        $comments = $post->comments()->with('user')->get();
        return response()->json($comments);
    }

    public function saveComment(Request $request){
        $request->validate([
            "user_id" => "required|exists:users,id",
            "comment" => "required|string",
        ]);
        $comment = Comment::create([
            "user_id" => $request->user_id,
            "post_id" => $request->post_id,
            "comment" => $request->comment,
            "ip_address" => $request->ip(),
        ]);

        $post = Post::findOrFail($request->post_id);
        $post->user->notify( new NewCommentNotify($comment, $post) );
        
        $comment->load('user');

        if (! $comment) {
            return response()->json([
                "data" => "failed",
                'status' => 403,
            ]);
        }
        return response()->json([
            'msg' => "comment created successfully",
            'comment' => $comment,
            'status' => 201,
        ]);
    }
}
