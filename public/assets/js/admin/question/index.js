'use strict';

var createQuestion = {};
var editQuestion = {};
var deleteQuestion = {};
var mainTable = '#js-question-list';

$(document).ready(function () {
    let base_url = window.location.origin;
    $('#js-question-list').DataTable({
        'processing': true,
        'serverSide': true,
        'ajax': {
            url: base_url + "/admin/question/question-list-table",
            method: "POST",
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            cache: false
        },
        "columns": [
            {
                "data": "question"
            },
            {
                "targets": 2,
                "data": "question_type",
                "render": function (data, type, row, meta) {
                    if (row.question_type == 2) {
                        type = 'Question Text Answer Image';
                        return type;
                    }
                    else if (row.question_type == 1) {
                        type = 'Question Text Answer Text';
                        return type;
                    }
                    else if (row.question_type == 3) {
                        type = 'Question Text Image Answer Text';
                        return type;
                    }
    
                }
            },
            {
                "data": "score"
            },
            {
                "data": "editaction"
            },
            {
                "data": "deleteaction"
            },

            ],
            "columnDefs": [{
                "searchable": true
            }]
    });
});

(function(createQuestion){

    createQuestion.elements = {
        submitQuestion : '#submit_question',
        formQuestion : '#form_question'
    }

    createQuestion.init = () => {
        createQuestion.bindControls();
    }

    createQuestion.bindControls = () => {

        $(document).on('click', createQuestion.elements.submitQuestion, function (e) {
                e.preventDefault();
                $(createQuestion.elements.formQuestion).submit();
        })

        var validator = $(createQuestion.elements.formQuestion).validate({
            rules: {
                question: {
                    required: true
                },
                score: {
                    required: true,
                },
                question_file: {
                    required: true,
                },
                option_4: {
                    required: true,
                },
                option_3: {
                    required: true,
                },
                option_2: {
                    required: true,
                },
                option_1: {
                    required: true,
                },
            },
            errorClass: "is-invalid text-danger",
            errorPlacement: function(error, element) {
           
                if (element.attr("name") =="question") {
                    
                    error.appendTo('#js-question-error')
                }
                else if (element.attr("name") == "score") {
                    
                    error.appendTo('#js-score-error')
                }
                else if (element.attr("name") == "question_type") {
                    
                    error.appendTo('#js-question_type-error')
                }
                else if (element.attr("name") == "option_4") {
                    
                    error.appendTo('#js-option_4-error')
                }
                else if (element.attr("name") == "option_3") {
                    
                    error.appendTo('#js-option_3-error')
                }
                else if (element.attr("name") == "option_2") {
                    
                    error.appendTo('#js-option_2-error')
                }
                else if (element.attr("name") == "option_1") {
                    
                    error.appendTo('#js-option_1-error')
                }
                 else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                var formData = new FormData($(createQuestion.elements.formQuestion)[0]);
                $.ajax({
                    type: "POST",
                    url: QUESTION_STORE_URL,
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
                                location.href = QUESTION_LIST_URL;
                        }
                        $(createQuestion.elements.formQuestion)[0].reset();
                        $(createQuestion.elements.submitQuestion).text('Submit');
                    },
                    error: function (xhr) {
                        validator.showErrors(xhr.responseJSON.errors);
                    },
                });
            },           
        });
    }

})(createQuestion);

(function(deleteQuestion){

    deleteQuestion.elements = {
        deleteQstn : '.js_delete_question',
    }

    deleteQuestion.init = () => {
        deleteQuestion.bindControls();
    }

    deleteQuestion.bindControls = () => {

        $(document).on('click', deleteQuestion.elements.deleteQstn, function (e) {
                e.preventDefault();
                var token = $("meta[name='csrf-token']").attr("content");
                Swal.fire({
                    text:"Are you sure, do you want to delete",
                    type:"warning",
                    showCancelButton:!0,
                    buttonsStyling:!1,
                    confirmButtonText:"Yes, delete!",
                    cancelButtonText:"No, cancel",
                    customClass:{
                        confirmButton:"btn fw-bold btn-danger",
                        cancelButton:"btn fw-bold btn-active-light-primary"
                    }
                    })
                    .then((isConfirm) => {
                        if (isConfirm.value) {
                            console.log($(this).data('id'));
                            $.ajax(
                            {
                                url: QUESTION_DELETE_URL,
                                type: 'POST',
                                data: {
                                    "id": $(this).data('id'),
                                    "_token": token,
                                },
                                success: function (res){
                                    if(res.status == true) {
                                        Swal.fire(
                                            'Deleted!',
                                            'Question Deleted Succesfully.',
                                            'success'
                                            );
                                        $(mainTable).DataTable().ajax.reload();
                                    }
                                }
                            });
                        }
                        else{
                            Swal.fire({
                                text:"Not Deleted.",
                                type:"error",
                                buttonsStyling:!1,
                                confirmButtonText:"Ok, got it!",
                                customClass:{
                                    confirmButton:"btn fw-bold btn-primary"
                                }
                            });
                            $(mainTable).DataTable().ajax.reload();
                        }
                    });
        })
    }
})(deleteQuestion);

$( document ).ready(function() {
    $('.question').hide();
    $('.optionimages').hide();
    $('.options').show();
    $('.questionimage').show();
    $("#myselect").on("change", function() { 
        console.log($(this).val());
        $('#form_type').val($(this).val());
        if($(this).val() == '1') {
            $('.options').show();
            $('.optionimages').hide();
            $('.question').show();
            $('.questionimage').hide();
        } else if($(this).val() == '2') {
            $('.options').hide();
            $('.question').show();
            $('.optionimages').show();
            $('.questionimage').hide();
        } else {
            $('.options').hide();
            $('.question').show(); 
            $('.options').show();
            $('.questionimage').show();
            $('.optionimages').hide();
        }
    })
});

