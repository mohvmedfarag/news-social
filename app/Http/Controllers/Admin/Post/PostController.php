<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Utils\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:posts');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Post::query();

        if (request()->filled('keyword')){
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . request('keyword') . '%');
                // ->orWhere('email', 'like', '%' . request('keyword') . '%')
                // ->orWhere('country', 'like', '%' . request('keyword') . '%');
            });
        }

        if (request()->filled('status')) {
            $query->where('status', request('status'));
        }

        if (request()->filled('sort_by')) {
            $query->orderBy(request()->sort_by, request()->order_by ?? 'asc');
        }

        $posts = $query->with('category')->paginate(request()->limit_by ?? 5);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $request->validated();
        try {
            DB::beginTransaction();
            $post = Post::create([
                'title' => $request->title,
                'desc'  => $request->desc,
                'small_desc' => $request->small_desc,
                'comment_able' => $request->comment_able,
                'status' => $request->status,
                'admin_id' => Auth::guard('admin')->user()->id,
                'category_id' => $request->category_id
            ]);
            ImageManager::uploadImages($request, $post);
            DB::commit();
            Cache::forget('read_more_posts');
            Cache::forget('latestPosts');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['errors', $e->getMessage()]);
        }

        return redirect()->back()->with('success', 'post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        ImageManager::deleteImage($post);
        $post->delete();
        return redirect()->back()->with('success', 'post deleted successfully');
    }

    public function changeStatus(Post $post)
    {
        if($post->status == true){
            $post->status = false;
            $post->save();
            return redirect()->back()->with('success','post changed successfully');
        }

        $post->status = true;
        $post->save();
        return redirect()->back()->with('success','post changed successfully');
    }
}
