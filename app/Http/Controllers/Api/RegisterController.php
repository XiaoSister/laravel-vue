<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Models\User;

class RegisterController extends Controller
{
    public function registered(RegisterRequest $request)
    {
        $captchaData = \Cache::get($request->captcha_key);

        if (!$captchaData) {
            return $this->data(422, '图片验证码已失效');
        }

        if (!hash_equals($captchaData['code'], $request->captcha_code)) {
            // 验证错误就清除缓存
            \Cache::forget($request->captcha_key);

            return $this->data(422, '验证码错误');
        }

        // 清除图片验证码缓存
        \Cache::forget($request->captcha_key);

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
