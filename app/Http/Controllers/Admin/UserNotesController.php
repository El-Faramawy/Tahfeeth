<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LessonSubject;
use App\Models\UserNotes;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserNotesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = UserNotes::where('student_id',$request->user_id);
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
                ->editColumn('created_at', function ($user) {
                    return date('Y-m-d',strtotime($user->created_at));
                })
                ->addColumn('lesson_subject', function ($user) {
                    return $user->lesson_subject->title ?? '';
                })
                ->addColumn('teacher', function ($user) {
                    return $user->teacher->name ?? 'أدمن';
                })
                ->addColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="sub_chk" data-id="' . $item->id . '">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.UserNotes.index', ['id' => $request->user_id]);
    }

    ################ Add Object #################
    public function create(Request $request)
    {
        $id = $request->id;
        $lesson_subjects = LessonSubject::all();
        return view('Admin.UserNotes.parts.create', compact('lesson_subjects','id'))->render();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        UserNotes::create($data);

        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم الاضافة بنجاح'
            ]);
    }

    ################ Edit UserNotes #################
    public function edit(UserNotes $userNote)
    {
        $lesson_subjects = LessonSubject::all();
        return view('Admin.UserNotes.parts.edit', compact('userNote', 'lesson_subjects'));
    }

    ################ update UserNotes #################
    public function update(Request $request, UserNotes $userNote)
    {
        $data = $request->all();
        $userNote->update($data);

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
        UserNotes::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }

    ################ Delete UserNotes #################
    public function destroy(UserNotes $userNote)
    {
        $userNote->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }


}
