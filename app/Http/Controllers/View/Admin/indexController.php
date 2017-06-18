<?php
namespace App\Http\Controllers\View\Admin;

use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function getIndex()
    {
        return view('admin.index');
    }
}