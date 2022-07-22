'use strict'

var createExam = {};
var changeExamStatus = {};


(function(createExam){

    createExam.elements = {
        submitExamBtn : '#js_submit_exam',
        formExam : '#js_form_exam'
    }

    createExam.init = () => {
        createExam.bindControls();
    }

    createExam.bindControls = () => {

        $(document).on('click', createExam.elements.submitExamBtn, function (e) {
                e.preventDefault();
                $(createExam.elements.formExam).submit();
        })

        $(createExam.elements.formExam).validate({
            rules: {
                title: {
                    required: true
                },
            },
            submitHandler: function (form) {
                var formData = new FormData($(createExam.elements.formExam)[0]);
                $.ajax({
                    type: "POST",
                    url: EXAM_STORE_URL,
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
                        }
                        location.href = "http://127.0.0.1:8000/admin/exam/index";
                        $(createExam.elements.formExam)[0].reset();
                    },
                    error: function (xhr) {
                        $(createExam.elements.formExam).text('Submit');
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

})(createExam);


(function(changeExamStatus){

    changeExamStatus.elements = {
        changeExamBtn : '#js_change_status',
    }

    changeExamStatus.init = () => {
        changeExamStatus.bindControls();
    }

    changeExamStatus.bindControls = () => {
            $('input[name="status"]').change(function (e) {
                var status = $(this).prop('checked') == true ? 1 : 0; 
                console.log(status);
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: EXAM_STATUS_CHANGE_URL,
                    data: {
                        id : $(this).data('id'),
                        status : status
                    },
                    cache: false,
                    dataType: 'JSON',
                    success: function (res) {
                        if(res.status == true) {
                            Swal.fire(
                                'Success!',
                                res.message,
                                'success'
                                );
                        }
                        location.reload();
                        $(changeExamStatus.elements.formExam)[0].reset();
                    },
                    error: function (xhr) {
                        console.log(xhr);
                    },
                });
        })
    }

})(changeExamStatus);