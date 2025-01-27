@extends('layouts.student.master')

@section('main')
<style>
    p img{
    width: 80%;
    margin-inline: 10%;
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
                          <!-- Blog Image -->
                          @if($blog->img)
                          <div class="blog-image mb-4 text-center">
                              <img src="{{ asset($blog->img) }}" alt="{{ $blog->title }}" class="img-fluid rounded" style="width: 100%">
                          </div>
                          @endif
                        <h1 class="blog-title fw-bold">{{ $blog->title }}</h1>
                        <div class="blog-meta d-flex align-items-center gap-2 mb-2">
                            <img src="{{ asset('profile-image/' . $blog->user->profile_photo_path) }}" alt="Author" width="25px" height="25px" class="rounded-circle">
                            <p class="m-0"><span style="font-weight:600;">{{ $blog->user->first_name }} {{ $blog->user->last_name }}</span></p>
                            <!--<img src="{{ asset('studens-asset/assets/img/icon-10.svg') }}" alt="Calendar" width="20rem">-->
                           <p class="m-0">{{ \Carbon\Carbon::parse($blog->created_at)->format('M j, Y') }}</p>

                        </div>

               

                       
                        <!-- Blog Description -->
                        <div class="blog-description">
                            <p class="lead"> {!! $blog->long_desc !!}</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mx-auto card">
                    <div class="blog-details card-body">
                        <div class="mb-4">
                            <h5 class="blog-title fw-bold my-3 text-center" style="font-size:30px">Other Blogs</h5>
                        
                        </div>
                      
                        
                     
                
                        <!-- Other Blogs Section -->
                        
                       
                            @forelse($otherBlogs as $otherBlog)
                            @php 
                            $blogTitle = $otherBlog->title; // Assuming $blog->title contains the title
                            $blogSlug = str_replace(' ', '-', $blogTitle);
                        
                        @endphp
                              <div class="">
                                <img src="{{ asset($otherBlog->img) }}" alt="{{ $otherBlog->title }}" class="img-fluid " style="margin-bottom: 10px" >
                                <br>
                                <a href="{{ route('blog.show', ['title' => $blogSlug]) }}" class="text-decoration-none" style="font-size:20px">
                                    <strong>{{ $otherBlog->title }}</strong>
                                </a>
                                <hr style="margin-bottom: 30px">
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
