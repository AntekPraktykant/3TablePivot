<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    private function appRoles()
    {
        return $this->hasMany('App\AppRoleUser'); // dla ->pluck('app_id', 'role_id') LogicException with message 'App/User::appRoles must return a relationship instance.';
    }
    public function getAppRoles()
    {
        return $this->appRoles()->pluck('role_id', 'app_id');
    }


    public function apps()
    {

    }
}