<?php

namespace App\Http\Controllers\Api;

use Gregwar\Captcha\CaptchaBuilder;
use App\Http\Controllers\Controller;
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

        return response()->json(['status' => 200, 'message' => 'success', 'data' => $data]);
    }
}
