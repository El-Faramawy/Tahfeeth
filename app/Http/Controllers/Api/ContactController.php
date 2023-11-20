<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;

class ContactController extends Controller
{
    public function contact_us(Request $request){
        $validator = Validator::make($request->all(),[
            'type'=>'required',
            'subject'=>'required',
            'message'=>'required',
        ],[
            'type.required' => 'نوع الرسالة مطلوب',
            'subject.required' => 'عنوان الرسالة مطلوب',
            'message.required' => 'الرسالة مطلوبة'
        ]);
        if ($validator->fails()){
            return apiResponse(null,$validator->errors()->first(),'422');
        }

        $data = $request->only('name','mail','subject','message','type');
        $contact = Contact::create($data);

        return apiResponse($contact);

    }

}
