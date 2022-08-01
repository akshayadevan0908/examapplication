@extends('layouts.dashboard-layout')

@push('styles')

@endpush

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12" id="accordion">
                @foreach($questions as $question)
                <form id="js_form_question">
                    <div class="card card-primary card-outline questioncard">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne{{$question->_id}}">
                            <div class="card-header">
                                <h4 class="card-title w-100">
                                    {{$loop->iteration}}. {{$question->question}}
                                </h4>
                            </div>
                        </a>
                        <div id="collapseOne{{$question->_id}}" class="collapse questioncardBody" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="question_id" value="{{$question->_id}}">
                                        @foreach($question->answer_options as $option)
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input required class="form-check-input answer_option" name="answer_option{{$question->_id}}" id="js_answer_option" type="radio" value="option_{{$loop->iteration}}">
                                                    <input type="text" disabled required="" name="option_{{$loop->iteration}}" value="{{$option['text']}}" class="form-control">
                                                    <span id="js_answer_option{{$question->_id}}_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-1"></div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary js_submit_exam_question" data-quid="{{$question->_id}}" value="Confirm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('script')
<script src="{{asset('/assets/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/student/exam/index.js')}}"></script> 

<script>
   var ATTEND_EXAM_URL = '{{ route('student.exam.attend-exam')}}'
   $(document).ready(function () {
        attendQuestion.init();
   });
   var QID = '';
   var OPTION = '';
</script>
@endpush