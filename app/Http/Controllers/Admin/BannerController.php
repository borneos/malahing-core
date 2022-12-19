<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CloudinaryImage;
use App\Models\Banners;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BannerController extends Controller
{
    use CloudinaryImage;

    public function index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $banners = Banners::sortable()
                ->where('banners.title', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $banners = Banners::sortable()->paginate(10);
        }
        return view('admin.banners.index', compact('banners', 'filter'));
    }

    public function add()
    {
        return view('admin.banners.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);

        if ($request->file('image')) {
            $image = $this->UploadImageCloudinary([
                'image'  => $request->file('image'),
                'folder' => 'images/banners'
            ]);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        }

        Banners::create([
            'title'             => $request->title,
            'image'             => $image_url ?? '',
            'additional_image'  => $additional_image ?? '',
            'status'            => 1
        ]);
        Alert::success('Success', 'Data Created Successfully');
        return redirect()->route('admin.banners.index');
    }

    public function banner_status(Request $request)
    {
        $banners = Banners::withoutGlobalScopes()->find($request->id);
        $banners->status = $request->status;
        $banners->save();
        Alert::success('Success', 'Update Successfully');
        return redirect()->route('admin.banners.index');
    }

    public function edit(Banners $banner)
    {
        return view('admin.banners.edit', [
            'banner' => $banner
        ]);
    }

    public function update(Request $request, Banners $banner)
    {
        $request->validate([
            'title'     => 'required',
            'image'     => 'image|mimes:jpeg,png,svg|max:8192'
        ]);

        if ($request->file('image')) {
            $image = $this->UpdateImageCloudinary([
                'image'     => $request->file('image'),
                'folder'    => 'images/banners',
                'collection' => $banner
            ]);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        }

        $banner->update([
            'title'             => $request->title,
            'image'             => $image_url ?? $banner->image,
            'additional_image'  => $additional_image ?? $banner->additional_image
        ]);

        Alert::success('Success', 'Updated Successfully');
        return redirect()->route('admin.banners.index');
    }

    public function delete(Banners $banner)
    {
        if ($banner->image && $banner->additional_image) {
            $key = json_decode($banner->additional_image);
            Cloudinary::destroy($key->public_id);
        }
        $banner->delete();
        return response()->json(['status' => 200]);
    }
}
