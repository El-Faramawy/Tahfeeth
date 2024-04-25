<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainReport;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    public function ReportType($reportType)
    {
        if ($reportType == 'daily') {
            $type = 'يومى';
            $color = 'primary';
        } else { // repeated
            $type = 'تكرار';
            $color = 'info';
        }

        return ['type' => $type, 'color' => $color];
    }

    public function index(Request $request)
    {
        $id = $track = null;
        if ($request->user_id) {
            $id = $request->user_id;
            $track = User::where('id', $id)->pluck('track')->first();
        } elseif ($request->group_id) {
            $id = $request->group_id;
            $track = User::where('group_id', $id)->pluck('track')->first();
        }
        if ($request->ajax()) {
            $from = $request->order_from ? date('Y-m-d', strtotime($request->order_from)) : date('1970-1-1');
            $to = $request->order_to ? date('Y-m-d', strtotime($request->order_to)) : date('Y-m-d', strtotime('+1 year'));
            $type = $request->type != null ? [$request->type] : ['daily', 'repeated'];
            $type = $request->type == 'all' ? ['daily', 'repeated'] : $type;

            $data = MainReport::whereIn('type', $type)
                ->with('student.group')
                ->whereBetween('reported_at', [$from, $to])
                ->orderBy('reported_at', 'desc');

            if ($request->user_id) {
                $data->where('student_id', $request->user_id);
            } elseif ($request->group_id) {
                $data->whereRelation('student', 'group_id', '=', $request->group_id);
            } else {
                $data->whereHas('student');
            }
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
                ->editColumn('type', function ($item) {
                    $reportType = $this->ReportType($item->type);
                    return '
                            <div class="card-header pt-0  pb-0 border-bottom-0">
                            <a  class="badge badge-' . $reportType['color'] . ' text-white ">' . $reportType['type'] . '</a>
                            </div>
							';
                })
                ->editColumn('reported_at', function ($item) {
                    return date('Y-m-d', strtotime($item->reported_at)) . '<br>' . date('h:i A', strtotime($item->reported_at));
                })
                ->editColumn('created_at', function ($item) {
                    return date('Y-m-d', strtotime($item->created_at)) . '<br>' . date('h:i A', strtotime($item->created_at));
                })
                ->addColumn('student', function ($item) {
                    return '<a href="' . route("users.index", "user_id=" . $item->student_id) . '">' . $item->student->name ?? '' . '</a>';
                })
                ->addColumn('teacher', function ($item) {
                    return $item->teacher->name ?? '';
                })
                ->editColumn('listen', function ($item) {
                    return $item->listen == 1 ? '<b class="text-success">تم</b>' : '';
                })
                ->editColumn('repeat', function ($item) {
                    return $item->repeat == 1 ? '<b class="text-success">تم</b>' : '';
                })->editColumn('chapters', function ($item) {
                    return json_decode($item->chapters);
                })->editColumn('pages', function ($item) {
                    return json_decode($item->pages);
                })->editColumn('previous', function ($item) {
                    return json_decode($item->previous);
                })->editColumn('old', function ($item) {
                    return json_decode($item->old);
                })->addColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="sub_chk" data-id="' . $item->id . '">';
                })
                ->escapeColumns([])
                ->make(true);
        }

        return view('Admin.Report.index', ['id' => $id, 'track' => $track]);
    }

    //==================================================
    public function periodic_reports(Request $request)
    {
        $id = null;
        if ($request->user_id) {
            $id = $request->user_id;
        } elseif ($request->group_id) {
            $id = $request->group_id;
        }

        if ($request->ajax()) {
            $from = $request->order_from ? date('Y-m-d', strtotime($request->order_from)) : date('1970-1-1');
            $to = $request->order_to ? date('Y-m-d', strtotime($request->order_to)) : date('Y-m-d', strtotime('+1 year'));
            $data = MainReport::where('type', 'periodic')
                ->with('student.group')
                ->whereBetween('reported_at', [$from, $to])
                ->orderBy('reported_at', 'desc');

            if ($request->user_id) {
                $data->where('student_id', $request->user_id);
            } elseif ($request->group_id) {
                $data->whereRelation('student', 'group_id', '=', $request->group_id);
            } else {
                $data->whereHas('student');
            }
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
                ->editColumn('reported_at', function ($item) {
                    return date('Y-m-d', strtotime($item->reported_at)) . '<br>' . date('h:i A', strtotime($item->reported_at));
                })
                ->editColumn('created_at', function ($item) {
                    return date('Y-m-d', strtotime($item->created_at)) . '<br>' . date('h:i A', strtotime($item->created_at));
                })
                ->addColumn('student', function ($item) {
                    return '<a href="' . route("users.index", "user_id=" . $item->student_id) . '">' . $item->student->name ?? '' . '</a>';
                })->editColumn('stage', function ($item) {
                    return $item->stage == 0 ? '<b class="text-primary">لا</b>'
                        : '<b class="text-success">نعم</b>';
                })->editColumn('chapters', function ($item) {
                    return json_decode($item->chapters);
                })
                ->addColumn('teacher', function ($item) {
                    return $item->teacher->name ?? '';
                })->addColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="sub_chk" data-id="' . $item->id . '">';
                })
                ->escapeColumns([])
                ->make(true);
        }

        return view('Admin.Report.periodic_reports', ['id' => $id]);
    }

    ################ multiple Delete  #################
    public function multiDelete(Request $request)
    {
        $ids = explode(",", $request->ids);
        MainReport::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }


    ################ Delete MainReport #################
    public function destroy($id)
    {
        MainReport::where('id', $id)->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }

}
