$(function () {
    var table = $('.post_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/management/table/post",
        columns: [
            { data: 'title', name: 'title' },
            { data: 'category_id', name: 'category_id' },
            { data: 'thumbnail', name: 'thumbnail' },
            { data: 'status', name: 'status'},
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'liveview', name: 'liveview' },
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });

});