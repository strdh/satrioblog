$(function () {
    var table = $('.slider_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/management/table/slider",
        columns: [
            { data: 'title', name: 'title' },
            { data: 'url', name: 'image' },
            { data: 'order_', name: 'order_' },
            { data: 'status', name: 'status' },
            { data: 'created_at', name:'created_at'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });

});