
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    GM Selection Hub
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('auth/assets/css/soft-ui-dashboard.css')}}" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="">
  <!-- Navbar -->
  <!--<nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">-->
  <!--        <div class="container-fluid pe-0">-->
  <!--          <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="{{url('/')}}">-->
  <!--          <img src="{{asset('frontend/img/logo.png')}}" alt="Logo" style="width: 66px;">-->
  <!--          </a>-->
  <!--          <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">-->
  <!--            <span class="navbar-toggler-icon mt-2">-->
  <!--              <span class="navbar-toggler-bar bar1"></span>-->
  <!--              <span class="navbar-toggler-bar bar2"></span>-->
  <!--              <span class="navbar-toggler-bar bar3"></span>-->
  <!--            </span>-->
  <!--          </button>-->
  <!--          <div class="collapse navbar-collapse" id="navigation">-->
  <!--            <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">-->
  <!--              <li class="nav-item">-->
  <!--                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="{{url('student/dashboard')}}">-->
  <!--                  <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>-->
  <!--                  Dashboard-->
  <!--                </a>-->
  <!--              </li>-->
  <!--              <li class="nav-item">-->
  <!--                <a class="nav-link me-2" href="{{url('student/profile')}}">-->
  <!--                  <i class="fa fa-user opacity-6 text-dark me-1"></i>-->
  <!--                  Profile-->
  <!--                </a>-->
  <!--              </li>-->
  <!--              <li class="nav-item">-->
  <!--                <a class="nav-link me-2" href="{{url('student/register')}}">-->
  <!--                  <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>-->
  <!--                  Sign Up-->
  <!--                </a>-->
  <!--              </li>-->
  <!--              <li class="nav-item">-->
  <!--                <a class="nav-link me-2" href="{{url('login')}}">-->
  <!--                  <i class="fas fa-key opacity-6 text-dark me-1"></i>-->
  <!--                  Sign In-->
  <!--                </a>-->
  <!--              </li>-->
  <!--            </ul>-->
             
  <!--            <ul class="navbar-nav d-lg-block d-none">-->
  <!--              <li class="nav-item">-->
  <!--                <a href="https://www.creative-tim.com/product/soft-ui-dashboard" class="btn btn-sm btn-round mb-0 me-1 bg-gradient-dark">Back to Home</a>-->
  <!--              </li>-->
  <!--            </ul>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--      </nav>-->
  <!-- End Navbar -->
  <main class="main-content  mt-0">
    <section class="min-vh-100 mb-8">
      <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('../auth/assets/img/curved-images/curved14.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
              <h1 class="text-white mb-2 mt-5">Welcome!</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
          <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
              <div class="card-header text-center pt-4">
                <h5>Register with</h5>
              </div>
              <div class="card-body">
                <form role="form text-left" method="post" action="{{route('student.store')}}">
                @csrf  
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{old('name')}}">
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror

                  </div>
                  <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('enail')}}" id="email">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror

                  </div >
                  <div class="mb-3" style="text-align:right" id="sendmail"><span style="color:white; background-color:blue;padding:8px;border-radius:8px" onclick="sendOtp()">Send Otp</span> </div>

                  <div class="mb-3">
                    <input type="number" class="form-control" placeholder="Phone" name="phone" value="{{old('phone')}}">
                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror

                  </div>
                  <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password" aria-describedby="password-addon" value="{{old('password')}}" id="password">
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror

                  </div>

                  <div class="form-group">
    <input type="password"
           name="password_confirmation"
           class="form-control required"
           placeholder="Confirm Password"
           id="password_confirmation"
           onkeyup="passwordMatch()">

    <small id="passwordError" class="text-danger d-none">
        Passwords do not match
    </small>

    @error('password_confirmation')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

            <div class="form-group">
              <select class="form-control" name="state">
                <option>--Select State--</option>
                <option value="Andhra Pradesh">Andhra Pradesh</option>
    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
    <option value="Assam">Assam</option>
    <option value="Bihar">Bihar</option>
    <option value="Chhattisgarh">Chhattisgarh</option>
    <option value="Goa">Goa</option>
    <option value="Gujarat">Gujarat</option>
    <option value="Haryana">Haryana</option>
    <option value="Himachal Pradesh">Himachal Pradesh</option>
    <option value="Jharkhand">Jharkhand</option>
    <option value="Karnataka">Karnataka</option>
    <option value="Kerala">Kerala</option>
    <option value="Madhya Pradesh">Madhya Pradesh</option>
    <option value="Maharashtra">Maharashtra</option>
    <option value="Manipur">Manipur</option>
    <option value="Meghalaya">Meghalaya</option>
    <option value="Mizoram">Mizoram</option>
    <option value="Nagaland">Nagaland</option>
    <option value="Odisha">Odisha</option>
    <option value="Punjab">Punjab</option>
    <option value="Rajasthan">Rajasthan</option>
    <option value="Sikkim">Sikkim</option>
    <option value="Tamil Nadu">Tamil Nadu</option>
    <option value="Telangana">Telangana</option>
    <option value="Tripura">Tripura</option>
    <option value="Uttar Pradesh">Uttar Pradesh</option>
    <option value="Uttarakhand">Uttarakhand</option>
    <option value="West Bengal">West Bengal</option>
    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
    <option value="Chandigarh">Chandigarh</option>
    <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
    <option value="Delhi">Delhi</option>
    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
    <option value="Ladakh">Ladakh</option>
    <option value="Lakshadweep">Lakshadweep</option>
    <option value="Puducherry">Puducherry</option>
              
              </select>
							@error('states') <small class="text-danger">{{ $message }}</small> @enderror
						</div>
                 
                 @if(isset($id) && $id !='')
                  <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Refferal Code" name="refferal" aria-describedby="" value="{{$id}}" readonly>
                  </div>
                 @else
                  <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Refferal Code" name="refferal" aria-describedby="">
                  </div>
                 @endif
                 
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2" style="background: #701723;">Sign up</button>
                  </div>
                  <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{url('login')}}" class="text-dark font-weight-bolder">Sign in</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
   <div class="modal fade" id="otpModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Verify OTP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <label>Enter 6-digit OTP</label>
                <input type="text"
                       id="otp"
                       class="form-control"
                       maxlength="6"
                       placeholder="Enter OTP">

                <small id="otpError" class="text-danger d-none"></small>

                <p class="mt-2" id="otpMsg"></p>

                <div class="text-end">
                    <a href="javascript:void(0)" onclick="sendOtp()">Resend OTP</a>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-success" onclick="verifyOtp()">Verify</button>
            </div>

        </div>
    </div>
</div>

  </main>
  <!--   Core JS Files   -->
  <script src="{{asset('auth/assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('auth/assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('auth/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('auth/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
 <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    let otpModal;

function openOtpModal() {
    otpModal = new bootstrap.Modal(document.getElementById('otpModal'));
    otpModal.show();
}
function sendOtp() {
    let email = $("#email").val();

    if (email === "") {
        alert("Please enter email");
        return;
    }
openOtpModal();
    $.ajax({
        url: "{{ route('student.send.otp') }}",
        type: "POST",
        data: {
            email: email,
            _token: "{{ csrf_token() }}"
        },
        beforeSend: function () {
            $("#otpMsg").text("Sending OTP...");
        },
        success: function (response) {
            
            $("#otpMsg").text(response.message).css("color", "green");
        },
        error: function (xhr) {
            $("#otpMsg").text("Failed to send OTP").css("color", "red");
        }
    });
}
function verifyOtp() {
    let otp = $("#otp").val();
    let email = $("#email").val();

    if (otp.length !== 6) {
        $("#otpError").text("Enter valid 6-digit OTP").removeClass("d-none");
        return;
    }

    $("#otpError").addClass("d-none");

    $.ajax({
        url: "{{ route('otp.verify') }}",
        type: "POST",
        data: { otp: otp ,
        'email':email,
            _token: "{{ csrf_token() }}"
        },
        success: function (res) {
            $("#otpMsg").text(res.message).css("color", "green");
let email = $("#email").val();
    sessionStorage.setItem("otp_email", email);
            setTimeout(() => {
                otpModal.hide();
           $("#sendmail").hide();     
            }, 1500);
        },
        error: function (xhr) {
            $("#otpMsg").text(xhr.responseJSON.message).css("color", "red");
        }
    });
}

</script>


  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
 
function passwordMatch() {
    let storedEmail = sessionStorage.getItem("otp_email");
    
if(!storedEmail){
        const password = document.getElementById("password").value="";
alert("First verify Your Email");
}

    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("password_confirmation").value;
    const error = document.getElementById("passwordError");

    if (confirmPassword === "") {
        error.classList.add("d-none");
        return;
    }

    if (password === confirmPassword) {
        error.classList.add("d-none");
    } else {
        error.classList.remove("d-none");
    }
}




  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('auth/assets/js/soft-ui-dashboard.min.js')}}"></script>
  
</body>

</html>
@if(session('success'))
<script>
    Swal.fire({
        toast: true,
        position: 'top-end',   // 👈 यहाँ position बदल सकते हो (top-end, top-start, bottom-end, bottom-start)
        icon: 'success',
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 3000
    });
</script>

@endif