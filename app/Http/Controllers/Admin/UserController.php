<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        if (!empty($filter)) {
            $users = User::sortable()
                ->where('users.name', 'like', '%' . $filter . '%')
                ->orWhere('users.email', 'like', '%' . $filter . '%')
                ->paginate(10);
        } else {
            $users = User::sortable()->paginate(10);
        }
        return view('admin.users.index', compact('users', 'filter'));
    }
}
