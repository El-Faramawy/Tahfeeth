<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Session;

class SessionController extends Controller
{
    public function sessions(){
        $data = Session::all();
        return apiResponse($data);
    }

}
