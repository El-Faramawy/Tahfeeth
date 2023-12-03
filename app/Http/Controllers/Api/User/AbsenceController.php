<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Absence;

class AbsenceController extends Controller
{
    public function create_absence(Request $request)
    {
        try {
            // validation
            $validator = Validator::make($request->all(), [
                'date' => 'required|date',
                'reason' => 'required',
            ], [
                'date.required' => 'التاريخ مطلوب',
                'date.date' => 'التاريخ ليس تاريخًا صالحًا',
                'reason.required' => 'مطلوب سبب الغياب',
            ]);

            if ($validator->fails()) {
                return apiResponse(null, $validator->errors()->first(), '400');
            }
            $data = $request->all();
            $user = user_api();

            Absence::create([
                'date' => $data['date'],
                'reason' => $data['reason'],
                'student_id' => $user->id()
            ]);

            return apiResponse(null, 'تم إنشاء الغياب بنجاح');
        } catch (\Exception $ex) {
            return apiResponse($ex->getCode(), $ex->getMessage(), '500');
        }
    }
}
