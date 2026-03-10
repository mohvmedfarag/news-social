<?php
namespace App\Utils;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ImageManager{

    public static function uploadImages($request, $post){
        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $file = self::generateImageName($image);
                $path = self::storeImageInLocal($image, 'posts', $file);
                $post->images()->create([
                    'path' => $path,
                ]);
            }
        }
    }
    
    public static function uploadImage($request, $user){
        if ($request->hasFile('image')) {
            $image = $request->image;
            self::deleteImageFromLocal($user->image);
            $file = self::generateImageName($image);
            $path = self::storeImageInLocal($image, 'users', $file);
            $user->update([ 'image' => $path ]);
        }
    }

    public static function deleteImage($post){
        if (!$post) {
            abort(404);
        }
        if ($post->images->count() > 0) {
            foreach($post->images as $image) {
                self::deleteImageFromLocal($image->path);
                $image->delete();
            }
        }
    }

    public static function deleteImageFromLocal($image_path){
        if (File::exists(public_path($image_path))) {
            File::delete(public_path($image_path));
        }
    }

    public static function storeImageInLocal($image, $folder, $file){
        $path = $image->storeAs('uploads/'.$folder, $file, ['disk' => 'uploads']);
        return $path;
    }

    public static function generateImageName($image){
        $file = Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
        return $file;
    }
}
