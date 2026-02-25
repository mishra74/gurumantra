<script src="{{asset('admin_assets/assets/js/vendor.min.js')}}"></script>

<!-- Daterangepicker js -->
<script src="{{asset('admin_assets/assets/vendor/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('admin_assets/assets/vendor/daterangepicker/daterangepicker.js')}}"></script>

<!-- Apex Charts js -->
<script src="{{asset('admin_assets/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>

<!-- Vector Map js -->
<script src="{{asset('admin_assets/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('admin_assets/assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js')}}"></script>

<!-- Dashboard App js -->
<script src="{{asset('admin_assets/assets/js/pages/demo.dashboard.js')}}"></script>

<!-- App js -->
<script src="{{asset('admin_assets/assets/js/app.min.js')}}"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


</body>

<!-- Mirrored from coderthemes.com/attex/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Feb 2025 06:35:16 GMT -->
</html> 


<!-- Ckeditor JS -->
<style>
    .cke_notifications_area,
.cke_notification_warning {
    display: none !important;
}
</style>

{{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/4.20.2/full-all/ckeditor.js"></script>

    {{-- CKFinder --}}
    <script src="{{ asset('js/ckfinder/ckfinder.js') }}"></script>

  

    <script>
    const ckConfig = {
        extraPlugins: 'uploadimage,uploadfile,image2',
        removePlugins: 'easyimage,cloudservices',
        filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
        filebrowserImageBrowseUrl: '{{ route('ckfinder_browser') }}?type=Images',
        filebrowserUploadUrl: '{{ route('ckfinder_connector') }}?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '{{ route('ckfinder_connector') }}?command=QuickUpload&type=Images',
        
    };

    document.querySelectorAll('.ckeditor').forEach((el) => {
        CKEDITOR.replace(el, ckConfig);
    });
</script>


@if(session('success'))
<script>
    Swal.fire({
        toast: true,
        position: 'top-end',   
        icon: 'success',
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 3000
    });
</script>
@endif


@if(session('error'))
<script>
    Swal.fire({
        toast: true,
        position: 'top-end',   
        icon: 'error',
        title: "{{ session('error') }}",
        showConfirmButton: false,
        timer: 3000
    });
</script>


@endif
<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Select.....",
        allowClear: true
    });
});
</script>

