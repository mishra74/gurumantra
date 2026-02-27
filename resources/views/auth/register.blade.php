<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up | Gurumantra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f4f6f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 380px;
            background: #fff;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .form-control {
            border-radius: 10px;
            height: 45px;
        }

        .btn-primary {
            border-radius: 12px;
        }

        .btn-register {
            background: #701723;
            color: #fff;
            border-radius: 12px;
            height: 45px;
        }

        .btn-register:hover {
            background: #5c101a;
        }
    </style>
</head>

<body>

<div class="login-card">

    <h3 class="mb-3 text-center">Register</h3>

    <form method="POST" action="{{ route('student.store') }}" onsubmit="return checkOtpVerified()">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}">
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Send OTP -->
        <div class="mb-3 text-end" id="sendmail">
            <button type="button" class="btn btn-primary btn-sm" onclick="sendOtp()">Send OTP</button>
        </div>

        <!-- Phone -->
        <div class="mb-3">
            <input type="number" class="form-control" name="phone" placeholder="Phone" value="{{ old('phone') }}">
            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <input type="password" class="form-control" name="password_confirmation"
                   id="password_confirmation"
                   placeholder="Confirm Password"
                   onkeyup="passwordMatch()">

            <small id="passwordError" class="text-danger d-none">
                Passwords do not match
            </small>

            @error('password_confirmation')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- State -->
        <div class="mb-3">
            <select class="form-control" name="state">
                <option value="">--Select State--</option>
                <option value="Gujarat" {{ old('state')=='Gujarat'?'selected':'' }}>Gujarat</option>
                <option value="Maharashtra" {{ old('state')=='Maharashtra'?'selected':'' }}>Maharashtra</option>
                <option value="Delhi" {{ old('state')=='Delhi'?'selected':'' }}>Delhi</option>
                <option value="Rajasthan" {{ old('state')=='Rajasthan'?'selected':'' }}>Rajasthan</option>
            </select>
            @error('state') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Referral -->
        <div class="mb-3">
            <input type="text" class="form-control" name="refferal" placeholder="Referral Code"
                   value="{{ isset($id) ? $id : old('refferal') }}"
                   {{ isset($id) ? 'readonly' : '' }}>
        </div>

        <!-- Submit -->
        <div class="text-center">
            <button type="submit" class="btn btn-register w-100">Sign Up</button>
        </div>

        <p class="text-sm mt-3 text-center">
            Already have an account?
            <a href="{{ url('login') }}">Sign in</a>
        </p>
    </form>
</div>

<!-- OTP Modal -->
<div class="modal fade" id="otpModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Verify OTP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="text" id="otp" class="form-control" maxlength="6" placeholder="Enter 6-digit OTP">
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>

let otpModal;

function openOtpModal() {
    otpModal = new bootstrap.Modal(document.getElementById('otpModal'));
    otpModal.show();
}

function sendOtp() {

    let email = $("#email").val();

    if (!email) {
        alert("Please enter email");
        return;
    }

    openOtpModal();

    $.post("{{ route('student.send.otp') }}", {
        email: email,
        _token: "{{ csrf_token() }}"
    }, function (response) {
        $("#otpMsg").text(response.message).css("color", "green");
    }).fail(function () {
        $("#otpMsg").text("Failed to send OTP").css("color", "red");
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

    $.post("{{ route('otp.verify') }}", {
        otp: otp,
        email: email,
        _token: "{{ csrf_token() }}"
    }, function (res) {

        $("#otpMsg").text(res.message).css("color", "green");

        sessionStorage.setItem("otp_verified", "true");

        setTimeout(() => {
            otpModal.hide();
            $("#sendmail").hide();
        }, 1000);

    }).fail(function (xhr) {
        $("#otpMsg").text(xhr.responseJSON.message).css("color", "red");
    });
}

function passwordMatch() {

    if (sessionStorage.getItem("otp_verified") !== "true") {
        alert("First verify your email");
        document.getElementById("password").value = "";
        document.getElementById("password_confirmation").value = "";
        return;
    }

    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("password_confirmation").value;
    let error = document.getElementById("passwordError");

    if (!confirmPassword) {
        error.classList.add("d-none");
        return;
    }

    if (password === confirmPassword) {
        error.classList.add("d-none");
    } else {
        error.classList.remove("d-none");
    }
}

function checkOtpVerified() {

    if (sessionStorage.getItem("otp_verified") !== "true") {
        alert("Please verify your email first");
        return false;
    }

    return true;
}

</script>

@if(session('success'))
<script>
    sessionStorage.removeItem("otp_verified");
    alert("{{ session('success') }}");
</script>
@endif

</body>
</html>