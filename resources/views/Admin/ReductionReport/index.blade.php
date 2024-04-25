@extends('layouts.admin.app')
@section('page_title') تقارير تخفيف البرنامج @endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تقارير تخفيف البرنامج</h3>
                    <div class="mr-auto pageheader-btn">
{{--                        @if(in_array(40,admin()->user()->permission_ids))--}}
                            <a href="#"  id="multiDeleteBtn" class="btn btn-danger btn-icon text-white">
                                            <span>
                                                <i class="fa fa-trash-o"></i>
                                            </span>حذف المحدد
                            </a>
{{--                        @endif--}}
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="exportexample" class="table table-striped table-responsive-lg  card-table table-vcenter text-nowrap mb-0 table-primary align-items-center mb-0">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-white"><input type="checkbox" id="master"></th>
                                <th class="text-white">#</th>
                                <th class="text-white">الطالب</th>
                                <th class="text-white">تاريخ الانشاء</th>
                                <th class="text-white">من تاريخ</th>
                                <th class="text-white">الى تاريخ</th>
                                <th class="text-white">السبب</th>
                                <th class="text-white">الحالة</th>
                                <th class="text-white">مراجع الحالة</th>
                                <th class="text-white">حذف</th>
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

@endsection
@push('admin_js')

    <script>
        var  columns =[
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'id', name: 'id'},
            {data: 'student', name: 'student'},
            {data: 'created_at', name: 'created_at'},
            {data: 'from_date', name: 'from_date'},
            {data: 'to_date', name: 'to_date'},
            {data: 'reason', name: 'reason'},
            {data: 'status', name: 'status'},
            {data: 'teacher', name: 'teacher'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];
    </script>
    @include('layouts.admin.inc.ajax',['url'=>'reduction_reports'])
    @include('Admin.Absence.parts.block',['url'=>'change_reduction_reports'])

@endpush
