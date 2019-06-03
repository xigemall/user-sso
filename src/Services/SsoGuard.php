<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019-06-01
 * Time: 22:43
 */

namespace Xigemall\UserSso\Services;


use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;

class SsoGuard implements Guard
{
    use GuardHelpers;

    protected $authorizationKey = 'Authorization';
    protected $provider;

    public function __construct(UserProvider $provider)
    {
        $this->provider = $provider;
    }

    public function user()
    {
        if (!is_null($this->user)) {
            return $this->user;
        }
        $token = $this->getToken();
        if ($token) {
            $this->user = $this->provider->retrieveByCredentials([$this->authorizationKey => $token]);
        }
        return $this->user;
    }

    public function validate(array $credentials = [])
    {
        return true;
    }

    protected function getToken()
    {
        return request()->header($this->authorizationKey);
    }
}