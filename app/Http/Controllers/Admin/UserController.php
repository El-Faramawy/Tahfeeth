<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Test;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()){
            $users =User::where('role','user');
            if (isset($request->group_id)){
                $users->where('group_id',$request->group_id);
            }
            $users->latest()->get();

            return Datatables::of($users)
                ->addColumn('action', function ($user) {
//                    if(in_array(7,admin()->user()->permission_ids)) {
                        return '
                             <a class="btn btn-default btn-danger btn-sm mb-2 mb-xl-0 delete"
                             data-id="' . $user->id . '" ><i class="fa fa-trash-o text-white"></i></a>
                       ';
//                    }
                })
//                ->addColumn('orders', function ($user) {
//                    $order_data = '<a  class="btn btn-icon btn-bg-light btn-info btn-sm me-1 "
//                            href="'.route("orders.index","user_id=".$user->id).'" >
//                            <span class="svg-icon svg-icon-3">
//                                <span class="svg-icon svg-icon-3">
//                                    <i class="fa fa-shopping-basket "></i>
//                                </span>
//                            </span>
//                            </button>';
//                    return in_array(39,admin()->user()->permission_ids) ?$order_data :'';
//                })
                ->editColumn('image',function ($user){
                    return '<img alt="image" class="img list-thumbnail border-0" style="width:100px;border-radius:10px" onclick="window.open(this.src)" src="'. $user->dashboard_image .'">';
                })
                ->editColumn('gender',function ($user){
                    return $user->gender == 'female' ? 'انثى': 'ذكر';
                })
                ->editColumn('track',function ($user){
                    $records = Test::where('user_id',$user->id)->count();
                    $recordBtn = '';
                    if ($records > 0){
                        $recordBtn = '<span data-id="'.$user->id.'" href="'.route("user_records" , $user->id).'"
                        class="badge badge-warning badge-sm mt-1 d-block recordsBtn" style="cursor: pointer" > مقاطع الصوت </span>';
                    }
                    $beginner_selected = $user->track == "beginner" ? "selected" : " " ;
                    $mid_level_selected = $user->track == "mid_level" ? "selected" : " " ;
                    $high_level_selected = $user->track == "high_level" ? "selected" : " " ;
                    $input = '<select name="change_track" data-column="track" href="'.url("admin/change_track").'"
                    data-id="'.$user->id.'" style="min-width: 110px;" class="form-control change_track">
                        <option value="" selected disabled>اختر مسار ...</option>
                        <option value="beginner" '. $beginner_selected .'>التاهيلى</option>
                        <option value="mid_level" '. $mid_level_selected .'>الحافظ الجديد</option>
                        <option value="high_level" '. $high_level_selected .'>الخاتمين</option>
                        </select>'
                    ;
                    return $input . $recordBtn;
                })
                ->editColumn('stage',function ($user){
                    $qiraat_selected = $user->stage == "qiraat" ? "selected" : " " ;
                    $taahhud_selected = $user->stage == "taahhud" ? "selected" : " " ;
                    $isnad_selected = $user->stage == "isnad" ? "selected" : " " ;
                    $dabt_selected = $user->stage == "dabt" ? "selected" : " " ;
                    return '<select name="change_track" data-column="stage" href="'.url("admin/change_track").'"
                    data-id="'.$user->id.'" style="min-width: 110px;" class="form-control change_track">
                        <option value="qiraat" '. $qiraat_selected .'>القراءات</option>
                        <option value="taahhud" '. $taahhud_selected .'>التعاهد</option>
                        <option value="isnad" '. $isnad_selected .'>الاسناد</option>
                        <option value="dabt" '. $dabt_selected .'>الضبط</option>'
                    ;
                })
                ->editColumn('group',function ($user){
                    $output = '';
                    $output .= '<select name="change_track" data-column="group_id" href="'.url("admin/change_track").'"
                    data-id="'.$user->id.'" style="min-width: 150px;" class="form-control change_track">
                    <option value="" selected disabled> اختر مجموعة ...</option>';
                    $groups = Group::all();
                    foreach ($groups as $group){
                        $selected = $group->id == $user->group_id ? "selected" :"";
                        $output .= '<option value="'.$group->id.'" '. $selected .'>'.$group->name.'</option>';
                    }
                    $output .='</selected>';
                    return $output ;
                })
                ->editColumn('status',function ($user){
//                    $block =in_array(10,admin()->user()->permission_ids)? "block" : " ";
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
        return view('Admin.User.index');
    }
    ################ multiple Delete  #################
    public function multiDelete(Request $request)
    {
        $ids = explode(",", $request->ids);
        User::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ Delete user #################
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }
    ################ block user #################
    public function block(Request $request , $id)
    {
        $user = User::where('id',$id)->first();
        $user->status = $request->value;
        $user->save();
        $text = $user->status == "active" ? "تم التفعيل بنجاح" :"تم الحظر بنجاح";
        return response()->json(
            [
                'code' => 200,
                'message' => $text
            ]);
    }
    ################ change_user_track #################
    public function change_user_track(Request $request)
    {
        $user = User::where('id',$request->id)->first();
        $user->update(['track'=>$request->track]);

        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم بنجاح'
            ]);
    }
    ################ change_track #################
    public function change_track(Request $request)
    {
        $user = User::where('id',$request->id)->first();
        $user->update([$request->column=>$request->value]);

        if ($request->column == 'stage' && $request->value != 'dabt'){
            $user->update(['track'=>null]);
        }

        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم بنجاح'
            ]);
    }
    ################ user_records #################
    public function user_records($id)
    {
        $records = Test::where('user_id', $id)->get();
        return view('Admin.User.parts.records', compact('id','records'))->render();
    }
}
