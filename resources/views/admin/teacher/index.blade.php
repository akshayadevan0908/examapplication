@extends('layouts.dashboard-layout')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Teacher List</h3>
          <a href="{{ route('admin.teacher.create')}}"><button class="btn btn-primary float-right">Create New Teacher</button></a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                    <thead>
                        <tr role="row">
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Teacher Name</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Email</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($teachers) != 0)
                        @foreach($teachers as $teacher)
                        <tr class="odd">
                            <td class="dtr-control sorting_1" tabindex="0">{{ $teacher->name}}</td>
                            <td>{{ $teacher->email }}</td>
                            <td><a href="{{ route('admin.teacher.edit', $teacher->name)}}"><i class="far fa-edit"></i></a></td>

                            <td><i class="fa fa-trash" aria-hidden="true"></i></td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="odd">
                            <td colspan="3" class="dtr-control sorting_1" tabindex="0">No data found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                </div>
                </div>
            </div>
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

@endpush