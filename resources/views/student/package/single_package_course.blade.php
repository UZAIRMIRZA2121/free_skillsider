@extends('layouts.admin.master')

@section('admin')
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">-->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
    <style>
        :root {
            --primary-color: #F9C221;
            --hover-primary-color: #FBC116;
            --secondary-color: #04245C;
            --dark-secondary-color: #160430;
            --text-color: #fff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Open Sans", sans-serif;
            overflow-x: hidden;
        }

        a {
            /* color: var(--text-color); */
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
        }


        select select,
        option {
            border: none !important;
            box-shadow: none !important;
        }

        option {
            text-transform: capitalize;
            padding: 4px 0 !important;
            font-size: 14px !important;
        }

        select :focus,
        select :active {
            outline: none;
        }

        .package_container {
            background: #fff;
            /*margin: 2rem auto !important;*/
            padding: 1rem !important;
            border-radius: 10px;
            box-shadow: rgba(99, 99, 99, 0.397) 0px 2px 8px 0px;
            display: flex;
            flex-direction: column;
        }


        .package-select {
            text-transform: capitalize;
            padding: 10px 1rem;
            font-size: 16px !important;
            float: right;
            border-radius: 5px;
        }

        .package-body {
            margin: 1rem 0;
        }

        .packages_body_inner {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 1rem;

        }

        @media (max-width: 992px) {
            .packages_body_inner {
                grid-template-columns: repeat(2, 1fr);
            }



        }

        @media (max-width: 767px) {
            .packages_body_inner {
                grid-template-columns: repeat(2, 1fr);
                grid-gap: 10px;

            }
        }

        @media (max-width: 590px) {
            .packages_body_inner {
                grid-template-columns: repeat(1, 1fr);
                margin-left: 1.25rem;
                margin-right: 1.25rem;
            }

            #package-select {
                width: 89%;
                display: block;
                margin: auto;
                float: unset !important;
                font-size: 15px !important;
                padding: 0px 1rem;
                height: 33px;
            }


        }

        .package-card {
            overflow: hidden;
            border-radius: 10px;
            background: #F4F4F4 !important;
            transition: 0.3s all;
        }

        .package-card:hover {
            background: #FFFFFF !important;
        }

        .package_img {
            height: 240px;
            width: 100%;
            width: 100%;
            border-radius: 4px 4px 0 0;
            transform: translateZ(0);
            transition: all 2000ms cubic-bezier(.19, 1, .22, 1) 0ms;
        }

        .package_img:hover {
            -webkit-transform: scale(1.15);
            -moz-transform: scale(1.15);
            transform: scale(1.15)
        }

        .package_inner_body {
            padding: 10px;
        }

        .package_text a {
            color: black !important;
            transition: 0.3s all;
        }

        .package_text a:hover {
            color: var(--primary-color) !important;
        }

        .package {
            display: none;
        }

        .package_btn {
            border: none !important;
            padding: 7px 0 !important;
            width: 100%;
            border-radius: 5px;
            background-color: var(--dark-secondary-color);
            color: #FFFFFF !important;
            transition: 0.5s all;
        }

        .package_btn a {
            color: #FFFFFF !important;
        }

        .package_btn:hover {
            background-color: var(--primary-color);
        }

        .package_btn:hover a {
            color: var(--dark-secondary-color) !important;
        }






        /* Progress */
        progress {
            width: 100%;
            height: 30px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f0f0f0;
        }

        /* Style the progress bar itself */
        progress::-webkit-progress-bar {
            background-color: #f0f0f0;
            border-radius: 10px;
        }

        /* Style the value/progress of the progress bar */
        progress::-webkit-progress-value {
            background-color: var(--dark-secondary-color);
            border-radius: 10px;
        }

        progress::after {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 14px;
            color: #333;
        }
    </style>



    @php
        $aboutVideo = App\Models\AboutVideo::find(1);
        $dashboardimgs = App\Models\DashboardImage::where(function ($query) {
            $query->where('visibility', 'private')->orWhere('visibility', 'both');
        })->get();
    @endphp
    @if (isset($dashboardimgs) && $dashboardimgs->isNotEmpty())
        <section class="">
            <div class="">
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($dashboardimgs as $index => $dashboardimg)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="10000">
                                <img src="{{ asset('thumbnails/' . $dashboardimg->image) }}" class="d-block w-100 img-fluid"
                                    alt="...">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>
    @endif

    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->

        <div class="container package_container  ">
            <div class="alert-warning text-center my-2 ">
                @if(Auth::user()->package_id < 4)
                <h2 class="p-2">Hurry up: The clock is ticking! Upgrade to SKILLSIDER PRIME.</h2>
                @else
                <h2 class="p-2">Congratulations! you have successfully Purchased SKILLSIDER PRIME.</h2>
                @endif
            </div>
            <div>
                <select id="package-select" class="package-select  w-lg-auto">
                    @foreach ($packages as $package)
                        <option {{ $id == $package->id ? 'selected' : '' }}
                            value="{{ Auth::user()->paid_amount >= $package->price || Auth::user()->package_id == $package->id ? route('student.single_package_course', ['id' => $package->id]) : route('student.single_package_course', ['id' => $package->id]) }}">
                            {{ $package->package_title }}
                        </option>
                    @endforeach
                </select>

            </div>
            <div class="package-body">
                <div id="gold-package" class="package" style="display: block;">
                    <div class="packages_body_inner">
                        @foreach ($course_selected as $selected)
                            <div class="package-card">
                                <div class="overflow-hidden">
                                    <img src="{{ asset('course-image/' . $selected->image) }}" class=" img img-thumbnail"
                                        alt="">
                                </div>
                                <div class="package_inner_body ">
                                    <p class="package_text fw-bolder"> <a
                                            href="{{ Route('student.single_course_video', ['id' => encrypt($selected->id)]) }}">{{ $selected->course_title }}</a>
                                    </p>
                                    <!--<div class="progress-container">-->
                                    <!--    <progress id="myProgressBar" value="10" max="100"></progress>-->
                                    <!--</div>-->
                                    <!--<p id="progressValue">%</p>-->
                                    <!-- Video Progress Bar and Percentage -->
                                    @php
                                        $count_video = $selected->videos->count();
                                        $watched_video_count = App\Models\VideoHistory::where('user_id', Auth::id())
                                            ->where('course_id', $selected->id)
                                            ->count();
                                        $watch_percentage =
                                            $count_video > 0 && $watched_video_count > 0
                                                ? ($watched_video_count / $count_video) * 100
                                                : 0;
                                    @endphp

                                    <div class="video-progress-wrapper">
                                        <!-- Progress Bar -->
                                        <div class="progress my-3">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                style="background-color: #4a219c; width: {{ $watch_percentage }}%"
                                                role="progressbar" aria-valuenow="{{ $watch_percentage }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                                {{-- <b>{{ round($watch_percentage) }}%</b> --}}
                                            </div>
                                        </div>


                                        <!-- Video Sequence and Watching Percentage -->
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="video-sequence">
                                                {{-- <p><strong>{{ $watched_video_count }}</strong> / <strong>{{ $count_video }}</strong></p> --}}
                                                @if (round($watch_percentage) == 0)
                                                    <p><strong>Not Started</strong></p>
                                                @endif
                                                @if ($watch_percentage > 0 && $watch_percentage < 99)
                                                    <p> <strong>In Progress</strong>
                                                    <p>
                                                @endif
                                                @if ($watch_percentage > 99)
                                                    <p><strong>Completed</strong></p>
                                                @endif
                                            </div>
                                            <div class="watching-percentage">
                                                <p><strong>{{ round($watch_percentage) }}%</strong></p>
                                            </div>
                                        </div>
                                    </div>

                                    <a class="package_btn my-3 w-100 d-block text-center"
                                        href="{{ Route('student.single_course_video', ['id' => encrypt($selected->id)]) }}">
                                        <span>
                                            <i class="me-1 fa-solid fa-play"></i>
                                        </span>
                                        @if ($watch_percentage == 0)
                                            Start Course
                                            @endif

                                        @if($watch_percentage > 0 && $watch_percentage < 99)
                                            Continue Learning
                                        @endif

                                        @if( $watch_percentage > 99)
                                            Retake Course
                                        @endif
                                        <span>
                                            <i class=" ms-2 fa-solid fa-arrow-right text-light"></i>
                                        </span>
                                    </a>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header  bg-danger ">
                                <h5 class="modal-title text-light" id="exampleModalLabel"
                                    style="
                                            font-weight: 1000;
                                            font-size: 20px;">
                                    <b>Must Watch This Video</b>
                                </h5>
                                <button type="button" class="btn-close fs-3 " data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body bg-dark p-0">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" id="videoFrame"
                                        style="min-height: 300px; width: 100%;"
                                        src="https://www.youtube.com/embed/dX1kEP4tT1U?si=b-5_T3T-UUv3NSaf"
                                        title="YouTube video player" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>


    <!-- Slide-Up Form Container -->
    <div class="form-container" id="contactForm">
        <h5>Contact Us</h5>
        <p>If you face any problem, Feel free to <b><a href="https://whatsapp.com/channel/0029VaCun0IGehELSGQjdt3O"
                    target="_blank">Contact Us</a></b> for help on this number </p>
        <p class="fs-5"><b>(03417933393 WhatsApp only)</b></p>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#whatsappButton').on('click', function(event) {
                event.stopPropagation(); // Prevent event from bubbling up to the document
                var form = $('#contactForm');
                var button = $(this);
                var icon = button.find('i'); // Find the icon element

                form.toggleClass('show'); // Toggle the show class
                button.toggleClass('active'); // Toggle the active class

                if (form.hasClass('show')) {
                    form.fadeIn(300); // Show the form with fade-in effect
                    icon.addClass('icon-active'); // Add the icon-active class to change color to orange
                } else {
                    form.fadeOut(300); // Hide the form with fade-out effect
                    icon.removeClass(
                        'icon-active'); // Remove the icon-active class to change color back to white
                }
            });

            // Close button functionality
            $('#closeFormButton').on('click', function(event) {
                event.stopPropagation(); // Prevent event from bubbling up to the document
                $('#contactForm').removeClass('show').fadeOut(300); // Hide the form with fade-out effect
                $('#whatsappButton').removeClass('active'); // Remove active class from the button
                $('#whatsappButton i').removeClass(
                    'icon-active'); // Remove icon-active class to change color back to white
            });

            // Hide form when clicking outside of it
            $(document).on('click', function(event) {
                var form = $('#contactForm');
                var button = $('#whatsappButton');

                // Check if the click was outside the button and the form
                if (!button.is(event.target) && button.has(event.target).length === 0 && !form.is(event
                        .target) && form.has(event.target).length === 0) {
                    form.removeClass('show').fadeOut(300); // Hide the form with fade-out effect
                    button.removeClass('active'); // Remove active class from the button
                    button.find('i').removeClass(
                        'icon-active'); // Remove icon-active class to change color back to white
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Automatically open the modal on page load
            $('#myModal').modal('show');

            // Stop video when the modal is closed
            $('#myModal').on('hidden.bs.modal', function() {
                var $iframe = $(this).find('iframe');
                var tempSrc = $iframe.attr('src');
                $iframe.attr('src', '');
                $iframe.attr('src', tempSrc);
            });
        });
    </script>
    <!--end::Content wrapper-->
    <script>
        document.getElementById('package-select').addEventListener('change', function() {
            var selectedValue = this.value;
            if (selectedValue) {
                window.location.href = selectedValue;
            }
        });
    </script>




@endsection
