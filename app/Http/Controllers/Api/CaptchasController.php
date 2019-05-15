<?php

namespace App\Http\Controllers\Api;

use Gregwar\Captcha\CaptchaBuilder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CaptchasController extends Controller
{
    public function getCaptchas(CaptchaBuilder $captchaBuilder)
    {
        $key = 'captcha-'.Str::random(15);

        $captcha = $captchaBuilder->build();

        \Cache::put($key, ['code' => $captcha->getPhrase()], 60);

        $data = [
            'captcha_key' => $key,
            'captcha_image' => $captcha->inline()
        ];

        return $this->data(200, 'success', $data);
    }

    public function validateCaptcha($key, $code)
    {
        $captchaData = \Cache::get($key);

        if (!$captchaData) {
            return false;
        }

        if (!hash_equals($captchaData['code'], $code)) {
            // 验证错误就清除缓存
            \Cache::forget($key);

            return false;
        }

        // 清除图片验证码缓存
        \Cache::forget($key);

        return true;
    }
}
