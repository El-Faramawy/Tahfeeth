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
                'type' => 'required|in:periodic,daily,repeated,intense',
            ]);
            // TODO: add validation messages

            if ($validator->fails()) {
                return apiResponse(null, $validator->errors()->first(), '422');
            }
            $data = $request->all();

            $data['reported_at'] = date('Y-m-d H:i:s', time());
            $data['student_id'] = user_api()->id();

            $report = MainReport::create($data);

            return apiResponse($report, 'تم إنشاء التقرير بنجاح');
        } catch (\Exception $ex) {
            return apiResponse($ex->getCode(), $ex->getMessage(), '500');
        }
    }

    public function update_report(Request $request)
    {
        try {

            $report_id = $request->route('report_id');
            $validator = Validator::make($request->all(), [
                'chapters' => 'required',
                'surah' => 'required',
                'pages' => 'required',
                'type' => 'required|in:periodic,daily,repeated,intense',
            ]);

            if ($validator->fails()) {
                return apiResponse(null, $validator->errors()->first(), '400');
            }
            $data = $request->all();
            $user = user_api();

            // finding by ID alone is enough to get the record,
            // but student_id is added for validation, to make sure the authenticated student
            // is authorized to update the report
            // the teacher_id is null to prevent the student from updating the report after the teacher approves it
            MainReport::where('id', $report_id)
                ->where('student_id', $user->id())
                ->where('teacher_id', null)
                ->update([
                    'type' => $data['type'],
                    'chapters' => $data['chapters'],
                    'surah' => $data['surah'],
                    'pages' => $data['pages'],
                ]);

            return apiResponse(null, 'تم بنجاح');
        } catch (\Exception $ex) {
            return apiResponse($ex->getCode(), $ex->getMessage(), '500');
        }
    }

    public function list_reports(Request $request)
    {
        try {

            $page = $request->query('page', 1);
            $page_size = $request->query('page_size', 10);
            $report_id = $request->query('report_id', null);
            $user_id = user_api()->id();
            $sort_by = $request->query('sort_by', 'reported_at');
            $sort_direction = $request->query('sort_direction', 'desc');

            $reports = MainReport::where('student_id', $user_id)
            ->limit($page_size)
            ->offset(($page - 1) * $page_size);


            if ($report_id) {
                $reports = $reports->where('id', $report_id);
            }
            $reports = $reports->orderBy($sort_by, $sort_direction)->get();

            return apiResponse($reports, null, 200);
        } catch (\Exception $ex) {
            return apiResponse($ex->getCode(), $ex->getMessage(), '500');
        }
    }
}
