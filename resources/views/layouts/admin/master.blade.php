<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
    <!-- Quill.js CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        #editor {
            height: 200px;
        }

        .menu-item a:hover .menu-icon i {
            color: #4d3184 !important;
            /* Change this to your desired hover color */
        }

        .image-container {
            display: inline-block;
            /* or any other display value that suits your layout */
            overflow: hidden;
            /* Hides the zoomed-in part of the image */
        }

        .image-container img {
            transition: transform 0.3s ease;
            /* Transition property for smooth effect */
        }

        .image-container:hover img {
            transform: scale(1.5) translate(0px, 25px);
            /* Adjust the scale value to control the zoom level */
        }

        [data-kt-app-layout=light-sidebar] .app-sidebar .menu>.menu-item .menu-link .menu-title {
            color: black !important;
        }


        .menu-item .menu-link .menu-title {
            color: #000 !important;
        }

        .showOnlyMob {
            display: none;
        }

        @media screen and (max-width: 992px) {
            .showOnlyMob {
                display: block;
            }

            #kt_app_sidebar {
                margin-top: 60px !important;
            }

            .menu-title {
                font-size: 18px !important;
            }

            .menu-icon i {
                font-size: 18px !important;
            }
        }

        #app {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 600px;
            max-width: 100%;
            margin: 50px auto;
            position: relative;
        }

        .image {
            width: 400px;
            max-width: 100%;
        }

        .expandable-image {
            position: relative;
            transition: 0.25s opacity;
            cursor: zoom-in;
        }

        body>.expandable-image.expanded {
            position: fixed;
            z-index: 999999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: black;
            display: flex;
            align-items: center;
            opacity: 0;
            padding-bottom: 0 !important;
            cursor: default;
        }

        body>.expandable-image.expanded>img {
            width: 100%;
            max-width: 1200px;
            max-height: 100%;
            object-fit: contain;
            margin: 0 auto;
        }

        body>.expandable-image.expanded>.close-button {
            display: block;
        }

        .close-button {
            position: fixed;
            top: 10px;
            right: 10px;
            display: none;
            cursor: pointer;
        }

        svg {
            filter: drop-shadow(1px 1px 1px rgba(0, 0, 0, 0.5));
        }

        svg path {
            fill: #FFF;
        }

        .expand-button {
            position: absolute;
            z-index: 999;
            right: 10px;
            top: 10px;
            padding: 0px;
            align-items: center;
            justify-content: center;
            padding: 3px;
            opacity: 0;
            transition: 0.2s opacity;
        }

        .expandable-image:hover .expand-button {
            opacity: 1;
        }

        .expand-button svg {
            width: 20px;
            height: 20px;
        }

        .expand-button path {
            fill: #FFF;
        }

        .expandable-image img {
            width: 100%;
        }


        .icon-mobile-nav {
            height: 40px;
            width: 40px;
            color: #cda314;


        }

        .paginate_button.active,
        .btn-primary,
        .active>.page-link {
            background-color: #50cd89 !important;
            /* Change background color */
            color: white !important;
            /* Change text color */
        }
    </style>
    <style>
        .whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            background-color: #25D366;
            /* WhatsApp Green */
            color: white;
            border-radius: 50%;
            width: 60px;
            /* Increased for larger icon */
            height: 60px;
            /* Increased for larger icon */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            /* Font size for the button */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            cursor: pointer;
            transition: background-color 0.3s ease;
            /* Transition for button background */
        }

        .whatsapp-button:hover {
            background-color: #128C7E;
            /* Darker green on hover */
        }

        .whatsapp-button i {
            font-size: 2.5rem !important;
            /* Font size for the icon */
            color: white;
            /* Default icon color */
            transition: color 0.3s ease, transform 0.3s ease;
            /* Transition for icon color and scaling */
        }

        .whatsapp-button:hover i,
        .whatsapp-button.active i {
            color: orange !important;
            /* Change icon color to orange */
            transform: scale(1.1);
            /* Scale up the icon slightly */
        }



        .form-container.show {
            display: block;
            /* Show the form when active */
            transform: translateY(0);
            /* Move to original position */
            opacity: 1;
            /* Full opacity */
            width: fit-content;
        }

        /* New class to set the icon color to orange with !important */
        .icon-active {
            color: orange !important;
            /* Change icon color to orange */
        }

        @keyframes shake {
            0% {
                transform: translateX(0);
            }

            25% {
                transform: translateY(-2px);
            }

            50% {
                transform: translateY(2px);
            }

            75% {
                transform: translateX(-2px);
            }

            100% {
                transform: translateX(2px);
            }
        }

        /* Add the shake animation to the button */
        .whatsapp-button.shake {
            animation: shake 0.5s ease-in-out;
            animation-iteration-count: infinite;
            /* Loop animation if you want it to shake continuously */
        }

        /* Stop the shaking animation on hover */
        .whatsapp-button.shake:hover {
            animation: none;
        }
    </style>
  

    <link href="{{ asset('assets/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/assets/plugins/global/plugins.bundle.js') }}"></script>
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!-- Main Quill library -->
    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

    <!-- Core build with no theme, formatting, non-essential modules -->
    <link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
    <script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-KyZXEAg3QhqLMpG8r+6AY4kenGEF/xKz3ZxsyDfNiqJw4xlt/8W1aJTQ4PFPm1" crossorigin="anonymous"></script>

    <script src="assets/js/scripts.bundle.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <link href="{{ asset('assets/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/assets/plugins/global/plugins.bundle.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <base href="../" />
    <title>Skillsider</title>
    <meta charset="utf-8" />

    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plyr.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
    <style>
        .menu-link:hover {
            background-color: #E0B0FF;
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->
<!--oncontextmenu="return false"-->

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
      
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!-- Include top bar -->


            @include('layouts.admin.topbar')

            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">

                <!-- Include sidebar -->
                {{-- sidebar Start --}}

                @include('layouts.admin.sidebar')
                {{-- sidebar End --}}
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid bg-light" id="kt_app_main">


                    @yield('admin')
                </div>
                {{-- footer Start --}}
                @include('layouts.admin.footer')
                {{-- footer End --}}
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>


    <style>
        audio {
            display: none;
        }
    </style>

    @if (Auth::user()->sounds == 1 &&  Auth::user()->role == 0 && Route::currentRouteName() == 'student.single_package_course')

        <audio id="background-music" src="{{ asset('skill_sider_welcome_voice_note.mp3') }}" autoplay></audio>
        
    @endif
    <!--end::App-->
    @if (Auth::user()->role == 0 && Route::currentRouteName() != 'student.dashboard')
        @if (Route::currentRouteName() == 'student.single_course_video')
            <!-- WhatsApp Button -->
            <div class="whatsapp-button icon-active" id="whatsappButton">
                <i class="fab fa-whatsapp"></i>
            </div>
        @else
            @if (Route::currentRouteName() == 'student.single_package_course')
                <!-- WhatsApp Button -->
                <a href="https://whatsapp.com/channel/0029VauO4atAojYlvdgXx306" target="_blank">
                    <div class="whatsapp-button icon-active" id="whatsappButton">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                </a>
            @else
                <a href="https://whatsapp.com/channel/0029VaCun0IGehELSGQjdt3O" target="_blank">
                    <div class="whatsapp-button icon-active" id="whatsappButton">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                </a>
            @endif



        @endif

    @endif


    <script>
        // Add shake class to the WhatsApp button when the page loads
        const whatsappButton = document.getElementById("whatsappButton");

        // Add the shake animation when the page loads
        window.addEventListener("load", () => {
            whatsappButton.classList.add("shake");
        });

        // Optionally, remove the shake animation after it finishes
        whatsappButton.addEventListener("animationend", () => {
            whatsappButton.classList.remove("shake");
        });
    </script>
    <!--begin::Javascript-->
    <script>
        var hostUrl = "asset/";
    </script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.js') }}"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/custom/documentation/charts/chartjs.js') }}"></script> --}}
    <script src="{{ asset('assets/js/custom/documentation/charts/amcharts/charts.js') }}"></script>
    <script src="{{ asset('assets/js/custom/documentation/forms/image-input.js') }}"></script>

    <!--end::Custom Javascript-->
    <!--end::Javascript-->
    {{--    <script src = "https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Check window width on page load and resize
        function checkWindowSize() {
            if ($(window).width() < 992) { // Change this threshold as needed
                $('#kt_app_sidebar').attr('data-kt-drawer-direction', 'top');
            } else {
                $('#kt_app_sidebar').attr('data-kt-drawer-direction', 'start');
            }
        }

        // Run the function on page load and resize
        $(document).ready(function() {
            checkWindowSize();

            $(window).resize(function() {
                checkWindowSize();
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toggleButton = document.getElementById('kt_app_sidebar_mobile_toggle');
            var icon = document.getElementById('bar-icon');

            // Add a click event listener to the button
            toggleButton.addEventListener('click', function() {
                // Toggle between 'menu' and 'close' based on the current icon name
                icon.name = (icon.name === 'menu') ? 'close' : 'menu';
            });
        });
    </script>

    <script>
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 3000);
        //toaster start

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toastr-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            toastr.error("{{ Session::get('error') }}");
        @endif
        @if (Session::has('success'))
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toastr-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr.success("{{ Session::get('success') }}");
            //toaster end
        @endif
        //confirm before delete
        $('.submitDeleteForm').on('click', function(e) {
            e.preventDefault();
            var form = $(this).parents('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {

                    form.submit();
                }
            });
        });
    </script>

    <script>
        // Disable right-click context menu
        document.addEventListener('contextmenu1', event => event.preventDefault());

        // Disable Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U
        document.onkeydown = function(e) {
            if (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'i')) {
                return false;
            }
            if (e.ctrlKey && e.shiftKey && (e.key === 'J' || e.key === 'j')) {
                return false;
            }
            if (e.ctrlKey && (e.key === 'U' || e.key === 'u')) {
                return false;
            }
        }

        // Example of handling sidebar close button click using jQuery
        $("#closeSidebar").click(function() {
            $("#kt_app_sidebar").removeClass("drawer-on");
        });

        // Disable Ctrl+U
        document.addEventListener('contextmenu', function(event) {
            if (event.ctrlKey && event.key === 'u') {
                event.preventDefault();
                alert("Sorry, you can't view the page source!");
            }
        });
        // Select elements
        const target = document.getElementById('kt_clipboard_1');
        const button = target.nextElementSibling;

        // Init clipboard -- for more info, please read the offical documentation: https://clipboardjs.com/
        var clipboard = new ClipboardJS(button, {
            target: target,
            text: function() {
                return target.value;
            }
        });

        // Success action handler
        clipboard.on('success', function(e) {
            const currentLabel = button.innerHTML;

            // Exit label update when already in progress
            if (button.innerHTML === 'Copied!') {
                return;
            }

            // Update button label
            button.innerHTML = 'Copied!';

            // Revert button label after 3 seconds
            setTimeout(function() {
                button.innerHTML = currentLabel;
            }, 3000)
        });
    </script>

<script>
    document.querySelectorAll('.toggle-status').forEach((checkbox) => {
        checkbox.addEventListener('change', function() {
            const field = this.dataset.field; // Get the field name (e.g., passive_income, sounds)
            const value = this.checked ? 1 : 0; // Determine the new value (1 for checked, 0 for unchecked)

            // Send AJAX request
            fetch('student/update-user-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    field: field,
                    value: value
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const statusText = value === 1 ? 'enabled' : 'disabled'; // Determine the status text
                  
                    toastr.success(`${field} is now ${statusText}`); // Success message with "enabled" or "disabled"
                } else {
                   
                    toastr.error('Failed to update status.'); // Error message
                }
            })
            .catch(error => {
                console.error('Error:', error);
                toastr.error('An error occurred while updating status.'); // General error message
            });
        });
    });
</script>
<script src="{{ asset('assets/js/plyr.js') }}"></script>
<script>
    // Initialize Plyr for video player
    const player = new Plyr('#player');

    // Get the iframe element
    const iframe = document.querySelector('iframe');

   
</script>
    @stack('custom-scripts')




</body>
<!--end::Body-->

</html>
