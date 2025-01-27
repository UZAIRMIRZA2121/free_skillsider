@extends('layouts.student.master')
@section('main')

@php
$minutes = $sumOfVideoDurations;
$hours = floor(($minutes % 1440) / 60);
$Minutes = $minutes % 60;
@endphp


<main style="background-color: #FAFAFA;">
    <!-- top image -->
    <div class="inner-banner">
        <div class="inner-banner-text">
            <h5><strong class="text-light">{{$single_package->package_title}}</strong></h5>
            <p class="main-text">This course is designed to help you build a strong narrative in the professional
                realm. If you want to make your career in social media marketing, then this course is for you.
                Having a wide range of topics, this course makes you a prominent leader in the business sector. From
                enhancing your professional skills to improving your mental flexibility, this course is going to be
                a game-changer for your overall growth. </p>
            <div class="inner-banner-courses">
                <div class="d-flex gap-2 inner-item">
                    <img src="{{ asset('studens-asset/assets/icons/icon-01.svg')}}" alt="">
                    <p>{{$courses->count()}} Courses</p>
                </div>
                <div class="d-flex gap-2 inner-item result">
                    <img src="{{ asset('studens-asset/assets/icons/icon-01.svg')}}" alt="">
                     <p>{{$hours}} hours, {{$Minutes}} minutes</p>
                    
                </div>
                <div class="d-flex gap-2 inner-item">
                    <img src="{{ asset('studens-asset/assets/icons/icon-01.svg')}}" alt="">
                    <p>Students Enrolled</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container courses-starter">
        <!-- left section -->
        <div class="courses-left-section">
            <div class="courses-left-section-first-col">
                <h3><strong>Course Overview</strong></h3>
                <div id="htmlContent">
                    {!!html_entity_decode($single_package->description)!!}
                </div> 
            </div>
            <div class="courses-left-section-second-col-carasoul-starter">
                <!-- FAQ section -->
                <div class="carasoul-left-top">
                    <h5><strong>Course Content</strong></h5>
                    <div>
                        <div class="inner-banner-courses">
                            <div class="d-flex gap-2 inner-item">
                                <img src="{{ asset('studens-asset/assets/icons/icon-01.svg')}}" alt="">
                                <p>{{$courses->count()}} Courses</p>
                            </div>
                            <div class="d-flex gap-2 inner-item result">
                                <img src="{{ asset('studens-asset/assets/icons/icon-01.svg')}}" alt="">
                                <p>{{$hours}} hours, {{$Minutes}} minutes</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div>
                <!-- Re-sort courses by course_seq descending before iteration -->
                @foreach($courses->sortBy('course_seq') as $course)
                <div class="faq-section">
                    <div class="faq-section-main-div">
                        <h4 class="faq-section-heading">{{ $course->course_title }}</h4>
                        <p class="arrow"><i class="fa-solid faq-section-icon fa-plus"></i></p>
                    </div>
                    <!-- Sort the videos for the current course by video_seq -->
                    @foreach($videos->where('courses_id', $course->id)->sortByDesc('video_seq') as $video)
                    <div class="faq-list" style="background-color: rgb(255, 255, 255); display: none;">
                        <div class="faq-answer">
                            <img src="{{ asset('studens-asset/assets/img/play.svg') }}" alt="">
                            <p>{{ $video->video_title }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach

                </div>
                <!-- faq section end -->
            </div>

            <div class="courses-left-section-third-col">
                <h5 class="mb-3"><strong>Earn the Certificate of Completion</strong></h5>
                <img src="{{ asset('studens-asset/assets/img/certificate.png')}}" alt=""
                    class="courses-certificate-img">
            </div>
          
        </div>
        <!-- right section -->
        <div class="courses-right-section">
            <div class="courses-right-section-first-row">
                
                <a href="https://www.youtube.com/embed/Lr67iwyohP8?si=2smfrg1H3P2HqgEp" class="video-thumbnail" data-lity="" target="_blank">
                    <div class="courses-right-section-play-icon ">
                        <i class="fa-solid fa-play"></i>
                    </div>
                    <img class="courses-right-section-img" src="{{ asset('packages_image/' . $single_package->image) }}"  alt="">
                </a>
                <div>
                    <h1 class="section-header fw-bold" style="color: #FB5B66;"> Rs {{$single_package->price}}</h1>
                    <a href="{{ route('user.register')}}" >
                        <button class="main__btn rounded-pill" style="width: 100%; display: flex;
                        justify-content: center;
                      ">
                            <span>Buy Now</span>
                            <i class='main-button-arrow fa fa-arrow-right'></i>
                        </button>
                    </a>
                </div>
            </div>
            <div class="courses-right-section-second-row ">
              <h5 class="fw-bold">Include</h5>
              <div>
                <div class="d-flex gap-2 my-3 inner-item">
                    <img src="{{ asset('studens-asset/assets/icons/icon-01.svg')}}" alt="">
                    <p>{{$hours}} hours, {{$Minutes}} minutes</p>

                </div>  <div class="d-flex  my-3 gap-2 inner-item">
                    <img src="{{ asset('studens-asset/assets/icons/icon-01.svg')}}" alt="">
                    <p>{{$courses->count()}} Courses Full lifetime access</p>
                </div>  <div class="d-flex my-3 gap-2 inner-item">
                    <img src="{{ asset('studens-asset/assets/icons/icon-01.svg')}}" alt="">
                    <p> Access on mobile and TV</p>
                </div>  <div class="d-flex my-3 gap-2 inner-item">
                    <img src="{{ asset('studens-asset/assets/icons/icon-01.svg')}}" alt="">
                    <p>  Assignments</p>
                </div>
                <div class="d-flex gap-2  my-3inner-item">
                    <img src="{{ asset('studens-asset/assets/icons/icon-01.svg')}}" alt="">
                    <p> Certificate of Completion</p>
                </div>
              </div>
            </div>
        </div>
    </div>


</main>

@endsection
