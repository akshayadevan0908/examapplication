
 @extends('layouts.dashboard-layout')

 @push('styles')
 <!-- You can also include the stylesheet separately if desired: -->
   
   <link rel="stylesheet" href="sweetalert2/dist/sweetalert2.min.css">
 @endpush
 
 @section('content')
 <section class="content">
   <div class="container-fluid">
     <div class="card card-default">
       <div class="card-header">
         <h3 class="card-title">Edit Question</h3>
       </div>
       <div class="card-body">

         <form id="js_update_question_form">
         <div class="row">
           <div class="col-md-6">
               <div class="form-group">
                   <label for="inputClientCompany">Question</label>
                   <input type="text" required class="form-control" name="question" value="{{ $examQuestion->question}}">
                 </div>
           </div>
           <div class="col-md-6">
             <div class="form-group">
               <label>Question Type</label>
               <input class="form-control" type="text" disabled value="{{ getQuestionType($examQuestion->question_type) }}">
               <input type="hidden" required value="{{$examQuestion->question_type}}" name="form_type">
             </div>
           </div>
         </div>
         <input type="hidden" value="{{ $examQuestion->_id}}" name="question_id">

         
         @if($examQuestion->question_type == config('examapp.question_type.question_text_image_answer_text'))
         <div class="col-md-6">
           <input type="file" name="question_file" class="form-control" placeholder="image">
           <img src="{{ asset('storage/questions/'.$examQuestion->question_image) }}" width="150px" height="150px">
           <div class="form-group">
             <label for="score">Mark</label>
             <input type="number" required name="score" value="{{ $examQuestion->score}}" class="form-control">
             @error('score')
             <span class="text-danger">{{ $message }}</span>
             @enderror
         </div>
           @foreach($examQuestion->answer_options as $key=>$option)
           <div class="form-group">
             <div class="form-check">
                 <input class="form-check-input" name="answer_option" type="radio" value="option_{{$key+1}}" @if(true == $option['is_correct_answer']) checked @endif>
                 <label for="exampleInputFile">Option {{$key+1}}</label>
                 <input type="text" required name="option_{{$key+1}}" value="{{ $option['text']}}" class="form-control">
             </div>
           </div>
           @endforeach
         </div>
         @elseif($examQuestion->question_type == config('examapp.question_type.question_text_answer_text'))
         <div class="col-md-6">
           <div class="form-group">
             <label for="score">Mark</label>
             <input type="number" required name="score" value="{{ $examQuestion->score}}" class="form-control">
             @error('score')
             <span class="text-danger">{{ $message }}</span>
             @enderror
         </div>
           @foreach($examQuestion->answer_options as $key=>$option)
           <div class="form-group">
             <div class="form-check">
                 <input class="form-check-input" required name="answer_option" type="radio" value="option_{{$key+1}}" @if(true == $option['is_correct_answer']) checked @endif>
                 <label for="exampleInputFile">Option {{$key+1}}</label>
                 <input type="text" required name="option_{{$key+1}}" value="{{ $option['text']}}" class="form-control">
             </div>
           </div>
           @endforeach
         </div>
         @elseif($examQuestion->question_type == config('examapp.question_type.question_text_answer_image'))
         <div class="col-md-6">
           <div class="form-group">
             <label for="score">Mark</label>
             <input type="number" required name="score" value="{{ $examQuestion->score}}" class="form-control">
             @error('score')
             <span class="text-danger">{{ $message }}</span>
             @enderror
         </div>
           @foreach($examQuestion->answer_options as $key=>$option)
           <div class="form-group">
             <div class="form-check">
                 <input class="form-check-input" name="answer_option" type="radio" value="option_{{$key+1}}"  @if(true == $option['is_correct_answer']) checked @endif>
                 <label for="exampleInputFile">Option {{$key+1}}</label>
                 <input type="file" name="option_{{$key+1}}_file" class="form-control" placeholder="image">
                 <img src="{{ asset('storage/questions/'.$option['image']) }}" width="150px" height="150px">
             </div>
           </div>
           @endforeach
         </div>
         @endif

         <div class="card-footer">
           <input type="submit" id="js_update_question" value="Update" class="btn btn-primary">
         </div>
         </form>
       </div>
     </div>
   </div>
 </section>
 @endsection

@push('script')
<script src="sweetalert2/dist/sweetalert2.all.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="{{asset('/assets/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/admin/question/edit.js')}}"></script>

<script>
   var QUESTION_UPDATE_URL = '{{ route('admin.question.update')}}'
   $(document).ready(function () {
       editQuestion.init();
   });
</script>
@endpush