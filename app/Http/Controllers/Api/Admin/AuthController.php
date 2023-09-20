<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhoneToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function logout(Request $request){
        $validator = Validator::make($request->all(), [ // <---
            'token' => 'required',
        ]);
        if ($validator->fails()) {
            return apiResponse(null,$validator->errors(),'422');
        }

        if (!admin_api()->check())
        {
            return apiResponse(null,'logout once or token is not valid');
        }

        PhoneToken::where(['admin_id' => admin_api()->user()->id, 'phone_token' => $request->token])->delete();

        $token = getToken();
        if ($token != null){
            try {
                JWTAuth::setToken($token)->invalidate(); // logout user
                return apiResponse(null,'logout done');
            }catch(TokenInvalidException $e){
                return apiResponse(null,'done');
            }
        }
        else{
            return apiResponse(null,'done');
        }
    }
}
