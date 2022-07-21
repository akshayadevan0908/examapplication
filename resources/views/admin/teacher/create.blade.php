@extends('layouts.dashboard-layout')

@push('styles')
@endpush

@section('content')
<div class="row">
    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Teacher</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool"  title="Collapse"></button>
          </div>
        </div>
        <div class="card-body">
          <form action="#" method="POST" id="form_teacher">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="Enter Name" class="form-control">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
            <div class="card-footer">
              <input type="submit" id="submit_teacher" value="Submit" class="btn btn-primary">
            </div>
        </form>
      </div> 
    </div>
</div>
@endsection

@push('script')
<script src="{{asset('/assets/js/jquery.validate.min.js')}}"></script>

<script type="text/javascript" src="{{asset('assets/js/admin/teacher/index.js')}}"></script>

<script>
    var TEACHER_STORE_URL = '{{ route('admin.teacher.store')}}'
    var TEACHER_LIST_URL = '{{ route('admin.teacher.index')}}'
    $(document).ready(function () {
        createTeacher.init();
    });
</script>
@endpush