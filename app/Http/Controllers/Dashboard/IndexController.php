<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;

class IndexController extends Controller
{
    public function index()
    {
        $usersCount = User::query()->count();
        $postsCount = Post::query()->count();

        return view('dashboard', compact(
            'usersCount',
            'postsCount'
        ));
    }
}
