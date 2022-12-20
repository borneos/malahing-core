<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CloudinaryImage;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class BlogController extends Controller
{
    use CloudinaryImage;

    public function index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $blogs = Blog::sortable()
                ->where('blogs.title', 'like', '%' . $filter . '%')
                ->orWhere('blogs.author', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $blogs = Blog::sortable()->paginate(10);
        }
        return view('admin.blogs.index', compact('blogs', 'filter'));
    }

    public function add()
    {
        return view('admin.blogs.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required',
            'short_description' => 'required',
            'description'       => 'required',
            'image'             => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);

        if ($request->file('image')) {
            $image = $this->UploadImageCloudinary([
                'image' => $request->file('image'),
                'folder' => 'images/blogs'
            ]);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        }

        Blog::create([
            'title'             => $request->title,
            'short_description' => $request->short_description,
            'description'       => $request->description,
            'author'            => Auth::user()->name,
            'status'            => 1,
            'image'             => $image_url ?? '',
            'additional_image'  => $additional_image ?? ''
        ]);
        Alert::success('Success', 'Data Created Succesfully');
        return redirect()->route('admin.blogs.index');
    }
}
