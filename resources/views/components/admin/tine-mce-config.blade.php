{{-- jQuery for AJAX (optional, only if you use it for uploads) --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

{{-- TinyMCE CDN --}}
<script src="https://cdn.tiny.cloud/1/o2tn51z1a47anyadbsstx3m33i2o1dvfx3o0126wq0hysk3o/tinymce/8/tinymce.min.js" referrerpolicy="origin"></script>

{{-- Supercharged TinyMCE Init --}}
<script>
document.addEventListener('DOMContentLoaded', () => {

    const isDark = document.documentElement.classList.contains('dark');

    tinymce.init({
        selector: '#myeditorinstance',
        height: 500,
        menubar: true,
        plugins: `
            advlist autolink lists link image charmap print preview anchor
            searchreplace visualblocks code fullscreen insertdatetime media table
            paste help wordcount emoticons
        `,
        toolbar: `
            undo redo | formatselect | bold italic underline strikethrough |
            forecolor backcolor | alignleft aligncenter alignright alignjustify |
            bullist numlist outdent indent | link image media table emoticons |
            removeformat | code fullscreen
        `,
        toolbar_mode: 'wrap',
        branding: false, // removes TinyMCE branding

        /* 🔥 Advanced HTML Editing */
        valid_elements: '*[*]', // allows all HTML tags & attributes
        extended_valid_elements: 'iframe[src|width|height|name|align|frameborder|allowfullscreen]', 
        content_css: isDark ? 'dark' : 'default', // dark mode content
        skin: isDark ? 'oxide-dark' : 'oxide',    // dark mode UI
        automatic_uploads: true,
        relative_urls: false,
        remove_script_host: false,
        convert_urls: false,

        /* 🔥 Custom Image Upload Handler */
        images_upload_handler: function (blobInfo, progress) {
            return new Promise((resolve, reject) => {
                let formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());

                $.ajax({
                    url: '{{ url("admin/editor/upload-image") }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    xhr: function () {
                        let xhr = new XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function (e) {
                            if (e.lengthComputable) {
                                progress(e.loaded / e.total * 100);
                            }
                        });
                        return xhr;
                    },
                    success: function (response) {
                        if (response.location) {
                            resolve(response.location);
                        } else {
                            reject('No location returned from server');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('TinyMCE Upload Error:', xhr.responseText);
                        reject('Image upload failed: ' + error);
                    }
                });
            });
        },

        /* 🔥 Paste & Cleanup Options */
        paste_as_text: false,         // allow rich HTML pastes
        paste_data_images: true,      // allow images from clipboard
        paste_block_drop: true,       // prevent dropping files by accident
        forced_root_block: 'p',       // automatically wrap content in <p>

        /* 🔥 Code & Fullscreen Mode */
        code_dialog_width: 800,
        code_dialog_height: 600,
        fullscreen_native: true,
        resize: true,

        /* 🔥 Wordcount & Help */
        wordcount_countregex: /[\w\u2019-]+/g,
        setup: function (editor) {
            editor.on('init', function () {
                console.log('TinyMCE is ready 🚀');
            });
        }
    });
});
</script>