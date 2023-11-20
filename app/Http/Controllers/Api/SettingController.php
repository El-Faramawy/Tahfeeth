<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Models\Setting;

class SettingController extends Controller
{
    public function setting(){
        $setting = Setting::first();
        return apiResponse($setting);
    }

}
