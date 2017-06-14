<?php

namespace App\Tool;

class dataPusher
{
    public $status;
    public $message;

    public function toJson()
    {
        return json_encode($this, JSON_UNESCAPED_UNICODE);
    }
}