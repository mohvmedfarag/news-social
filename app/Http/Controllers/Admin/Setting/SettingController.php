<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Utils\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.settings.index', compact("setting"));
    }

    public function update(Request $request, $id)
    {
        try {
            $setting = Setting::findOrFail($id);

            // Validation
            $request->validate([
                'site_name'   => 'nullable|string|max:255',
                'facebook'    => 'nullable|url',
                'instagram'   => 'nullable|url',
                'youtube'     => 'nullable|url',
                'email'       => 'nullable|string',
                'phone'       => 'nullable|string|max:20',
                'country'     => 'nullable|string|max:100',
                'city'        => 'nullable|string|max:100',
                'street'      => 'nullable|string|max:255',
                'small_desc'  => 'nullable|string',
                'logo'        => 'nullable|image|mimes:jpg,jpeg,png,svg',
                'favicon'     => 'nullable|image|mimes:jpg,jpeg,png,ico,svg',
            ]);

            // Begin database transaction
            DB::beginTransaction();

            // Handle logo upload
            if ($request->hasFile('logo')) {
                // Delete old logo if exists
                if ($setting->logo) {
                    ImageManager::deleteImageFromLocal('assets/front-end/' . $setting->logo);
                }

                $logo = $request->file('logo');
                $logoName = ImageManager::generateImageName($logo);
                $logoPath = ImageManager::storeImageInLocal($logo, 'settings', $logoName);
                $setting->logo = $logoPath;
            }

            // Handle favicon upload
            if ($request->hasFile('favicon')) {
                // Delete old favicon if exists
                if ($setting->favicon) {
                    ImageManager::deleteImageFromLocal('assets/front-end/' . $setting->favicon);
                }

                $favicon = $request->file('favicon');
                $faviconName = ImageManager::generateImageName($favicon);
                $faviconPath = ImageManager::storeImageInLocal($favicon, 'settings', $faviconName);
                $setting->favicon = $faviconPath;
            }

            // Update other fields
            $setting->site_name = $request->site_name;
            $setting->facebook = $request->facebook;
            $setting->instagram = $request->instagram;
            $setting->youtube = $request->youtube;
            $setting->email = $request->email;
            $setting->phone = $request->phone;
            $setting->country = $request->country;
            $setting->city = $request->city;
            $setting->street = $request->street;
            $setting->small_desc = $request->small_desc;

            // Save the setting
            $setting->save();

            // Commit the transaction
            DB::commit();

            return redirect()->route('admin.settings.index')
                ->with('success', 'Setting updated successfully!');

        } catch (ValidationException $e) {
            // Re-throw validation exception to show validation errors
            throw $e;

        } catch (\Exception $e) {
            // Rollback the transaction if something went wrong
            DB::rollBack();

            // Redirect back with error message
            return redirect()->back()
                ->with('error', 'An error occurred while updating the setting. Please try again.')
                ->withInput();
        }
    }
}
