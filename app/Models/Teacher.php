<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['age'];

    public function getAgeAttribute()
    {
        $dateDiff = strtotime(date('Y-m-d')) - strtotime(date('Y-m-d', strtotime($this->attributes['birth_date'])));
        return floor($dateDiff / 31556926);
    }

    public function getDashboardImageAttribute()
    {
        return get_file($this->attributes['image']);
    }
}
