<?php

namespace App\Http\Controllers\Auth;

use App\Mail\UserRegister;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function activeAccount($token)
    {
        if ($user = User::where('active_token', $token)->first()) {
            $user->is_active = 1;

            $user->active_token = str_random(60);
            $user->save();

            return view('hint.success', ['status' => "{$user->name} 账户激活成功！", "url" => url('login')]);
        }
    }

    public function sendActiveMail($id)
    {
        if ($user = User::find($id)) {
            Mail::to($user->email)
                ->queue(new UserRegister($user));

            return view('hint.success', ['status' => '发送邮件成功', 'url' => route('login')]);
        }

        return view('hint.error', ['status' => '用户名或者密码错误']);
    }
}
