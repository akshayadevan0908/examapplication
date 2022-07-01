'use strict';

var createTeacher = {};

(function(createTeacher){

    createTeacher.elements = {
        submitTeacher : '#submit_teacher',
        formTeacher : '#form_teacher'
    }

    createTeacher.init = () => {
        createTeacher.bindControls();
    }

    createTeacher.bindControls = () => {

        $(document).on('click', createTeacher.elements.submitTeacher, function (e) {
                e.preventDefault();
                $(createTeacher.elements.formTeacher).submit();
        })

        $(createTeacher.elements.formTeacher).validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                },
                password: {
                    required: true,
                },
            },
            submitHandler: function (form) {
                var formData =new FormData($(createTeacher.elements.formTeacher)[0]);
                $.ajax({
                    type: "POST",
                    url: TEACHER_STORE_URL,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'JSON',
                    beforeSend: function () {
                        $(createTeacher.elements.formTeacher).text('Please wait..');
                    },
                    success: function (res) {
                        if(res.status == true) {
                            location.href = TEACHER_LIST_URL
                        }
                        Swal.fire(
                            'Success!',
                            res.msg,
                            'success'
                            );
                        $(createTeacher.elements.formTeacher)[0].reset();
                        $(createTeacher.elements.submitTeacher).text('Submit');
                    },
                    error: function (xhr) {
                        $(createTeacher.elements.submitTeacher).text('Submit');
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            var oldString = key;
                            var newString = oldString.split('.', 1)[0];
                            $('#js_'+newString+'_error').text(value);
                        });
                    },
                });
            },
        });
    }

})(createTeacher);

