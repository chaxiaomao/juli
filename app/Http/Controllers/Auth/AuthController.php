<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Tool\userForm;
//use Validator;
use Illuminate\Http\Request;
//use App\Http\Requests\userLoginRequest;
//use App\Http\Requests\userRegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getRegister()
    {
        return view("home.register");
    }

    public function getLogin(Request $request)
    {
        return view('home.login');
    }

    public function postRegister(Request $request){
        //验证通过 注册用户
        $data = $request->all();
        if ($data['validate_code'] != session()->get('validate_code')) {
            echo '<script>alert("验证码错误");history.go(-1);</script>';
            exit;
        }
        $user_form = new userForm($data['phone'], $data['password'], $data['password_confirmation']);
        $result = $user_form->check();//格式验证
        if ($result->status == 1) {
            echo '<script>alert("'. $result->message . '");history.go(-1)</script>';
            exit;
        }
        if ($result->status == 0) {
            if (User::where('phone', $data['phone'])->first()) {
                echo '<script>alert("手机已被注册");history.go(-1);</script>';
                exit;
            }
            $user =  new User();
            $user->phone = $data['phone'];
            $user->password = md5('juli' . $data['password']);
            $user->username = $request->session()->get('user.wechat')['nickname'];
            $user->avatar = $request->session()->get('user.wechat')['avatar'];
            $user->openid = $request->session()->get('user.wechat')['id'];
            $user->ip = $request->ip();
            $user->save();
            $user->agent_id = $user->id;
            $user->save();
            session()->put('user.user_id', $user->id);
            return redirect('/at/home/index');
        }

    }

    public function postLogin(Request $request)
    {
        if (session()->get('user.user_id')) {
            return '<script>alert("你已经登录");location.href = "/at/home/index";</script>';
        }
        //验证通过 登陆用户
        $data = $request->all();
        if ($data['validate_code'] != session()->get('validate_code')) {
            echo '<script>alert("验证码错误");history.go(-1);</script>';
            exit;
        }
        $user_form = new userForm($data['phone'], $data['password'], $data['password']);
        $result = $user_form->check();//格式验证
        if ($result->status == 1) {
            echo '<script>alert("'. $result->message . '");history.go(-1);</script>';
            exit;
        }
        if ($result->status == 0) {
            $user = User::where('phone', $data['phone'])->first();
            if ($user) {
                if ($user->password != md5('juli' . $data['password'])) {
                    echo '<script>alert("密码不正确");history.go(-1);</script>';
                    exit;
                }
                $user->update([
                    'ip' => $request->ip(),
                ]);
                session()->put('user.user_id', $user->id);
                return redirect('/at/home/index');
            } else {
                echo '<script>alert("账号不存在");history.go(-1);</script>';
                exit;
            }
        }

    }
}
