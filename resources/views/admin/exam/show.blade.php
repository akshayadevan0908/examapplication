@extends('layouts.dashboard-layout')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Create Exam Question</h3>
              <i class="fa fa-plus float-right" aria-hidden="true"></i>
            </div>
            <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Exam</label>
                      <input class="form-control" type="" value="{{ $exam->title}}" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <button type="button" class="btn btn-primary"  data-toggle="modal" data-target=".addQuestionModal">Add Question</button>
                    </div>
                </div>
              </div>
              </div>
            </div>

            <div class="card card-info" id="js_question_section">
              <div class="card-header">
                <h3 class="card-title">Selected Question</h3>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      
                      <div id="js_question">
                        <div class="form-group">
                          <label for="inputClientCompany">Question</label>
                          <input type="text"  class="form-control" id="js_question_value">
                        </div>

                        <input type="file" name="question_file" class="form-control" placeholder="image">
                        <img src="http://127.0.0.1:8000/storage/questions/optionimage1658840493.jpeg" width="150px" height="150px">
                        
                        <div class="form-group">
                          <label for="score">Mark</label>
                          <input type="number" id="js_mark" class="form-control">
                          @error('score')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                    <div class="" id="js_type_option_type2">
                      <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" name="answer_option" type="radio" value="">
                            <label for="exampleInputFile">Option</label>
                            <input type="file" class="form-control">
                            <img src="{{ asset('storage/questions/') }}" width="150px" height="150px">
                        </div>
                      </div>
                    </div>

                      <div class="" id="js_type_option_type1">
                        <div class="form-group">
                          <div class="form-check">
                              <input class="form-check-input" type="radio" id="js_option_1">
                              <label for="exampleInputFile">Option 1</label>
                              <input type="text" id="js_answer_text_1" class="form-control">
                          </div>
                        </div>
  
                        <div class="form-group">
                          <div class="form-check">
                              <input class="form-check-input" type="radio" id="js_option_2">
                              <label for="exampleInputFile">Option 2</label>
                              <input type="text" id="js_answer_text_2" class="form-control">
                          </div>
                        </div>
  
                        <div class="form-group">
                          <div class="form-check">
                              <input class="form-check-input" type="radio" id="js_option_3">
                              <label for="exampleInputFile">Option 3</label>
                              <input type="text" id="js_answer_text_3" class="form-control">
                          </div>
                        </div>
  
                        <div class="form-group">
                          <div class="form-check">
                              <input class="form-check-input" type="radio" id="js_option_4" >
                              <label for="exampleInputFile">Option 4</label>
                              <input type="text" id="js_answer_text_4" class="form-control">
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

          </div>
        </div>
      </div>
  </section>
@include('admin/exam/includes/add-question')
@endsection

@push('script')
<script src="{{asset('/assets/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/admin/exam-question/index.js')}}"></script>
<script>
    var EXAM_QUESTION_STORE_URL = '{{ route('admin.exam.store-question-to-exam')}}'
    var GET_QUESTION_DATA = '{{ route('admin.question.get-details')}}'
    $(document).ready(function () {
        createExamQuestion.init();
    });
</script>
@endpush