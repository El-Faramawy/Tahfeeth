<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LessonSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class LessonSubjectController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = LessonSubject::get();
            return Datatables::of($data)
                ->addColumn('action', function ($item) {
                    $action = '';
//                    if (in_array(61, admin()->user()->permission_ids)) {
                    $action .= '
                        <button  id="editBtn" class="btn btn-default btn-primary btn-sm mb-2  mb-xl-0 "
                             data-id="' . $item->id . '" ><i class="fa fa-edit text-white"></i>
                        </button>';
//                    }
//                    if(in_array(62,admin()->user()->permission_ids)) {
                    $action .= '
                             <a class="btn btn-default btn-danger btn-sm mb-2 mb-xl-0 delete"
                             data-id="' . $item->id . '" ><i class="fa fa-trash-o text-white"></i></a>
                       ';
//                    }
                    return $action;
                })
                ->addColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="sub_chk" data-id="' . $item->id . '">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.LessonSubject.index');
    }

    ################ Add Object #################
    public function create()
    {
        return view('Admin.LessonSubject.parts.create')->render();
    }

    public function store(Request $request)
    {
        $valedator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->all();
        LessonSubject::create($data);

        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم الاضافة بنجاح'
            ]);
    }

    ################ Edit LessonSubject #################
    public function edit(LessonSubject $lessonSubject)
    {
        return view('Admin.LessonSubject.parts.edit', compact('lessonSubject'));
    }

    ################ update Session #################
    public function update(Request $request, LessonSubject $lessonSubject)
    {
        $valedator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->all();
        $lessonSubject->update($data);

        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم التعديل بنجاح '
            ]);
    }

    ################ multiple Delete  #################
    public function multiDelete(Request $request)
    {
        $ids = explode(",", $request->ids);
        LessonSubject::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }

    ################ Delete LessonSubject #################
    public function destroy(LessonSubject $lessonSubject)
    {
        $lessonSubject->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }


}
