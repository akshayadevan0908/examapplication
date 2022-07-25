
  @extends('layouts.dashboard-layout')

  @push('styles')
  @endpush
  
  @section('content')
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Question</h3>
          </div>
          <div class="card-body">
            <form action="" method="POST" id="form_question">
              <span id="js_answer_option_error" class="text-danger"></span>
            <input type="hidden" value="1" name="form_type" id="form_type">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Question</label>
                  <input type="text" required name="question" value="{{ old('question')}}" class="form-control">
                  @error('question')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group questionimage">
                  <input type="file" name="question_file" class="form-control">
                    @error('question_file')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
  
                <div class="form-group">
                  <label for="score">Mark</label>
                  <input type="number" required name="score" value="{{ old('score')}}" class="form-control">
                  @error('score')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
  
                <div class="form-group">

                  <div class="optionimages">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" name="answer_option" type="radio" value="option_1">
                            <label for="exampleInputFile">Option A</label>
                            <input type="file" required name="option_1_file" class="form-control">
                            @error('option_1_file')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" name="answer_option" type="radio" value="option_2">
                            <label for="exampleInputFile">Option B</label>
                            <input type="file" required name="option_2_file" class="form-control">
                            @error('option_2_file')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" name="answer_option" type="radio" value="option_3">
                            <label for="exampleInputFile">Option C</label>
                            <input type="file" required name="option_3_file" class="form-control">
                            @error('option_3_file')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" name="answer_option" type="radio" value="option_4">
                            <label for="exampleInputFile">Option D</label>
                            <input type="file" required name="option_4_file" class="form-control">
                            @error('option_4_file')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                  </div>

                  <div class="row options">

                    <div class="form-group">
                      <div class="form-check">
                          <input class="form-check-input" name="answer_option" type="radio" value="option_1"></span>
                          <label for="exampleInputFile">Option A</label>
                          <input type="text" required name="option_1" value="{{ old('option_1')}}"  class="form-control">
                          @error('option_1')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" name="answer_option" type="radio" value="option_2"></span>
                          <label for="exampleInputFile">Option B</label>
                          <input type="text" required name="option_2" value="{{ old('option_2')}}" class="form-control">
                          @error('option_2')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" name="answer_option" type="radio" value="option_3"></span>
                          <label for="exampleInputFile">Option c</label>
                          <input type="text" required name="option_3" value="{{ old('option_3')}}" class="form-control">
                          @error('option_3')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" name="answer_option" type="radio" value="option_4"></span>
                          <label for="exampleInputFile">Option D</label>
                          <input type="text" required name="option_4" value="{{ old('option_4')}}" class="form-control">
                          @error('option_4')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                    </div>
                  </div>

                  <div class="card-footer">
                    <input type="submit" id="submit_question" value="Submit" class="btn btn-primary">
                  </div>
                  
                </div>

              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Question Type</label>
                  <select id="myselect" name="question_type" class="form-control">
                    @foreach(config('examapp.question_type') as $key =>$value)
                    <option value="{{$value}}" @if($value==3) selected @endif>{{$key}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            </form>
          </div>
          
        </div>
      </div>
    </section>
  @endsection

  @push('script')
  <script src="{{asset('/assets/js/jquery.validate.min.js')}}"></script>
  <script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
  
  
  <script type="text/javascript" src="{{asset('assets/js/admin/question/index.js')}}"></script>
  
  <script>
      var QUESTION_STORE_URL = '{{ route('admin.question.store')}}'
      var QUESTION_LIST_URL = '{{ route('admin.question.index')}}'
      $(document).ready(function () {
          createQuestion.init();
      });
  </script>
  @endpush