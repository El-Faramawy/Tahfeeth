<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\SendEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ForgetPasswordController extends Controller
{
    use SendEmail;

    public function get_code(Request $request)
    {
        $validator = Validator::make($request->all(), [ // <---
            'email' => 'required|exists:users,email',
        ], [
            'email.required' => 'البريد الالكترونى مطلوب',
            'email.exists' => 'البريد الالكترونى غير موجود'
        ]);
        if ($validator->fails()) {
            return apiResponse(null, $validator->errors()->first(), '422');
        }
        $user = User::where('email', $request->email)->first();
        $code = rand('000000', '999999');
        $user->update([
            'code' => $code,
            'code_created_at' => date('Y-m-d H:i:s')
        ]);
        if ($user) {
            if (filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
                $this->send_EmailFun($request->email, $code . ' رمز تاكيد بريدك الالكترونى هو ', 'رمز تأكيد كلمة بريد الالكترونى لبرنامج مقارئ السفرة');
                return apiResponse($user, 'تم ارسال الكود على بريدك الالكترونى بنجاح');
            } else {
                return apiResponse(null, 'البريد الالكترونى غير فعال', 410);
            }
        } else {
            return apiResponse(null, 'البريد الالكترونى غير صحيح', 409);
        }
    }

    //*********************************************************************
    public function ConfirmCode(Request $request)
    {
        $user = User::where('email', $request->email)->where('code', $request->code)->first();
        if ($user && $user->code != null) {
            $codeSentTimeInTime = strtotime(date('Y-m-d H:i:s')) - strtotime($user->code_created_at);
            $codeSentTimeInMinutes = date('i', $codeSentTimeInTime);
            if ($codeSentTimeInMinutes >= 10 ){
                return apiResponse(null, 'نأسف انتهت صلاحية الكود قم بتاكيد البريد الالكترونى مرة اخرى','422');
            }
            $user->code = null;
            $user->save();
            return apiResponse($user, 'yes');
        } else {
            return apiResponse(null, 'خطأ فى الكود','422');
        }
    }//end fun

    //*********************************************************************

    public function UpdatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [ // <---
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'البريد الالكترونى مطلوب',
            'password.required' => 'كلمة المرور مطلوبة'
        ]);
        if ($validator->fails()) {
            return apiResponse(null, $validator->errors()->first(), '422');
        }
        $user = User::where('email', $request->email)->first();
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        return apiResponse($user, 'done');
    }//end fun
}
