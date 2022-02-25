<?php

namespace App\Http\Controllers;

use App\Models\User;
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
}
