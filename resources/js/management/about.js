$(function () {
    var table = $('.about_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/management/table/about",
        columns: [
            { data: 'name', name: 'name' },
            { data: 'short_description', name: 'short_description' },
            { data: 'image', name: 'image' },
            { data: 'created_at', name: 'created_at' },
            { data: 'detail', name: 'detail' },
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });

});