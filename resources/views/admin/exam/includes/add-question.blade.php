
<div class="modal fade addQuestionModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add Question</h3>
                <div class="card-tools">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
            </div>
            <div class="card-body p-0" style="display: block;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Question</th>
                            <th></th>
                        </tr>
                    </thead>
                    <input type="hidden" value="{{ $exam->_id}}" id="js_exam_id">
                    <tbody>
                        @foreach($questions as $key => $qstn)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $qstn->question}}</td>
                            <td class="text-right py-0 align-middle">
                                @if(in_array($qstn->_id, $questionIds))
                                <div class="btn-group btn-group-sm">
                                    <a href="javascript:;" class="btn btn-primary">
                                        <div>Remove</div>
                                    </a>
                                </div>
                                @else
                                <div class="btn-group btn-group-sm">
                                    <a href="javascript:;" class="btn btn-primary js_add_question" data-id="{{ $qstn->_id}}">
                                        <div data-id="{{ $qstn->_id}}" id="js_text{{$qstn->_id}}" data-qtype={{ $qstn->question_type }}>Add</div>
                                    </a>
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button>
          </div>
    </div>
</div>
</div>

