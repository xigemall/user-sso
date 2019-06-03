<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019-06-02
 * Time: 10:55
 */

namespace Xigemall\UserSso\Services;


use Illuminate\Contracts\Auth\Authenticatable;

class SsoUser implements Authenticatable
{
    // 自增key (字段的名称) 默认id
    protected $incrementKey;
    // 密码字段key
    protected $password;

    protected $user;

    public function __construct(array $user)
    {
        $this->user = $user;
        $this->incrementKey = config('sso.increment_key', 'id');
        $this->password = config('sso.password', 'password');
    }

    public function getAuthIdentifierName()
    {
        return $this->incrementKey;
    }

    public function getAuthIdentifier()
    {
        return $this->user[$this->incrementKey];
    }
    public function getAuthPassword()
    {
        return $this->user[$this->password];
    }
    public function getRememberToken()
    {
        // TODO: Implement getRememberToken() method.
    }
    public function setRememberToken($value)
    {
        // TODO: Implement setRememberToken() method.
    }
    public function getRememberTokenName()
    {
        // TODO: Implement getRememberTokenName() method.
    }

    public function __get($name)
    {
        return $this->user[$name];
    }
    public function __set($name, $value)
    {
        $this->user[$name] = $value;
    }
    public function __isset($name)
    {
        return isset($this->user[$name]);
    }
    public function __unset($name)
    {
        unset($this->user[$name]);
    }
    public function __toString()
    {
        return json_encode($this->user);
    }
}