@extends('layouts.admin.app')
@section('page_title') الاسئلة @endsection
<!-- INTERNAL  WYSIWYG EDITOR CSS -->
<script src="https://cdn.ckeditor.com/4.19.0/full-all/ckeditor.js"></script>

@section('content')
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">الاسئلة</h3>
                    <div class="mr-auto pageheader-btn">
                        <a href="#" id="addQuestion" class="btn btn-primary btn-icon text-white">
                            <span>
                                <i class="fe fe-plus"></i>
                            </span> اضافة جديد
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form  action="{{route('questions.store')}}" id="Form" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row" id="questions" question_count="{{count($questions)}}">
                            @foreach($questions as $question)
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">اضف السؤال</div>
                                        </div>
                                        <div class="card-body">
                                            <textarea  name="questions[]" id="question{{$question->id}}">{!! $question->question !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="card-footer text-center">
                            <input type="submit" class="btn btn-success mt-1 " value="حفظ">
                            <input type="reset" class="btn btn-danger mt-1 " value="الغاء">
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
@push('admin_js')
    <!-- INTERNAL   WYSIWYG Editor JS -->
    <script src="{{url('Admin')}}/assets/plugins/wysiwyag/jquery.richtext.js"></script>
    <script src="{{url('Admin')}}/assets/plugins/wysiwyag/wysiwyag.js"></script>
    <script>
        CKEDITOR.config.contentsLangDirection = 'rtl';
        @foreach($questions as $question)
            CKEDITOR.replace( 'question{{$question->id}}' );
        @endforeach
    </script>
    <script>
        $(document).on('click', '#addQuestion', function (e) {
            e.preventDefault();
            var question_number = $('#questions').attr('question_count')+1 ;
            $('#questions').attr('question_count',question_number);

            $('#questions').append(`
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">اضف السؤال</div>
                    </div>
                    <div class="card-body">
                        <textarea  name="questions[]" id="question`+question_number+`"></textarea>
                    </div>
                </div>
            </div>`);

            CKEDITOR.replace( 'question'+question_number );
        });

    </script>

    <script>
        $(document).on('submit', 'form#Form', function (e) {
            e.preventDefault();
            var form_data = new FormData(document.getElementById("Form"));
            var url = $('#Form').attr('action');
            $.ajax({
                type: 'POST',
                url: url,
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $('#global-loader').show()
                },
                success: function (data) {
                    window.setTimeout(function() {
                        $('#global-loader').hide()
                        if (data.success == 'true') {
                            var messages = Object.values(data.messages);
                            $( messages ).each(function(index, message ) {
                                my_toaster(message)
                            });
                        }
                    }, 1000);
                }, error: function (data) {
                    $('#global-loader').hide()
                    var error = Object.values(data.responseJSON.errors);
                    $( error ).each(function(index, message ) {
                        my_toaster(message,'error')
                    });
                }
            });
        });
    </script>

@endpush
