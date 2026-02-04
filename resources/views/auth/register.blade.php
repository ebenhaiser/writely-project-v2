<!doctype html>
<html lang="en">
<!-- [Head] start -->

<head>
    <x-auth.head-meta title="Register | Writely." />

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
                <div class="card mt-5">
                    <div class="card-body">
                        <a href="#" class="d-flex justify-content-center mt-3">
                            <img src="{{ asset('src/assets/images/writely-logo.png') }}" alt="image"
                                class="img-fluid" style="width: 50px" />
                        </a>
                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="auth-header">
                                    <h2 class="text-secondary mt-5"><b>Sign up</b></h2>
                                    <p class="f-16 mt-2">Enter your credentials to continue</p>
                                </div>
                            </div>
                        </div>
                        {{-- <button type="button" class="btn mt-2 bg-light-primary bg-light text-muted" style="width: 100%">
              <img src="../assets/images/authentication/google-icon.svg" alt="image" />Sign Up With Google
            </button> --}}
                        {{-- <div class="saprator mt-3">
              <span>or</span>
            </div> --}}
                        {{-- <h5 class="my-4 d-flex justify-content-center">Sign Up with Email address</h5> --}}
                        <livewire:auth.register />

                        <hr />
                        <h5 class="d-flex justify-content-center">Already have an account? <a
                                href="{{ route('login') }}" class="ms-1">Login</a></h5>
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
