@extends('layouts.student.master')
@section('main')
    <main>
        <div class="slider-starter">
            <div class="container">
                <section class="">
                    <div class="row gy-4">
                        @foreach ($reviews as $review)
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="blog-card p-3">
                                    <div class="overflow">
                                        <a href="{{ route('student.review.show', ['id' => $review->id]) }}"><img
                                                src="{{ asset('review_image/' . $review->video_thumbnail) }}"
                                                class="blog-image img-fluid d-block m-auto" alt="Blog Image"></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection
