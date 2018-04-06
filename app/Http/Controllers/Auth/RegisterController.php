<?php

namespace App\Http\Controllers\Auth;

use App\Mail\UserRegister;
use App\Models\User;
use App\Http\Controllers\Controller;
use Faker\Factory;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath())->with('status', '注册成功');
    }

    protected function registered(Request $request, $user)
    {
        Mail::to($user->email)
            ->queue(new UserRegister($user));
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
            'name' => 'required|string|max:50|unique:users',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:5|confirmed',
            'captcha' => 'required|captcha'
        ], [
            'name.required' => '用户名不能为空',
            'name.max' => '用户名不能超过50个字符',
            'name.unique' => '用户名已经被占用',
            'email.unique' => '邮箱已经被占用',
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式不正确',
            'password.min' => '密码最少六位数',
            'password.required' => '密码不能为空',
            'password.confirmed' => '两次密码不一致',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '验证码不正确',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $faker = Factory::create();

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'sex' => $data['sex'],
            'password' => bcrypt($data['password']),
            'active_token' => str_random(60),
            'avatar' => $faker->imageUrl(120, 120)
        ]);
    }

    protected function redrectTo()
    {
        return 'register';
    }
}
