<!--begin::Form-->
<link href="{{url('Admin')}}/assets/plugins/select2/select2.min.css" rel="stylesheet"/>
<form id="form" enctype="multipart/form-data" method="POST" action="{{route('sessions.store')}}">
    @csrf
    <div class="row mt-0">
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 mt-0">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">العنوان </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="العنوان"></i>
            </label>
            <input type="text" class="form-control form-control-solid" placeholder="العنوان" name="title" >
        </div>
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 mt-0">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">اللينك </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="اللينك"></i>
            </label>
            <input type="url" class="form-control form-control-solid" placeholder="اللينك" name="link" >
        </div>
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">التاريخ </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="التاريخ"></i>
            </label>
            <input type="date" class="form-control form-control-solid" placeholder="التاريخ" name="date" >
        </div>
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الوقت </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الوقت"></i>
            </label>
            <input type="time" class="form-control form-control-solid" placeholder="الوقت" name="time" >
        </div>
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">المعلم </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="المطعم"></i>
            </label>
            <select name="teacher_id" class="form-control form-control-solid select2">
                <option value="" selected disabled>المعلم</option>
                @foreach($teachers as $teacher)
                    <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                @endforeach
            </select>
        </div>
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-6 mt-0">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">المعلم الثانى </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="المطعم"></i>
            </label>
            <select name="teacher2_id" class="form-control form-control-solid select2">
                <option value="" selected disabled>المعلم الثانى</option>
                @foreach($teachers as $teacher)
                    <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                @endforeach
            </select>
        </div>
        <!--begin::Input group-->



    </div>
</form>
<!--end::Form-->
<script src="{{url('Admin')}}/assets/plugins/select2/select2.full.min.js"></script>
<script src="{{url('Admin')}}/assets/js/select2.js"></script>
