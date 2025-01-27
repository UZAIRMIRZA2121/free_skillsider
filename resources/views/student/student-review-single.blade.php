@extends('layouts.student.master')

@section('main')
    <style>
        p img {
            width: 80%;
            margin-inline: 10%;
        }
    </style>
      <style>
        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>
    <main>
        <!-- Blog Content Section -->
        <div class="blog-content py-5">
            <div class="container">
                <div class="row">
                    <!-- Blog Content -->

                   
                  
                    
                    <div class="col-lg-8 mx-auto">
                        <div class="blog-details">
                            <h1 class="blog-title fw-bold"></h1>
                            <div class="blog-meta d-flex align-items-center gap-2 mb-2">
                                <!-- Custom Responsive Container -->
                                <div class="video-container">
                                    <iframe 
                                        src="https://www.youtube.com/embed/{{ $review->video_id }}?autoplay=1" 
                                        title="YouTube video player" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    <div class="col-lg-4 mx-auto card">
                        <div class="blog-details card-body">
                            <div class="mb-4">
                                <h5 class="blog-title fw-bold my-3 text-center" style="font-size:30px">Other Reviews</h5>
                            </div>
                            <!-- Other Blogs Section -->
                            @forelse($reviews as $review)
                                <div class="">
                                    <a href="{{ route('student.review.show', ['id' => $review->id]) }}">
                                    <img src="{{ asset('review_image/' . $review->video_thumbnail) }}" alt="{{ $review->video_thumbnail }}" class="img-fluid "
                                        style="margin-bottom: 10px">
                                    </a>
                                    <br>
                                </div>
                            @empty
                            @endforelse

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
