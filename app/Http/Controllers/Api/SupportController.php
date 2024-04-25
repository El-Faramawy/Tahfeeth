<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupportController extends Controller
{
    public function support(Request $request){
        $validator = Validator::make($request->all(),[
            'amount'=>'required',
            'email'=>'email',
        ],[
            'amount.required' => 'مقدار الدعم مطلوب',
            'email.email' => 'صيغة البريد الالكترونى غير صحيحة',
        ]);
        if ($validator->fails()){
            return apiResponse(null,$validator->errors()->first(),'422');
        }

        $data = $request->all();
        $support = Support::create($data);

        return apiResponse($support);

    }

}
