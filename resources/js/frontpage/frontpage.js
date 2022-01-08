ClassicEditor
    .create(document.querySelector('#post-view'), {
        toolbar: []
    })
    .then(editor => {
        editor.isReadOnly = true;
    })
    .catch(error => {
        console.error(error);
    });