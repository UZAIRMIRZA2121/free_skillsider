<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../">
    <title>skillsider</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png')}}" />
    <!--begin::Fonts-->
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />-->
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--end::Global Stylesheets Bundle-->
 <style>
    .container {
      position: relative;
      text-align: center;
      color: white;
    }

    .centered {
      color: black;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
       font-size: 20px;
    }

    /* Set the size of the image */
    .container img {
      width: 100px;
      height: auto; /* Maintain aspect ratio */
    }

   

    #toggle-password {
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1; /* Ensure it appears above the input field */
}

  </style>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <!-- Your code -->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-body" onload="generateCaptcha()">
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid py-10">
            <!--begin::Content-->
            <div class="row w-100">
                <!--begin::Wrapper-->
                <div class="col-10 col-md-10 col-lg-4 p-md-5 p-lg-10 mx-auto">
                    <!--begin::Form-->
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                   <form class="form w-100" novalidate="novalidate" id="myForm" method="POST" 
                  
                          action="{{ route('login') }}"  onsubmit="return validateCaptcha()">
                    @csrf


                    <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Logo-->
                        <a href="{{route('std.index')}}" class="py-9 mx-5">
                            <img alt="Logo" src="{{ asset('assets/images/skillsider_logo.png')}}" class="h-70px"  />
                        </a>
                    <!--end::Logo-->
                            <!--begin::Title-->
                            <h3 class="text-dark mt-5 mb-3">Sign In to skillsider</h3>
                            <!--end::Title-->
                            <!--begin::Link-->
                            <div class="text-gray-400 fw-bold fs-4">New to Skillsider?
                                <a href="{{ route('user.register') }}" class="link-success fw-bolder">Sign up now</a>
                            </div>
                            <!--end::Link-->
                            @if (Session::has('success'))
                                <div class="alert  alert-success">
                                    {{ Session::get('success') }}
                                    </div>
                            @endif
                            <!--begin::Link-->
                            {{-- <div class="text-gray-400 fw-bold fs-4">New Here?
                                <a href="{{ route('register') }}" class="link-success fw-bolder">Create an
                                    Account</a>
                            </div> --}}
                            <!--end::Link-->
                        </div>
                         <div class="  alert-success py-4 h1 text-center">
                                    Welcome back!
                                </div>
                        <!--begin::Heading-->
                        <div class="error">
                            <x-validation-errors class="mb-4 alert error  alert-danger" />
                            @if (Session::has('login'))
                                <div class="alert error  alert-success">
                                    {{ Session::get('login') }}
                                </div>
                            @endif
                            @if (Session::has('message'))
                                <div class="alert error  alert-danger">
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert error  alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                               
                        </div>
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                            <x-input id="email" class="form-control form-control-lg form-control-solid"
                                     type="email" name="email" :value="old('email')" required autofocus
                                     autocomplete="username" />

                        </div>
                        <div class="fv-row mb-10">
                            <div class="d-flex flex-stack mb-2">
                                <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                                @if (Route::has('password.request'))
                                    <a class="link-primary fs-6 fw-bolder underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>
                        
                            <!-- Password Input with Eye Icon -->
                            <div class="position-relative">
                                <!-- Password Input -->
                                <x-input id="password" class="form-control form-control-lg form-control-solid" type="password" name="password" required autocomplete="current-password" />
                        
                                <!-- Eye Icon -->
                                <span id="toggle-password" class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" style="cursor: pointer;">
                                    <i class="bi bi-eye-slash fs-2"></i> <!-- Hidden by default -->
                                    <i class="bi bi-eye fs-2 d-none"></i> <!-- Visible when password is shown -->
                                </span>
                            </div>
                        </div>
                        
                         <div class="fv-row mb-10  d-flex">
                         <div class="container" id="captcha-container">
                          <img src="{{ asset('captcha-image.jpeg')}}" alt="Snow">
                          <div class="centered" id="captcha-text"></div>
                            <i class="fas fa-sync" onclick="generateCaptcha()"></i>
                        </div>
                          <input type="text" id="captcha-input"class="form-control form-control-lg form-control-solid" placeholder="Type here"> </br>
                    
                        </div>
                            <!-- Input field and error message -->
                      
                        <p  class="alert error  alert-danger" id="captcha-error" style="display:none">Please retype text from the image (without spaces)</p>
                        
                        
                     
                    
                     
                        <button type="submit" class="btn btn-lg btn-success w-100 mb-5 ">
                            <a href=" {{ __('Log in') }}" ></a>Login
                        </button>
                    </form>

                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
            <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
                <!--begin::Links-->
                <div class="d-flex flex-center fw-bold fs-6">
                  © 2025 SkillSider. All Rights Reserved
                </div>
                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->
<!--end::Main-->
<!--begin::Javascript-->
<script>
    var hostUrl = "assets/";
</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js')}}"></script> 
<!--end::Global Javascript Bundle-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('assets/js/custom/authentication/sign-in/general.js')}}"></script>
<!--end::Page Custom Javascript-->
<!--end::Javascript-->

<!--captcha--start-->
<script>
  function generateCaptcha() {
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var captcha = '';

    // Generate a random 8-character captcha
    for (var i = 0; i < 6; i++) {
      captcha += characters.charAt(Math.floor(Math.random() * characters.length));
    }

    // Set the captcha text
    document.getElementById('captcha-text').innerText = captcha;
  }

 function validateCaptcha() {
  var userInput = document.getElementById('captcha-input').value;
  var actualCaptcha = document.getElementById('captcha-text').innerText;

  if (userInput.toLowerCase() === actualCaptcha.toLowerCase()) {
    document.getElementById('your-form-id').submit(); // Submit the form
  } else {
    document.getElementById('captcha-error').style.display = 'block';
      return false;
  }
}

document.getElementById("toggle-password").addEventListener("click", function () {
    var passwordInput = document.getElementById("password");
    var iconEye = this.querySelector(".bi-eye");
    var iconEyeSlash = this.querySelector(".bi-eye-slash");

    // Toggle the password visibility
    if (passwordInput.type === "password") {
        passwordInput.type = "text";  // Show password
        iconEye.classList.remove("d-none");  // Show open eye icon
        iconEyeSlash.classList.add("d-none");  // Hide closed eye icon
    } else {
        passwordInput.type = "password";  // Hide password
        iconEye.classList.add("d-none");  // Hide open eye icon
        iconEyeSlash.classList.remove("d-none");  // Show closed eye icon
    }
});





</script>

<!--captcha--end-->
 @if(session('session_expired'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Session Expired',
                text: '{{ session('session_expired') }}',
                confirmButtonText: 'OK',
                allowOutsideClick: false,
            });
        </script>
    @endif

</body>
<!--end::Body-->

</html>
