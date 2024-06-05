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
                'reported_at' => 'required',
                'day' => 'required',
//                'chapters' => 'required',
//                'surah' => 'required',
//                'pages' => 'required',
                'type' => 'required|in:periodic,daily,repeated,intense',
                'teacher_id' => 'exists:teachers,id',
            ]);
            // TODO: add validation messages

            if ($validator->fails()) {
                return apiResponse(null, $validator->errors()->first(), '422');
            }
//            // validation if user added report with same type in this day
//            $date = date('Y-m-d', strtotime($request->reported_at));
//            $reportCount = MainReport::whereDate('reported_at', $date)->where([
//                'student_id' => user_api()->id(),
//                'type' => $request->type,
//            ])->count();
//            if ($reportCount > 0){
//                return apiResponse(null, 'تم اضافة تقرير فى هذا اليوم مسبقا', '422');
//            }

            $data = $request->all();
            $data['reported_at'] = $request->reported_at ?? date('Y-m-d H:i:s', time());
            $data['student_id'] = user_api()->id();
            $report = MainReport::create($data);

            return apiResponse($report, 'تم إنشاء التقرير بنجاح');
        } catch (\Exception $ex) {
            return apiResponse($ex->getCode(), $ex->getMessage(), '500');
        }
    }

    public function updateReportByDateAndType(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'reported_at' => 'required',
                'type' => 'required|in:periodic,daily,repeated,intense',
            ]);

            if ($validator->fails()) {
                return apiResponse(null, $validator->errors()->first(), '400');
            }
            $data = $request->all();

            $report = MainReport::whereDate('reported_at', date('Y-m-d', strtotime($request->reported_at)))
                ->where([
                    'student_id' => user_api()->id(),
                    'type' => $request->type
                ])->first();
            if (!$report) {
                return apiResponse(null, 'لا يوجد تقرير بهذه البيانات', '400');
            }
            $report->update($data);

            return apiResponse(null, 'تم بنجاح');
        } catch (\Exception $ex) {
            return apiResponse($ex->getCode(), $ex->getMessage(), '500');
        }
    }

    public function saveReport(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'reported_at' => 'required',
                'type' => 'required|in:periodic,daily,repeated,intense',
            ]);

            if ($validator->fails()) {
                return apiResponse(null, $validator->errors()->first(), '400');
            }


            $report = MainReport::whereDate('reported_at', date('Y-m-d', strtotime($request->reported_at)))
                ->where([
                    'student_id' => user_api()->id(),
                    'type' => $request->type
                ])->first();

            if ($report) {
                return $this->updateReportByDateAndType($request);
            }else{
                return $this->create_report($request);
            }

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

    public function reportByDateAndType(Request $request)
    {
        try {
            $report = MainReport::whereDate('reported_at', $request->date)
                ->where([
                    'student_id' => user_api()->id(),
                    'type' => $request->type
                ])->first();
            return apiResponse($report);
        } catch (\Exception $ex) {
            return apiResponse($ex->getCode(), $ex->getMessage(), '500');
        }
    }

    public function reportPages(Request $request)
    {
        try {
            $studentId = user_api()->id();
            $reports = MainReport::studentReportsPages($studentId)->get();

            $reportPages = $reports->map(function ($report) {
                return $report->formatted_pages;
            })->flatten()->unique()->values()->toArray();

            return apiResponse($reportPages);
        } catch (\Exception $ex) {
            return apiResponse($ex->getCode(), $ex->getMessage(), '500');
        }
    }
}
