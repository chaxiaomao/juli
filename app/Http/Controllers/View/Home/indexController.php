<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        echo url('/home');
        echo '这是首页';
    }
}