<?php

namespace App\Http\Requests;

use Config;
use App\Http\Requests\Request;

class userRegisterRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //自定义的电话号码正则表达式
        //$regex = Config::get('constant.phone_number_regex');
        return [
            //对注册表单提交的信息进行验证
            "phone" => ['required','min:3','max:16','unique:users'],
            "password" => ['required','min:6','max:16','confirmed'],
        ];
    }

    public function sanitize()
    {
        return $this->all();
    }
}
