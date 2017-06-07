<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public static $rules = array(
        'phone' => 'required|min:11|unique:users',
        'password' => 'required|alpha_num|between:6,12|confirmed',
        'password_confirmation' => 'required|alpha_num|between:6,12',
    );

}