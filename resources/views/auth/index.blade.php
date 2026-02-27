<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | Gurumantra</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
</head>

<body class="login-body">

  <div class="login-wrapper">
    <div class="login-card">

      <h2 class=" mb-2">Welcome back</h2>
      <p class="text-muted mb-4">
        Enter your email and password to sign in
      </p>
                  <form role="form" method="post" action="{{route('student.login')}}">
                    @csrf
                    <div class="mb-3">
                                <label class="form-label fw-semibold">Email</label>

                      <input type="email"class="form-control login-input" placeholder="Email" aria-label="Email" name="email" aria-describedby="email-addon">
                      @error('email') <small class="text-danger">{{ $message }}</small> @enderror

                    </div>
                    <div class="mb-3">
                                <label class="form-label fw-semibold">Password</label>

                      <input type="password" class="form-control login-input" placeholder="Password" name="password" aria-label="Password" aria-describedby="password-addon">
                      @error('password') <small class="text-danger">{{ $message }}</small> @enderror

                    </div>
                   
                     <button type="submit" class="btn btn-login w-100 mb-3">
          Sign in
        </button>
        <p class="text-center small mb-1">
          Don't have an account?
          <a href="{{route('student.register')}}" class="text-orange fw-bold">Sign up</a>
        </p>

        <p class="text-center small">
          <a href="{{route('student.forgoton')}}" class="text-primary">Forgot Password</a>
        </p>
                  </p>
                  </form>

    </div>
  </div>

</body>
</html>