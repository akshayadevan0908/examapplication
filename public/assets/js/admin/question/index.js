'use strict';

var createQuestion = {};
var editQuestion = {};

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

        $(createQuestion.elements.formQuestion).validate({
            rules: {
                question: {
                    required: true
                },
                // answer_option: {
                //     required: true,
                // },

                // option_a: {
                //     required: false,
                // },
                // option_b: {
                //     required: false,
                // },
                // option_c: {
                //     required: false,
                // },
                // option_d: {
                //     required: false,
                // },

                // option_a_file: {
                //     required: false,
                // },
                // option_b_file: {
                //     required: false,
                // },
                // option_c_file: {
                //     required: false,
                // },
                // option_d_file: {
                //     required: false,
                // },
                score: {
                    required: false,
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
                    // beforeSend: function () {
                    //     $(createQuestion.elements.formQuestion).text('Please wait..');
                    // },
                    success: function (res) {
                        if(res.status == true) {
                            location.href = QUESTION_LIST_URL
                        }
                        Swal.fire(
                            'Success!',
                            res.msg,
                            'success'
                            );
                        $(createQuestion.elements.formQuestion)[0].reset();
                        $(createQuestion.elements.submitQuestion).text('Submit');
                    },
                    error: function (xhr) {
                        $(createQuestion.elements.submitQuestion).text('Submit');
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

})(createQuestion);

(function(editQuestion){

    editQuestion.elements = {
        editQuestion : '#js_update_question',
        updateQuestionForm : '#js_update_question_form',
    }

    editQuestion.init = () => {
        editQuestion.bindControls();
    }

    editQuestion.bindControls = () => {

        $(document).on('click', editQuestion.elements.editQuestion, function (e) {
                e.preventDefault();
                $(editQuestion.elements.updateQuestionForm).submit();
        })

        $(editQuestion.elements.updateQuestionForm).validate({
            rules: {
                question: {
                    required: true
                },
                // score: {
                //     required: false,
                // }
            },
            submitHandler: function (form) {
                var formData = new FormData($(editQuestion.elements.updateQuestionForm)[0]);
                $.ajax({
                    type: "POST",
                    url: QUESTION_UPDATE_URL,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'JSON',
                    // beforeSend: function () {
                    //     $(createQuestion.elements.formQuestion).text('Please wait..');
                    // },
                    success: function (res) {
                        if(res.status == true) {
                            location.href = QUESTION_LIST_URL
                        }
                        Swal.fire(
                            'Success!',
                            res.msg,
                            'success'
                            );
                        $(editQuestion.elements.formQuestion)[0].reset();
                        $(editQuestion.elements.submitQuestion).text('Submit');
                    },
                    error: function (xhr) {
                        $(editQuestion.elements.submitQuestion).text('Submit');
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

})(editQuestion);

$( document ).ready(function() {
    $('.question').hide();
    $('.optionimages').hide();
    $('.options').hide();
    $('.questionimage').hide();
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

