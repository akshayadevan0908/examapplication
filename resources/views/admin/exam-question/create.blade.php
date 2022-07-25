@extends('layouts.dashboard-layout')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Create Exam Question</h3>
            </div>
            <div class="card-body">
              <form id="js_form_exam_question">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                        <label>Exam</label>
                        <select class="form-control" name="exam_id">
                          <option value="">--Select--</option>
                          @foreach($exams as $exam)
                            <option value="{{$exam->_id}}">{{ $exam->title}}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                        <label>Question</label>
                        <select class="form-control" name="question_id">
                            <option value="">--Select--</option>
                          @foreach($questions as $question)
                            <option value="{{ $question->_id}}">{{ $question->question}}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>
                </div>
                <div class="card-footer">
                    <input type="submit" id="js_submit_exam_question" value="Submit" class="btn btn-primary">
                  </div>
                </form>
                </div>
            </div>
          </div>
        </div>
      </div>
  </section>
@endsection

@push('script')
<script src="{{asset('/assets/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/admin/exam-question/index.js')}}"></script>
<script>
    var EXAM_QUESTION_STORE_URL = '{{ route('admin.exam-question.store')}}'
    $(document).ready(function () {
        createExamQuestion.init();
    });
</script>
@endpush