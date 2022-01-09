$(function () {
    var table = $('.message_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/management/table/message",
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'subject', name: 'subject' },
            { data: 'created_at', name: 'created_at' },
            {
                data: 'view',
                name: 'view',
                orderable: true,
                searchable: true
            },
        ]
    });

});