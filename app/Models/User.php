<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements JWTSubject
{
    protected $hidden = ['password'];
    protected $appends = ['age'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $guarded = [];

    public function getImageAttribute()
    {
        return get_file($this->attributes['image']);
    }

    public function getAgeAttribute()
    {
        $dateDiff = strtotime(date('Y-m-d')) - strtotime(date('Y-m-d', strtotime($this->attributes['birth_date'])));
        return floor($dateDiff / 31556926);
    }


}
