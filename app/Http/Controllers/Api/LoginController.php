<?php

namespace App\Http\Controllers\Api;

use App\Http\Proxy\TokenProxy;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    protected $proxy;

    public function __construct(TokenProxy $proxy)
    {
        $this->proxy = $proxy;
    }

    public function login(LoginRequest $request, CaptchasController $captchas)
    {
        if (!$captchas->validateCaptcha($request->captcha_key, $request->captcha_code)) {
            return $this->data(422, '验证码错误');
        }

        return $this->proxy->login($request->name, $request->password);
    }
}
