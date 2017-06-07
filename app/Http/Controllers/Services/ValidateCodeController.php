<?php
namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tool\ValidateCode;
use App\Tool\dataPusher;

class ValidateCodeController extends Controller
{
    public function create(Request $request)
    {
        $validateCode = new ValidateCode;
        $request->session()->put('validate_code', $validateCode->getCode());
        return $validateCode->doimg();
    }
}