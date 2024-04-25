@extends('layouts.admin.app')
@section('page_title') التقارير @endsection
<!-- INTERNAL SELECT2 CSS -->
<link href="{{url('Admin')}}/assets/plugins/select2/select2.min.css" rel="stylesheet"/>

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">التقارير</h3>
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
                    <div class="col-lg-6 ">
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
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-status bg-blue br-tr-7 br-tl-7"></div>
                            <div class="card-header">
                                <div class="card-title">نوع التقرير</div>
                                <div class="card-options">
                                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="mg-b-20 mg-sm-b-40">اختر نوع التقرير .</p>
                                <div class="wd-200 mg-b-30">
                                    <div class="input-group">
                                        <select class="form-control select2 custom-select order_filter" id="status" data-placeholder="اختر نوع التقرير ... ">
                                            <option label=" اختر نوع التقرير ... ">
                                            </option>
                                            <option value="all">الكل</option>
                                            <option value="daily">يومى </option>
                                            <option value="repeated">تكرار </option>
                                        </select>

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
                                <th class="text-white">النوع</th>
                                <th class="text-white">وقت الانشاء</th>
                                <th class="text-white">وقت التقرير</th>
                                <th class="text-white">اليوم</th>
                                @if($track != 'beginner')
                                <th class="text-white">السورة</th>
                                @endif
                                @if($track == 'beginner')
                                <th class="text-white">الدرس</th>
                                <th class="text-white">الاستماع</th>
                                <th class="text-white">التكرار</th>
                                @endif
                                <th class="text-white">عدد الصفحات</th>
                                <th class="text-white">عدد مرات التكرار</th>
                                <th class="text-white">الاجزاء</th>
                                <th class="text-white">الصفحات</th>
                                <th class="text-white">الحالى من</th>
                                <th class="text-white">الحالى الى</th>
                                <th class="text-white">السابق</th>
                                <th class="text-white">القديم</th>

                                <th class="text-white">حذف</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
{{--                            <tfoot>--}}
{{--                            <tr>--}}
{{--                                <th colspan="12" style="text-align:right">الاجمالى : </th>--}}
{{--                                <th colspan="3"></th>--}}
{{--                            </tr>--}}
{{--                            </tfoot>--}}
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered modal-lg mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content" id="modalContent">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2>التقارير</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" style="cursor: pointer" data-dismiss="modal" aria-label="Close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                      fill="black"/>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-3" id="form-load">

                </div>
                <!--end::Modal body-->
{{--                <div class="modal-footer">--}}
{{--                    <div class=" ">--}}
{{--                        <input  form="form" value="حفظ" type="submit" id="submit" class="btn btn-primary " style="width: 100px">--}}
{{--                        --}}{{--                            <span class="indicator-label ">حفظ</span>--}}

{{--                    </div>--}}
{{--                    <div class=" ">--}}
{{--                        <button type="reset" data-dismiss="modal" class="btn btn-light me-3 " style="width: 100px">غلق</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>

            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>

@endsection
@push('admin_js')

    <script>
        var  columns =[
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'id', name: 'id'},
            {data: 'student', name: 'student'},
            {data: 'teacher', name: 'teacher'},
            {data: 'type', name: 'type'},
            {data: 'created_at', name: 'created_at'},
            {data: 'reported_at', name: 'reported_at'},
            {data: 'day', name: 'day'},
            @if($track != 'beginner')
            {data: 'surah', name: 'surah'},
            @endif
            @if($track == 'beginner')
            {data: 'lesson', name: 'lesson'},
            {data: 'listen', name: 'listen'},
            {data: 'repeat', name: 'repeat'},
            @endif
            {data: 'amount_of_pages', name: 'amount_of_pages'},
            {data: 'repeated_amount', name: 'repeated_amount'},
            {data: 'chapters', name: 'chapters'},
            {data: 'pages', name: 'pages'},
            {data: 'current_from', name: 'current_from'},
            {data: 'current_to', name: 'current_to'},
            {data: 'previous', name: 'previous'},
            {data: 'old', name: 'old'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];

    {{--    var footer_sum = function (row, data, start, end, display) {--}}
    {{--        var api = this.api();--}}
    {{--        var coloum_num = 12;--}}
    {{--        // Remove the formatting to get integer data for summation--}}
    {{--        var intVal = function (i) {--}}
    {{--            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;--}}
    {{--        };--}}

    {{--        pageTotal = api--}}
    {{--            .column(coloum_num  , {page: 'current'})--}}
    {{--            .data()--}}
    {{--            .reduce(function (a, b) {--}}
    {{--                return intVal(a) + intVal(b);--}}
    {{--            }, 0);--}}

    {{--        // Update footer--}}
    {{--        $(api.column(coloum_num).footer()).html( pageTotal + ' CHF' /*+ total + ' total)'*/);--}}
    {{--    };--}}
    </script>
    @include('layouts.admin.inc.ajax',['url'=>'reports'])

    <script>
        function reload_table(){
            var order_from = $('#order_from').val();
            var order_to = $('#order_to').val();
            var status = $('#status').val();
            var url = '';
            if ('{{$id}}' == '') {
                url = window.location.href+"?order_from=" + order_from + "&order_to=" + order_to + "&type=" + status;
            }else{
                url = window.location.href+"&order_from=" + order_from + "&order_to=" + order_to + "&type=" + status;
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
