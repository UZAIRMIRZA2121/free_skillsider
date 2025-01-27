@extends('layouts.admin.master')
@section('admin')
    <style>
        /* Genel stil */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 24px;
            margin: 10px;
        }

        /* Giriş stil */
        .toggle-switch .toggle-input {
            display: none;
        }

        /* Anahtarın stilinin etrafındaki etiketin stil */
        .toggle-switch .toggle-label {
            position: absolute;
            top: 0;
            left: 0;
            width: 40px;
            height: 24px;
            background-color: #2196F3;
            border-radius: 34px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* Anahtarın yuvarlak kısmının stil */
        .toggle-switch .toggle-label::before {
            content: "";
            position: absolute;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            top: 2px;
            left: 2px;
            background-color: #fff;
            box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s;
        }

        /* Anahtarın etkin hale gelmesindeki stil değişiklikleri */
        .toggle-switch .toggle-input:checked+.toggle-label {
            background-color: #4CAF50;
        }

        .toggle-switch .toggle-input:checked+.toggle-label::before {
            transform: translateX(16px);
        }

        /* Light tema */
        .toggle-switch.light .toggle-label {
            background-color: #BEBEBE;
        }

        .toggle-switch.light .toggle-input:checked+.toggle-label {
            background-color: #9B9B9B;
        }

        .toggle-switch.light .toggle-input:checked+.toggle-label::before {
            transform: translateX(6px);
        }

        /* Dark tema */
        .toggle-switch.dark .toggle-label {
            background-color: #4B4B4B;
        }

        .toggle-switch.dark .toggle-input:checked+.toggle-label {
            background-color: #717171;
        }

        .toggle-switch.dark .toggle-input:checked+.toggle-label::before {
            transform: translateX(16px);
        }

        #toggle-password {
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1; /* Ensure it appears above the input field */
}
    </style>


    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"></h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1 d-none">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Dashboard
                            </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">My Profile</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card  mb-2">
                    <div class="card-header cursor-pointer w-100 text-center">
                        <h1 class="d-block m-auto"> <span> <img src="{{ asset('sidebaricon/user.png') }}" alt=""
                                    width="30px" class="mx-3 mb-3">Profile Settings</span></h1>
                        
                    </div>
            </div>
                <!--begin::Navbar-->
                <div class="card mb-5 mb-xxl-8">
                    <div class="card-body pt-9 pb-0">
                        <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">Profile</a>
                            </li>
                            @if (auth::user()->role == 0 || auth::user()->role == 1)
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_2">Manage Password</a>
                                </li>
                            @endif
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                                <div class="container">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel">
                                        <div class="pt-4">
                                            <div class="col-lg-12 col-xl-12">
                                                <div class="row ">
                                                    <div class="col-xl-6 col-sm-12">
                                                        <div class="card-body p-9">
                                                            <!--begin::Row-->
                                                            <div class="row mb-7 ">
                                                                <!--begin::Label-->
                                                                <label class="col-lg-3 fw-semibold text-muted">Full
                                                                    Name</label>
                                                                <!--end::Label-->
                                                                <div class="col-3"></div>
                                                                <!--begin::Col-->
                                                                <div class="col-lg-5 d-felx justify-content-end">
                                                                    <span
                                                                        class="fw-bold fs-6 text-gray-800">{{ Auth::user()->first_name }}
                                                                        {{ Auth::user()->last_name }}</span>
                                                                </div>
                                                                <!--end::Col-->

                                                            </div>
                                                            <!--end::Row-->

                                                            <!--begin::Input group-->
                                                            <div class="row mb-7">
                                                                <!--begin::Label-->
                                                                <label class="col-lg-3 fw-semibold text-muted">Email</label>
                                                                <!--end::Label-->
                                                                <div class="col-3"></div>

                                                                <!--begin::Col-->
                                                                <div class="col-lg-5 d-felx justify-content-end">
                                                                    <span
                                                                        class="fw-semibold text-gray-800 fs-6">{{ Auth::user()->email }}</span>
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Input group-->

                                                            <!--begin::Input group-->
                                                            <div class="row mb-7">
                                                                <!--begin::Label-->
                                                                <label
                                                                    class="col-lg-3 fw-semibold text-muted">Package</label>
                                                                <!--end::Label-->
                                                                <div class="col-3"></div>

                                                                <!--begin::Col-->
                                                                <div class="col-lg-5 d-felx justify-content-end">
                                                                    <span
                                                                        class="fw-semibold text-gray-800 fs-6">{{ Auth::user()->package->package_title ?? 'No Package' }}</span>
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="row mb-7">
                                                                <!--begin::Label-->
                                                                <label class="col-lg-3 fw-semibold text-muted">
                                                                    Contact Phone
                                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                                        aria-label="Phone number must be active"
                                                                        data-bs-original-title="Phone number must be active"
                                                                        data-kt-initialized="1">
                                                                        <i class="ki-duotone ki-information fs-7"><span
                                                                                class="path1"></span><span
                                                                                class="path2"></span><span
                                                                                class="path3"></span>
                                                                        </i>
                                                                    </span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <div class="col-3"></div>

                                                                <!--begin::Col-->
                                                                <div class="col-lg-5 d-felx justify-content-end">
                                                                    <span
                                                                        class="fw-bold fs-6 text-gray-800 me-2">{{ Auth::user()->phone }}</span>
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="row mb-7">
                                                                <!--begin::Label-->
                                                                <label
                                                                    class="col-lg-4 fw-semibold text-muted">Status</label>
                                                                <!--end::Label-->
                                                                <div class="col-2"></div>

                                                                <!--begin::Col-->
                                                                <div class="col-lg-5">

                                                                    @if (Auth::user()->status == 1)
                                                                        <span
                                                                            class="badge badge-lg badge-success">Verified</span>
                                                                    @else
                                                                        <span class="badge badge-lg badge-danger">Not
                                                                            Verified</span>
                                                                    @endif
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <div class="row mb-7">
                                                                <!--begin::Label-->
                                                                <label class="col-lg-3 fw-semibold text-muted">Referral
                                                                    by</label>
                                                                <!--end::Label-->
                                                                <div class="col-3"></div>

                                                                <!--begin::Col-->
                                                                <div class="col-lg-5 d-felx justify-content-end">

                                                                    <span
                                                                        class="fw-semibold fs-6 text-gray-800 text-hover-primary">{{ Auth::user()->referral_by }}</span>
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="row mb-7">
                                                                <!--begin::Label-->
                                                                <label class="col-lg-3 fw-semibold text-muted">Referal
                                                                    code</label>
                                                                <!--end::Label-->
                                                                <div class="col-3"></div>

                                                                <!--begin::Col-->
                                                                <div class="col-lg-5 d-felx justify-content-end">

                                                                    <span
                                                                        class="fw-bold fs-6 text-gray-800">{{ Auth::user()->referral_code }}</span>
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Input group-->

                                                            <!--begin::Input group-->
                                                            {{-- <div class="row mb-10">
                                                                <!--begin::Label-->
                                                                <label class="col-lg-3 fw-semibold text-muted">Coupen
                                                                    code</label>
                                                                <!--begin::Label-->
                                                                <div class="col-3"></div>

                                                                <!--begin::Label-->
                                                                <div class="col-lg-5 d-felx justify-content-end">

                                                                    <span
                                                                        class="fw-semibold fs-6 text-gray-800">{{ Auth::user()->coupen_code }}</span>
                                                                </div>
                                                                <!--begin::Label-->
                                                            </div> --}}
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="row mb-10">
                                                                <!--begin::Label-->
                                                                <label class="col-lg-3 fw-semibold text-muted">Paid
                                                                    Amount</label>
                                                                <!--begin::Label-->
                                                                <div class="col-3"></div>

                                                                <!--begin::Label-->
                                                                <div class="col-lg-5 d-felx justify-content-end">
                                                                    <span
                                                                        class="fw-semibold fs-6 text-gray-800">{{ Auth::user()->paid_amount }}</span>
                                                                </div>
                                                                <!--begin::Label-->
                                                            </div>
                                                            <!-- Passive Income -->
                                                            <div class="row mb-10">
                                                                <label class="col-lg-3 fw-semibold text-muted">Passive
                                                                    Income</label>
                                                                <div class="col-3"></div>
                                                                <div class="col-lg-5 d-felx justify-content-end">
                                                                    <span class="fw-semibold fs-6 text-gray-800">
                                                                        <div class="toggle-switch">
                                                                            <input class="toggle-input toggle-status"
                                                                                id="passive_income" type="checkbox"
                                                                                name="passive_income"
                                                                                data-field="passive_income "
                                                                                {{ Auth::user()->passive_income == 1 ? 'checked' : '' }}>
                                                                            <label class="toggle-label"
                                                                                for="passive_income"></label>
                                                                        </div>
                                                                    </span>
                                                                </div>
                                                                <label
                                                                    class="col-lg-3 fw-semibold text-muted">Sounds</label>
                                                                <div class="col-3"></div>
                                                                <div class="col-lg-5 d-felx justify-content-end">
                                                                    <span class="fw-semibold fs-6 text-gray-800">
                                                                        <div class="toggle-switch">
                                                                            <input class="toggle-input toggle-status"
                                                                                id="sounds" type="checkbox"
                                                                                name="sounds" data-field="sounds"
                                                                                {{ Auth::user()->sounds == 1 ? 'checked' : '' }}>
                                                                            <label class="toggle-label"
                                                                                for="sounds"></label>
                                                                        </div>
                                                                    </span>
                                                                </div>

                                                            </div>




                                                            <!--begin::Notice-->
                                                            <br>
                                                            <div class="w3-row-padding">
                                                                <div class="w3-container w3-third">
                                                                    <img src="" style="width:100%;cursor:pointer"
                                                                        onclick="onClick(this)" class="w3-hover-opacity">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-sm-12">
                                                        <div class="card-body px-5">
                                                            <!--begin::Row-->
                                                            <div class="row mb-7 ">
                                                                <!--begin::Label-->
                                                                <label class="col-lg-3 fw-semibold text-muted">
                                                                    ID Card Name</label>
                                                                <!--end::Label-->
                                                                <div class="col-3"></div>
                                                                <!--begin::Col-->
                                                                <div class="col-lg-5 d-felx justify-content-end">
                                                                    <span
                                                                        class="fw-bold fs-6 text-gray-800">{{ Auth::user()->id_card_name }}</span>
                                                                </div>
                                                                <!--end::Col-->

                                                            </div>
                                                            <!--end::Row-->
                                                            @php
                                                                $idCardNumber = Auth::user()->id_card_number;
                                                                $formattedIdCardNumber = preg_replace(
                                                                    '/^(\d{5})(\d{7})(\d{1})$/',
                                                                    '$1-$2-$3',
                                                                    $idCardNumber,
                                                                );
                                                            @endphp

                                                            <!--begin::Row-->
                                                            <div class="row mb-7 ">
                                                                <!--begin::Label-->
                                                                <label class="col-lg-3 fw-semibold text-muted">ID Card
                                                                    Number</label>
                                                                <!--end::Label-->
                                                                <div class="col-3"></div>
                                                                <!--begin::Col-->
                                                                <div class="col-lg-5 d-felx justify-content-end">
                                                                    <span
                                                                        class="fw-bold fs-6 text-gray-800">{{ $formattedIdCardNumber }}
                                                                    </span>
                                                                </div>
                                                                <!--end::Col-->

                                                            </div>
                                                            <!--end::Row-->
                                                            <!--begin::Row-->
                                                            <div class="row mb-7 ">
                                                                <!--begin::Label-->
                                                                <label class="col-lg-3 fw-semibold text-muted">Date of
                                                                    Birth</label>
                                                                <!--end::Label-->
                                                                <div class="col-3"></div>
                                                                <!--begin::Col-->
                                                                <div class="col-lg-5 d-felx justify-content-end">
                                                                    <span
                                                                        class="fw-bold fs-6 text-gray-800">{{ Auth::user()->dob }}</span>
                                                                </div>
                                                                <!--end::Col-->

                                                            </div>
                                                            <!--end::Row-->
                                                            <!--begin::Row-->
                                                            <div class="row mb-7 ">
                                                                <!--begin::Label-->
                                                                <label class="col-lg-3 fw-semibold text-muted">
                                                                    Gender</label>
                                                                <!--end::Label-->
                                                                <div class="col-3"></div>
                                                                <!--begin::Col-->
                                                                <div class="col-lg-5 d-felx justify-content-end">
                                                                    <span
                                                                        class="fw-bold fs-6 text-gray-800">{{ Auth::user()->gender }}</span>
                                                                </div>
                                                                <!--end::Col-->

                                                            </div>
                                                            <!--end::Row-->
                                                            <!--begin::Row-->
                                                            <div class="row mb-7 ">
                                                                <!--begin::Label-->
                                                                <label
                                                                    class="col-lg-3 fw-semibold text-muted">State</label>
                                                                <!--end::Label-->
                                                                <div class="col-3"></div>
                                                                <!--begin::Col-->
                                                                <div class="col-lg-5 d-felx justify-content-end">
                                                                    <span
                                                                        class="fw-bold fs-6 text-gray-800">{{ Auth::user()->state }}</span>
                                                                </div>
                                                                <!--end::Col-->

                                                            </div>
                                                            <!--end::Row-->
                                                            <!--begin::Row-->
                                                            <div class="row mb-7 ">
                                                                <!--begin::Label-->
                                                                <label class="col-lg-3 fw-semibold text-muted">City</label>
                                                                <!--end::Label-->
                                                                <div class="col-3"></div>
                                                                <!--begin::Col-->
                                                                <div class="col-lg-5 d-felx justify-content-end">
                                                                    <span
                                                                        class="fw-bold fs-6 text-gray-800">{{ Auth::user()->city }}
                                                                    </span>
                                                                </div>
                                                                <!--end::Col-->

                                                            </div>
                                                            <!--end::Row-->
                                                            <!--begin::Row-->
                                                            <div class="row mb-7 ">
                                                                <!--begin::Label-->
                                                                <label class="col-lg-3 fw-semibold text-muted">
                                                                    Post Code</label>
                                                                <!--end::Label-->
                                                                <div class="col-3"></div>
                                                                <!--begin::Col-->
                                                                <div class="col-lg-5 d-felx justify-content-end">
                                                                    <span
                                                                        class="fw-bold fs-6 text-gray-800">{{ Auth::user()->pin_code }}</span>
                                                                </div>
                                                                <!--end::Col-->

                                                            </div>
                                                            <!--end::Row-->
                                                            <!--begin::Row-->
                                                            <div class="row mb-7 ">
                                                                <!--begin::Label-->
                                                                <label class="col-lg-3 fw-semibold text-muted">
                                                                    Address</label>
                                                                <!--end::Label-->
                                                                <div class="col-3"></div>
                                                                <!--begin::Col-->
                                                                <div class="col-lg-5 d-felx justify-content-end">
                                                                    <span
                                                                        class="fw-bold fs-6 text-gray-800">{{ Auth::user()->address }}</span>
                                                                </div>
                                                                <!--end::Col-->

                                                            </div>
                                                            <!--end::Row-->

                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2  ">
                                                        <!--begin::Input group-->
                                                        <div class=" my-10">
                                                            <!--begin::Label-->
                                                            <label class="fw-semibold fs-6 text-gray-800 ">Profile
                                                                Image</label>
                                                            <!--begin::Label-->

                                                        </div>
                                                        <!--end::Input group-->
                                                        @if (Auth::user()->profile_photo_path)
                                                            <img src="{{ asset('profile-image/' . Auth::user()->profile_photo_path) }}"
                                                                height="250" width="220" class="rounded-3"
                                                                alt="user" />
                                                        @else
                                                            <img src="{{ asset('assets/images/defaultprofile.jpg') }}"
                                                                class="rounded-3 " height="250" width="220"
                                                                alt="user" />
                                                        @endif
                                                        <!--end::Image input-->
                                                    </div>
                                                    <!--<div class="col-3">-->
                                                    <!--begin::Input group-->
                                                    <!--    <div class=" my-10">-->
                                                    <!--begin::Label-->
                                                    <!--        <label class="fw-semibold fs-6 text-gray-800 ">Payment-->
                                                    <!--            Image</label>-->
                                                    <!--begin::Label-->

                                                    <!--    </div>-->
                                                    <!--end::Input group-->
                                                    <!--    @if (Auth::user()->payment_image)
    -->
                                                    <!--    <div class="w3-row-padding">-->
                                                    <!--        <div class="w3-container w3-third" data-toggle="modal"-->
                                                    <!--            data-target="#modal01">-->
                                                    <!--            <img src="{{ asset('payment_image/' . Auth::user()->payment_image) }}"-->
                                                    <!--                width="250" alt="" style="cursor: pointer"-->
                                                    <!--                onclick="onClick(this)" class="w3-hover-opacity">-->
                                                    <!--        </div>-->
                                                    <!--    </div>-->

                                                <!--    @else-->
                                                    <!--        <img src="{{ asset('assets/images/defaultprofile.jpg') }}"-->
                                                    <!--            class="rounded-3 " height="250" width="220"-->
                                                    <!--            alt="user" />-->
                                                    <!--
    @endif-->
                                                    <!--end::Image input-->
                                                    <!--</div>-->


                                                    <div class="btn mb-5">
                                                        @if (Auth::user()->role == 1)
                                                            <a href="{{ route('admin.edit.profile', ['user' => Auth::user()->id]) }}"
                                                                type="button" id="butsave" class="btn btn-primary"
                                                                style="float: right;">
                                                                Edit Profile
                                                            </a>
                                                        @elseif(Auth::user()->role == 0)
                                                            <a href="{{ route('users.edit', ['user' => Auth::user()->id]) }}"
                                                                type="button" id="butsave" class="btn btn-primary"
                                                                style="float: right;">
                                                                Edit
                                                            </a>
                                                        @endif


                                                    </div>

                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                                <div class="card mb-5" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                                    <div class="card-header">
                                        <h4 class="card-title"> CHANGE PASSWORD </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="basic-form">
                                            <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form"
                                                method="POST" enctype="multipart/form-data"
                                                action="{{ route('users.update', Auth::user()->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <!-- Old Password -->
                                                <div class="mb-10 fv-row" data-kt-password-meter="true">
                                                    <label class="form-label fw-bolder text-dark fs-6">Old Password</label>
                                                    <div class="position-relative mb-3">
                                                        <input id="oldpassword"
                                                            class="form-control form-control-lg form-control-solid"
                                                            type="password" name="oldpassword" required
                                                            autocomplete="new-oldpassword" />
                                                        <!-- Eye Icon -->
                                                        <span id="toggle-oldpassword"
                                                            class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                            style="cursor: pointer;">
                                                            <i class="bi bi-eye-slash fs-2"></i>
                                                            <i class="bi bi-eye fs-2 d-none"></i>
                                                        </span>
                                                        <span id="oldpasswordMessage" class="text-danger mt-2"></span>
                                                    </div>
                                                </div>

                                                <!-- New Password -->
                                                <div class="mb-10 fv-row" data-kt-password-meter="true">
                                                    <label class="form-label fw-bolder text-dark fs-6">New Password</label>
                                                    <div class="position-relative mb-3">
                                                        <input id="password"
                                                            class="form-control form-control-lg form-control-solid"
                                                            type="password" name="password" required
                                                            autocomplete="new-password" />
                                                        <!-- Eye Icon -->
                                                        <span id="toggle-password"
                                                            class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                            style="cursor: pointer;">
                                                            <i class="bi bi-eye-slash fs-2"></i>
                                                            <i class="bi bi-eye fs-2 d-none"></i>
                                                        </span>
                                                        <span id="passwordMessage" class="text-danger mt-2"></span>
                                                    </div>
                                                </div>

                                                <!-- Confirm New Password -->
                                                <div class="mb-10 mb-5 fv-row" data-kt-password-meter="true">
                                                    <label class="form-label fw-bolder text-dark fs-6">Confirm New
                                                        Password</label>
                                                    <div class="position-relative mb-3">
                                                        <input id="password_confirmation"
                                                            class="form-control form-control-lg form-control-solid"
                                                            type="password" name="password_confirmation" required />
                                                        <!-- Eye Icon -->
                                                        <span id="toggle-password_confirmation"
                                                            class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                            style="cursor: pointer;">
                                                            <i class="bi bi-eye-slash fs-2"></i>
                                                            <i class="bi bi-eye fs-2 d-none"></i>
                                                        </span>
                                                        <span id="confirmPasswordMessage" class="text-danger mt-2"></span>
                                                    </div>
                                                </div>

                                                <!--end::Input group-->
                                                <x-button id="butsave" class="btn btn-primary my-5"
                                                    style="float: right;" type="submit">
                                                    {{ __('Update password') }}
                                                </x-button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--end::Navbar-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <script>
        // Function to toggle password visibility
        function togglePasswordVisibility(toggleId, inputId) {
            const toggleButton = document.getElementById(toggleId);
            const passwordInput = document.getElementById(inputId);
            const iconEye = toggleButton.querySelector(".bi-eye");
            const iconEyeSlash = toggleButton.querySelector(".bi-eye-slash");

            toggleButton.addEventListener("click", function() {
                if (passwordInput.type === "password") {
                    passwordInput.type = "text"; // Show password
                    iconEye.classList.remove("d-none");
                    iconEyeSlash.classList.add("d-none");
                } else {
                    passwordInput.type = "password"; // Hide password
                    iconEye.classList.add("d-none");
                    iconEyeSlash.classList.remove("d-none");
                }
            });
        }

        // Attach toggle functionality to each password field
        togglePasswordVisibility("toggle-oldpassword", "oldpassword");
        togglePasswordVisibility("toggle-password", "password");
        togglePasswordVisibility("toggle-password_confirmation", "password_confirmation");
    </script>
    <!--end::Content wrapper-->
    <div class="modal fade" id="modal01" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Receipt</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="img01" src="" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function onClick(element) {
            var modal = document.getElementById("modal01");
            var img = document.getElementById("img01");
            img.src = element.src;
            modal.style.display = "block";

            // Add code here to close the modal when desired.
        }
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success',
                text: '{{ session('success') }}',
                icon: 'success'
            });
        </script>
    @endif
    <script>
        const form = document.getElementById("kt_sign_up_form");
        const passwordInput = document.getElementById("password");
        const confirmPasswordInput = document.getElementById("password_confirmation");
        const passwordMessage = document.getElementById("passwordMessage");
        const confirmPasswordMessage = document.getElementById("confirmPasswordMessage");

        passwordInput.addEventListener("keyup", function() {
            if (passwordInput.value.length < 8) {
                passwordMessage.textContent = "Password must be at least 8 characters long.";
            } else {
                passwordMessage.textContent = "";
            }
        });

        confirmPasswordInput.addEventListener("keyup", function() {
            if (passwordInput.value !== confirmPasswordInput.value) {
                confirmPasswordMessage.textContent = "Passwords do not match.";
            } else {
                confirmPasswordMessage.textContent = "";
            }
        });

        form.addEventListener("submit", function(event) {
            if (passwordInput.value == "" && confirmPasswordInput.value == "") {
                passwordMessage.textContent = "Password is required.";
                confirmPasswordMessage.textContent = "  Confirm password is required.";
                event.preventDefault();
            }
            if (passwordInput.value !== confirmPasswordInput.value) {
                confirmPasswordMessage.textContent = "Passwords do not match.";
                event.preventDefault();
            }
        });
    </script>
@endsection
