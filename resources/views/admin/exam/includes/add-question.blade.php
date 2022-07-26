
<div class="modal fade addQuestionModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add Question</h3>
                <div class="card-tools">
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
                                <div class="btn-group btn-group-sm">
                                    <a href="javascript:;" class="btn btn-primary js_add_question" data-id={{ $qstn->_id}}>Add</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

