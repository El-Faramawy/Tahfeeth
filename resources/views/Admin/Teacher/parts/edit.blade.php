<!--begin::Form-->
<form id="form" enctype="multipart/form-data" method="POST" action="{{route('teachers.update',$teacher->id)}}">
    @csrf
    @method('PUT')
    <div class="row mt-0">
        <!--begin::Input group-->
        <div class=" mb-2 fv-row col-sm-12 mt-0 row">
            <label class=" align-items-center fs-6 fw-bold form-label col-sm-6">
                <span class="required">قبول و حظر المستخدم</span>
            </label>
            <div class=" align-items-center mb-3 mt-3 col-sm-6">
                <div class="material-switch pull-left">
                    <input id="someSwitchOptionPrimary" {{$teacher->can_accept_user == '1' ? 'checked' : '' }} name="can_accept_user" type="checkbox"/>
                    <label for="someSwitchOptionPrimary" class="label-primary"></label>
                </div>
            </div>
        </div>
        <!--begin::Input group-->
        <div class=" mb-2 fv-row col-sm-12 mt-0 row">
            <label class=" align-items-center fs-6 fw-bold form-label col-sm-6">
                <span class="required">تقييم الاختبار التأهيلى</span>
            </label>
            <div class=" align-items-center mb-3 mt-3 col-sm-6">
                <div class="material-switch pull-left">
                    <input id="someSwitchOptionPrimary2" {{$teacher->can_accept_beginner_user == '1' ? 'checked' : '' }} name="can_accept_beginner_user" type="checkbox"/>
                    <label for="someSwitchOptionPrimary2" class="label-primary"></label>
                </div>
            </div>
        </div>
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-2 fv-row col-sm-12 mt-0">
            <label class="d-flex align-items-center fs-6 fw-bold form-label ">
                <span class="required">المجموعات </span>
                <i class="fa fa-exclamation-circle ms-2 fs-7 text-primary " title="المجموعات"></i>
            </label>
            <div class="table-responsive-md">
                <table class="table table-striped-table-bordered table-hover table-checkable table-" id="tbl_posts">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>المجموعة</th>
                        <th>وقت العمل</th>
                        <th>
                            <a class="btn btn-info add-record2 click" data-added="0"><i class="fa fa-plus"></i></a>
                        </th>
                    </tr>
                    </thead>
                    <tbody id="tbl_posts_body">
                    @foreach($teacher_groups as $key=>$teacher_group)
                        <tr id="rec-{{$key+1}}">
                            <td><span class="sn">{{$key+1}}</span>.</td>
                            <td>
                                <select name="group_id[]" class="form-control form-control-solid select2">
                                    <option value="" selected disabled>المجموعة</option>
                                    @foreach($groups as $group)
                                        <option {{$group->id == $teacher_group->group_id ?'selected':''}} value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="work_time[]" value="{{$teacher_group->work_time}}" class="form-control form-control-solid" data-validation="required" >
                            </td>
                            <td><a class="btn btn-xs delete-record2 " data-id="{{$key+1}}"><i style="color: #f4516c" class="fa fa-trash"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>
        <!--begin::Input group-->




    </div>

</form>
<!--end::Form-->

<div style="display:none;">
    <table id="sample_table">
        <tr id="">
            <td><span class="sn"></span>.</td>
            <td>
                <select name="group_id[]" class="form-control form-control-solid select2">
                    <option value="" selected disabled>المجموعة</option>
                    @foreach($groups as $group)
                        <option value="{{$group->id}}">{{$group->name}}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="text" name="work_time[]" class="form-control form-control-solid" data-validation="required" >
            </td>
            <td><a class="btn btn-xs delete-record2 " data-id="0"><i style="color: #f4516c" class="fa fa-trash"></i></a></td>
        </tr>
    </table>
</div>


<script>
    jQuery(document).delegate('a.add-record2', 'click', function(e) {
        e.preventDefault();
        var content = jQuery('#sample_table tr');
        var size = jQuery('#tbl_posts >tbody >tr').length + 1;
        var  element = content.clone();
        element.attr('id', 'rec-'+size);
        element.find('.delete-record2').attr('data-id', size);
        element.appendTo('#tbl_posts_body');
        element.find('.sn').html(size);
    });
</script>
<script>
    jQuery(document).delegate('a.delete-record2', 'click', function(e) {
        e.preventDefault();
        var id = jQuery(this).attr('data-id');
        jQuery('#rec-' + id).remove();
        $('#tbl_posts_body tr').each(function (index) {
            $(this).find('span.sn').html(index + 1);
        });
        return true;
    });
</script>
