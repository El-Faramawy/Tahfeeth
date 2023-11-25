<!--begin::Form-->
<form id="form" enctype="multipart/form-data" method="POST" action="{{route('groups.update',$group->id)}}">
    @csrf
    @method('PUT')
    <div class="row mt-0">
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 mt-0">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الاسم </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الاسم"></i>
            </label>
            <input type="text" class="form-control form-control-solid" placeholder="الاسم" name="name" value="{{$group->name}}" >
        </div>
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 mt-0">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الوصف </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الوصف"></i>
            </label>
            <textarea type="text" class="form-control form-control-solid" placeholder="الوصف" name="description" >{{$group->description}}</textarea>
        </div>
    </div>

</form>
<!--end::Form-->

