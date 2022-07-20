'use strict';

var editQuestion = {};


(function(editQuestion){

    editQuestion.elements = {
        editquestion : '#js_update_question',
        updateQuestionForm : '#js_update_question_form',
    }

    editQuestion.init = () => {
        editQuestion.bindControls();
    }

    editQuestion.bindControls = () => {

        $(document).on('click', editQuestion.elements.editquestion, function (e) {
                e.preventDefault();
                $(editQuestion.elements.updateQuestionForm).submit();
        })

        $(editQuestion.elements.updateQuestionForm).validate({
            rules: {
                question: {
                    required: true
                },
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
                    success: function (res) {
                        if(res.status == true) {
                            Swal.fire(
                            'Success!',
                            res.msg,
                            'success'
                            );
                            location.reload();
                        }
                        
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