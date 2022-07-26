@extends('layouts.dashboard-layout')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Create Exam</h3>
            </div>
            <div class="card-body">
              {{-- <form id="js_form_exam"> --}}
                <form action="{{ route('admin.exam.store')}}" method="post">
                  @csrf
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Title</label>
                      <input type="text" name="title" class="form-control" placeholder="">
                      @error('title')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror

                    </div>
                  </div>
                </div>
                <div class="card-footer">
                    <input type="submit" id="" value="Submit" class="btn btn-primary">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </section>
@endsection

@push('script')
<script src="{{asset('/assets/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/admin/exam/index.js')}}"></script>
<script>
    var EXAM_STORE_URL = '{{ route('admin.exam.store')}}'
    $(document).ready(function () {
        createExam.init();
    });
</script>
@endpush