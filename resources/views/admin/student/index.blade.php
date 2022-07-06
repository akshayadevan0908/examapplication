@extends('layouts.dashboard-layout')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Student List</h3>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Student Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @if(count($students) != 0)
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{!! getStudentStatus($student->status) !!}</td>
                        <td><a href="#" title="Edit student"><i class="far fa-edit"></i></a></td>
                        <td><i class="fa fa-trash" aria-hidden="true"></i></td>
                    </tr>
                @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
@endsection

@push('script')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
@endpush