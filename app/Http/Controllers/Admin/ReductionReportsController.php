<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReductionReport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ReductionReportsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ReductionReport::latest();
            return Datatables::of($data)
                ->addColumn('action', function ($item) {
//                    if (in_array(40, admin()->user()->permission_ids)) {
                    return '
                            <button class="btn btn-default btn-danger btn-sm mb-2 mb-xl-0 delete"
                                 data-id="' . $item->id . '" ><i class="fa fa-trash-o text-white"></i>
                            </button>
                       ';
//                    }
                })
                ->editColumn('created_at', function ($item) {
                    return date('Y-m-d', strtotime($item->created_at)) . '<br>' . date('h:i A', strtotime($item->created_at));
                })
                ->addColumn('student', function ($item) {
                    return $item->student->name ?? '';
                })
                ->addColumn('teacher', function ($item) {
                    return $item->teacher->name ?? '';
                })
                ->editColumn('status', function ($user) {
                    $color = "danger";
                    $color2 = "success";
                    $text = "رفض";
                    $text2 = "موافقة";
                    if ($user->status == "pending") {
                        return '
                        <span class="badge badge-warning badge-sm d-block"> معلق </span>
                        <a style="font-size: xx-large; display: inline-block!important;cursor: pointer " class="block text-center fw-3 pl-1 text-' . $color2 . '" data-value="approved" data-id="' . $user->id . '" data-text="' . $text2 . '" ><i class="py-2 fw-3  fa fa-thumbs-up text-' . $color2 . '" ></i></a>
                        <a style="font-size: xx-large; display: inline-block!important;cursor: pointer" class="block text-center fw-3 pr-1 text-' . $color . '" data-value="rejected" data-id="' . $user->id . '" data-text="' . $text . '" ><i class="py-2 fw-3  fa fa-thumbs-down text-' . $color . '" ></i></a>
                                ';
                    } elseif ($user->status == "approved") {
                        return '<span class="badge badge-success badge-sm d-block"> مقبول </span>';
                    } else {
                        return '<span class="badge badge-danger badge-sm d-block"> مرفوض </span>';
                    }
                })->addColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="sub_chk" data-id="' . $item->id . '">';
                })
                ->escapeColumns([])
                ->make(true);
        }

        return view('Admin.ReductionReport.index');
    }

    public function multiDelete(Request $request)
    {
        $ids = explode(",", $request->ids);
        ReductionReport::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }

    public function destroy(ReductionReport $reductionReport)
    {
        $reductionReport->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }

    public function change_reduction_reports(Request $request, $id)
    {
        $item = ReductionReport::where('id', $id)->first();
        $item->status = $request->value;
        $item->updated_by = admin()->id();
        $item->save();
        $text = $item->status == "approved" ? "تم الموافقة بنجاح" : "تم الرفض بنجاح";
        return response()->json(
            [
                'code' => 200,
                'message' => $text
            ]);
    }
}
