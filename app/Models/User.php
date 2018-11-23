<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use League\OAuth2\Server\Exception\OAuthServerException;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'last_login_ip'
    ];

    /**
     * Oatuh2.0 username match column
     *
     * @param  string $username
     * @return object
     */
    public function findForPassport($username)
    {
        $user = $this->where('username', $username)
                     ->orWhere('email', $username)
                     ->first();

        if ($user !== NULL && $user->status == 0) {
            // 正常情况下返回message, 如果想返回{'code' => 401, 'msg' => $message} 需要修改 OAuthServerException
            throw new OAuthServerException('User account is not activated', 6, 'account_inactive', 401);
        }

        return $user;
    }
}



