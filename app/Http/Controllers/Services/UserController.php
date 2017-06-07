<?php
namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function postRegister(Request $request)
    {
//        $_POST['validate_code'];
        $post_validate_code = $request->input('validate_code', '');
        $validate_code = $request->session()->get('validate_code');
        if ($post_validate_code == $validate_code) {
            return '0';
        } else {
            return $post_validate_code . "," . $validate_code;
        }
    }
}