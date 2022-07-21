@extends('layouts.dashboard-layout')

@section('content')
    <div class="card card-outline-secondary">
        <div class="card-header">
            <h3 class="mb-0">Password Change</h3>
        </div>
        <div class="card-body">
            <form class="form" role="form" autocomplete="off" id="js_profile_form">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">First name</label>
                    <div class="col-lg-9">
                        <input class="form-control" type="text" name="name" value="{{ $teacher->name}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Email</label>
                    <div class="col-lg-9">
                        <input class="form-control" type="email" name="email" value="{{ $teacher->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Password</label>
                    <div class="col-lg-9">
                        <input class="form-control" name="password" type="password" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Confirm</label>
                    <div class="col-lg-9">
                <input type="password" name="password_confirmation" id="js_user_password_confirmation" class="form-control" />
                <span class="text-danger js_change_password_validation" id="js_change_password_confirmation_error"></span>
                <span class="text-danger js_change_password_validation" id="js_change_password_error"></span>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label"></label>
                    <div class="col-lg-9">
                        <input type="reset" class="btn btn-secondary" value="Cancel">
                        <input type="submit" id="js_profile_save_btn" class="btn btn-primary" value="Save Changes">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script')
<script src="sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="{{asset('/assets/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/admin/teacher/index.js')}}"></script> 

<script>
   var TEACHER_UPDATE_URL = '{{ route('teacher.profile.update')}}'
   $(document).ready(function () {
       teacherProfileUpdate.init();
   });
</script>
@endpush