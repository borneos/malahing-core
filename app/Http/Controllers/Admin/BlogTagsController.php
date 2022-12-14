<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BlogTags;
use Illuminate\Http\Request;

class BlogTagsController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $tags = BlogTags::sortable()
                ->where('blog-tags.tag_name', 'like', '%' . $filter . '%')
                ->orWhere('blog-tags.slug', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $tags = BlogTags::sortable()->paginate(2);
        }
        return view('admin.blog-tags.index', compact('tags', 'filter'));
    }
}
