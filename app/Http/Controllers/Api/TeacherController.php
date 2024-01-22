<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\PhotoTrait;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    use PhotoTrait;

    public function createTeacher(Request $request){
        try {
            // validation
            $validator = Validator::make($request->all(),[
                'username'=>'required|unique:teachers,username',
                'email'=>'required|unique:teachers,email',
                'phone'=>'required|unique:teachers,phone',
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
                $data['image'] = $this->saveImage($request->image , 'Uploads/Teacher');
            }
            $teacher = Teacher::create($data);

            return apiResponse(['teacher'=>$teacher],'done');
        }catch (\Exception $ex){
            return apiResponse($ex->getCode(),$ex->getMessage(),'422');
        }

    }

}
