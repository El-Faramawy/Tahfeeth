<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Teacher;
use App\Models\TeacherGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class TeacherController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()){
            $teachers =Teacher::latest()->get();

            return Datatables::of($teachers)
                ->addColumn('action', function ($user) {
//                    if(in_array(7,admin()->user()->permission_ids)) {
                        return '
                        <button  id="editBtn" class="btn btn-default btn-primary btn-sm mb-2  mb-xl-0 "
                             data-id="' . $user->id . '" ><i class="fa fa-edit text-white"></i>
                        </button>
                             <a class="btn btn-default btn-danger btn-sm mb-2 mb-xl-0 delete"
                             data-id="' . $user->id . '" ><i class="fa fa-trash-o text-white"></i></a>
                       ';
//                    }
                })
                ->editColumn('image',function ($user){
                    return '<img alt="image" class="img list-thumbnail border-0" style="width:100px;border-radius:10px" onclick="window.open(this.src)" src="'. $user->dashboard_image .'">';
                })
                ->editColumn('gender',function ($user){
                    return $user->gender == 'female' ? 'انثى': 'ذكر';
                })
                ->editColumn('status',function ($user){
                    $color ="danger";
                    $color2 ="success";
                    $text = "حظر";
                    $text2 = "تفعيل";
                    if ($user->status == "pending"){
                        return '
                        <span class="badge badge-warning badge-sm d-block"> معلق </span>
                        <a style="font-size: xx-large; display: inline-block!important;cursor: pointer " class="block text-center fw-3 pl-1 text-' . $color2 . '" data-value="active" data-id="' . $user->id . '" data-text="' . $text2 . '" ><i class="py-2 fw-3  fa fa-thumbs-up text-' . $color2 . '" ></i></a>
                        <a style="font-size: xx-large; display: inline-block!important;cursor: pointer" class="block text-center fw-3 pr-1 text-' . $color . '" data-value="inactive" data-id="' . $user->id . '" data-text="' . $text . '" ><i class="py-2 fw-3  fa fa-thumbs-down text-' . $color . '" ></i></a>
                                ';
                    }elseif ($user->status == "active"){
                        return '<span class="badge badge-success badge-sm d-block"> مفعل </span>
                        <a style="font-size: xx-large; display: inline-block!important;cursor: pointer" class="block text-center fw-3 pr-1 text-' . $color . '" data-value="inactive" data-id="' . $user->id . '" data-text="' . $text . '" ><i class="py-2 fw-3  fa fa-thumbs-down text-' . $color . '" ></i></a>';
                    }else{
                        return '<span class="badge badge-danger badge-sm d-block"> غير مفعل </span>
                        <a style="font-size: xx-large; display: inline-block!important;cursor: pointer " class="block text-center fw-3 pl-1 text-' . $color2 . '" data-value="active" data-id="' . $user->id . '" data-text="' . $text2 . '" ><i class="py-2 fw-3  fa fa-thumbs-up text-' . $color2 . '" ></i></a>';
                    }
                })
               ->addColumn('checkbox' , function ($user){
                    return '<input type="checkbox" class="sub_chk" data-id="'.$user->id.'">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.Teacher.index');
    }
    ################ Edit Teacher #################
    public function edit(Teacher $teacher)
    {
        $groups = Group::get();
        $teacher_groups = TeacherGroup::where('teacher_id',$teacher->id)->get();
        return view('Admin.Teacher.parts.edit', compact('groups','teacher_groups','teacher'));
    }
    ################ update Teacher #################
    public function update(Request $request, Teacher $teacher)
    {
        $data = [];
        $data['can_accept_beginner_user'] = $request->can_accept_beginner_user == 'on'? 1:0;
        $data['can_accept_user'] = $request->can_accept_user == 'on'? 1:0;
        $teacher->update($data);

        TeacherGroup::where('teacher_id', $teacher->id)->delete();
        if ($request->group_id) {
            foreach ($request->group_id as $key => $group_id) {
                TeacherGroup::create([
                    'teacher_id' => $teacher['id'],
                    'group_id' => $group_id,
                    'work_time' => $request->work_time[$key],
                ]);
            }
        }
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
        Teacher::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ Delete teacher #################
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ block teacher #################
    public function block(Request $request , $id)
    {
        $user = Teacher::where('id',$id)->first();
        $user->status = $request->value;
        $user->save();
        $text = $user->status == "active" ? "تم التفعيل بنجاح" :"تم الحظر بنجاح";
        return response()->json(
            [
                'code' => 200,
                'message' => $text
            ]);
    }

}
