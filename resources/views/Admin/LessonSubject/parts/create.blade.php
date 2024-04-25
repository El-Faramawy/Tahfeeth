<!--begin::Form-->
<form id="form" enctype="multipart/form-data" method="POST" action="{{route('lesson_subject.store')}}">
    @csrf
    <div class="row mt-0">
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 mt-0">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">التوصية </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="التوصية"></i>
            </label>
            <input type="text" class="form-control form-control-solid" placeholder="التوصية" name="title" >
        </div>

    </div>
</form>
