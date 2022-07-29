'use strict';


$(document).ready(function () {
    let base_url = window.location.origin;
    $('#example1').DataTable({
        'processing': true,
        'serverSide': true,
        'ajax': {
            url: base_url + "/admin/student/exam-list-table",
            method: "POST",
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            cache: false
        },
        "columns": [
            {
                "data": "name"
            },
            {
                "data": "email"
            },
            {
                "targets": 2,
                "data": "status",
                "render": function (data, type, row, meta) {
                    if (row.status == 0) {
                        type = 'Active';
                        return type;
                    }
                    else if (row.status == 1) {
                        type = 'Inactive';
                        return type;
                    }
    
                }
            },
            {
                "data": "actions"
            },


            ],
            "columnDefs": [{
                "searchable": true
            }]
    });
});