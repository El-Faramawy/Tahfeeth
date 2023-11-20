<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'settings';
    protected $appends = ['reservation_open'];

    public function getReservationOpenAttribute()
    {
        $setting = Setting::first();
        if ( $setting->group_limit > $setting->group_number
            && $setting->start_date <= date('Y-m-d')
            && $setting->end_date >= date('Y-m-d')
        ) {
            return true;
        }
        return false;
    }

    public function getLogoAttribute(){
        return  get_file($this->attributes['logo']);
    }
    public function getFavIconAttribute(){
        return  get_file($this->attributes['fav_icon']);
    }
}
