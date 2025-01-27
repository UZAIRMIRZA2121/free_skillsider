@extends('layouts.student.master')

@section('main')
    <style>
        p img {
            width: 80%;
            margin-inline: 10%;
        }
    </style>
    <style>
        /* Default iframe styling (for larger screens) */
        #videoIframe {
            width: 100%;
            height: 415px;
        }

        /* Tablet screens (768px to 1024px) */
        @media (max-width: 1024px) {
            #videoIframe {
                height: 360px;
                /* Adjust height for tablets */
            }
        }

        /* Mobile screens (up to 767px) */
        @media (max-width: 767px) {
            #videoIframe {
                height: 208px;
                /* Adjust height for mobile */
            }
        }
    </style>

    <main>
        <!-- Blog Content Section -->
        <div class="blog-content py-5">
            <div class="container">
                <div class="row">
                    <!-- Blog Content -->
                    <div class="col-lg-8 mx-auto">
                        @if (isset($all_video) && count($all_video) > 0)
                            <div class="blog-details">
                                <!-- Blog Image -->
                                <div class="blog-image mb-2 text-center">

                                    <iframe id="videoIframe"
                                        src="https://www.youtube.com/embed/{{ $all_video[0]->video_link }}"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                    </iframe>

                                </div>
                                <!-- Video Title Display -->
                                <h1 id="videoTitle" class="blog-title fw-bold mb-3" style="font-size:20px">
                                    {{ $all_video[0]->video_title }}</h1>
                            </div>
                        @endif

                    </div>
                    <div class="col-lg-4 mx-auto card">
                        <div class="blog-details card-body">
                            <div class="mb-4">
                                <h5 class="blog-title fw-bold my-2 text-center" style="font-size:25px">Playlist</h5>
                            </div>
                            @if (isset($all_video) && count($all_video) > 0)
                                <div class="">
                                    @foreach ($all_video as $video)
                                        <!-- Video Title with Dynamic URL -->
                                        <div class="d-flex">
                                            <div class="mt-1"> <i class="fa fa-play" style="font-size:16px"></i></div>
                                            <div class="ms-1">
                                                <a href="javascript:void(0);"
                                                    onclick="changeVideo('{{ $video->video_link }}', '{{ $video->video_title }}')"
                                                    class="text-decoration-none" style="font-size:20px">
                                                    <strong style="font-size: 16px ">{{ $video->video_title }}</strong>
                                                </a>

                                            </div>

                                        </div>
                                        <hr style="margin-bottom: 15px">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </main>
    <script>
        // Function to change the video when a video link is clicked and update the title
        function changeVideo(videoLink, videoTitle) {
            const iframe = document.getElementById('videoIframe');
            iframe.src = `https://www.youtube.com/embed/${videoLink}`;

            // Update the video title displayed on the page
            const titleElement = document.getElementById('videoTitle');
            titleElement.textContent = videoTitle;
        }
    </script>
@endsection
