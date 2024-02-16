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

            Absence::create($data);

            return apiResponse(null, 'تم إنشاء الغياب بنجاح');
        } catch (\Exception $ex) {
            return apiResponse($ex->getCode(), $ex->getMessage(), '500');
        }
    }


    public function update_absence(Request $request)
    {
        try {

            $absence_id = $request->route('absence_id');
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
            $user = user_api();

            // finding by ID alone is enough to get the record,
            // but student_id is added for validation, to make sure the authenticated student
            // is authorized to update the absence
            // the updated_by is null to prevent the student from updating the absence after the teacher accepts/rejects it
            Absence::where('id', $absence_id)
                ->where('student_id', $user->id())
                ->where('updated_by', null)
                ->update($data);

            return apiResponse(null, 'تم بنجاح');
        } catch (\Exception $ex) {
            return apiResponse($ex->getCode(), $ex->getMessage(), '500');
        }
    }

    public function list_absences(Request $request)
    {
        try {

            $page = $request->query('page', 1);
            $page_size = $request->query('page_size', 10);
            $absence_id = $request->query('absence_id', null);
            $user_id = user_api()->id();
            $sort_field = $request->query('sort_by', 'created_at');
            $sort_direction = $request->query('sort_direction', 'desc');

            $reports = Absence::where('student_id', $user_id)
                ->limit($page_size)
                ->offset(($page - 1) * $page_size);


            if ($absence_id) {
                $reports = $reports->where('id', $absence_id);
            }
            $reports = $reports->orderBy($sort_field, $sort_direction)->get();

            return apiResponse($reports, null, 200);
        } catch (\Exception $ex) {
            return apiResponse($ex->getCode(), $ex->getMessage(), '500');
        }
    }
}
