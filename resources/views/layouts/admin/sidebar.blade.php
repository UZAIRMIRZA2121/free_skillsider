<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column  "
    style=" max-height: 100%;background-color:#ffffff;
    overflow-y: auto;" data-kt-drawer="true"
    data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="false"
    data-kt-drawer-width="100vw" data-kt-drawer-height="100vh" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6 bg-white fixed-top " id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="{{ route('dashboard') }}" class="text-dark">
            <img alt="Logo" src="{{ asset('assets/images/skillsider_logo.png') }}"
                class="h-50px app-sidebar-logo-default " />
        </a>
        <!--begin::Logo image-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden bg-white ">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" style=" max-height: 100%;
    overflow-y: auto;"
            class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div class="row mb-0 d-none d-lg-block ">
                <div class="card-body text-center pt-5">
                    <div class="d-flex justify-content-center  mx-5">
                        <!--begin::Section-->
                        <div class="">
                            @if (Auth::user()->profile_photo_path)
                                <img src="{{ asset('profile-image/' . Auth::user()->profile_photo_path) }}"
                                    class="rounded-circle shadow-4-strong mt-3" width="80px" height="80px"
                                    alt="user" style="border: 2px solid rgb(123 212 79); padding: 2px;" />
                            @else
                                <img src="{{ asset('assets/images/defaultprofile.jpg') }}"
                                    class=" rounded-3rounded-circle shadow-4-strong" width="90px" height="90px"
                                    alt="user" style="border: 2px solid #35D7FF; padding: 2px;" />
                            @endif
                        </div>
                        <div class="mt-8 ms-3">
                            <div class="d-flex justify-content-start gx-10">
                                <h3>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                            </div>
                            @if (Auth::user()->role == 0)
                                <div class="d-flex justify-content-start gx-10">
                                    @php
                                        // Define images for each package
                                        $images = [
                                            1 => 'verified_skill_sider.png',
                                            2 => 'employee_of_the_month_skill_sider.png',
                                            3 => 'best_seller_pro_skill_sider.png',
                                            4 => 'diamond_skill_sider.png',
                                        ];
                                        $package = Auth::user()->package; // Get the user's package
$img = $images[$package->id] ?? 'default.png'; // Fallback to 'default.png' if no image is found
                                    @endphp
                                    @if ($package)
                                        <span class="badge badge-lg d-flex align-items-center"
                                            style="background-color:{{ $package->color_code }}; color: {{ $package->text_color_code }}; line-height: 1; border-radius: 10px 1px 10px 1px; 
                                    border-bottom: 3px solid rgba(0, 0, 0, 0.3); border-right: 3px solid rgba(0, 0, 0, 0.3);">
                                            {{-- <img src="{{ asset('sidebaricon/' . $img) }}" alt="" class="me-1" width="20px"> --}}
                                            {{ $package->package_title }}
                                        </span>
                                    @endif
                                </div>
                            @else
                                <div class="d-flex justify-content-start gx-10">
                                    @if (Auth::user()->role == 2)
                                        <span class="badge badge-lg badge-success">Order Admin</span>
                                    @elseif(Auth::user()->role == 3)
                                        <span class="badge badge-lg badge-success">Analytic Admin</span>
                                    @elseif(Auth::user()->role == 4)
                                        <span class="badge badge-lg badge-success">Withdraw Admin</span>
                                    @else
                                        <span class="badge badge-lg badge-success">Super Admin</span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    <!--end::Section-->
                </div>
            </div>
            <div id="kt_app_sidebar_menu_scroll" class="my-5 mx-3" style="max-height: 100%; overflow-y: auto;"
                data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="700px"
                data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu"
                    data-kt-menu="true" data-kt-menu-expand="false">
                    <div class="menu-item ">
                        <!--begin::Menu-->
                        <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6"
                            id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                            <div class="menu-item ">
                                @if (Auth::user()->role == 1)
                                    <!--begin:Menu link-->
                                    <a href="{{ route('std.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa  fa-home"></i>
                                            </span>
                                            <span class="menu-title ">Home</span>
                                        </span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu link-->
                                    <!--<a href="{{ Route('admin.dashboard') }}">-->
                                    <!--    <span class="menu-link">-->
                                    <!--        <span class="menu-icon">-->
                                    <!--            <i class="fa fa-dashboard"></i>-->
                                    <!--        </span>-->
                                    <!--        <span class="menu-title">Dashboard</span>-->
                                    <!--    </span>-->
                                    <!--</a>-->
                                    <!--end:Menu link-->
                                    <!--begin:Menu link-->
                                    <a href="{{ route('students.management.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa-solid fa-people-group"></i>
                                            </span>
                                            <span class="menu-title">Students Management</span>
                                        </span>
                                    </a>
                                    <!--end:Menu link-->
                                    <a href="{{ route('upgrade.request.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa-solid fa-people-group"></i>
                                            </span>
                                            <span class="menu-title">Upgrade Request</span>
                                        </span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--end:Menu link-->
                                    <a href="{{ route('notifications.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa-solid fa-file-pen"></i>
                                            </span>
                                            <span class="menu-title">Notification</span>
                                        </span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu link-->
                                    <a href="{{ route('packages.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa-regular fa-square-check"></i>
                                            </span>
                                            <span class="menu-title">Packages Management</span>
                                        </span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu link-->
                                    <a href="{{ route('courses.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa-solid fa-file-pen"></i>
                                            </span>
                                            <span class="menu-title">Courses Management</span>
                                        </span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu link-->
                                    <a href="{{ route('videos.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa-solid fa-stamp"></i>
                                            </span>
                                            <span class="menu-title">Video Management</span>
                                        </span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--end:Menu link-->
                                    <a href="{{ route('payment.admin.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-credit-card" aria-hidden="true"></i>
                                            </span>
                                            <span class="menu-title">Skillsider Payment Method</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('payment.management') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-credit-card" aria-hidden="true"></i>
                                            </span>
                                            <span class="menu-title">Payment Management</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('coupons.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-ticket" aria-hidden="true"></i>
                                            </span>
                                            <span class="menu-title">Coupen Management</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('rank.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-ticket" aria-hidden="true"></i>
                                            </span>
                                            <span class="menu-title">Rank Management</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('review.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-star"></i>
                                            </span>
                                            <span class="menu-title">Review Management</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('team.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-users" aria-hidden="true"></i>
                                            </span>
                                            <span class="menu-title">Skillsider Team</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('admin.claim-rewards.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-users" aria-hidden="true"></i>
                                            </span>
                                            <span class="menu-title">Claim Reward Management</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('earning-rewards.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-users" aria-hidden="true"></i>
                                            </span>
                                            <span class="menu-title">Reward Management</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('questions.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-users" aria-hidden="true"></i>
                                            </span>
                                            <span class="menu-title">Questions Management</span>
                                        </span>
                                    </a>
                                    <!--begin:Menu link-->
                                    <a href="{{ route('dashboard.images.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa-solid fa-stamp"></i>
                                            </span>
                                            <span class="menu-title">Dashboard Images</span>
                                        </span>
                                    </a>
                                    <!--end:Menu link-->
                                    <!--begin:Menu link-->
                                    <a href="{{ route('about.video') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa-solid fa-stamp"></i>
                                            </span>
                                            <span class="menu-title">About Video</span>
                                        </span>
                                    </a>
                                    <!--end:Menu link-->
                                    <a href="{{ route('faq.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                                            </span>
                                            <span class="menu-title">FAQ'S</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('std.earning') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-dollar-sign" aria-hidden="true"></i>

                                            </span>
                                            <span class="menu-title">Unrequested Earning</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('std.total.earning') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-dollar-sign" aria-hidden="true"></i>
                                            </span>
                                            <span class="menu-title">Total Earning</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('faq_affiliate_videos.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                                            </span>
                                            <span class="menu-title">FAQ'S & Affiliate Video</span>
                                        </span>
                                    </a>
                                    <a
                                        href="{{ Auth::user()->role == 1 ? route('admin.index') : route('users.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa-solid fa-user"></i>
                                            </span>
                                            <span class="menu-title">Profile</span>
                                        </span>
                                    </a>

                                    <a href="{{ route('market_tools.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-cog"></i>
                                            </span>
                                            <span class="menu-title ">Marketing Tools Management</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('blogs.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa  fa-home"></i>
                                            </span>
                                            <span class="menu-title ">Blog Management</span>
                                        </span>
                                    </a>
                                    <a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button class="btn btn-danger py-2 px-4 ms-4 mt-3" type="submit"><i
                                                    class="fa fa-power-off" aria-hidden="true"></i> Logout</button>
                                        </form>
                                    </a>
                                @elseif(Auth::user()->role == 2)
                                    <!--begin:Menu link-->
                                    <a href="{{ route('students.management.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa-solid fa-people-group"></i>
                                            </span>
                                            <span class="menu-title">Students Management</span>
                                        </span>
                                    </a>
                                    <!--end:Menu link-->
                                    <a href="{{ route('upgrade.request.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa-solid fa-people-group"></i>
                                            </span>
                                            <span class="menu-title">Upgrade Request</span>
                                        </span>
                                    </a>
                                    <a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button class="btn btn-danger py-2 px-4 ms-4 mt-3" type="submit"><i
                                                    class="fa fa-power-off" aria-hidden="true"></i> Logout</button>
                                        </form>
                                    </a>
                                @elseif(Auth::user()->role == 3)
                                    <!--begin:Menu link-->
                                    <!--begin:Menu link-->
                                    <a href="{{ Route('admin.dashboard') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-dashboard"></i>
                                            </span>
                                            <span class="menu-title">Dashboard</span>
                                        </span>
                                    </a>
                                    <!--end:Menu link-->

                                    <a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button class="btn btn-danger py-2 px-4 ms-4 mt-3" type="submit"><i
                                                    class="fa fa-power-off" aria-hidden="true"></i> Logout</button>
                                        </form>
                                    </a>
                                @elseif(Auth::user()->role == 4)
                                    <!--begin:Menu link-->
                                    <a href="{{ route('payment.management') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <i class="fa fa-credit-card" aria-hidden="true"></i>
                                            </span>
                                            <span class="menu-title">Payment Management</span>
                                        </span>
                                    </a>
                                    <!--end:Menu link-->

                                    <a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button class="btn btn-danger py-2 px-4 ms-4 mt-3" type="submit"><i
                                                    class="fa fa-power-off" aria-hidden="true"></i> Logout</button>
                                        </form>
                                    </a>
                                @else
                                    <a href="{{ route('std.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <img src="{{ asset('sidebaricon/clean-house.png') }}" alt=""
                                                    width="23px">
                                            </span>
                                            <span class="menu-title">Home</span>
                                        </span>
                                    </a>
                                    <a href="{{ Route('student.dashboard') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <img src="{{ asset('sidebaricon/dashboard.png') }}" alt=""
                                                    width="18px">
                                            </span>
                                            <span class="menu-title">Dashboard</span>
                                        </span>
                                    </a>
                                    <!--begin:Menu link-->
                                    @php
                                        $courseId = Auth::user()->package_id ? Auth::user()->package_id : 1;
                                    @endphp
                                    <a href="{{ route('student.single_package_course', ['id' => $courseId]) }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <img src="{{ asset('sidebaricon/training.png') }}" alt=""
                                                    width="20px">
                                            </span>
                                            <span class="menu-title">My Courses</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('students.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <img src="{{ asset('sidebaricon/team.png') }}" alt=""
                                                    width="20px">
                                            </span>
                                            <span class="menu-title">My Affiliates</span>
                                        </span>
                                    </a>
                                    <!--end:Menu link-->
                                    <a href="{{ Route('leaderboard') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <img src="{{ asset('sidebaricon/award-badge.png') }}" alt=""
                                                    width="25px">
                                            </span>
                                            <span class="menu-title">Leaderboard</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('student.payments') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <img src="{{ asset('sidebaricon/bank.png') }}" alt=""
                                                    width="20px">
                                            </span>
                                            <span class="menu-title">Bank Details</span>
                                        </span>
                                    </a>
                                    <a href="{{ Route('earnings.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <img src="{{ asset('sidebaricon/money-withdraw.png') }}"
                                                    alt="" width="20px">
                                            </span>
                                            <span class="menu-title">Withdrawals</span>
                                        </span>
                                    </a>
                                    <a href="{{ Route('community') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <img src="{{ asset('sidebaricon/social.png') }}" alt=""
                                                    width="23px">
                                            </span>
                                            <span class="menu-title">Community</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('market_tools.index_std') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <img src="{{ asset('sidebaricon/digital-marketing.png') }}"
                                                    alt="" width="22px">
                                            </span>
                                            <span class="menu-title ">Resources</span>
                                        </span>
                                    </a>
                                    <a href="{{ Route('tests.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <img src="{{ asset('sidebaricon/certificate.png') }}" alt=""
                                                    width="20px">
                                            </span>
                                            <span class="menu-title">Certificates</span>
                                        </span>
                                    </a>
                                    <a href="{{ Route('affiliate.training') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <img src="{{ asset('sidebaricon/video.png') }}" alt=""
                                                    width="20px">
                                            </span>
                                            <span class="menu-title">Trainings</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('users.coupon.code') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <img src="{{ asset('sidebaricon/coupon.png') }}" alt=""
                                                    width="20px">
                                            </span>
                                            <span class="menu-title">Discounts</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('earning-rewards.std.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <img src="{{ asset('sidebaricon/giftbox.png') }}" alt=""
                                                    width="20px">
                                            </span>
                                            <span class="menu-title">Rewards</span>
                                        </span>
                                    </a>
                                    <a href="{{ route('users.package.upgrade.form') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <img src="{{ asset('sidebaricon/upgrade.png') }}" alt=""
                                                    width="20px">
                                            </span>
                                            <span class="menu-title">Upgrade</span>
                                        </span>
                                    </a>


                                    <a
                                        href="{{ Auth::user()->role == 1 ? route('users.index') : route('student-profile.index') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <img src="{{ asset('sidebaricon/user.png') }}" alt=""
                                                    width="18px">
                                            </span>
                                            <span class="menu-title">Profile</span>
                                        </span>
                                    </a>
                                    <a href="{{ Route('faq') }}">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <img src="{{ asset('sidebaricon/conversation.png') }}" alt=""
                                                    width="20px">
                                            </span>
                                            <span class="menu-title">FAQs</span>
                                        </span>
                                    </a>



                                    <a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button class="btn btn-danger py-2 px-4 ms-4 mt-3" type="submit"><i
                                                    class="fa fa-power-off" aria-hidden="true"></i> Logout</button>
                                        </form>
                                    </a>
                                @endif
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->

</div>
<!--end::Sidebar-->
