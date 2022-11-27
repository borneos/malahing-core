<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CloudinaryImage;
use App\Models\BlogCategory;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BlogCategoryController extends Controller
{
    use CloudinaryImage;

    public function index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $categories = BlogCategory::sortable()
                ->where('blog-categories.name', 'like', '%' . $filter . '%')
                ->orWhere('blog-categories.slug', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $categories = BlogCategory::sortable()->paginate(10);
        }
        return view('admin.blog-category.index', compact('categories', 'filter'));
    }

    public function add()
    {
        return view('admin.blog-category.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'slug'     => 'required',
            'image'    => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);

        if ($request->file('image')) {
            $image = $this->UploadImageCloudinary(['image' => $request->file('image'), 'folder' => 'images/blogs']);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        }

        BlogCategory::create([
            'name'        => $request->category,
            'slug'        => $request->slug,
            'description' => $request->description ?? '',
            'image'       => $image_url ?? '',
            'additional_image' => $additional_image ?? ''
        ]);
        Alert::success('Success', 'Data Created Successfully');
        return redirect()->route('admin.blog-category.index');
    }
}
