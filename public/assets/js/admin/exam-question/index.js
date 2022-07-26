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
    var id = $(this).data('id');
    var questionType = $(this).data('qtype');
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
                $('#js_text'+id).html('Remove');
                $('#js_question_value').val(res.data.question);
                $('#js_mark').val(res.data.score);
                if(res.data.question_type == 1){
                    var correctAnswer = '#js_'+res.data.answer_options[0].answer_option_id;
                    $('#js_question_section').show();
                    $('#js_question').show();
                    $('#js_type_option_type1').show();
                    $('#js_answer_text_1').val(res.data.answer_options[0].text);
                    $('#js_answer_text_2').val(res.data.answer_options[1].text);
                    $('#js_answer_text_3').val(res.data.answer_options[2].text);
                    $('#js_answer_text_4').val(res.data.answer_options[3].text);
                    $('#js_answer_option').val(res.data.answer_options[0].answer_option_id);
                    $(correctAnswer).prop('checked', true);
                } else if(res.data.question_type == 2) {
                    $('#js_question_section').show();
                    $('#js_question').show();
                    $('#js_type_option_type2').show();

                } else if(res.data.question_type == 3) {
                    console.log(res.data.question_image);
                    $('.div_imagetranscrits').html('<img src="/storage/images/' + res.data.question_image + '" width="350px" height="300px">');
                    $('#js_question_section').show();
                    $('#js_question').show();
                    $('#js_type_option_type3').show();
                }
            }
        },
        error: function (xhr) {
            console.log(xhr);
        },
    });
})


$(document).ready(function() {
    $('#js_selected_question').hide();
    $('#js_type_option_type1').hide();
    $('#js_type_option_type2').hide();
    $('#js_type_option_type3').hide();
    $('#js_question').hide();
    $('#js_question_section').hide();
});