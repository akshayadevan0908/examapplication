@extends('layouts.dashboard-layout')

@push('styles')
@endpush

@section('content')
<div class="row">
    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Question</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool"  title="Collapse"></button>
          </div>
        </div>
        <div class="card-body">
          <form action="" method="POST" id="form_question">
            <span id="js_answer_option_error" class="text-danger"></span>
          <div class="form-group">
            <label for="question">Question</label>
            <input type="text" name="question" value="{{ old('question')}}" class="form-control">
            @error('question')
                <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="score">Mark</label>
            <input type="number" name="score" value="{{ old('score')}}" class="form-control">
            @error('score')
                <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="score">Question Type</label>
            <select name="question_type" class="form-control">
              <option value="">--Select--</option>
              @foreach(config('examapp.question_type') as $key =>$value)
              <option value="{{$value}}">{{$key}}</option>
              @endforeach
            </select>
            @error('score')
                <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <br>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                    <label>A</label>
                    <span class="input-group-text"><input name="answer_option" type="radio" value="option_a"></span>
                    </div>
                    <input type="text" name="option_a" value="{{ old('option_a')}}"  class="form-control">
                    @error('option_a')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div><br>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label>B</label>
                        <span class="input-group-text"><input name="answer_option" type="radio" value="option_b"></span>
                    </div>
                <input type="text" name="option_b" value="{{ old('option_b')}}" class="form-control">
                @error('option_b')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div><br>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <label>c</label>
                        <span class="input-group-text"><input name="answer_option" type="radio" value="option_c"></span>
                        </div>
                        <input type="text" name="option_c" value="{{ old('option_c')}}" class="form-control">
                        @error('option_c')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div><br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label>D</label>
                            <span class="input-group-text"><input name="answer_option" type="radio" value="option_d"></span>
                        </div>
                    <input type="text" name="option_d" value="{{ old('option_d')}}" class="form-control">
                    @error('option_d')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                  </div>
            </div><br>
          </div>
        </div>
            <div class="col-4">
                <input type="submit" id="submit_question" value="Submit" class="btn btn-primary float-right">
            </div> 
        </form>
      </div> 
    </div>
</div>
@endsection

@push('script')
<script src="{{asset('/assets/js/jquery.validate.min.js')}}"></script>

<script type="text/javascript" src="{{asset('assets/js/admin/question/index.js')}}"></script>

<script>
    var QUESTION_STORE_URL = '{{ route('admin.question.store')}}'
    var QUESTION_LIST_URL = '{{ route('admin.question.index')}}'
    $(document).ready(function () {
        createQuestion.init();
    });
</script>
@endpush