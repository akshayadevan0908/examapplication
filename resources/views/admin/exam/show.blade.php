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
                <div id="js_question_type_2">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputClientCompany">Question</label>
                      <input type="text" id="js_question" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="score">Mark</label>
                      <input type="number" id="js_mark" class="form-control">
                    </div>

                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" id="js_option_1" type="radio">
                        <label for="exampleInputFile">Option 1</label>
                        <img src="" id="js_image_1" width="150px" height="150px">
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" id="js_option_2" type="radio">
                        <label for="exampleInputFile">Option 2</label>
                        <img src="" id="js_image_2" width="150px" height="150px">
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" id="js_option_3" type="radio">
                        <label for="exampleInputFile">Option 3</label>
                        <img src="" id="js_image_3" width="150px" height="150px">
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" id="js_option_4" type="radio">
                        <label for="exampleInputFile">Option 4</label>
                        <img src="" id="js_image_4" width="150px" height="150px">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <button type="button" class="btn btn-tool js_remove_qstn" data-id="62e0bb34476ef87e5f05e6b8" data-card-widget="remove" id="js_question_id">
                      <i class="fas fa-times"></i>
                      </button>
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
    var EXAM_QUESTION_DELETE_URL = '{{ route('admin.exam.delete')}}'
    $(document).ready(function () {
        createExamQuestion.init();
    });
</script>
@endpush