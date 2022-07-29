@extends('layouts.dashboard-layout')

@section('content')

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Questions</h3>
              @if(Auth::guard('admin')->user()->admin_type == config('examapp.user_role.admin'))
              <a href="{{ route('admin.question.create')}}"><button class="btn btn-primary float-right">Create New Question</button></a>
              @endif
            </div>
            
            <div class="card-body">
              <table id="js-question-list" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Question</th>
                  <th>Question Type</th>
                  <th>Score</th>
                  @if(Auth::guard('admin')->user()->admin_type == config('examapp.user_role.admin'))
                  <th>Edit</th>
                  <th>Delete</th>
                  @endif
                </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('script')
<script type="text/javascript" src="{{asset('assets/js/admin/question/index.js')}}"></script>
<script>
  var QUESTION_DELETE_URL = '{{ route('admin.question.delete')}}'
  var QUESTION_LIST_URL = '{{ route('admin.question.index') }}'
    $(document).ready( function () {
      deleteQuestion.init();
    } );
</script>
@endpush