<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../">
    <title></title>
    <meta charset="utf-8" />
    <meta name="description"
        content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords"
        content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-body">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-up -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">

            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid py-10">
                <!--begin::Content-->
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-800px py-5 px-10 py-lg-5 pb-lg-10 px-lg-15 mx-auto card">
                        <!--begin::Form-->

                        <!--begin::Heading-->
                        <div class="mb-10 text-center">
                            <!--begin::Logo-->
                            <a href="#" class="py-9 mx-5">
                                <img alt="Logo" src="{{ asset('assets/images/logo.png') }}" class="h-70px" />
                            </a>
                            <!--end::Logo-->
                            <!--begin::Link-->
                            <div class="text-gray-400 fw-bold fs-4">New to Skillsider?
                                <a href="{{ route('user.register') }}" class="link-primary fw-bolder">Sign up now</a>
                            </div>
                            <!--end::Link-->
                        </div>
                        <!--end::Heading-->


                        <!--begin::Separator-->
                        <div class="d-flex align-items-center mb-10">
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                            <span class="fw-bold text-gray-400 fs-7 mx-2">OR</span>
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>

                        </div>

                        <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" method="get"
                            enctype="multipart/form-data" action="{{ route('affiliate.veification.check') }}">
                            @csrf
                            <div class="row fv-row mb-7 ">
                                <x-validation-errors class="mb-4" />
                                <!--begin::Col-->
                                <div class="col-xl-6">
                                    <label class="form-label fw-bolder text-dark fs-6">Enter Referral Code</label>
                                    <x-input class="form-control form-control-lg form-control-solid" type="text"
                                        name="referral_code" placeholder="Referral Code" required />
                                </div>

                                <div class="col-xl-6 mt-9">
                                    <x-button class="btn btn-primary w-50" type="submit">
                                        {{ __('Verification') }}<i class="fa-solid fa-arrow-right"></i>
                                    </x-button>
                                </div>
                                <!--end::Col-->
                                @if (Session::has('error'))
                                <div class="alert alert-danger m-5 w-50">
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                            </div>
                            <!--end::Input group-->
                        </form>
                        @if (isset($all_users))
                        <!--begin::Card body-->
                            <div class="card-body p-9">
                                <!--begin::Row-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Full Name</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $all_users->first_name }}
                                            {{ $all_users->last_name }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Input group-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Referal code</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span
                                            class="fw-bold fs-6 text-gray-800">{{ $all_users->referral_code }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-10">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Joining Data</label>
                                    <!--begin::Label-->

                                    <!--begin::Label-->
                                    <div class="col-lg-8">
                                        <span
                                            class="fw-semibold fs-6 text-gray-800">{{ $all_users->created_at }}</span>
                                    </div>
                                    <!--begin::Label-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card body-->
                        @endif

                        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                            <div id="toast-container" class="toast-container">
                                <!-- Toast messages will be added here -->
                            </div>
                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-up-->
    </div>
    <!--end::Root-->
    <!--end::Main-->
    <!--begin::Javascript-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="assets/js/custom/authentication/sign-up/general.js"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
    <script>
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 3000); // <-- time in milliseconds
        /////form validation///
        function scrollToTop() {
            var currentPosition = window.scrollY;
            if (currentPosition > 0) {
                window.scrollTo(0, currentPosition - 20); // Scroll up by 20 pixels
                window.requestAnimationFrame(scrollToTop); // Call the function recursively
            }
        }
    </script>
</body>
<!--end::Body-->

</html>
