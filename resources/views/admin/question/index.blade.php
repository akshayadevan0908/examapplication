@extends('layouts.dashboard-layout')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Questions</h3>
              <a href="{{ route('admin.question.create')}}"><button class="btn btn-primary float-right">Create New Question</button></a>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Question</th>
                  <th colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($questions as $question)
                <tr>
                  <td>{{ $question->question}}</td>
                  <td><a href="{{ route('admin.question.edit', $question->_id)}}" title="Edit" >Edit</a></td>
                  <td> <a href="javascript:;" class="js_delete_question" data-id={{$question->_id}}>Delete</a></td>
                </tr>
                @endforeach
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
<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{asset('assets/js/admin/question/index.js')}}"></script>

<script>
  var QUESTION_DELETE_URL = '{{ route('admin.question.delete')}}'
  var QUESTION_LIST_URL = '{{ route('admin.question.index') }}'
    $(document).ready( function () {
      deleteQuestion.init();
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