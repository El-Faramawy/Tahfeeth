<!--begin::Form-->
<form id="form" enctype="multipart/form-data" method="POST" action="{{route('faqs.update',$faq->id)}}">
    @csrf
    @method('PUT')
    <div class="row mt-0">
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 mt-0">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">السؤال </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="السؤال"></i>
            </label>
            <textarea type="text" class="form-control form-control-solid" placeholder="السؤال" name="question" >{{$faq->question}}</textarea>
        </div>
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 mt-0">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">الاجابة </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="الاجابة"></i>
            </label>
            <textarea type="text" class="form-control form-control-solid" placeholder="الاجابة" name="answer" >{{$faq->answer}}</textarea>
        </div>
    </div>

</form>
<!--end::Form-->

