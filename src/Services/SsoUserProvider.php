<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019-06-02
 * Time: 10:25
 */

namespace Xigemall\UserSso\Services;


use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Xigemall\UserSso\Facades\UserSsoCurl;

class SsoUserProvider implements UserProvider
{
    public function retrieveById($identifier)
    {
    }

    public function retrieveByToken($identifier, $token)
    {
        // TODO: Implement retrieveByToken() method.
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // TODO: Implement updateRememberToken() method.
    }

    public function retrieveByCredentials(array $credentials)
    {
        $url = config('sso.url') . config('sso.current_user_path');
        $user = UserSsoCurl::get($url, [], $credentials);
        if (array_has($user, ['message']) && $user['message'] == 'Unauthenticated.') {
            return null;
        }
        return new SsoUser($user);
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // TODO: Implement validateCredentials() method.
    }

}