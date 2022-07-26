@extends('layouts.dashboard-layout')

@section('content')

@push('styles')
 
@endpush

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Exam List</h3>
              @if(Auth::guard('admin')->user()->admin_type == config('examapp.user_role.admin'))
              <a href="{{ route('admin.exam.create')}}"><button class="btn btn-primary float-right">Create New Exam</button></a>
              @endif
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Exam</th>
                  <th>Status</th>
                  <th></th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                  @if(count($exams) > 0)
                  @foreach($exams as $exam)
                <tr>
                  <td>{{ $exam->title }}</td>
                  <td>{!! getExamStatus($exam->status) !!}</td>
                  <td><div class="form-group">
                    <div class="custom-control custom-switch @if($exam->status == config('examapp.exam_status.active')) custom-switch-off-success @elseif($exam->status == config('examapp.exam_status.inactive')) custom-switch-on-danger @endif">
                      <input type="checkbox" name="status" {{ $exam->status ? 'checked' : '' }}  class="custom-control-input js_change_status" id="customSwitch{{$exam->_id}}" data-id={{$exam->_id}}>
                      <label class="custom-control-label" for="customSwitch{{$exam->_id}}"></label>
                    </div>
                    </div>
                  </td>
                  <td><a href="{{ route('admin.exam.show', $exam->_id) }}">View</td>
                </tr>
                @endforeach
                @endif
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
<script src="sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="{{asset('/assets/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/admin/exam/index.js')}}"></script> 

<script>
   var EXAM_STATUS_CHANGE_URL = '{{ route('admin.exam.status')}}'
   $(document).ready(function () {
      changeExamStatus.init();
   });
</script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
  });
</script>
@endpush