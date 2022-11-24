<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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
    public function add()
    {
        return view('admin.users.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8'
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        Alert::success('Success','Data Created Successfully');
        return redirect()->route('admin.users.index');
    }
}
