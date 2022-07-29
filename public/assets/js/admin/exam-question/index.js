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
                $("#remove-test-"+id).toggle();
                $("#add-test-"+id).toggle();
                $('#js_question_section').show();
                if(res.data.question_type == 2){
                    $('#js_question_type_2').show();
                    var typeData2 = '';
                    typeData2 += '<div class="row">';
                    typeData2 += '<div class="col-md-6">';
                    typeData2 += '<div class="form-group">';
                    typeData2 += '<label for="inputClientCompany">Question</label>';
                    typeData2 += '<input type="text" id="js_question_type2" class="form-control" value="'+res.data.question+'">';
                    typeData2 += '</div>';
                    typeData2 += '<div class="form-group">';
                    typeData2 += '<label for="score">Mark</label>';
                    typeData2 += '<input type="number" id="js_mark_type2" class="form-control" value="'+res.data.score+'">';
                    typeData2 += ' </div>';

                    for (let index = 1; index < 5; index++) {
                        var checkedStatus = '';
                        var answerKey     = res.data.answer_options[0].answer_option_id.split("_");
                    
                        if (answerKey[1] == index) {
                            checkedStatus = 'checked';
                        }
                        typeData2 += '<div class="form-group">';
                        typeData2 += '<div class="form-check">';
                        typeData2 += '<input class="form-check-input" id="js_option_'+index+'_type1" '+checkedStatus+' type="radio">';
                        typeData2 += '<label for="exampleInputFile">Option '+index+'</label>';
                        typeData2 += '<img src="/storage/questions/'+res.data.answer_options[index-1].image+'" id="js_image_1" width="150px" height="150px">';
                        typeData2 += '</div>';
                        typeData2 += '</div>';
                    }

                    typeData2 += '<div class="col-md-6">';
                    typeData2 += '<button type="button" class="btn btn-tool js_remove_qstn" data-id=""  id="js_question_id_type2">';
                    typeData2 += '<i class="fas fa-times"></i>';
                    typeData2 += '</button>';
                    typeData2 += '</div>';
                    typeData2 += '</div>';
                    $('#js_question_type_2').append(typeData2);

                } else if(res.data.question_type == 1) {
                    $('#js_question_type_1').show();
                    var typeData1 = '';
                    typeData1 += '<div class="row">';
                    typeData1 += '<div class="col-md-6">';
                    typeData1 += '<div class="form-group">';
                    typeData1 += '<label for="inputClientCompany">Question</label>';
                    typeData1 += '<input type="text" id="js_question_type1" class="form-control" value="'+res.data.question+'">';
                    typeData1 += '</div>';
                    typeData1 += '<div class="form-group">';
                    typeData1 += '<label for="score">Mark</label>';
                    typeData1 += '<input type="number" id="js_mark_type1" class="form-control" value="'+res.data.score+'">';
                    typeData1 += '</div>';
                    for (let index = 1; index < 5; index++) {
                        var checkedStatus = '';
                        var answerKey     = res.data.answer_options[0].answer_option_id.split("_");
                    
                        if (answerKey[1] == index) {
                            checkedStatus = 'checked';
                        }
                        typeData1 += '<div class="form-group">';
                        typeData1 += '<div class="form-check">';
                        typeData1 += '<input class="form-check-input" id="js_option_'+index+'_type1" '+checkedStatus+' type="radio">';
                        typeData1 += '<label for="exampleInputFile">Option '+index+'</label>';
                        typeData1 += '<input type="text" id="js_option'+index+'" class="form-control" value="'+res.data.answer_options[index-1].text+'">';
                        typeData1 += '</div>';
                        typeData1 += ' </div>';
                    }
                    typeData1 += '<div class="col-md-6">';
                    typeData1 += '<button type="button" class="btn btn-tool js_remove_qstn" data-id="'+res.data.question_id+'">';
                    typeData1 += '<i class="fas fa-times"></i>';
                    typeData1 += '</button>';
                    typeData1 += '</div>';
                    typeData1 += '</div>';
                    typeData1 += '</div>';

                    $('#js_question_type_1').append(typeData1);

                } else if(res.data.question_type == 3) {
                    var image = '/storage/questions/'+res.data.question_image;
                    $('#js_question_type_3').show();
                    var typeData3 = '';
                    typeData3+= '<div class="row" id="'+res.data.question_id+'">'; 
                    typeData3+= '<div class="col-md-6">';
                    typeData3+= '<div class="form-group">';
                    typeData3+= '<label for="inputClientCompany">Question</label>';
                    typeData3+= '<input type="text" id="js_question_type3" class="form-control" value="'+res.data.question+'">';
                    typeData3+= '</div>';
                    typeData3+= '<img src="'+image+'" id="js_question_image" width="150px" height="150px">';

                    typeData3+= '<div class="form-group">';
                    typeData3+= '<label for="score">Mark</label>';
                    typeData3+= '<input type="number" id="js_mark_type3" class="form-control" value="'+res.data.score+'">';
                    typeData3+= '</div>';
                    
                    for(let index = 1; index < 5; index++) {
                        var checkedStatus = '';
                        var answerKey     = res.data.answer_options[0].answer_option_id.split("_");
                    
                        if (answerKey[1] == index) {
                            checkedStatus = 'checked';
                        }
                        typeData3+= '<div class="form-group">';
                        typeData3+= '<div class="form-check">';
                        typeData3+= '<input class="form-check-input" id="js_option_'+index+'_type1" '+checkedStatus+' type="radio">';
                        typeData3+= '<label for="exampleInputFile">Option '+index+'</label>';
                        typeData3+= '<input type="text" id="js_option'+index+'" class="form-control" value="'+res.data.answer_options[index-1].text+'">';
                        typeData3+= '</div>';
                        typeData3+= '</div>';
                    }

                    typeData3+= '<div class="col-md-6">';
                    typeData3+= '<button type="button" class="btn btn-tool js_remove_qstn" data-id="'+res.data.question_id+'">';
                    typeData3+= '<i class="fas fa-times"></i>';
                    typeData3+= '</button>';
                    typeData3+= '</div>';

                    typeData3+= '</div>';
                    typeData3+= '</div>';

                    $('#js_question_type_3').append(typeData3);
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
    var questionId = $(this).data('id');
    $.ajax({
        type: "POST",
        url: EXAM_QUESTION_DELETE_URL,
        data: {
            id : $(this).data('id')
        },
        cache: false,
        dataType: 'JSON',
        success: function (res) {
            $("#"+questionId).remove();
            $("#remove-test-"+questionId).hide();
            $("#add-test-"+questionId).show();
        },
        error: function (xhr) {
            console.log(xhr);
        },
    });
})



$(document).on('click', '#js_save_exam', function (e) {
    e.preventDefault();
    var exam_id = $(this).data('examid');
    var url = $(this).data('href');
    $.ajax({
        type: "POST",
        url: url,
        data: {
            exam_id : exam_id,
            url: url
        },
        cache: false,
        dataType: 'JSON',
        success: function (res) {
            // $("#js_exam_update").load(" #js_exam_update");
            swal({
                title: "Success!",
                text: res.msg,
                type: "success",
                timer: 3000
                });
                function () {
                   location.reload(true);
                   tr.hide();
                };
        },
        error: function (xhr) {
            console.log(xhr);
        },
    });
})



$(document).ready(function() {
    $('#js_question_section').hide();
    $('#js_question_type_2').hide();
    $('#js_question_type_1').hide();
    $('#js_question_type_3').hide();
});