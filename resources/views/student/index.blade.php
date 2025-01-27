@extends('layouts.student.master')

@section('main')
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->

    <style>
        /* Custom CSS to center and resize the modal */
        .modal-lg {
            max-width: 90%;
        }

        ifram {
            le margin: auto;
            display: block;
            Stay informed with exclusi
        }

        /* Add this CSS in your HTML or external CSS file */
        .card:hover {
            cursor: pointer;
            /* Change the cursor to a hand pointer */
        }
    </style>
    <style>
        .product-container {
            position: relative;
            display: inline-block;
        }

        .product-img img {
            display: block;
            width: 100%;
            /* Adjust width as needed */
            height: auto;
        }

        .badge {
            position: absolute;
            bottom: 10px;
            /* Distance from bottom */
            right: 10px;
            /* Distance from right */
            background-color: #f7f7f9;
            /* Badge background color */
            color: #000050;
            /* Badge text color */
            padding: 5px 10px;
            border-radius: 7px;
            font-size: 16px;
            /* Adjust font size as needed */
            font-weight: bold;
        }


        #course-feature-box {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.7rem !important;
        }

        @media(max-width:992px) {
            #course-feature-box {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 1.7rem !important;
            }

        }

        @media(max-width:767px) {
            .carasoul-text-2 {
                font-size: 14px;
            }

            #course-feature-box {
                display: grid;
                grid-template-columns: repeat(1, 1fr);
                gap: 1.7rem !important;
            }
        }
    </style>
    <main>
        <!-- /////////// hero section -->

        <style>
            .carousel-item img {
                height: auto;
                max-height: 700px;
                /* Set this to your desired maximum height */
            }
        </style>

        @php
            $aboutVideo = App\Models\AboutVideo::find(1);
            $dashboardimgs = App\Models\DashboardImage::where(function ($query) {
                $query->where('visibility', 'public')->orWhere('visibility', 'both');
            })->get();

        @endphp
        @if (isset($dashboardimgs) && $dashboardimgs->isNotEmpty())
            <section class="mt-5">
                <div class="container">
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($dashboardimgs as $index => $dashboardimg)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="10000" >
                                    <img src="{{ asset('thumbnails/' . $dashboardimg->image) }}" style="border-radius: 30px"
                                        class="d-block w-100 img-fluid" alt="...">
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

        <div>
            <div class="container">
                <div class="herosection row">
                    <div class="herosection__left col-xl-7 col-lg-7 col-md-8">
                        <h4 class="text-muted welcome-text">Welcome to SkillSider</h4>
                        <h1 class="herosection__heading__first">Your Gateway to Success in the Digital World</h1>
                        <p class="mb-2 text-start d-none d-md-block">
                            We teach you the skills of the 21st century that will help you to earn more than your competitors
                        </p>
                        
                        <a href="https://youtube.com/@skillsider">
                            <button class="main__btn rounded-pill hero-btn">
                                <span>Get Started Now</span>
                            </button>
                        </a>
                       
                    </div>
                    <div class="herosection__right col-xl-5 col-lg-5 col-md-4">
                        <img src="{{ asset('studens-asset/assets/img/left.png') }}" alt="" class="herosection__img">
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="container">
                <div class="  course-full-list">


                    <div class="  course-full-items">
                        {{-- <img src="{{ asset('studens-asset/assets/img/distance-Learning.png') }}" alt=""> --}}
                        <div class="container d-flex">
                            <div class="content">
                                <dt>90,000 + </dt>
                                <p class="course-full-list-text">HAPPY STUDENTS</p>
                            </div>
                        </div>
                        <div class="content d-flex justify-content-end mx-3">
                            {{-- <i class="fa-sharp fa-solid fa-graduation-cap icon " style="font-size: 40px;color:#4d3183"></i> --}}
                            <img src="{{ asset('home-icone/skillsider_students.png') }}" alt="" width="75px">
                        </div>
                    </div>
                    <div class="  course-full-items">
                        {{-- <img src="{{ asset('studens-asset/assets/img/money.png') }}" alt=""> --}}
                        <div class="container d-flex">
                            <div class="content">
                                <dt>20Cr +</dt>
                                <p class="course-full-list-text">COMMUNITY EARNINGS</p>
                            </div>

                        </div>
                        <div class="content d-flex justify-content-end mx-3">
                            {{-- <i class="fa-sharp fa-solid fa-chart-line icon " style="font-size: 40px;color:#4d3183"></i> --}}
                            <img src="{{ asset('home-icone/skillsider_earning.png') }}" alt="" width="75px">
                        </div>
                    </div>
                    <div class="  course-full-items">
                        {{-- <img src="{{ asset('studens-asset/assets/img/Online-Lecturer.png') }}" alt=""> --}}
                        <div class="container d-flex">
                            <div class="content">
                                <dt>100 +</dt>
                                <p class="course-full-list-text">LIVE TRAININGS</p>
                            </div>

                        </div>
                        <div class="content d-flex justify-content-end mx-3">
                            {{-- <i class="fa-solid fa-chalkboard-user icon " style="font-size: 40px ;color:#4d3183"></i> --}}
                            <img src="{{ asset('home-icone/skillsider_courses.png') }}" alt="" width="75px">

                        </div>
                    </div>
                    <div class="  course-full-items">
                        {{-- <img src="{{ asset('studens-asset/assets/img/lecture-sharing.png') }}" alt=""> --}}
                        <div class="container d-flex">
                            <div class="content">
                                <dt>10 +</dt>
                                <p class="course-full-list-text">Trainers & Courses</p>
                            </div>

                        </div>
                        <div class="content d-flex justify-content-end mx-3">
                            {{-- <i class="fa-sharp fa-solid fa-users-line icon " style="font-size: 40px;color:#4d3183"></i> --}}
                            <img src="{{ asset('home-icone/skillsider_trainers.png') }}" alt="" width="75px">

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- our exclosive couses section goes here -->
        {{-- <section class="section-new-course">
            <div class="container" style="background-color: #f2f2f2;">
                <div class="row">
                    <div class="col-md-6 my-2 d-flex justify-content-center align-items-center">
                        <img class="img-fluid" src="{{ asset('assets/images/students.jpg') }}" alt="" width="577"
                            height="310">
                    </div>
                    <div class="col-md-6 my-2 d-flex justify-content-center align-items-center">
                        <img class="img-fluid" src="{{ asset('assets/images/students1.jpg') }}" alt=""
                            width="577" height="310">
                    </div>
                </div>
            </div>
        </section> --}}


<!-- meat founder section end -->
        <!-- Our exclusive courses section ends here -->

        <!-- our exclosive couses section goes here -->
        <section class="section-new-course" id="section-new-course">
            <div class="container">
                <div class="section-text">
                    <p class="mb-2 text-center sm-text-size">
                        Unlock Your Full Potential with Our
                    </p>
                </div>
                <div class="section-header ">
                    <div class="section-sub-head">
                        <h2 class="section-heading text-center">Educational Bundles
                        </h2>
                    </div>
                </div>
              
                <div class="course-feature">
                    <div id="course-feature-box">
                        @foreach ($packages as $package)
                            <div class="d-flex">
                                <div class="course-box d-flex ">
                                    <div class="product ">
                                        <div class="product-container">
                                            <div class="product-img">
                                                <a href="{{ route('single.package', ['id' => $package->id]) }}">
                                                    <img class="img-fluid" alt=""
                                                        src="{{ asset('packages_image/' . $package->image) }}">
                                                </a>
                                                <!-- Price badge -->
                                                <div class="badge">
                                                    Rs {{ $package->price }} <!-- Displaying the price -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <div class="d-flex">
                                                <h5 class="course-title"><a
                                                        href="{{ route('single.package', ['id' => $package->id]) }}">
                                                        {{ $package->package_title }}</a></h5>
                                            </div>
                                            <div class="course-img d-flex justify-content-between align-items-center
                                        py-2 mb-2"
                                                style="border-bottom: 1px solid rgba(128, 128, 128, 0.563);
                                         color: rgba(128, 128, 128, 0.942);">
                                                <div class="d-flex gap-2 align-items-center">
                                                    <img src="{{ asset('studens-asset/assets/icons/icon-01.svg') }}"
                                                        alt="">
                                                    @php
                                                        $package = App\Models\packages::where(
                                                            'id',
                                                            $package->id,
                                                        )->first();
                                                        $courseIds = explode(',', $package->course_id);
                                                        $courses = App\Models\Courses::whereIn('id', $courseIds)->get();
                                                        $videoIds = $courses->pluck('id')->toArray();
                                                        $videos = App\Models\Videos::whereIn(
                                                            'courses_id',
                                                            $videoIds,
                                                        )->get();
                                                        $minutes = $videos->sum('video_duration');
                                                        $days = floor($minutes / 1440);
                                                        $hours = floor(($minutes % 1440) / 60);
                                                        $Minutes = $minutes % 60;
                                                    @endphp

                                                    <p>{{ $courses->count() }} Courses</p>
                                                </div>

                                                <div class="d-flex gap-2 align-items-center">
                                                    <img src="{{ asset('studens-asset/assets/icons/icon-02.svg') }}"
                                                        alt="">
                                                    @if ($days > 0)
                                                        <p>{{ $days }}d</p>
                                                    @endif
                                                    @if ($hours > 0)
                                                        <p>{{ $hours }}hr</p>
                                                    @endif
                                                    @if ($Minutes > 0)
                                                        <p>{{ $Minutes }}min</p>
                                                    @endif
                                                </div>


                                            </div>
                                            <div>
                                                <ul class="packages-ul">

                                                    <li> <i class="fa-solid fa-check"></i> Live Q&amp;A Support</li>
                                                    <li> <i class="fa-solid fa-check"></i>10k+ Students Enrolled</li>
                                                    <li> <i class="fa-solid fa-check"></i>Skillsider Certificate </li>
                                                </ul>
                                            </div>
                                            <div class="all-btn all-category d-flex align-items-center ">

                                                <a href="{{ route('single.package', ['id' => $package->id]) }}">
                                                    <button class="main__btn rounded-pill">
                                                        <span>Know More</span>
                                                    </button>
                                                </a>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </div>
                </div>
            </div>
        </section>
        <!-- Our exclusive courses section ends here -->
        <!-- Skillsider work start -->

        <!-- Our exclusive courses section ends here -->
        <div>
            <div class="container ">
                <section class="skill-slider-section">
                    <div class="section-sub-head">
                        <h2 class=" text-center section-heading ">How SkillSider Works?</h2>
                    </div>
                    <div class="row skill-slider-row">
                        <div class="lead-guru-box  ">
                            <img src="{{ asset('studens-asset/assets/img/learn.png') }}" alt="" width="83"
                                height="80">
                            <h3 class="herosection__heading__last">Learn</h3>
                            <div class="my-auto">
                                <p class="sm-text-size">Learn from trainers who have real-time expertise in their
                                    respective
                                    fields.</p>
                            </div>

                        </div>
                        <div class="lead-guru-box ">
                            <img src="{{ asset('studens-asset/assets/img/profit.png') }}" alt="" width="83"
                                height="80">
                            <h3 class="herosection__heading__last">Implement </h3>
                            <div class="my-auto">
                                <p class="sm-text-size">Implement these trending skills of the future and grow with the
                                    digital world.</p>
                            </div>
                        </div>
                        <div class="lead-guru-box ">
                            <img src="{{ asset('studens-asset/assets/img/investment.png') }}" alt=""
                                width="83" height="80">
                            <h3 class="herosection__heading__last">Earn</h3>
                            <div class="my-auto">
                                <p class="sm-text-size">This helps you stand out from the crowd, Earn more money than
                                    competitors in the market.
                                </p>
                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
   <!-- Demanding Carasoul carasoul -->
   <div class="slider-starter "
  >
   <div class="container">
       <div class="text-center d-flex justify-content-between align-items-center flex-column">
           <h1 class="section-heading">Upskilling Courses</h1>
           <p class="main-text sm-text-size">With our exclusive courses, now you can aquire the best knowledge and
               expertise
               from our experienced trainers. We believe you can master the art of digital entrepreneurship by our
               industry-leading courses.</p>
       </div>
       <section class="regular slider">
           @foreach ($all_courses as $course)
               <div>
                   <div class="overflow"  style=" background: linear-gradient(to top, var(--primary-gradiant-color) 0%, var(--primary-gradiant-color)0%,
var(--Secondary-gradiant-color) 100%);">
                       <img style="hieght: 1280 !important; width: 720 !imortant;"
                           src="{{ asset('course-image/' . $course->image) }}" class="carasoul-image" />
                   </div>
                   <div class="carasoul-textarea" >
                       <h3 class="slider-title">{{ $course->course_title }}</h3>

                   </div>

               </div>
           @endforeach
       </section>
   </div>
</div>

        <!-- Skillsider work ends -->
      
        <!-- first instructor carasoul -->
        <div class="slider-starter"  style=" background: linear-gradient(to top, var(--primary-gradiant-color) 0%, var(--primary-gradiant-color)0%,
var(--Secondary-gradiant-color) 100%);" >
            <div class="container" >
                <div class="text-center d-flex justify-content-between align-items-center flex-column">
                    <h1 class="section-heading">Meet Our Top Mentors</h1>
                    <p class="main-text text-center sm-text-size">At Skillsider, you can now be assured to get the top-most
                        training
                        from the leading educators of their respective fields. Turn your dreams into reality with
                        SkillSider proficient instructors.</p>
                </div>
                <section class="regular slider">
                    @foreach ($teams as $team)
                        <div>
                            <div class="overflow">
                                <img style="hieght: 512px !important; width: 512px !imortant;"
                                    src="{{ asset('team-image/' . $team->image) }}" class="carasoul-image" />
                            </div>
                            <div class="carasoul-textarea">
                                <h3 class="slider-title">{{ $team->name }}</h3>
                                <!--<p class="slider-text">{{ $team->title }}</p>-->
                                <p class="slider-text">{{ $team->description }}</p>
                                <!--<div class="user-profile-icon">-->
                                <!--    <a href="">-->
                                <!--        <i class="fa-brands fa-facebook"></i>-->
                                <!--    </a>-->
                                <!--    <a href="">-->
                                <!--        <i class="fa-brands fa-linkedin"></i>-->
                                <!--    </a>-->
                                <!--    <a href="">-->
                                <!--        <i class="fa-brands fa-twitter"></i>-->
                                <!--    </a>-->
                                <!--</div>-->
                            </div>

                        </div>
                    @endforeach
                </section>
            </div>

        </div>
     

        <section class="py-5" style=" background: #ffff;">
            <div class="container">
                <div class="row"  >
                    <div class="bg-grad-pink p-4 p-sm-5 rounded position-relative z-index-n1 overflow-hidden"
                        style="background: linear-gradient(384deg, #f46f22 6%, #523680 79%)">
                        <figure class="position-absolute top-50 start-0 mt-3 ms-n3 opacity-5">
                            <svg width="818.6px" height="235.1px" viewBox="0 0 818.6 235.1">
                                <path class="fill-white"
                                    d="M735,226.3c-5.7,0.6-11.5,1.1-17.2,1.7c-66.2,6.8-134.7,13.7-192.6-16.6c-34.6-18.1-61.4-47.9-87.3-76.7 c-21.4-23.8-43.6-48.5-70.2-66.7c-53.2-36.4-121.6-44.8-175.1-48c-13.6-0.8-27.5-1.4-40.9-1.9c-46.9-1.9-95.4-3.9-141.2-16.5 C8.3,1.2,6.2,0.6,4.2,0H0c3.3,1,6.6,2,10,3c46,12.5,94.5,14.6,141.5,16.5c13.4,0.6,27.3,1.1,40.8,1.9 c53.4,3.2,121.5,11.5,174.5,47.7c26.5,18.1,48.6,42.7,70,66.5c26,28.9,52.9,58.8,87.7,76.9c58.3,30.5,127,23.5,193.3,16.7 c5.8-0.6,11.5-1.2,17.2-1.7c26.2-2.6,55-4.2,83.5-2.2v-1.2C790,222,761.2,223.7,735,226.3z">
                                </path>
                            </svg>
                        </figure>
                        <figure class="position-absolute top-50 start-0 translate-middle-y ms-5">
                            <svg width="473px" height="234px">
                                <path fill-rule="evenodd" opacity="0.051" fill="rgb(255, 255, 255)"
                                    d="M0.004,222.303 L364.497,-0.004 L472.998,32.563 L100.551,233.991 L0.004,222.303 Z">
                                </path>
                            </svg>
                        </figure>
                        <figure class="position-absolute top-50 end-0 translate-middle-y">
                            <svg width="355.6px" height="396.1px">
                                <path class="fill-danger rotate-10"
                                    d="M32.8,364.1c16.1-14.7,36-21.5,56.8-26.7c20-5.1,40.5-9.7,57.8-21.4c35.7-24.3,51.1-68.5,57.2-109.4 c6.8-45.7,4.6-93.7,21.6-137.5c8.3-21.4,22.3-41.4,43.3-51.9c17.4-8.7,36.2-7.9,54.2-1.5c10.2,3.6,19.8,8.5,29.4,13.5l2.5-4.3 c-2.7-1.4-5.4-2.8-8.2-4.2c-15.8-8-32.9-15.3-50.9-15.2C276,5.6,256.9,16,243.3,31c-16.6,18.3-25.3,42.2-30.5,66 c-5,22.9-6.8,46.3-8.8,69.6c-3.9,44.4-9.7,92.8-40.1,128c-7.1,8.2-15.4,15.4-24.9,20.8c-9.3,5.4-19.5,8.9-29.8,11.8 c-20.2,5.7-41.3,9.1-59.9,19.2c-19.3,10.4-35.1,27.2-44.2,47.1c0,0,0,0.1,0,0.1l4.4,2.6C15,384,22.9,373.1,32.8,364.1z">
                                </path>
                            </svg>
                        </figure>
                        <div class="row g-3 align-items-center justify-content-lg-end position-relative py-4">
                            <div class="col-md-6">
                                <h2 class="text-white">Become an Instructor!</h2>
                                <p class="text-white mb-0">Teach thousands of students and earn money with ease!</p>
                            </div>
                            <div class="col-md-6 col-lg-3 text-md-end">
                                <a href="http://127.0.0.1:8000/package/1">
                                    <button class="main__btn rounded-pill">
                                        <span>Get Started Now</span>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 position-relative z-index-1">
                        <div class="d-none d-lg-block position-absolute bottom-0 start-0 ms-3 ms-xl-5">
                            <img src="{{ asset('assets/images/instructor.jpg') }}" alt="">
                        </div>
                        <div class="position-absolute bottom-0 start-50 mb-n4">
                            <img src="{{ asset('assets/images/graduated.svg') }}" alt="">
                        </div>
                        {{-- <div class="position-absolute bottom-10 start-55 mb-n4">
                            <img src="{{ asset('assets/images/pencil.svg') }}" alt="">
                        </div> --}}


                    </div>
                </div>
            </div>
        </section>
        <!-- Button to trigger the modal -->
  <!-- why choose us -->
  <section>
    <div class="container why-choose-us d-flex">
        <div class="col-lg-7 choose-us-left-section">
            <div>
                <small style="color: #FB5B66; ">Why Choose Us? </small>
                <h1 class="section-heading">Why SkillSider</h1>
                <p class="text-muted sm-text-size">Skillsider is an ed-tech platform. Through our industry-leading
                    courses, we
                    bring the learner community of all age groups under one roof to learn, implement, and earn by
                    the digital skills of the future that help you stand out from the crowd.</p>
            </div>
            <div class="career-group ">
                <div class="row">
                    <div class="col-lg-6 col-md-6 d-flex">
                        <div class="certified-group-box  blur-border d-flex">
                            <img src="{{ asset('studens-asset/assets//img/learning.png') }}" alt="">
                            <p style="overflow-y: scroll;">
                                <strong class="fw-bold">Skill Based Courses:</strong> SkillSider teach you the
                                skills of 21st century that will help you to earn more
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 d-flex">
                        <div class="certified-group-box  blur-border d-flex">
                            <img src="{{ asset('studens-asset/assets//img/graduation.png') }}" alt="">
                            <p style="overflow-y: scroll;">
                                <strong class="fw-bold">Course Certification:</strong>You can boost your CV by
                                including SkillSider certificate that help you stand out from the crowd in your
                                professional career.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 d-flex">
                        <div class="certified-group-box blur-border d-flex">
                            <img src="{{ asset('studens-asset/assets//img/profit.svg') }}" alt=""
                                class="certifiate-img">
                            <p style="overflow-y: scroll;">
                                <strong class="fw-bold">Affiliate Program:</strong> SkillSider students can earn a
                                decent amount of commission through our exclusive affiliate program.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 d-flex">
                        <div class="certified-group-box blur-border d-flex">
                            <img src="{{ asset('studens-asset/assets//img/handshake.png') }}" alt=""
                                class="certifiate-img">
                            <p style="overflow-y: scroll;">
                                <strong class="fw-bold">Partner Program:</strong> Trainers can start their journey
                                with the SkillSider partner program and build a strong position in the market.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-lg-5 choose-us-right-section d-flex justify-content-center ">
            <img src="{{ asset('studens-asset/assets/img/history.png') }}" alt="">
        </div>
    </div>
</section>
<!-- why choose us section end -->s
        <style>
            @keyframes glowing {
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
        <!--Referral Code Modal end-->

      
        <!-- testimonials carasoul start -->
        <div class="slider-starter">
            <div class="container">
                <div class="slider-section-2-head">
                    <!-- what other say Carasoul carasoul -->
                    <div class=""
                        style="background: linear-gradient(to top, var(--primary-gradiant-color) 0%, var(--primary-gradiant-color)0%,
                                var(--Secondary-gradiant-color) 98%);">
                        <div class="container">
                            <div class="text-center d-flex justify-content-between align-items-center flex-column">
                                <h1 class="section-heading">What Our Students Say About SkillSider</h1>
                            </div>

                            <section class="regular slider">
                                @foreach ($reviews as $review)
                                    <div class="card overflow video-modal" data-toggle="modal" data-target="#videoModal"
                                        data-video-id="{{ optional($review)->video_id }}">
                                        <img src="{{ asset('review_image/' . $review->video_thumbnail) }}"
                                            class="carousel-image card-img-top" alt="Review Image"
                                            style="max-height: 162px;">

                                    </div>
                                @endforeach
                            </section>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- testimonials carasoul end -->



        <div>

            <div class="container my-5">
                <div class="courses-left-section-second-col-carasoul-starter">
                    <!-- FAQ section -->
                    <div class="carasoul-left-top">
                        <h5><strong>Frequently Asked Questions</strong></h5>
                    </div>
                    <div>
                        <!-- 1 -->
                        @foreach ($faqs as $faq)
                            <div class="faq-section">
                                <div class="faq-section-main-div">
                                    <h4 class="faq-section-heading">{{ $faq->question }}</h4>
                                    <p class="arrow"><i class="fa-solid faq-section-icon fa-plus"></i></p>
                                </div>

                                <div class="faq-list" style="background-color: rgb(255, 255, 255); display: none;">
                                    <div class="faq-answer ">
                                        <img src="{{ asset('studens-asset/assets/img/play.svg') }}" alt="">
                                        <p>{{ $faq->answer }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- faq section end -->
                </div>
            </div>
        </div>
    <!-- update section for exclusice information -->
    <div class="update-section-starter" style="padding-top:1px">
        <div class="container update-section">
            <a href="https://www.instagram.com/skillsider.pk" target="blank">
                <div>
                    <div class="container update-section">
                        <img src="{{ asset('studens-asset/assets/img/skillsiderInstagram.jpg') }}" alt=""
                            style="max-width: 100%; height: auto; border-radius: 10px; display: block;">
                    </div>
                </div>
            </a>
        </div>
    </div>
        

        <!-- update section for exclusice information -->
        <div class="update-section-starter" style="padding-top:1px">
            <div class="container update-section">
                <div class="update-inform">
                    <h3 class="fw-bold text-white"> Disclaimer :</h3>
                    <p>SKILLSIDER is not responsible for payment made against our products to anyone other than the official account numbers given on our website.</p>
                </div>
            </div>
        </div>
        {{--        referral code modal --}}
        <div class="modal" id="codeExistsModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Referral Code</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body mb-3">
                        <!--begin::Card body-->
                        <div class="card-body p-9">
                            <p id="no-found"></p>
                            <div id="found">
                                <!--begin::Row-->
                                <div class="row mb-7" id="found">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Full Name</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800" id="username"></span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Input group-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Referal code</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800" id="ref-code"></span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-10">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Joining Data</label>
                                    <!--begin::Label-->

                                    <!--begin::Label-->
                                    <div class="col-lg-8">
                                        <span class="fw-semibold fs-6 text-gray-800" id="joining-date"></span>
                                    </div>
                                    <!--begin::Label-->
                                </div>
                                <!--end::Input group-->
                            </div>

                        </div>
                        <!--end::Card body-->
                    </div>


                </div>
            </div>
        </div>
      
       


        <!-- Video Modal -->
        <!-- Video Modal -->
        <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg mx-auto">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header" style="background-color: #4d3185">
                        <h5 class="modal-title text-warning" id="exampleModalLabel"><b>Must Watch This Video</b></h5>

                        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class=" btn btn-sm btn-danger">&times;</span>
                        </button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body p-0 bg-dark" style="height: 70vh;">
                        <!-- Responsive Video Container -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe id="videoIframe" class="embed-responsive-item" style="width: 100%; height: 70vh;"
                                src=""
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // JavaScript to handle passing the video ID and loading the video in the modal
        $(document).on('click', '.video-modal', function() {
            var videoId = $(this).data('video-id'); // Get the video ID from the button's data-video-id attribute
            var videoIframe = document.getElementById('videoIframe');
            videoIframe.src = 'https://www.youtube.com/embed/' + videoId; // Load the video in the iframe
        });

        // Pause video and close modal when close button is clicked
        $('#closeModalBtn').on('click', function() {
            var videoIframe = document.getElementById('videoIframe');
            videoIframe.src = ''; // Stop the video by clearing the iframe source
            $('#videoModal').removeClass('show'); // Close the modal programmatically
            $('#videoModal').css('display', 'none'); // Ensure the modal is hidden by adding display: none
        });

        // Pause the video when the modal is hidden
        $('#videoModal').on('hidden.bs.modal', function() {
            var videoIframe = document.getElementById('videoIframe');
            videoIframe.src = ''; // Stop the video when modal is closed
        });
    </script>

<script>
        $(document).on('click', '#glowingIcon', function() {

var videoIframe = document.getElementById('videoFrameabout');
videoIframe.src = 'https://www.youtube.com/embed/Lr67iwyohP8?si=uW_CQyR-_IVsVEi5';

});
    $(document).on('click', '#close-model-btn', function() {

       var videoIframe = document.getElementById('videoFrameabout');
       videoIframe.src = ''; // Stop the video by clearing the iframe source
       $('#myModal').removeClass('show'); // Close the modal programmatically
       $('#myModal').css('display', 'none'); // Ensure the modal is hidden by adding display: none
   });
 
</script>

@endsection
