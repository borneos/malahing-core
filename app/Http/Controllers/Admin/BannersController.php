<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CloudinaryImage;
use App\Models\Banners;
use Illuminate\Http\Request;

class BannersController extends Controller
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
}
