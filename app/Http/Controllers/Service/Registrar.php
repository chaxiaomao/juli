<?php
namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;

class Registrar extends Controller
{
    public function create(array $data)
    {

        $properties = [
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'register_time' => Carbon::now()->toDateTimeString(),
            'register_ip' => $data['register_ip']
        ];
        return User::create($properties);

        $user = new User();
        $user->save();
    }
}