@extends('layouts.admin.app')
@section('page_title') تقارير العرض @endsection
<!-- INTERNAL SELECT2 CSS -->

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تقارير العرض</h3>
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
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="card">
                            <div class="card-status bg-blue br-tr-7 br-tl-7"></div>
                            <div class="card-header">
                                <div class="card-title">تاريخ التقرير</div>
                                <div class="card-options">
                                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="mg-b-20 mg-sm-b-40">اختر تاريخ البداية و النهاية</p>
                                <div class="wd-200 mg-b-30">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div>
                                        <input class="form-control fc-datepicker order_filter" id="order_from"  placeholder="تاريخ البداية" type="text">
                                        <input class="form-control fc-datepicker order_filter" id="order_to" placeholder="تاريخ النهاية" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- COL END -->
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="exportexample" class="table table-striped table-responsive-lg  card-table table-vcenter text-nowrap mb-0 table-primary align-items-center mb-0">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-white"><input type="checkbox" id="master"></th>
                                <th class="text-white">#</th>
                                <th class="text-white">الطالب</th>
                                <th class="text-white">المعلم</th>
                                <th class="text-white">وقت الانشاء</th>
                                <th class="text-white">وقت التقرير</th>
                                <th class="text-white">اليوم</th>
                                <th class="text-white">مرحلى</th>
                                <th class="text-white">المستوى</th>
                                <th class="text-white">الجزء</th>
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
            {data: 'teacher', name: 'teacher'},
            {data: 'created_at', name: 'created_at'},
            {data: 'reported_at', name: 'reported_at'},
            {data: 'day', name: 'day'},
            {data: 'stage', name: 'stage'},
            {data: 'level', name: 'level'},
            {data: 'chapters', name: 'chapters'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];

    </script>
    @include('layouts.admin.inc.ajax',['url'=>'reports'])

    <script>
        function reload_table(){
            var order_from = $('#order_from').val();
            var order_to = $('#order_to').val();
            var url = '';
            if ('{{$id}}' == '') {
                url = window.location.href+"?order_from=" + order_from + "&order_to=" + order_to ;
            }else{
                url = window.location.href+"&order_from=" + order_from + "&order_to=" + order_to ;
            }
            // alert(url);
            $('#exportexample').DataTable().ajax.url(url).draw();
        }

        $(document).on('change','.order_filter', function () {
            reload_table()
        })
    </script>

    <!-- INTERNAL BOOTSTRAP-DATERANGEPICKER JS -->
    <script src="{{url('Admin')}}/assets/plugins/bootstrap-daterangepicker/moment.min.js"></script>
    <script src="{{url('Admin')}}/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- INTERNAL  TIMEPICKER JS -->
    <script src="{{url('Admin')}}/assets/plugins/time-picker/jquery.timepicker.js"></script>
    <script src="{{url('Admin')}}/assets/plugins/time-picker/toggles.min.js"></script>

    <!-- INTERNAL DATEPICKER JS-->
    <script src="{{url('Admin')}}/assets/plugins/date-picker/spectrum.js"></script>
    <script src="{{url('Admin')}}/assets/plugins/date-picker/jquery-ui.js"></script>
    <script src="{{url('Admin')}}/assets/plugins/input-mask/jquery.maskedinput.js"></script>

    <!--INTERNAL  FORMELEMENTS JS -->
    <script src="{{url('Admin')}}/assets/js/form-elements.js"></script>
    <script src="{{url('Admin')}}/assets/js/select2.js"></script>

    <!-- INTERNAL SELECT2 JS -->
    <script src="{{url('Admin')}}/assets/plugins/select2/select2.full.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.card-options-collapse').click();
        })
    </script>

@endpush
