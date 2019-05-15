<?php


namespace App\Http\Proxy;


class TokenProxy
{
    protected $http;

    public function __construct(\GuzzleHttp\Client $http)
    {
        $this->http = $http;
    }

    public function login($name, $password)
    {
        if (auth()->attempt(['name' => $name, 'password' => $password])) {
            return $this->proxy('password', [
                'username' => $name,
                'password' => $password,
                'scope'    => ''
            ]);
        }

        return response()->json([
            'status' => 422,
            'messge' => '用户名或密码错误',
            'data' => [],
        ]);
    }

    /**
     * proxy
     * @param $grantType
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function proxy($grantType, array $data = [])
    {
        $data = array_merge($data, [
            'client_id'     => env('PUBLIC_ID'),
            'client_secret' => env('PUBLIC_SECRET'),
            'grant_type'    => $grantType,
        ]);

        $response = $this->http->post(env('APP_URL').'/oauth/token', [
            'form_params' => $data
        ]);

        $token = json_decode((string) $response->getBody(), true);

        return response()->json([
            'token' => $token['access_token'],
            'expires_in' => $token['expires_in'],
        ])->cookie('refreshToken', $token['refresh_token'], 864000, null, null, false, true);
    }
}
