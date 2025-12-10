<!doctype html>
<html lang="en">
<!-- [Head] start -->
<head>
  <x-auth.head-meta title="Login | Writely." />
  
  <x-auth.head />
  
</head>
<!-- [Head] end -->
<!-- [Body] Start -->
<body>
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->
  
  <div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">
        <div class="card my-5">
          <div class="card-body">
            <div class="d-flex gap-3 justify-content-center">
              <img src="{{ asset('src/assets/images/writely-logo.png') }}" alt="image" class="img-fluid" width="50px" />
              {{-- <h1>Writely.</h1> --}}
            </div>
            <div class="row">
              <div class="d-flex justify-content-center">
                <div class="auth-header">
                  <h2 class="text-secondary mt-5"><b>Hi, Welcome Back</b></h2>
                  <p class="f-16 mt-2">Enter your credentials to continue</p>
                </div>
              </div>
            </div>
            {{-- <div class="d-grid">
              <button type="button" class="btn mt-2 bg-light-primary bg-light text-muted">
                <img src="../assets/images/authentication/google-icon.svg" alt="image" />Sign In With Google
              </button>
            </div>
            <div class="saprator mt-3">
              <span>or</span>
            </div>
            <h5 class="my-4 d-flex justify-content-center">Sign in with Email address</h5> --}}
            
            <livewire:auth.login />
            <hr />
            <h5 class="d-flex justify-content-center">Don't have an account?<a href="{{ route('auth.register') }}" class="ms-1">Register</a></h5>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  
  <x-auth.scripts />
  
</body>
<!-- [Body] end -->
</html>
