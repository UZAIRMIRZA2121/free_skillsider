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
    </style>
    <main>
        <!-- inner -->
        {{-- <div class="inner-banner about-banner"></div> --}}
        <!-- about company -->
        <section>
            <!-- meet our founder -->
            <div class="meet-founder-stater">
                <div class="container meet-founder-section">
                    <div class="position-relative d-inline-block m-auto">
                        <!-- Image -->
                        <img class="img-fluid" src="{{ asset('thumbnails/' . $aboutVideo->video_thumbnail) }}" alt=""
                            width="577" height="310">
                        <!-- Play button -->
                        <i id="glowingIcon"
                            class="fa-regular fa-circle-play position-absolute top-50 start-50 translate-middle"
                            data-bs-toggle="modal" data-bs-target="#myModal" style="font-size: 50px;"></i>
                    </div>


                    <div class="d-flex flex-column  justify-content-center align-items-left ">
                        <h1 class="section-heading">About Skillsider</h1>
                        <p class=" sm-text-size fs-5">Skillsider is Fastest Growing Learning plateform. As we all know
                            social
                            media is growing day by day And this Century You cant Earn if you have not High paying skills.
                            We
                            are dedicated to provide you High paying skills like Social Media Marketing, personal branding
                            and
                            content creation etc.</p>
                        <p class="fs-5"><i class="me-2 fa-regular fa-circle-check"></i>Outstanding Courses For learning.
                        </p>

                        <p class="fs-5"><i class="me-2 fa-regular fa-circle-check"></i>90% Commission Distribution.</p>
                        <p class="fs-5"><i class="me-2 fa-regular fa-circle-check"></i>Hand hold Support System.</p>
                    </div>
                </div>
            </div>
            <div class="container why-choose-us d-flex">
                <div class="col-lg-7 choose-us-left-section">
                    <small style="color: #fb5b66">We Are An Open Book?
                    </small>
                    <h1 class="section-heading">About Company</h1>
                    <p class="text-muted">
                        SkillSider, a leading ed-tech platform, prepares you
                        for real-world opportunities that you have always
                        desired. With the vision to import valuable
                        knowledge, we introduce you to the top industry
                        professionals at SkillSider. Fuel the passion in you
                        and get years ahead in your career with SkillSider-
                        your one-stop solution for all your educational
                        needs.
                    </p>
                    <div>
                        <div class="d-flex gap-2 align-items-center my-2">
                            <i class="fa fa-check about-company-check-icon"></i>
                            <p>
                                Passion and commitment to delivery
                                excellence
                            </p>
                        </div>
                        <div class="d-flex gap-2 align-items-center mb-2">
                            <i class="fa fa-check about-company-check-icon"></i>
                            <p>Innovation and collaboration culture</p>
                        </div>
                        <div class="d-flex gap-2 align-items-center mb-2">
                            <i class="fa fa-check about-company-check-icon"></i>
                            <p>Transparency</p>
                        </div>
                        <div class="d-flex gap-2 align-items-center mb-2">
                            <i class="fa fa-check about-company-check-icon"></i>
                            <p>Commitment towards excellence</p>
                        </div>
                        <div class="d-flex gap-2 align-items-center mb-2">
                            <i class="fa fa-check about-company-check-icon"></i>
                            <p>Integrity</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 choose-us-right-section d-flex justify-content-center">
                    <img src="{{ asset('studens-asset/assets/img/why-join.png') }}" alt="" />
                </div>
            </div>
        </section>

        <!-- long term -->

        <div
            style="
            background: linear-gradient(
                to right,
                var(--primary-gradiant-color) 0%,
                var(--primary-gradiant-color) 0%,
                var(--Secondary-gradiant-color) 100%
            );">
            <div class="container">
                <section class="skill-slider-section">
                    <div class="section-sub-head">
                        <h2 class="text-center section-heading">
                            Long-term Vision and Trajectory
                        </h2>
                    </div>
                    <div class="row skill-slider-row">
                        <div class="lead-guru-box">
                            <i class="fa-solid fa-people-roof course-list-icon"></i>
                            <h3 class="herosection__heading__last">
                                Mission
                            </h3>
                            <div class="my-auto">
                                <p>
                                    With the mission to bring emerging
                                    leaders and experienced teachers on one
                                    platform to generate productive results
                                    and create a win-win situation for all,
                                    SkillSider is creating a revolutionary
                                    impact in the ed-tech industry. The
                                    platform fosters quality education,
                                    which precedes your exceptional
                                    forthcoming results.
                                </p>
                                <p class="fw-bold mt-3">
                                    <a href=""
                                        style="
                                        color: #fb5b66;
                                        font-size: 18px;
                                    ">
                                        Result</a>
                                </p>
                            </div>
                        </div>
                        <div class="lead-guru-box">
                            <i class="fa-solid fa-people-roof course-list-icon"></i>
                            <h3 class="herosection__heading__last">
                                Vision
                            </h3>

                            <div class="my-auto">
                                <p>
                                    SkillSider was founded with the vision
                                    to provide online education and educate
                                    learners about the trending skills that
                                    are dominating the professional
                                    industry. At SkillSider, we believe
                                    nothing is unachievable if you put your
                                    heart and soul into it. If you are
                                    registering yourself with SkillSider
                                    today, then you can feel assured of
                                    having a huge success ratio in getting
                                    placed in the top leading companies.
                                </p>
                                <p class="fw-bold mt-3">
                                    <a href=""
                                        style="
                                        color: #fb5b66;
                                        font-size: 18px;
                                    ">
                                        Result</a>
                                </p>
                            </div>
                        </div>
                        <div class="lead-guru-box">
                            <i class="fa-solid fa-people-roof course-list-icon"></i>
                            <h3 class="herosection__heading__last">
                                Values
                            </h3>
                            <div class="my-auto">
                                <p>
                                    SkillSider envisions making a
                                    transformative change in the lives of
                                    students through its world-class faculty
                                    and interactive sessions. Having rooted
                                    its business modules in integrity and
                                    perseverance, SkillSider aims to create
                                    skilled individuals who excel in their
                                    fields.
                                </p>
                                <p class="fw-bold mt-3">
                                    <a href=""
                                        style="
                                        color: #fb5b66;
                                        font-size: 18px;
                                    ">
                                        Result</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- our approach -->
        <section>
            <div class="container why-choose-us d-flex">
                <div class="col-lg-6 d-flex flex-column justify-content-center gap-2">
                    <div class="d-flex gap-2">
                        <i class="fa-regular fa-lightbulb about-approach-icon"></i>
                        <h1 class="section-heading">Our Approach</h1>
                    </div>

                    <p class="text-muted" style="font-size: 18px">
                        With an endeavor to facilitate quality education,
                        SkillSider is making every possible effort to bring
                        a revolution to the emerging ed-tech industry. Now
                        with the growing number of students who wish to
                        upskill themselves with the latest trends, online
                        educational platforms are manifesting a strong
                        market in the professional world. Hence, SkillSider,
                        with its dynamic team and exceptional courses, is
                        helping you transform your professional journey to a
                        whole new level.
                    </p>
                </div>
                <div class="col-lg-6 choose-us-right-section d-flex justify-content-center">
                    <img src="{{ asset('studens-asset/assets/img/why-join.png') }}" alt="" />
                </div>
            </div>
        </section>
        <!-- our promises -->
        <section>
            <div class="container why-choose-us d-flex flex-row-reverse">
                <div class="col-lg-6 d-flex flex-column justify-content-center gap-2">
                    <div class="d-flex gap-2">
                        <i class="fa-solid fa-person about-approach-icon"></i>
                        <h1 class="section-heading">Our Promise</h1>
                    </div>
                    <p class="text-muted" style="font-size: 18px">
                        With an endeavor to facilitate quality education,
                        SkillSider is making every possible effort to bring
                        a revolution to the emerging ed-tech industry. Now
                        with the growing number of students who wish to
                        upskill themselves with the latest trends, online
                        educational platforms are manifesting a strong
                        market in the professional world. Hence, SkillSider,
                        with its dynamic team and exceptional courses, is
                        helping you transform your professional journey to a
                        whole new level.
                    </p>
                </div>
                <div class="col-lg-6 choose-us-right-section d-flex justify-content-center">
                    <img src="{{ asset('studens-asset/assets/img/why-join.png') }}" alt="" />
                </div>
            </div>
        </section>
        <!-- revlution -->
        <div class="about-revolution">
            <h2 class="section-header fw-bold">
                Beginning of a revolution
            </h2>
            <p class="main-text">
                We believe in doing things the right way! SkillSider
                envisions transforming the way professionals learn and grow,
                empowering them to take charge of their own career and stay
                ahead in today's competitive job industry. Initiating a new
                trend in the professional realm, we aim to make your
                learning journey easier.
            </p>
            <a href="">
                <button class="main__btn rounded-pill">
                    <span>Get Started Now</span>
                    <i class="main-button-arrow fa fa-arrow-right"></i>
                </button>
            </a>
            <style>
                .demo_btn {
                    border: 2px solid #FF783E;
                    background-color: #523680;
                    color: white !important;
                    font-size: 15px;
                    display: flex;
                    text-transform: capitalize;
                    align-items: center;
                    gap: 10px;
                    position: relative;
                    padding: 6px 1rem;
                    transition: all 0.6s;
                    width: auto;
                    z-index: 1;
                    transition: var(--tran);
                    overflow: hidden;
                    margin: 1rem auto;
                }

                .demo_btn:hover {
                    color: white;
                    border: 2px solid #523680;
                }
            </style>
            <a href="">
                <button class="demo_btn rounded-pill" style="  background-color: #652c92;">
                    <span>Get Started Now</span>
                    <i class="main-button-arrow fa fa-arrow-right"></i>
                </button>
            </a>
            <a href="">
                <button class="demo_btn rounded-pill" style="  background-color: #f56522;">
                    <span>Get Started Now</span>
                    <i class="main-button-arrow fa fa-arrow-right"></i>
                </button>
            </a>
        </div>
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
