<?php
namespace App\Tool;

//use dataPusher;

class userForm
{
    private $phone;
    private $password;
    private $password_confirmation;

    public function __construct($phone, $password, $password_confirmation)
    {
        $this->phone = $phone;
        $this->password = $password;
        $this->password_confirmation = $password_confirmation;
    }

    public function check()
    {
        $data_pusher = new dataPusher();
        if ($this->phone == '') {
            $data_pusher->status = 1;
            $data_pusher->message = "手机不能为空";
            return $data_pusher;
            exit;
        }
        if ($this->password == '') {
            $data_pusher->status = 1;
            $data_pusher->message = "密码不能为空";
            return $data_pusher;
            exit;
        }
        if ($this->password_confirmation == '') {
            $data_pusher->status = 1;
            $data_pusher->message = "确认密码不能为空";
            return $data_pusher;
            exit;
        }
        if ($this->phone != 1 && strlen($this->phone) != 11) {
            $data_pusher->status = 1;
            $data_pusher->message = "手机格式不正确";
            return $data_pusher;
            exit;
        }
        if (strlen($this->password) < 6) {
            $data_pusher->status = 1;
            $data_pusher->message = "密码长度不能少于6位";
            return $data_pusher;
            exit;
        }
        if ($this->password != $this->password_confirmation) {
            $data_pusher->status = 1;
            $data_pusher->message = "两次密码不一致";
            return $data_pusher;
            exit;
        }
        $data_pusher->status = 0;
        return $data_pusher;
    }
}