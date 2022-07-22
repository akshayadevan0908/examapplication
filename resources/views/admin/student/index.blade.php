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
              <h3 class="card-title">Student List</h3>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Teacher Name</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(count($students) != 0)
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->name}}</td>
                            <td>{{ $student->email }}</td>
                            <td><a href="#" title="Edit teacher"><i class="far fa-edit"></i></a></td>
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
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
@endpush