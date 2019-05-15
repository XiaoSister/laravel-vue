<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Models\User;

class RegisterController extends Controller
{
    public function registered(RegisterRequest $request, CaptchasController $captchas)
    {
        if (!$captchas->validateCaptcha($request->captcha_key, $request->captcha_code)) {
            return $this->data(422, '验证码错误');
        }

        $user = User::create([
            'name'     => $request->name,
            'password' => bcrypt($request->password),
            'avatar'   => '/images/users/default.png',
            'ip'       => $request->getClientIp(),
        ]);

        $user->avatar = env('APP_URL').$user->avatar;

        return $this->data(200, '注册成功', $user);
    }
}
