<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function dashboard()
    {
        return view('admin.dashboard', [
            'users' => User::count(),
            'posts' => Post::count(),
            'comments' => Comment::count(),
        ]);
    }

    public function users() { return view('admin.users', ['users' => User::all()]); }
    public function posts() { return view('admin.posts', ['posts' => Post::all()]); }
}