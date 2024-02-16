<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements JWTSubject
{
    protected $hidden = ['password'];
    protected $appends = ['age','has_test'];

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
        return get_user_file($this->attributes['image']);
    }
    public function getDashboardImageAttribute()
    {
        return get_file($this->attributes['image']);
    }

    public function getAgeAttribute()
    {
        $dateDiff = strtotime(date('Y-m-d')) - strtotime(date('Y-m-d', strtotime($this->attributes['birth_date'])));
        return floor($dateDiff / 31556926);
    }

    public function tests(){
        return $this->hasMany(Test::class);
    }
    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function getHasTestAttribute(){
        $test_count = $this->tests()->count();
        return $test_count > 0;
    }


}
