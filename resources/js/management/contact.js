$(function () {
    var table = $('.contact_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/management/table/contact",
        columns: [
            { data: 'name', name: 'name' },
            { data: 'value', name: 'value' },
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