ClassicEditor
    .create(document.querySelector('#about-editor'))
    .catch(error => {
        console.error(error);
    });