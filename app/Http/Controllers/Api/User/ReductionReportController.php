<?php

namespace App\Http\Controllers\Api\User;

use App\Models\ReductionReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ReductionReportController extends Controller
{
    public function create_reduction_report(Request $request)
    {
        try {
            // validation
            $validator = Validator::make($request->all(), [
                'from_date' => 'required|date',
                'to_date' => 'required|date',
                'reason' => 'required',
            ], [
                'from_date.required' => 'التاريخ مطلوب',
                'from_date.date' => 'التاريخ ليس تاريخًا صالحًا',
                'to_date.required' => 'التاريخ مطلوب',
                'to_date.date' => 'التاريخ ليس تاريخًا صالحًا',
                'reason.required' => 'مطلوب سبب الغياب',
            ]);

            if ($validator->fails()) {
                return apiResponse(null, $validator->errors()->first(), '422');
            }
            $data = $request->all();
            $data['student_id'] = user_api()->id();

            ReductionReport::create($data);

            return apiResponse(null, 'تم إنشاء طلب التخفيف بنجاح');
        } catch (\Exception $ex) {
            return apiResponse($ex->getCode(), $ex->getMessage(), '500');
        }
    }

    public function list_reduction_report(Request $request)
    {
        try {

            $page = $request->query('page', 1);
            $page_size = $request->query('page_size', 10);
            $id = $request->query('id', null);
            $user_id = user_api()->id();
            $sort_field = $request->query('sort_by', 'created_at');
            $sort_direction = $request->query('sort_direction', 'desc');

            $reports = ReductionReport::where('student_id', $user_id)
                ->limit($page_size)
                ->offset(($page - 1) * $page_size);


            if ($id) {
                $reports = $reports->where('id', $id);
            }
            $reports = $reports->orderBy($sort_field, $sort_direction)->get();

            return apiResponse($reports, null, 200);
        } catch (\Exception $ex) {
            return apiResponse($ex->getCode(), $ex->getMessage(), '500');
        }
    }
}
