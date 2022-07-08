
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
                  <input type="text" name="question" value="{{ old('question')}}" class="form-control">
                  @error('question')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group questionimage">
                  <input type="file" class="form-control">
                </div>
  
                <div class="form-group">
                  <label for="score">Mark</label>
                  <input type="number" name="score" value="{{ old('score')}}" class="form-control">
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
                            <input type="file" name="option_a_file" class="form-control">
                            @error('option_a_file')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" name="answer_option" type="radio" value="option_2">
                            <label for="exampleInputFile">Option B</label>
                            <input type="file" name="option_b_file" class="form-control">
                            @error('option_b_file')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" name="answer_option" type="radio" value="option_3">
                            <label for="exampleInputFile">Option C</label>
                            <input type="file" name="option_c_file" class="form-control">
                            @error('option_c_file')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" name="answer_option" type="radio" value="option_4">
                            <label for="exampleInputFile">Option D</label>
                            <input type="file" name="option_d_file" class="form-control">
                            @error('option_d_file')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                  </div>

                  <div class="row options">

                    <div class="form-group">
                      <div class="form-check">
                          <input class="form-check-input" name="answer_option" type="radio" value="option_a"></span>
                          <label for="exampleInputFile">Option A</label>
                          <input type="text" name="option_a" value="{{ old('option_a')}}"  class="form-control">
                          @error('option_a')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" name="answer_option" type="radio" value="option_b"></span>
                          <label for="exampleInputFile">Option B</label>
                          <input type="text" name="option_b" value="{{ old('option_b')}}" class="form-control">
                          @error('option_b')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" name="answer_option" type="radio" value="option_c"></span>
                          <label for="exampleInputFile">Option c</label>
                          <input type="text" name="option_c" value="{{ old('option_c')}}" class="form-control">
                          @error('option_c')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" name="answer_option" type="radio" value="option_d"></span>
                          <label for="exampleInputFile">Option D</label>
                          <input type="text" name="option_d" value="{{ old('option_d')}}" class="form-control">
                          @error('option_d')
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