
  @extends('layouts.dashboard-layout')

  @push('styles')
  @endpush
  
  @section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Edit Question</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">

          <form id="js_update_question_form">
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputClientCompany">Question</label>
                    <input type="text" class="form-control" name="question" value="{{ $question->question}}">
                  </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Question TYpe</label>
                <select class="form-control select2" style="width: 100%;">
                  <option selected="selected">Alabama</option>
                  <option>Alaska</option>
                  <option disabled="disabled">California (disabled)</option>
                  <option>Delaware</option>
                </select>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <input type="submit" id="js_update_question" value="Update" class="btn btn-primary">
          </div>
          </form>

        </div>
      </div>
    </div>
  </section>
  @endsection

  @push('script')
<script src="{{asset('/assets/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>


<script type="text/javascript" src="{{asset('assets/js/admin/question/index.js')}}"></script>

<script>
    var QUESTION_UPDATE_URL = '{{ route('admin.question.update')}}'
    $(document).ready(function () {
        editQuestion.init();
    });
</script>
@endpush