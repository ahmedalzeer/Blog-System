<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','national_id','gender'
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
     * FaceBook Provider relation.
     *
     * @relation function
     */
    public function facebookprovider()
    {
        return $this->hasMany('App\FaceBookProvider','id');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment','id');
    }
    public function posts()
    {
        return $this->hasMany('App\Post','id');
    }
}
