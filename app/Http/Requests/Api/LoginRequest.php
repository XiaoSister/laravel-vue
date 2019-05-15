<?php

namespace App\Http\Requests\Api;

class LoginRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'         => 'required|between:4,24|string',
            'password'     => 'required|string|min:6',
            'captcha_key'  => 'required|string',
            'captcha_code' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => '用户名不能为空。',
            'name.between'          => '用户名必须介于 4 - 24 个字符之间。',
            'name.string'           => '用户名必须是字符串。',
            'name.unique'           => '用户名已被占用，请重新填写',
            'password.required'     => '密码不能为空。',
            'password.min'          => '密码最低6位。',
            'password.string'       => '密码必须是字符串。',
            'captcha_key.required'  => '验证码的key。',
            'captcha_key.string'    => '验证码的key。',
            'captcha_code.required' => '验证码的code。',
            'captcha_code.string'   => '验证码的code。',
        ];
    }
}
