ClassicEditor
    .create(document.querySelector('#about-editor'), {
        simpleUpload: {
            uploadUrl: 'http://localhost:8000/management/post/upload',

            withCredentials: false,

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        }
    })
    .catch(error => {
        console.error(error);
    });