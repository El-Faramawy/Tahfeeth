<script>
    $(document).on('click', '.recordsBtn', function (e) {
        e.preventDefault()
        $('#Modal').modal('show')
        var url = $(this).attr('href')
        setTimeout(function () {
            $('#form-load').load(url)
        }, 100)
    });

    $(document).on('click', ".record_submit", function (e) {
        e.preventDefault();
        var id = $('#id').val()
        var track = $(this).attr('status')
        var url = "{{route('change_user_track')}}?id=" + id + "&track=" + track ;
        $.ajax({
            url: url,
            type: 'POST',
            beforeSend: function () {
                $('#global-loader').show()
            },
            success: function (data) {

                window.setTimeout(function () {
                    $('#global-loader').hide()
                    if (data.success === 'true') {
// alert(1)
                        $('#Modal').modal('hide')
                        my_toaster(data.message)
                        $('#exportexample').DataTable().ajax.reload(null, false);
                    }
                }, 100);

            },
            error: function (data) {
                $('#global-loader').hide()
                console.log(data)
                if (data.status === 500) {
                    my_toaster('هناك خطأ', 'error')
                }

                if (data.status === 422) {
                    var errors = $.parseJSON(data.responseText);

                    $.each(errors, function (key, value) {
                        if ($.isPlainObject(value)) {
                            $.each(value, function (key, value) {
                                my_toaster(value, 'error')
                            });

                        } else {

                        }
                    });
                }
                if (data.status == 421) {
                    my_toaster(data.message, 'error')
                }

            },//end error method

            cache: false,
            contentType: false,
            processData: false
        });
    });
</script>
