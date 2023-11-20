<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getRecordAttribute()
    {
        return get_user_file($this->attributes['record']);
    }
}
