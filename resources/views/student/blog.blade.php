@extends('layouts.student.master')
@section('main')
@php
$blogs = App\Models\Blog::all();
@endphp

    <main>

            <div class="slider-starter">
        <div class="container">
            <section class="">
                <!-- Bootstrap Grid Container -->
                <div class="row gy-4">
                    @foreach($blogs as $blog)
                    @php 
                        $blogTitle = $blog->title; // Assuming $blog->title contains the title
                        $blogSlug = str_replace(' ', '-', $blogTitle);
                    
                    @endphp
                    <!-- Blog Card -->
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="blog-card p-3">
                            <div class="overflow">
                                <a href="{{ route('blog.show', ['title' => $blogSlug]) }}"><img src="{{ asset($blog->img) }}" 
                                    class="blog-image img-fluid d-block m-auto" alt="Blog Image"></a>
                                
                            </div>
                            <div class="p-3">
                                <div class="blog-meta d-flex align-items-center gap-2 mb-2">
                                    <img src="{{ asset('profile-image/' . $blog->user->profile_photo_path) }}" alt="Author" width="30px" height="30px" class="rounded-circle">
                                    <p class="m-0"><span style="font-weight:600;">{{ $blog->user->first_name }} {{ $blog->user->last_name }}</span></p>
                           
                                    <!--<img src="{{ asset('studens-asset/assets/img/icon-10.svg') }}" alt="Calendar" width="20rem">-->
                                   <p class="m-0">{{ \Carbon\Carbon::parse($blog->created_at)->format('M j, Y') }}</p>

                                </div>
                                <h5 class="mb-2">
                                    <a href="{{ route('blog.show', ['title' => $blogSlug]) }}">{{ $blog->title }}</a>
                                </h5>
                                <p class="blog-description mb-3 " style="font-size:17px">{{ Str::limit($blog->desc, 85) }}</p>
                                <a href="{{ route('blog.show', ['title' => $blogSlug]) }}">
                                    <button class="main__btn rounded-3 m-0 w-md-50 w-sm-100 d-flex justify-content-center align-items-center">
                                        <span>Read More</span>
                                        <i class='main-button-arrow fa fa-arrow-right ml-2'></i>
                                    </button>
                                </a>
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
