<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:role_superadmin']);
    }

    public function index()
    {
        $users = User::all()->sortBy('name');

        return view('admin.index', compact('users'));
    }

    public function storeuser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:users|min:3|max:64',
            'email' => 'required|email',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('admin.index')->with('success', 'User successfully added');
    }

    public function deleteuser(Request $request)
    {
        $user = User::find($request->userid);
        $user->delete();
        return redirect()->route('admin.index')->with('success', 'User successfully deleted');
    }

    public function setpassuser(Request $request)
    {

        return redirect()->route('admin.index')->with('success', 'Password successfully changed');
    }
}
