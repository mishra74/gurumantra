<!DOCTYPE html>
<html lang="en">

    
<!-- Mirrored from coderthemes.com/attex/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Feb 2025 06:35:32 GMT -->
<head>
        <meta charset="utf-8" />
        <title>GM Selection Hub</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        
        <!-- Theme Config Js -->
        <script src="{{asset('admin_assets/assets/js/config.js')}}"></script>

        <!-- App css -->
        <link href="{{asset('admin_assets/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons css -->
        <link href="{{asset('admin_assets/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    </head>
    
    <body class="authentication-bg position-relative">
        <div class="position-absolute start-0 end-0 start-0 bottom-0 w-100 h-100">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1920 1028">
                <g mask="url(&quot;#SvgjsMask1166&quot;)" fill="none">
                    <use xlink:href="#SvgjsSymbol1173" x="0" y="0"></use>
                    <use xlink:href="#SvgjsSymbol1173" x="0" y="720"></use>
                    <use xlink:href="#SvgjsSymbol1173" x="720" y="0"></use>
                    <use xlink:href="#SvgjsSymbol1173" x="720" y="720"></use>
                    <use xlink:href="#SvgjsSymbol1173" x="1440" y="0"></use>
                    <use xlink:href="#SvgjsSymbol1173" x="1440" y="720"></use>
                </g>
                <defs>
                    <mask id="SvgjsMask1166">
                        <rect width="1920" height="1028" fill="#ffffff"></rect>
                    </mask>
                    <path d="M-1 0 a1 1 0 1 0 2 0 a1 1 0 1 0 -2 0z" id="SvgjsPath1171"></path>
                    <path d="M-3 0 a3 3 0 1 0 6 0 a3 3 0 1 0 -6 0z" id="SvgjsPath1170"></path>
                    <path d="M-5 0 a5 5 0 1 0 10 0 a5 5 0 1 0 -10 0z" id="SvgjsPath1169"></path>
                    <path d="M2 -2 L-2 2z" id="SvgjsPath1168"></path>
                    <path d="M6 -6 L-6 6z" id="SvgjsPath1167"></path>
                    <path d="M30 -30 L-30 30z" id="SvgjsPath1172"></path>
                </defs>
                
            </svg>
        </div>
        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-lg-5">
                        <div class="card">

                            <!-- Logo -->
                            <div class="card-header py-4 text-center bg-primary">
                                <a href="index.html">
                                    <span><img src="{{asset('frontend/img/logo.png')}}" alt="logo" width="80px"></span>
                                </a>
                            </div>

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign In</h4>
                                    <p class="text-muted mb-4">Welcome Admin</p>
                                </div>

                                <form  method="post" action="{{route('admin.login.store')}}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Email address</label>
                                        <input class="form-control" type="email" name="email" required="" placeholder="Enter your email">
                                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror

                                    </div>

                                    <div class="mb-3">
                                        <!-- <a href="auth-recoverpw.html" class="text-muted float-end fs-12">Forgot your password?</a> -->
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" name="password" class="form-control" placeholder="Enter your password">
                                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror

                                        </div>
                                    </div>

                                    <!-- <div class="mb-3 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div> -->

                                    <div class="mb-3 mb-0 text-center">
                                        <button class="btn btn-primary" type="submit"> Log In </button>
                                    </div>

                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <!-- <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted bg-body">Don't have an account? <a href="auth-register.html" class="text-muted ms-1 link-offset-3 text-decoration-underline"><b>Sign Up</b></a></p>
                            </div> 
                        </div> -->
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt fw-medium">
            <span class="bg-body"><script>document.write(new Date().getFullYear())</script> Developed By GM Code Lab</span>
        </footer>
        <!-- Vendor js -->
        <script src="{{asset('admin_assets/assets/js/vendor.min.js')}}"></script>
        
        <!-- App js -->
        <script src="{{asset('admin_assets/assets/js/app.min.js')}}"></script>

    </body>

<!-- Mirrored from coderthemes.com/attex/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Feb 2025 06:35:32 GMT -->
</html>
