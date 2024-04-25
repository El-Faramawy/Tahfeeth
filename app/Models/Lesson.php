<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getImage1Attribute()
    {
        return dashboard_file($this->attributes['image1']);
    }
    public function getImage2Attribute()
    {
        return dashboard_file($this->attributes['image2']);
    }
    public function getVoiceAttribute()
    {
        return dashboard_file($this->attributes['voice']);
    }
    public function getVideoAttribute()
    {
        return dashboard_file($this->attributes['video']);
    }
}
