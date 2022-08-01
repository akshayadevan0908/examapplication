@extends('layouts.dashboard-layout')

@push('styles')

@endpush

@section('content')

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Exams</h3>
            </div>
            
            <div class="card-body">
              <table id="js-exam-list" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Exam</th>
                  <th>Status</th>
                  <th></th>
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
<script type="text/javascript" src="{{asset('assets/js/student/exam/index.js')}}"></script> 

<script>
   var EXAM_STATUS_CHANGE_URL = ''
   $(document).ready(function () {
      
   });
</script>
@endpush