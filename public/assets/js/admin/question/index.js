'use strict';

var createQuestion = {};
var editQuestion = {};
var deleteQuestion = {};

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
                    success: function (res) {
                        if(res.status == true) {
                            Swal.fire(
                                'Success!',
                                res.msg,
                                'success'
                                );
                                location.reload();
                        }
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
                $.ajax({
                    type: "POST",
                    url: QUESTION_DELETE_URL,
                    data: {
                        'id':$(this).data('id')
                    },
                    cache: false,
                    dataType: 'JSON',
                    success: function (res) {
                        if(res.status == true) {
                            location.href= QUESTION_LIST_URL,
                            Swal.fire(
                                'Success!',
                                res.msg,
                                'success'
                                );
                        }
                    },
                    error: function (xhr) {
                        $(deleteQuestion.elements.submitQuestion).text('Submit');
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            var oldString = key;
                            var newString = oldString.split('.', 1)[0];
                            $('#js_'+newString+'_error').text(value);
                        });
                    },
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

