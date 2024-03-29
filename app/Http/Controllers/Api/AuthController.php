<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Traits\PhotoTrait;

class AuthController extends Controller
{
    use PhotoTrait;

    public function user_login($data){
        $token = user_api()->attempt($data);
        if ($token){
            if (user_api()->user()->status != 'inactive'){
                $user = user_api()->user();
                return apiResponse(['user'=>$user,'token'=>$token]);
            }
            return apiResponse(null,'نأسف لا يمكنك الدخول الا بعد موافقة الادارة . ','422');
        }else{
            return apiResponse(null,'خطأ فى كلمة المرور . ','422');
        }
    }

    public function login(Request $request){
        try {
            $validator = Validator::make($request->all(),[
                'username'=>'required',
                'password'=>'required',
            ],[
                'username.required' => 'اسم المستخدم او رقم الهاتف مطلوب',
                'password.required' => 'كلمة المرور مطلوبة'
            ]);
            if ($validator->fails()){
                return apiResponse(null,$validator->errors()->first(),'422');
            }

            $data = $request->only('username','password');

            $user = User::where('username',$request->username)->first();
            if (! $user){
                $user = User::where('phone',$request->username)->first();
                $data = ['phone'=>$request->username , 'password'=>$request->password];
            }
            if (! $user){
                return apiResponse(null,'رقم الهاتف او اسم المستخدم غير صحيح','422');
            }
            return $this->user_login($data);

        }catch (\Exception $ex){
            return apiResponse($ex->getCode(),$ex->getMessage(),'422');
        }

    }

    //=======================================================================================================
    public function register(Request $request){
        try {
            // validation
            $validator = Validator::make($request->all(),[
                'username'=>'required|unique:users,username',
                'email'=>'required|unique:users,email',
                'phone'=>'required|unique:users,phone',
                'phone_code'=>'required',
                'password'=>'required',
                'name'=>'required'
            ],[
                'username.required' => 'اسم المستخدم مطلوب',
                'username.unique' => 'اسم المستخدم موجود مسبقا',
                'password.required' => 'كلمة المرور مطلوبة',
                'name.required' => 'الاسم مطلوب',
                'phone_code.required' => 'كود الهاتف مطلوب',
                'phone.required' => 'رقم الهاتف مطلوب',
                'phone.unique' => 'رقم الهاتف موجود مسبقا',
                'email.required' => 'البريد الالكترونى مطلوب',
                'email.unique' => 'البريد الالكترونى موجود مسبقا'
            ]);
            if ($validator->fails()){
                return apiResponse(null,$validator->errors()->first(),'422');
            }
            $data = $request->all();
            $data['password'] = Hash::make($request->password);
            if ($request->image && $request->image != null){
                $data['image'] = $this->saveImage($request->image , 'Uploads/User');
            }
            $user = User::create($data);

            if ($user->role == 'admin'){
                $token = admin_api()->login($user); // generate token
            }elseif ($user->role == 'teacher'){
                $token = teacher_api()->login($user); // generate token
            }else{
                $token = user_api()->login($user); // generate token
            }

            $setting = Setting::first();
            $setting->group_number += 1;
            $setting->save();
//            $user->token = $token;
            return apiResponse(['user'=>$user,'token'=>$token]);
        }catch (\Exception $ex){
            return apiResponse($ex->getCode(),$ex->getMessage(),'422');
        }

    }



}
