<?php
namespace App\Http\Controllers\View\Admin;

use App\Http\Controllers\Controller;

class deskController extends Controller
{
    public function getShow()
    {
        return view('admin.desk');
    }
}