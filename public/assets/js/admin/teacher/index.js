'use strict';

var createTeacher = {};
var teacherProfileUpdate = {};

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
                            Swal.fire(
                                'Success!',
                                res.msg,
                                'success'
                                );
                            location.href = TEACHER_LIST_URL
                        }
                        
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



(function(teacherProfileUpdate){

    teacherProfileUpdate.elements = {
        saveProfileBtn: '#js_profile_save_btn',
        formTeacherProfile : '#js_profile_form'
    }

    teacherProfileUpdate.init = () => {
        teacherProfileUpdate.bindControls();
    }

    teacherProfileUpdate.bindControls = () => {

        $(document).on('click', teacherProfileUpdate.elements.saveProfileBtn, function (e) {
                e.preventDefault();
                $(teacherProfileUpdate.elements.formTeacherProfile).submit();
        })

        $(teacherProfileUpdate.elements.formTeacherProfile).validate({
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
                var formData =new FormData($(teacherProfileUpdate.elements.formTeacherProfile)[0]);
                $.ajax({
                    type: "POST",
                    url: TEACHER_UPDATE_URL,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'JSON',
                    success: function (res) {
                        if(res.status == true) {
                            Swal.fire(
                                'Success!',
                                res.msg,
                                'success'
                                );
                        location.reload();
                        }
                    },
                    error: function (xhr) {
                        $('.js_change_password_validation').html('');
                        $(changePassword.elements.formTeacherProfile).text('Submit');
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('#js_change_'+key+'_error').text(value);
                        });
                    },
                });
            },
        });
    }

})(teacherProfileUpdate);

