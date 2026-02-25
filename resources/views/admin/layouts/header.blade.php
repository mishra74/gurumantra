<!DOCTYPE html>
<html lang="en">

    
<!-- Mirrored from coderthemes.com/attex/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Feb 2025 06:34:27 GMT -->
<head>
        <meta charset="utf-8" />
        <title>GM Code Lab</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('admin_assets/assets/images/favicon.ico')}}">

        <!-- Daterangepicker css -->
        <link rel="stylesheet" href="{{asset('admin_assets/assets/vendor/daterangepicker/daterangepicker.css')}}">

        <!-- Vector Map css -->
        <link rel="stylesheet" href="{{asset('admin_assets/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}">

        <!-- Theme Config Js -->
        <script src="{{asset('admin_assets/assets/js/config.js')}}"></script>

        <!-- App css -->
        <link href="{{asset('admin_assets/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Icons css -->
        <link href="{{asset('admin_assets/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <!-- Begin page -->
        <div class="wrapper">
            <style>
                /* Select2 dropdown options */
.select2-container--default .select2-results__option {
    color: #6c757d;        /* bootstrap gray */
    filter: blur(0.4px);   /* halka blur effect */
}

/* Selected items ko clear karke normal rakho */
.select2-container--default .select2-results__option[aria-selected="true"] {
    color: #000;       /* black for selected */
    filter: none;      /* no blur on selected */
}

.select2-selection__choice {
    background-color: #3b58ff !important;
    border: #3b58ff !important;
    border-radius: 4px;
    box-sizing: border-box;
    display: inline-block;
    margin-left: 5px;
    margin-top: 5px;
    padding: 0;
    padding-left: 20px;
    position: relative;
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    vertical-align: bottom;
    white-space: nowrap;
}
            </style>