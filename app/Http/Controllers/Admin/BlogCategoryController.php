<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CloudinaryImage;
use App\Models\BlogCategory;
use App\Models\BlogTags;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    use CloudinaryImage;

    public function index(Request $request)
    {
        $blogtags = BlogTags::all();
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $categories = BlogCategory::sortable()
                ->where('blog-categories.name', 'like', '%' . $filter . '%')
                ->orWhere('blog-categories.slug', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $categories = BlogCategory::sortable()->paginate(10);
        }
        return view('admin.blog-category.index', compact('categories', 'filter', 'blogtags'));
    }

    public function add()
    {
        $blogtags = BlogTags::all();
        return view('admin.blog-category.add', compact('blogtags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'slug'     => 'required',
            'image'    => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);

        $tags = $request->tags;
        foreach ($tags as $tag) {
            if (is_numeric($tag)) {
                $tagArr[] = $tag;
            } else {
                $newTag = BlogTags::create([
                    'tag_name' => $tag,
                    'slug' => Str::slug($tag)
                ]);

                $tagArr[] = $newTag->id;
            }
        }

        if ($request->file('image')) {
            $image = $this->UploadImageCloudinary([
                'image' => $request->file('image'),
                'folder' => 'images/blogs'
            ]);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        }

        BlogCategory::create([
            'name'        => $request->category,
            'slug'        => $request->slug,
            'tags_id'     => implode(',', $tagArr),
            'description' => $request->description ?? '',
            'image'       => $image_url ?? '',
            'additional_image' => $additional_image ?? ''
        ]);
        Alert::success('Success', 'Data Created Successfully');
        return redirect()->route('admin.blog-category.index');
    }

    public function edit(BlogCategory $category)
    {
        $blogtags = BlogTags::all();
        return view('admin.blog-category.edit', [
            'category' => $category,
            'blogtags' => $blogtags
        ]);
    }
    public function update(Request $request, BlogCategory $category)
    {
        $request->validate([
            'category' => 'required',
            'slug'     => 'required',
            'image'    => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);

        if ($request->file('image')) {
            $image = $this->UpdateImageCloudinary([
                'image'         => $request->file('image'),
                'folder'        => 'images/blogs',
                'collection'    => $category
            ]);
            $image_url = $image['url'];
            $additional_image = $image['additional_image'];
        }

        $category->update([
            'name'              => $request->category,
            'slug'              => $request->slug,
            'description'       => $request->description,
            'tags_id'           => implode(',', $request->tags),
            'image'             => $image_url ?? $category->image,
            'additional_image'  => $additional_image ?? $category->image
        ]);
        Alert::success('Success', 'Updated Successfully');
        return redirect()->route('admin.blog-category.index');
    }

    public function delete(BlogCategory $category)
    {
        if ($category->image && $category->additional_image) {
            $key = json_decode($category->additional_image);
            Cloudinary::destroy($key->public_id);
        }
        $category->delete();
        return response()->json(['status' => 200]);
    }
}
