<form enctype="multipart/form-data" method="POST">
    @csrf
    <input type="hidden" name="id" id="id" value="{{$id}}">
    <div class="row mt-0">
        <h3>تسجيلات المستخدم</h3>
    </div>
    <div class="row">
        @foreach($records as $record)
            <div class="col-md-12 col-lg-6 col-sm-12">
                <div class="card card-aside bg-primary">
                    <div class="card-body d-flex flex-column">
                        <h4><a href="#" class="text-white">استمع للتسجيل</a></h4>
                        <div class="text-white">اعوذ بالله من الشيطان الرجيم</div>
                        <div class="d-flex align-items-center pt-5 mt-auto text-center ">
                            <div class="text-muted">
                                <audio controls>
                                    <source src="{{$record->record}}" type="audio/ogg">
                                    <source src="{{$record->record}}" type="audio/mpeg">
                                    متصفحك لا يقبل التسجيل.
                                </audio>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center pt-3">
        <div class="d-inline-block ">
            <input form="form" value="الحافظ الجديد" status="mid_level" type="submit"
                   class="btn btn-success record_submit" style="width: 125px">
            <input form="form" value="التاهيلى" status="beginner" type="submit" class="btn btn-danger record_submit"
                   style="width: 125px">
        </div>
    </div>
</form>



