<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['username', 'ip'];

    public static $rules = array(
        'phone' => 'required|min:11|unique:users',
        'password' => 'required|alpha_num|between:6,12|confirmed',
        'password_confirmation' => 'required|alpha_num|between:6,12',
    );

}