'use strict'

var createExamQuestion = {};

(function(createExamQuestion){

    createExamQuestion.elements = {
        submitBtn : '#js_submit_exam_question',
        formSave : '#js_form_exam_question'
    }

    createExamQuestion.init = () => {
        createExamQuestion.bindControls();
    }

    createExamQuestion.bindControls = () => {

        $(document).on('click', createExamQuestion.elements.submitBtn, function (e) {
                e.preventDefault();
                $(createExamQuestion.elements.formSave).submit();
        })

        $(createExamQuestion.elements.formSave).validate({
            rules: {
                exam_id: {
                    required: true
                },
                question_id: {
                    required: false,
                }
            },
            submitHandler: function (form) {
                var formData = new FormData($(createExamQuestion.elements.formSave)[0]);
                $.ajax({
                    type: "POST",
                    url: EXAM_QUESTION_STORE_URL,
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
                        console.log(xhr);
                    },
                });
            },
        });
    }

})(createExamQuestion);


$(document).on('click', '.js_delete_question', function (e) {
    e.preventDefault();
    console.log($(this).data('id'));
    $.ajax({
        type: "POST",
        url: EXAM_QUESTION_DELETE_URL,
        data: {
            id : $(this).data('id')
        },
        cache: false,
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
            console.log(xhr);
        },
    });
})

$(document).on('click', '.js_add_question', function (e) {
    e.preventDefault();
    console.log($('#js_exam_id').val());
    $.ajax({
        type: "POST",
        url: EXAM_QUESTION_STORE_URL,
        data: {
            question_id : $(this).data('id'),
            exam_id : $('#js_exam_id').val()
        },
        cache: false,
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
            console.log(xhr);
        },
    });
})