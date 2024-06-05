<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\PhotoTrait;
use App\Models\MainReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

class AuthController extends Controller
{
    use PhotoTrait;
    //===========================================
    public function profile(Request $request){
        $user = User::with('group.teachers')->where('id',user_api()->user()->id)->first();
        $user->last_report = MainReport::where('type','daily')->latest()->first();
//        $user->token = getToken();
        return apiResponse(['user'=>$user/*,'token'=>getToken()*/]);
    }
    //===========================================
    public function update_profile(Request $request){
        // validation
        $validator = Validator::make($request->all(),[
            'username'=>'required|unique:users,username,'.user_api()->user()->id,
            'email'=>'required|unique:users,email,'.user_api()->user()->id,
            'phone'=>'required|unique:users,phone,'.user_api()->user()->id,
            'phone_code'=>'required',
//            'name'=>'required'
        ],[
            'username.required' => 'اسم المستخدم مطلوب',
            'username.unique' => 'اسم المستخدم موجود مسبقا',
//            'name.required' => 'الاسم مطلوب',
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
        if ($request->password && $request->password != null){
            $data['password'] = Hash::make($request->password);
        }
        $user = User::where('id',user_api()->user()->id)->first();
        $user->update($data);

//        $user->token = $user->token;

        return apiResponse(['user'=>$user/*,'token'=>$user->token*/]);

    }
    //===========================================
    public function update_image(Request $request){
        $user = User::where('id',user_api()->user()->id)->first();
        $data = [];
        if ($request->image && $request->image != null){
            $data['image'] = $this->saveImage($request->image , 'Uploads/User',$user->image);
        }
        $user->update($data);
        return apiResponse(['user'=>$user/*,'token'=>$user->token*/]);
    }
    //=======================================================================================================
    public function logout(Request $request){

        if (!\user_api()->check())
        {
            return apiResponse(null,'logout once or token is not valid');
        }

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
    //=======================================================================================================

    public function delete_image(Request $request)
    {
        $user = user_api()->user();
        $user->update(['image'=>null]);

        if (file_exists($user->image))
            unlink($user->image);

        return apiResponse($user);

    }
}
