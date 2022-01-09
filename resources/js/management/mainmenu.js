$(document).ready(function () {
    $('#content-m').hide();
    $('#file-m').hide();
    $('#link-m').hide();
    $('#menu-category').change(function () {
        if ($('#menu-category').val() == "content") {
            $('#content-m').show();
            $('#file-m').hide();
            $('#link-m').hide();
        } else if ($('#menu-category').val() == "file") {
            $('#content-m').hide();
            $('#file-m').show();
            $('#link-m').hide();
        } else if ($('#menu-category').val() == "link") {
            $('#content-m').hide();
            $('#file-m').hide();
            $('#link-m').show();
        }
    });
});

$(function () {
    var table = $('.menu_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/management/table/mainmenu",
        columns: [
            { data: 'title', name: 'title' },
            { data: 'category', name: 'staus' },
            { data: 'status', name: 'status' },
            { data: 'view', name: 'view' },
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