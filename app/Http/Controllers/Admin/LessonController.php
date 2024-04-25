<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\PhotoTrait;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class LessonController extends Controller
{
    use PhotoTrait;
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Lesson::orderBy('number');
            return Datatables::of($data)
                ->addColumn('action', function ($item) {
                    $action = '';
                    $action .= '
                        <button  id="editBtn" class="btn btn-default btn-primary btn-sm mb-2  mb-xl-0 "
                             data-id="' . $item->id . '" ><i class="fa fa-edit text-white"></i>
                        </button>';
                    $action .= '
                             <a class="btn btn-default btn-danger btn-sm mb-2 mb-xl-0 delete"
                             data-id="' . $item->id . '" ><i class="fa fa-trash-o text-white"></i></a>
                       ';
                    return $action;
                })
                ->editColumn('image1',function ($item){
                    return '<img alt="image" class="img list-thumbnail border-0" style="width:100px;border-radius:10px" onclick="window.open(this.src)" src="'. dashboard_file($item->image1) .'">';
                })
                ->editColumn('image2',function ($item){
                    return '<img alt="image" class="img list-thumbnail border-0" style="width:100px;border-radius:10px" onclick="window.open(this.src)" src="'. dashboard_file($item->image2) .'">';
                })
                ->editColumn('voice',function ($item){
                    $voice = $item->voice ? asset("Admin/imgs/default.jpg") : null;
                    $voice_file = "'".dashboard_file($item->voice)."'";
                    return '<img alt="image" class="img list-thumbnail border-0" style="width:100px;border-radius:10px" onclick="window.open('. $voice_file .')" src="'.  $voice .'">';
                })
                ->editColumn('video',function ($item){
                    $video = $item->video ? asset("Admin/imgs/default.jpg") : null;
                    $video_file = "'".dashboard_file($item->video)."'";
                    return '<img alt="image" class="img list-thumbnail border-0" style="width:100px;border-radius:10px" onclick="window.open('. $video_file .')" src="'.  $video .'">';
                })
                ->addColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="sub_chk" data-id="' . $item->id . '">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.Lesson.index');
    }

    ################ Add Object #################
    public function create()
    {
        return view('Admin.Lesson.parts.create')->render();
    }

    public function store(Request $request)
    {
        $valedator = Validator::make($request->all(), [
            'name' => 'required',
            'number' => 'required',
        ]);
        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->all();
        if (isset($request->image1)){
            $data['image1'] = $this->saveImage($request->image1 , 'Uploads/Lesson');
        }
        if (isset($request->image2)){
            $data['image2'] = $this->saveImage($request->image2 , 'Uploads/Lesson');
        }
        if (isset($request->voice)){
            $data['voice'] = $this->saveImage($request->voice , 'Uploads/Lesson');
        }
        if (isset($request->video)){
            $data['video'] = $this->saveImage($request->video , 'Uploads/Lesson');
        }
        Lesson::create($data);

        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم الاضافة بنجاح'
            ]);
    }

    ################ Edit Lesson #################
    public function edit(Lesson $lesson)
    {
        return view('Admin.Lesson.parts.edit', compact('lesson'));
    }

    ################ update Lesson #################
    public function update(Request $request, Lesson $lesson)
    {
        $valedator = Validator::make($request->all(), [
            'name' => 'required',
            'number' => 'required',
        ]);
        if ($valedator->fails())
            return response()->json(['messages' => $valedator->errors()->getMessages(), 'success' => 'false']);

        $data = $request->all();
        if ($request->image1 && $request->image1 != null){
            $data['image1'] = $this->saveImage($request->image1 , 'Uploads/User',$lesson->image);
        }
        if ($request->image2 && $request->image2 != null){
            $data['image2'] = $this->saveImage($request->image2 , 'Uploads/User',$lesson->image2);
        }
        if ($request->voice && $request->voice != null){
            $data['voice'] = $this->saveImage($request->voice , 'Uploads/User',$lesson->voice);
        }
        if ($request->video && $request->video != null){
            $data['video'] = $this->saveImage($request->video , 'Uploads/User',$lesson->video);
        }
        $lesson->update($data);

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
        Lesson::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }

    ################ Delete Lesson #################
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }


}
