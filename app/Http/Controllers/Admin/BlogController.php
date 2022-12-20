<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
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
}
