<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Utils\ImageManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\TryCatch;

class ProfileController extends Controller
{
    public function index()
    {
        $posts = Post::active()->with(['images'])->where('user_id', auth()->user()->id)->latest()->get();
        return view('frontend.dashboard.profile', compact('posts'));
    }
    public function sharePost(PostRequest $request)
    {
        $request->validated();
        try {
            DB::beginTransaction();
            $this->commentAble($request);
            $request->merge([
                'user_id' => auth()->user()->id,
            ]);

            $post = Post::create($request->except('_token', 'images'));
            ImageManager::uploadImages($request, $post);
            DB::commit();
            Cache::forget('read_more_posts');
            Cache::forget('latestPosts');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['errors', $e->getMessage()]);
        }

        Session::flash('success', 'post created successfully');
        return redirect()->back();
    }

    public function editPost($slug)
    {
        $post = Post::with(['images'])->whereSlug($slug)->first();
        if (!$post) {
            abort(404);
        }
        return view('frontend.dashboard.edit', compact('post'));
    }

    public function updatePost(PostRequest $request)
    {
        $request->validated();
        try {
            DB::beginTransaction();
            $this->commentAble($request);
            $post = Post::findOrFail($request->post_id);
            $post->update($request->except(['_token', 'images', 'post_id']));
            if ($request->hasFile('images')) {
                ImageManager::deleteImage($post);
                ImageManager::uploadImages($request, $post);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['errors', $e->getMessage()]);
        }
        return redirect()->route('frontend.dashboard.profile')->with('success', 'post updated successfully!');
    }
    private function commentAble($request)
    {
        $request->comment_able == "on" ? $request->merge(['comment_able' => 1]) : $request->merge(['comment_able' => 0]);
        return $request;
    }

    public function deletePost(Request $request)
    {
        $post = Post::where('slug', $request->slug)->first();
        ImageManager::deleteImage($post);
        $post->delete();
        return redirect()->back()->with('success', 'Post Deleted Successfully');
    }
    public function getComments($id)
    {
        $comments = Comment::with(['user'])->where('post_id', $id)->get();
        if (!$comments) {
            return response()->json([
                'msg' => 'No Comments',
            ]);
        }

        return response()->json([
            'data' => $comments,
        ]);
    }
    public function deletePostImage($id, Request $request)
    {
        $image = Image::findOrFail($id);
        if (!$image) {
            return response()->json([
                'status' => 404,
                'msg' => 'Image not found',
            ]);
        }
        ImageManager::deleteImageFromLocal($image->path);
        $image->delete();
        return response()->json([
            'msg' => 'Image deleted successfully!',
            'status' => 201,
        ]);
    }
}
