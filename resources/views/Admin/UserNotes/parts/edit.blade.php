<!--begin::Form-->
<link href="{{url('Admin')}}/assets/plugins/select2/select2.min.css" rel="stylesheet"/>
<form id="form" enctype="multipart/form-data" method="POST" action="{{route('user_notes.update',$userNote->id)}}">
    @csrf
    @method('PUT')
    <div class="row mt-0">
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 mt-0">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">التوصية </span>
{{--                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="التوصية"></i>--}}
            </label>
            <select name="lesson_subject_id" class="form-control form-control-solid select2">
                <option value="" selected disabled>التوصية</option>
                @foreach($lesson_subjects as $lesson_subject)
                    <option {{$userNote->lesson_subject_id == $lesson_subject->id?'selected':''}} value="{{$lesson_subject->id}}">{{$lesson_subject->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 mt-0">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">التفاصيل </span>
{{--                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="التفاصيل"></i>--}}
            </label>
            <input type="text" class="form-control form-control-solid" placeholder="التفاصيل" name="note" value="{{$userNote->note}}">
        </div>


    </div>

</form>
<!--end::Form-->
<script src="{{url('Admin')}}/assets/plugins/select2/select2.full.min.js"></script>
<script src="{{url('Admin')}}/assets/js/select2.js"></script>

