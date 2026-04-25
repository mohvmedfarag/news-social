<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateUserRequest;
use App\Models\User;
use App\Utils\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:users');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = User::query();

        if (request()->filled('keyword')){
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . request('keyword') . '%')
                ->orWhere('email', 'like', '%' . request('keyword') . '%')
                ->orWhere('country', 'like', '%' . request('keyword') . '%');
            });
        }

        if (request()->filled('status')) {
            $query->where('status', request('status'));
        }

        if (request()->filled('sort_by')) {
            $query->orderBy(request()->sort_by, request()->order_by ?? 'asc');
        }

        $users = $query->withCount('posts')->paginate(request()->limit_by ?? 5);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $request->validated();

        try{
            DB::beginTransaction();
            $request->merge([
                'email_verified_at' => $request->email_verified_at == 1? now():null,
            ]);
            $user = User::create($request->except('_token', 'image', 'password_confirmation'));

            ImageManager::uploadImage($request, $user);

            DB::commit();

            return redirect()->back()->with('success','user created successfully');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
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
        $user = User::findOrFail($id);
        ImageManager::deleteImageFromLocal($user->image);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success','user deleted successfully');
    }

    public function changeStatus(User $user){
        if($user->status == true){
            $user->status = false;
            $user->save();
            return redirect()->back()->with('success','user blocked successfully');
        }

        $user->status = true;
        $user->save();
        return redirect()->back()->with('success','user unblocked successfully');
    }
}
