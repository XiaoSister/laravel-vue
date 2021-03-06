<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class Request extends FormRequest
{
    public function failedValidation(Validator $validator)
    {
        $data = [
            'status'  => 422,
            'message' => '参数验证失败',
            'data'    => $validator->getMessageBag()->all(),
        ];

        exit(json_encode($data));
    }
}
