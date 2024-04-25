@extends('layouts.admin.app')
@section('page_title') المستخدمين @endsection
<link href="{{url('admin')}}/assets/plugins/select2/select2.min.css" rel="stylesheet"/>
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">المستخدمين</h3>
                    <div class="mr-auto pageheader-btn">
                        @if(in_array(7,admin()->user()->permission_ids))
                            <a href="#" id="multiDeleteBtn" class="btn btn-danger btn-icon text-white">
                                            <span>
                                                <i class="fa fa-trash-o"></i>
                                            </span> حذف المحدد
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="exportexample"
                               class="table table-striped table-responsive-lg  card-table table-vcenter text-nowrap mb-0 table-primary align-items-center mb-0">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-white"><input type="checkbox" id="master"></th>
                                <th class="text-white">#</th>
                                <th class="text-white">الصورة</th>
                                <th class="text-white">الاسم</th>
                                <th class="text-white">اسم المستخدم</th>
                                <th class="text-white">البريد الالكترونى</th>
                                <th class="text-white">رقم الهاتف</th>
                                <th class="text-white">العمر</th>
                                <th class="text-white">الجنسية</th>
                                <th class="text-white">رقم الهوية</th>
                                <th class="text-white">الجنس</th>
                                <th class="text-white">المسار</th>
                                <th class="text-white">المجموعة</th>
                                <th class="text-white">المرحلة</th>
                                <th class="text-white"> الملاحظات</th>
                                <th class="text-white"> التقارير</th>
                                <th class="text-white"> الحالة</th>
                                <th class="text-white">تحكم</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg mw-650px">
            <div class="modal-content" id="modalContent">
                <div class="modal-header">
                    <h2>المستخدمين</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" style="cursor: pointer"
                         data-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                      transform="rotate(-45 6 17.3137)"
                                      fill="black"/>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                      fill="black"/>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-3" id="form-load">

                </div>
            </div>
        </div>
    </div>

@endsection
@push('admin_js')
    <script>
        var columns = [
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image'},
            {data: 'name', name: 'name'},
            {data: 'username', name: 'username'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'age', name: 'age', searchable: false},
            {data: 'nationality', name: 'nationality'},
            {data: 'identification', name: 'identification'},
            {data: 'gender', name: 'gender'},
            {data: 'track', name: 'track'},
            {data: 'group', name: 'group'},
            {data: 'stage', name: 'stage'},
            {data: 'user_notes', name: 'user_notes'},
            {data: 'reports', name: 'reports'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];
        //======================== addBtn =============================

    </script>
    @include('layouts.admin.inc.ajax',['url'=>'users'])
    @include('Admin.User.parts.block',['url'=>'users'])
    @include('Admin.User.parts.records_js')

    <script>
        // Make Better Using Ajax
        $(document).on('change  ', '.change_track', function (event) {
            var id = $(this).data("id")
            var column = $(this).data("column")
            var value = $(this).val()
            var url = $(this).attr("href")
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': id,
                    'column': column,
                    'value': value,
                },
                success: function (data) {
                    if (data.success === 'true') {
                        my_toaster(data.message)
                        $('#exportexample').DataTable().ajax.reload(null, false);
                    }
                }
            })
        });
    </script>


@endpush
