<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class Userscontroller extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at','desc')->get();
        $totalPosts = Post::count();
        $totalComments = Comment::count();
        return view('pages.users.index', compact('users', 'totalPosts', 'totalComments'));
    }
}
