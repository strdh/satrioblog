$(function () {
    var table = $('.category_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/management/table/category",
        columns: [
            { data: 'name', name: 'name' },
            { data: 'image', name: 'image' },
            { data: 'created_at', name: 'created_at' },
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });

});