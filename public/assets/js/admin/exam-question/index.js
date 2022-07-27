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
    var id = $(this).data('id');
    var BaseUrl =$('#BaseUrl').val();
    e.preventDefault();
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
                console.log(res.data.question_type);
                $('#js_text'+id).html('Remove');
                if(res.data.question_type == 2){
                    console.log(res.data.question_type);
                    $('#js_question_section').show();
                    $('#js_question_type_2').show();
                    $('#js_question').val(res.data.question);
                    $('#js_mark').val(res.data.score);
                    var correctAnswer = '#js_'+res.data.answer_options[0].answer_option_id;
                    $(correctAnswer).prop('checked', true);
                    $("#js_image_1").attr('src', BaseUrl+ '/storage/questions/'+ res.data.answer_options[0].image);
                    $("#js_image_2").attr('src', BaseUrl+ '/storage/questions/'+ res.data.answer_options[1].image);
                    $("#js_image_3").attr('src', BaseUrl+ '/storage/questions/'+ res.data.answer_options[2].image);
                    $("#js_image_4").attr('src', BaseUrl+ '/storage/questions/'+ res.data.answer_options[3].image);
                    $('#js_question_id').val(res.data.question_id);

                } else if(res.data.question_type == 1) {
                    console.log(res.data.question_type);
                    $('#js_question_section').show();
                    $('#js_question_type_1').show();
                    $('#js_question_type1').val(res.data.question);
                    $('#js_mark_type1').val(res.data.score);
                    var correctAnswer = '#js_'+res.data.answer_options[0].answer_option_id+'_type1';
                    $(correctAnswer).prop('checked', true);
                    $('#js_option1').val(res.data.answer_options[0].text);
                    $('#js_option2').val(res.data.answer_options[1].text);
                    $('#js_option3').val(res.data.answer_options[2].text);
                    $('#js_option4').val(res.data.answer_options[3].text);
                    
                } else if(res.data.question_type == 3) {
                    console.log(res.data.question_type);
                    $('#js_question_section').show();
                    $('#js_question_type_3').show();
                    $('#js_question_type3').val(res.data.question);
                    $('#js_mark_type3').val(res.data.score);
                    var correctAnswer = '#js_'+res.data.answer_options[0].answer_option_id+'_type3';
                    $(correctAnswer).prop('checked', true);
                    $('#js_option1_type3').val(res.data.answer_options[0].text);
                    $('#js_option2_type3').val(res.data.answer_options[1].text);
                    $('#js_option3_type3').val(res.data.answer_options[2].text);
                    $('#js_option4_type3').val(res.data.answer_options[3].text);
                    $("#js_question_image").attr('src', BaseUrl+ '/storage/questions/'+ res.data.question_image);
                } else {
                    console.log('else');
                }
            }
        },
        error: function (xhr) {
            console.log(xhr);
        },
    });
})


$(document).on('click', '.js_remove_qstn', function (e) {
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
            }
        },
        error: function (xhr) {
            console.log(xhr);
        },
    });
})



$(document).ready(function() {
//     $('#js_question_section').hide();
//     $('#js_question_type_2').hide();
//     $('#js_question_type_1').hide();
//     $('#js_question_type_3').hide();
// });