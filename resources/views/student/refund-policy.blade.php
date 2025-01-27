@extends('layouts.student.master')
@section('main')
    @php
        $aboutVideo = App\Models\AboutVideo::find(1);
        $dashboardimgs = App\Models\DashboardImage::where(function ($query) {
            $query->where('visibility', 'public')->orWhere('visibility', 'both');
        })->get();

    @endphp
    <style>
        <style>@keyframes glowing {
            0% {
                text-shadow: 0 0 0 rgba(255, 255, 255, 0.7);
            }

            50% {
                text-shadow: 0 0 20px rgba(255, 255, 255, 0.9);
            }

            100% {
                text-shadow: 0 0 0 rgba(255, 255, 255, 0.7);
            }
        }

        #glowingIcon {
            animation: glowing 1.5s infinite;
            animation-delay: 3s;
            color: #ed3e3e;
        }
    </style>
    <main>
        <!-- inner -->
        {{-- <div class="inner-banner about-banner"></div> --}}
        <!-- about company -->
        <section>
            <!-- meet our founder -->
            <div class="meet-founder-stater">
                <div class="container ">
                 
                    <h1 class="section-heading  text-center">Refund Policy</h1>


                </div>
            </div>
         
        </section>

      
    </main>
    <!-- Bootstrap Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #4d3185">
                    <h5 class="modal-title text-warning" id="exampleModalLabel"><b>Must Watch This Video</b></h5>
                    <button type="button" id="close-model-btn" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>

                </div>
                <div class="modal-body bg-dark p-0">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" id="videoFrameabout"
                            style="min-height: 300px; width: 100%;"
                            src="https://www.youtube.com/embed/{{ $aboutVideo->video_link }}" title="YouTube video player"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).on('click', '#glowingIcon', function() {
            console.log('Play button clicked');
            var videoIframe = document.getElementById('videoFrameabout');
            videoIframe.src = 'https://www.youtube.com/embed/Lr67iwyohP8?si=uW_CQyR-_IVsVEi5';
            $('#myModal').modal('show');
        });

        $(document).on('click', '#close-model-btn', function() {
            console.log('Close button clicked');
            var videoIframe = document.getElementById('videoFrameabout');
            videoIframe.src = ''; // Stop the video by clearing the iframe source
            $('#myModal').modal('hide');
        });
    </script>
@endsection
