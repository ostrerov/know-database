<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('roles:Администратор');
    }

    public function index()
    {
        $usersCount = User::count();

        return view('pages.dashboard.users.index', compact(
            'usersCount'
        ));
    }

    public function createUser()
    {
        return view('pages.dashboard.users.add');
    }
}
