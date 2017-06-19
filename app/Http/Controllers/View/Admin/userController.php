<?php
namespace App\Http\Controllers\View\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class userController extends Controller
{
    public function getList()
    {
        $users = User::all()->sortByDesc('created_at');
        return view('admin.user_list')->with('users', $users);
    }

    public function getEdit()
    {
        $user = User::find($_GET['id']);
        return view('admin.user_edit')->with('user', $user);
    }
}