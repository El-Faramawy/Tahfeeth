<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\MainReport;

class MainReportController extends Controller
{
    public function create_report(Request $request)
    {
        try {
            // validation
            $validator = Validator::make($request->all(), [
                'chapters' => 'required',
                'surah' => 'required',
                'pages' => 'required',
                'type' => 'required',
            ]);
            // TODO: add validation messages

            if ($validator->fails()) {
                return apiResponse(null, $validator->errors()->first(), '400');
            }
            $data = $request->all();
            $user = user_api();

            $reported_at = date('Y-m-d H:i:s', time());
            MainReport::create([
                'reported_at' => $reported_at,
                'student_id' => $user->id(),
                'type' => $data['type'],
                'chapters' => $data['chapters'],
                'surah' => $data['surah'],
                'pages' => $data['pages'],
            ]);

            return apiResponse(null, 'تم إنشاء التقرير بنجاح');
        } catch (\Exception $ex) {
            return apiResponse($ex->getCode(), $ex->getMessage(), '500');
        }
    }
}
