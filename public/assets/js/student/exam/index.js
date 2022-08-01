'use strict';

var mainTable = '#js-exam-list';
var attendQuestion = {};

$(document).ready(function () {
    let base_url = window.location.origin;
    $('#js-exam-list').DataTable({
        'processing': true,
        'serverSide': true,
        'ajax': {
            url: base_url + "/student/exam/exam-list-table",
            method: "POST",
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            cache: false
        },
        "columns": [
            {
                "data": "title"
            },
            {
                "targets": 2,
                "data": "status",
                "render": function (data, type, row, meta) {
                    if (row.status == 1) {
                        type = 'active';
                        return type;
                    }
                    else if (row.status == 0) {
                        type = 'inactive';
                        return type;
                    }
                }
            },
            {
                "data": "actions"
            },
            ],
            "columnDefs": [{
                "searchable": true
            }]
    });
    
});

$(".questioncard").on('click', function (event) {
   
    if (!$(event.target).closest('.questioncardBody').length) {
      $('input[name="answer_option"]').prop('checked', false);
    }
});


// $(".questioncard").click(function(){
//     var answerOptn = $("input[name='answer_option']:checked").val();
//     console.log('---------------');
//     console.log(answerOptn);
//     // if(answerOptn) {
//     //     $('input[name="answer_option"]').prop('checked', false);
//     // }
// });


(function(attendQuestion){
    attendQuestion.elements = {
        confirmBtn   : '.js_submit_exam_question',
        answerOptn   : '#js_answer_option',
        formQuestion : '#js_form_question'
    }
    attendQuestion.init = () => {
        attendQuestion.bindControls();
    }
    attendQuestion.bindControls = () => {
        $(document).on('click', attendQuestion.elements.confirmBtn, function (e) {
                e.preventDefault();
                // var formData = new FormData($(attendQuestion.elements.formQuestion)[0]);
                // console.log('hii');
                // OPTION = '';
                // OPTION = $("input[name='answer_option']:checked").val(); 
                // QID = '';
                // QID = $(this).data('quid');
                $(attendQuestion.elements.formQuestion).submit();
        });

        var validator = $(attendQuestion.elements.formQuestion).validate({
            rules: {
                answer_option: {
                    required: true
                },
            },
            errorClass: "is-invalid text-danger",
            // errorPlacement: function(error, element) {
            //     if (element.attr("name") =="answer_option") {
            //         error.appendTo('#js-question-error')
            //     }
            // },
            submitHandler: function (form) {
                var formData = new FormData($(attendQuestion.elements.formQuestion)[0]);
                $.ajax({
                    type: "POST",
                    url: ATTEND_EXAM_URL,
                    // data: {
                    //     question_id : QID,
                    //     answer_option : OPTION
                    // },
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
                    },
                    error: function (xhr) {
                        console.log(xhr.responseJSON.errors);
                        validator.showErrors(xhr.responseJSON.errors);
                    },
                });
            },           
        });

    }

})(attendQuestion);