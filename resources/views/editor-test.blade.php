<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CKEditor + CKFinder Test</title>
</head>
<body>
    <textarea name="editor" id="editor"></textarea>

    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/4.20.2/full-all/ckeditor.js"></script>

    {{-- CKFinder --}}
    <script src="{{ asset('js/ckfinder/ckfinder.js') }}"></script>

    <script>
        CKEDITOR.replace('editor', {
            extraPlugins: 'uploadimage,uploadfile,image2',
            removePlugins: 'easyimage,cloudservices',

            // File Browser URLs
            filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
            filebrowserImageBrowseUrl: '{{ route('ckfinder_browser') }}?type=Images',
            filebrowserUploadUrl: '{{ route('ckfinder_connector') }}?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: '{{ route('ckfinder_connector') }}?command=QuickUpload&type=Images'
        });
    </script>
</body>
</html>
