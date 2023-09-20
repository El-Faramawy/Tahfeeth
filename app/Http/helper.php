<?php


// ============================================================
if (!function_exists('user_api')) {
    function user_api()
    {
        return auth()->guard('user_api');
    }
}
// ============================================================
if (!function_exists('teacher_api')) {
    function teacher_api()
    {
        return auth()->guard('teacher_api');
    }
}
// ============================================================
if (!function_exists('admin_api')) {
    function admin_api()
    {
        return auth()->guard('admin_api');
    }
}

// ============================================================
if (!function_exists('get_file')) {
    function get_file($file)
    {
        if (!is_null($file))
            return asset($file);
        else
            return asset('Admin/imgs/default.jpg');

    }
}
//===================  apiResponse ===========================
if (!function_exists('apiResponse')) {
    function apiResponse($data = '',$message = '',$code = 200,$status = '200') {
        return response()->json(['data'=>$data,'message'=>$message,'code'=>intval($code)],$status);
    }
}

//===================  getToken ===========================
if (!function_exists('getToken')) {
    function getToken() {
        $token = null;
        if (request()->header('auth_token') && request()->header('auth_token') != null)
            $token = request()->header('auth_token');
        elseif(request()->get('auth_token') && request()->get('auth_token') != null)
            $token = request()->get('auth_token');
        elseif(request()->auth_token && request()->auth_token != null)
            $token = request()->auth_token;
        return $token;
    }
}

