@extends('layouts.admin.master')

@section('admin')
    @php
        $count_video = $videos->count();
        $watch_percentage =
            $count_video > 0 && $watched_video_count > 0 ? ($watched_video_count / $count_video) * 100 : 0;

        $videoLink = request('play');
        $video_type = request('video_type');
        $video_seq = request('video_seq');
        $current_video_id = request('video_id');

        $video_resource_link = request('resource_link');
        $video_resource_text = request('resource_text');

    @endphp

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const watchPercentage = {{ round($watch_percentage) }}; // Percentage watched from the server
            const latestWatchedVideoId = {{ $latestWatchedVideo->video_id ?? 'null' }}; // Latest watched video ID
            const currentVideoId = {{ $current_video_id ?? 'null' }}; // Current video ID
            let isFormSubmitted = false; // Ensure the form is submitted only once

            // Case 1: If watch percentage is 0
            if (latestWatchedVideoId == null && currentVideoId == null) {
                const button = document.querySelector('button[data-form-id="0"]'); // Find the button
                if (button) {
                    const videoId = button.getAttribute('data-video-id'); // Get the video ID
                    const form = button.closest('form'); // Find the parent form of the button
                    if (form) {
                        // Send the AJAX request to store video history
                        fetch("{{ route('video-history.store') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                },
                                body: JSON.stringify({
                                    video_id: videoId
                                })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error("Failed to update video history");
                                }
                                return response.json();
                            })
                            .then(data => {
                                form.submit(); // Submit the form programmatically
                                isFormSubmitted = true; // Mark form submission as done
                            })
                            .catch(error => {
                                console.error("An error occurred:", error);
                                alert("An error occurred. Please try again.");
                            });
                    }
                }
            } else if (latestWatchedVideoId !== currentVideoId) {

                // Find the form corresponding to the latest watched video ID
                const form = document.querySelector(`.video-form-${latestWatchedVideoId}`);
                if (form) {
                    if (latestWatchedVideoId > currentVideoId) {
                        return;
                    }
                    //   form.submit(); // Submit the form programmatically
                } else {
                    console.warn(`No form found for the latest watched video ID: ${latestWatchedVideoId}`);
                }
            }
        });
    </script>

    <style>
        /* Container to hold the video iframe */
        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            /* 16:9 aspect ratio */
            margin: 20px 0;
            /* Adjust margin as needed */
        }

        /* Styles for the iframe */
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
    <style>
        .form-container {
            position: fixed;
            bottom: 100px;
            /* Adjust the position above the button */
            right: 20px;
            z-index: 999;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            border-radius: 5px;
            padding: 15px;
            width: 300px;
            /* Adjust width as needed */
            transform: translateY(20px);
            /* Initial position */
            opacity: 0;
            /* Initial opacity */
            transition: all 0.3s ease;
            /* Transition for smooth animation */
            display: none;
            /* Initially hidden */
        }

        .carousel-item img {
            height: auto;
            max-height: 700px;
            /* Set this to your desired maximum height */
        }
        /* Custom Styles for Header Inside Player */
        .plyr__video-embed {
            position: relative;
        }
        .video-header {
            position: absolute;
            top: 10px;
            left: 0;
            height: 100px;
            width: 100%;
            padding: 10px;
            background-color: transparent;
            color: white;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            z-index: 10;
            /* Make sure the header stays above the video */
        }

        @media (max-width: 768px) {
            .plyr__control.plyr__control--pressed {
                display: none;
            }
            .plyr__controls__item.plyr__volume input[type="range"] {
                display: none !important;
            }

            .video-header {
                height: 50px;
            }
        }

        @media (max-width: 420px) {}
    </style>
    <!-- Add Custom Styling to Align the Elements -->
    <style>
        .video-progress-wrapper {
            margin-top: 20px;
            text-align: center;
        }

        .video-sequence,
        .watching-percentage {
            font-size: 1.2rem;
            font-weight: bold;
            color: black
        }

        .video-sequence p,
        .watching-percentage p {
            margin: 0;
        }

        .d-flex {
            justify-content: space-between;
            font-size: 1rem;
        }
    </style>

    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Student
                    </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1 d-none">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Skillsider | Course Lecture</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{ $course_name->course_title }}</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->

                </div>

                <!--end::Page title-->
                <div class="d-flex justify-content-end">
                    <a class="btn btn-info btn-sm"
                        href="{{ route('student.single_package_course', ['id' => Auth::user()->package_id]) }}">Back </a>
                </div>

                <!--begin::Actions-->

            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="row p-0">
                    <div class="col-lg-12">
                        <div class="">
                            <div class="">
                                <div class="row p-0">
                                    <div class="col-xl-8" style="display: block;">
                                        <div class="card text-white">

                                            <div class="my-0 px-1 p-lg-5">
                                                <div class="embed-responsive embed-responsive-16by9" id="vid_con">

                                                    @if (isset($videoLink) && $videoLink != null)
                                                        <div class="video-container py-3">
                                                            <div style="position: relative;">
                                                                @if ($video_type == 1)
                                                                    <div style="padding:56.25% 0 0 0;position:relative;">
                                                                        <iframe
                                                                            src="https://player.vimeo.com/video/{{ $videoLink }}&amp;autopause=0&amp;player_id=0&amp;app_id=58479"
                                                                            frameborder="0"
                                                                            allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media"
                                                                            style="position:absolute;top:0;left:0;width:100%;height:100%;"
                                                                            title="new yt 4"></iframe>
                                                                    </div>
                                                                @else
                                                                    <div class="plyr__video-embed" {{-- id="player" --}}>
                                                                        <div class="video-header"></div>
                                                                        <iframe
                                                                            src="https://www.youtube.com/embed/{{ $videoLink }}?origin={{ url('/') }}&iv_load_policy=3&modestbranding=1&showinfo=0&rel=0"
                                                                            allowfullscreen width="500px" height="281px"
                                                                            allow="autoplay; encrypted-media; ">
                                                                        </iframe>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @else
                                                        <p class="text-info text-center mt-2">Please select video from the
                                                            course playlist
                                                        </p>
                                                    @endif
                                                </div>
                                                <!-- Video Progress Bar and Percentage -->


                                               <div class="video-progress-wrapper mx-3 mb-3">
                                                 
                                                    <div class="progress my-3 ">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                            style="background-color: #4a219c; width: {{ $watch_percentage }}%"
                                                            role="progressbar" aria-valuenow="{{ $watch_percentage }}"
                                                            aria-valuemin="0" aria-valuemax="100">
                                                            {{-- <b>{{ round($watch_percentage) }}%</b> --}}
                                                        </div>
                                                    </div>


                                                
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="video-sequence">
                                                            <p><strong>{{ $watched_video_count }}</strong> /
                                                                <strong>{{ $count_video }}</strong>
                                                            </p>
                                                        </div>
                                                        <div class="watching-percentage">
                                                            <p><strong>{{ round($watch_percentage) }}%</strong></p>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="mx-3 mb-3">
                                                    <!-- Progress Bar -->
                                                    <div class=" ">
                                                        {{-- <h3>Note</h3> --}}
                                                        <p class="text-dark text-center"><a
                                                                href="{{ $video_resource_link }}"
                                                                target="_blank">{{ $video_resource_text }}</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="card text-center">
                                            <div class="card-header">
                                                <h5 class="card-title">Course Playlist</h5>
                                            </div>

                                            <div class="card-body vertical-scrollable" style="overflow: auto;">
                                                <ol class="mb-3" style="max-height:500px;width:100%;overflow: auto;">
                                                    @foreach ($videos as $video)
                                                        <form action="" method="get"
                                                            class="video-form-{{ $video->id }}">
                                                            <!-- Hidden Input -->
                                                            <input type="hidden" name="play"
                                                                value="{{ $video->video_link }}">
                                                            <input type="hidden" name="video_type"
                                                                value="{{ $video->video_type }}">
                                                            <input type="hidden" name="video_seq"
                                                                value="{{ $video->video_seq }}" readonly>
                                                            <input type="hidden" name="video_id"
                                                                value="{{ $video->id }}" readonly>

                                                            <input type="hidden" name="resource_link"
                                                                value="{{ $video->resource_link }}" readonly>
                                                            <input type="hidden" name="resource_text"
                                                                value="{{ $video->resource_text }}" readonly>
                                                            <!-- Logic for Button Enable/Disable -->
                                                            <!-- Logic for Button Enable/Disable -->
                                                            @php
                                                                // Fetch the latest watched history for the video and current user
                                                                $watched = App\Models\VideoHistory::where(
                                                                    'video_id',
                                                                    $video->id,
                                                                )
                                                                    ->where('user_id', auth()->id()) // Ensure it's specific to the current user
    ->latest()
    ->first();

// Default current sequence to 0 if no history is found
$current_seq = $watched
    ? $watched->video->video_seq
    : null;

// Get the sequence of the current video
$seq = $video->video_seq;
if ($current_seq) {
    $next_seq = $current_seq + 1;
}
$next_seq = $next_seq ?? 2;
$current_video = $seq == $current_seq;
// Determine button enable/disable status
// Disable video button if the current video is not watched or is ahead of the next sequence
$disabled = $seq > $next_seq ? 'disabled' : '';
                                                            @endphp

                                                            <!-- Play Button -->
                                                            {{-- <button type="button" class="btn  btn-link p-0 m-0 play-btn"
                                                                {{ $disabled }} data-form-id="{{ $loop->index }}"
                                                                data-video-id="{{ $video->id }}">
                                                                <i class="fa fa-lock-open"
                                                                style="font-size:14px"></i>
                                                            <span
                                                                class="text-success">{{ $video->video_title }}</span>
                                                                @if ($disabled)
                                                                    <i class="fa fa-lock" aria-hidden="true"
                                                                        style="font-size:14px"></i>
                                                                    <span class="text-dark">
                                                                        {{ $video->video_title }}</span>
                                                                @else
                                                                    @if ($video_seq >= $video->video_seq + 1)
                                                                        <i class="fa fa-lock-open"
                                                                            style="font-size:14px"></i>
                                                                        <del class="text-muted">{{ $video->video_title }}</del>
                                                                    @elseif ($video_seq == $video->video_seq)
                                                                        <i class="fa fa-lock-open"
                                                                            style="font-size:14px"></i>
                                                                        <b
                                                                            class="text-primary text-bold">{{ $video->video_title }}</b>
                                                                    @else
                                                                        <i class="fa fa-lock-open"
                                                                            style="font-size:14px"></i>
                                                                        <span
                                                                            class="text-success">{{ $video->video_title }}</span>
                                                                    @endif
                                                                @endif
                                                            </button> --}}

                                                            <button type="submit" class="btn  btn-link p-0 m-0 play-btn"
                                                                data-form-id="{{ $loop->index }}"
                                                                data-video-id="{{ $video->id }}">
                                                                {{-- {{ $disabled }} --}}
                                                                @if ($video_seq >= $video->video_seq + 1)
                                                                    <i class="fa fa-lock-open" style="font-size:14px"></i>
                                                                    <span
                                                                        class="text-muted">{{ $video->video_title }}</span>
                                                                @elseif ($video_seq == $video->video_seq)
                                                                    <i class="fa fa-lock-open" style="font-size:14px"></i>
                                                                    <b
                                                                        class="text-primary text-bold">{{ $video->video_title }}</b>
                                                                @else
                                                                    <i class="fa fa-lock-open" style="font-size:14px"></i>
                                                                    <span
                                                                        class="text-success">{{ $video->video_title }}</span>
                                                                @endif
                                                            </button>
                                                        </form>
                                                        <hr>
                                                    @endforeach
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--end::Content container-->
        </div>
        <!--end::Content-->
        <!--end::Content wrapper-->
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

    <script src="https://player.vimeo.com/api/player.js"></script>

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
        function disablePiP(iframe) {
            iframe.allowPictureInPicture = false;
        }
    </script>
   <script>
        $(document).ready(function() {
            // On Play Button Click
            $('.play-btn').on('click', function() {
                var button = $(this);
                var current_video_id = {{ $current_video_id }};
                var videoId = button.data('video-id'); // Get the video ID
                // Get the corresponding form using the dynamic class
                var form = $('.video-form-' + videoId); // Select form by class
           
                form.submit(); // Programmatically submit the form
                // alert(current_video_id)
                // alert(videoId)

                // Send the AJAX request to store video history
                $.ajax({
                    url: "{{ route('video-history.store') }}", // Your route to store video history
                    type: "POST",
                    data: {
                        video_id: videoId,
                        _token: "{{ csrf_token() }}" // CSRF token for security
                    },
                    success: function(response) {
                        
                    },
                    error: function(xhr) {
                        // Handle Ajax error
                        console.error("Failed to update video history:", xhr.responseText);
                        alert("An error occurred. Please try again.");
                    }
                });
            });
        });
    </script>
    <script>
        // Wait for the YouTube IFrame API to load
        document.addEventListener('DOMContentLoaded', () => {
            const playerContainer = document.getElementById('player');
            const videoHeader = document.querySelector('.video-header');
            const iframe = document.getElementById('player');
            const player = new YT.Player(iframe, {
                events: {
                    'onReady': onPlayerReady
                }
            });

            // Handle toggle when clicking on the video-header
            function onPlayerReady(event) {

                videoHeader.addEventListener('click', () => {
                    const isPlaying = player.getPlayerState() === YT.PlayerState.PLAYING;


                    if (isPlaying) {
                        // Video is playing - pause it
                        player.pauseVideo();
                        toggleClasses('paused');

                    } else {
                        // Video is paused - play it
                        player.playVideo();
                        toggleClasses('playing');
                    }
                });
            }

            // Toggle the classes for the player UI
            function toggleClasses(state) {
                const playerElement = document.querySelector('.plyr');
                const controlElements = document.querySelectorAll('.plyr__control');

                // Update player UI classes based on the state (playing or paused)
                if (state === 'playing') {
                    playerElement.classList.replace('plyr--paused', 'plyr--playing');
                    playerElement.classList.replace('plyr--hide-controls', 'plyr--full-ui');
                    controlElements.forEach(control => {
                        control.classList.replace('plyr__control--overlaid',
                            'plyr__control--overlaid plyr__control--pressed');
                    });
                } else {
                    playerElement.classList.replace('plyr--playing', 'plyr--paused');
                    playerElement.classList.replace('plyr--full-ui', 'plyr--hide-controls');
                    controlElements.forEach(control => {
                        control.classList.replace('plyr__control--overlaid plyr__control--pressed',
                            'plyr__control--overlaid');
                    });
                }
            }
        });
    </script>
@endsection
