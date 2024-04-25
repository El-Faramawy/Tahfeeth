<!--begin::Form-->
<link href="{{url('Admin')}}/assets/plugins/fileuploads/css/fileupload.css" rel="stylesheet" type="text/css" />
<form id="form" enctype="multipart/form-data" method="POST" action="{{route('lessons.update',$lesson->id)}}">
    @csrf
    @method('PUT')
    <div class="row mt-0">
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 col-md-6 mt-0">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الاسم </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الاسم"></i>
            </label>
            <input type="text" class="form-control form-control-solid" placeholder="الاسم" name="name" value="{{$lesson->name}}" >
        </div>
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 col-md-6 mt-0">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الرقم </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الرقم"></i>
            </label>
            <input type="text" class="form-control form-control-solid numbersOnly" placeholder="الرقم" name="number" value="{{$lesson->number}}" >
        </div>
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="mb-0 card-title">الصورة الاولى</h3>
                </div>
                <div class="card-body">
                    <input type="file" name="image1" class="dropify" data-height="300" data-default-file="{{dashboard_file($lesson->image1)}}"/>
                </div>
            </div>
        </div><!-- COL END -->
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="mb-0 card-title">الصورة الثانية</h3>
                </div>
                <div class="card-body">
                    <input type="file" name="image2" class="dropify" data-height="300" />
                </div>
            </div>
        </div><!-- COL END -->
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="mb-0 card-title">ملف الصوت</h3>
                </div>
                <div class="card-body">
                    <input type="file" name="voice" class="dropify" data-height="300" />
                </div>
            </div>
        </div><!-- COL END -->
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="mb-0 card-title">الفيديو</h3>
                </div>
                <div class="card-body">
                    <input type="file" name="video" class="dropify" data-height="300" />
                </div>
            </div>
        </div><!-- COL END -->
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 mt-0">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الملاحظات </span>
            </label>
            <textarea type="text" class="form-control form-control-solid" placeholder="الملاحظات" name="notes" >{{$lesson->notes}}</textarea>
        </div>

    </div>

</form>
<!--end::Form-->
{{--@push('admin_js')--}}
    <script src="{{url('Admin')}}/assets/plugins/fileuploads/js/fileupload.js"></script>
    <script src="{{url('Admin')}}/assets/plugins/fileuploads/js/file-upload.js"></script>
{{--@endpush--}}
