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


                                <form  method="post" action="{{route('admin.login.store')}}">
                                    @csrf
                                    <div class="mb-4">
          <label class="form-label fw-semibold">Email</label>
                                        <input class="form-control login-input" type="email" name="email" required="" placeholder="Enter your email">
                                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror

                                    </div>

                                    <div class="mb-4">
                                        <!-- <a href="auth-recoverpw.html" class="text-muted float-end fs-12">Forgot your password?</a> -->
          <label class="form-label fw-semibold">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" name="password" class="form-control login-input" placeholder="Enter your password">
                                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror

                                        </div>
                                    </div>

                

                                    
                                        <button class="btn btn-login w-100 mb-3" type="submit"> Log In </button>
                                
<p class="text-center small mb-1">
          Don't have an account?
          <a href="signup.html" class="text-orange fw-bold">Sign up</a>
        </p>

        <p class="text-center small">
          <a href="forgot-password.html" class="text-primary">Forgot Password</a>
        </p>
      </form>

    </div>
  </div>

</body>
</html>