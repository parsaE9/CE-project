<?php

namespace App\Services;

use function PHPUnit\Framework\isNull;

class AuthTokenService
{
    private static AuthTokenService $instance;

    private string $key , $secret;

    private function __construct(){}

    public function grantToken($username, $password){
        $params = [
            'grant_type' => 'password',
            'username' => $username,
            'password' => $password,
        ];

        return $this->oAuthTokenPostRequest($params);
    }

    public function refreshAccessToken($refreshToken)
    {
        $params = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
        ];

        return $this->oAuthTokenPostRequest($params);
    }

    //TODO: move this function to AuthRequestClass
    private function oAuthTokenPostRequest($params){
        $params = array_merge([
            'client_id' => $this->key,
            'client_secret' => $this->secret,
            'scope' => '*',
        ], $params);

        $proxy = \Request::create('oauth/token', 'post', $params);

        $resp = json_decode(app()->handle($proxy)->getContent() , true);

        return $resp;

    }

    public static function getInstance() : AuthTokenService{
        if (!isset(self::$instance)){
            self::$instance = new static();
            self::$instance->key = env("PASSWORD_CLIENT_ID");
            self::$instance->secret = env("PASSWORD_CLIENT_SECRET");
        }

        return self::$instance;
    }

}