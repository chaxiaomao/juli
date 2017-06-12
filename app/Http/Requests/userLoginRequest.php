<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class userLoginRequest extends Request
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
        return [
            //再这里对表单提交字段进行过滤
            'phone' => 'required|min:11|max:11',
            'password' => 'required|min:6|max:16'
        ];
    }

    public function sanitize()
    {
        return $this->all();
    }
}
