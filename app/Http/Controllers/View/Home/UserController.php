<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/6
 * Time: 17:05
 */
namespace App\Http\Controllers\View\Home;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Tool\dataPusher;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getRegister()
    {
        return view('home.register')->with('validate_code', session()->get('validate_code'));
    }

    public function postCreate()
    {
//        $code = Input::get('phone_code');
//        $validator = Validator::make(Input::all(), User::$rules);
//        if ($code) {
//
//        }
        $post_validate_code = Input::get('validate_code');
        $validate_code = session()->get('validate_code');
        if ($post_validate_code == $validate_code) {
            return '200';
        }
    }
}