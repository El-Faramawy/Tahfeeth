<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Traits\PhotoTrait;

class AuthController extends Controller
{
    use PhotoTrait;

    public function user_login($data){
//        $credentials = ['user_name'=>$data['user_name'] , 'password'=>$data['password']];
        $token = user_api()->attempt($data);
        if ($token){
            $user = user_api()->user();
//            $user->token = $token;
            return apiResponse(['user'=>$user,'token'=>$token]);
        }else{
            return apiResponse(null,'خطأ فى الاسم او كلمة المرور . ','409');
        }
    }

    public function teacher_login($data){
//        $credentials = ['user_name'=>$data['user_name'] , 'password'=>$data['password']];
        $token = teacher_api()->attempt($data);
        if ($token){
            $user = teacher_api()->user();
//            $user->token = $token;
            return apiResponse(['user'=>$user,'token'=>$token]);
        }else{
            return apiResponse(null,'خطأ فى الاسم او كلمة المرور . ','409');
        }
    }

    public function admin_login($data){
//        $credentials = ['email'=>$data['user_name'] , 'password'=>$data['password']];
        $token = admin_api()->attempt($data);
        if ($token){
            $user = admin_api()->user();
//            $user->token = $token;
            return apiResponse(['user'=>$user,'token'=>$token]);
        }else{
            return apiResponse(null,'خطأ فى الاسم او كلمة المرور . ','409');
        }
    }

    public function login(Request $request){
        try {
            // validation
            $validator = Validator::make($request->all(),[
                'username'=>'required',
                'password'=>'required',
            ],[
                'username.required' => 'اسم المستخدم مطلوب',
                'password.required' => 'كلمة المرور مطلوبة'
            ]);
            if ($validator->fails()){
                return apiResponse(null,$validator->errors()->first(),'422');
            }

            $data = $request->only('username','password');
            $user = User::where('username',$request->username)->first();

            if ($user){
                if ($user->role == 'user'){
                    return $this->user_login($data);
                }elseif ($user->role == 'teacher'){
                    return $this->teacher_login($data);
                }elseif ($user->role == 'admin'){
                    return $this->admin_login($data);
                }
            }
            else{
                return apiResponse(null,'خطأ فى الاسم او كلمة المرور . ','409');
            }

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

//            $user->token = $token;
            return apiResponse(['user'=>$user,'token'=>$token]);
        }catch (\Exception $ex){
            return apiResponse($ex->getCode(),$ex->getMessage(),'422');
        }

    }



}