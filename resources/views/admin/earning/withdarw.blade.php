@extends('layouts.admin.master')

@section('admin')
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                   
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Earning</h1>
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
                        <li class="breadcrumb-item text-muted">Earning</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item text-muted">Withdraw</li>

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
                <!--begin::Navbar-->
                <div class="card mb-5 mb-xxl-8">
                    <div class="card-body pt-0  pb-0">
                        <div class="card-header cursor-pointer">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bold ">Withdraw</h3>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Action-->
                            <a href="{{ route('earnings.index') }}"
                                class="btn btn-sm text-light btn-primary align-self-center">Back</a>
                            <!--end::Action-->

                        </div>

                        <div>
                            <form class="Course_form form w-100  " novalidate="novalidate" id="kt_sign_up_form"
                                method="POST" enctype="multipart/form-data"
                                action="{{ route('earnings.update', $std_id) }}">

                                @csrf
                                @method('PUT')
                                <div class="row  pt-6">
                                    <!--payment method start-->
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-10">
                                            <!--begin::Col-->
                                            <!--begin::Card widget 11-->
                                            <div class="card card-flush h-xl-80" style="background-color: #f8f5ff">
                                                <!--begin::Body-->
                                                <div class="card-body text-center pt-5">
                                                    <div class="d-flex justify-content-center  btn-active-light-success">
                                                        <div>
                                                            <span class="d-block   h4  text-gray-800">Account Name </span>
                                                            <div class="fs-2 fw-bolder mt-4">{{$payment_method->account_name}} </div>
                                                            
                                                             <input type="hidden"  name="payment_method_id" value="{{$payment_method->id}}">
                                                        </div>
                                                        <div class="ms-md-5">
                                                            <img src="{{ asset('assets/images/hand.png') }}" class="mt-3"
                                                                alt="" height="60">
                                                        </div>
                                                    </div>
                                                    <!--end::Section-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                            <!--end::Card widget 11-->
                                        </div>
                                    </div>
                                    <!--payment method end-->
                                    
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-10">
                                            <!--begin::Col-->
                                            <!--begin::Card widget 11-->
                                            <div class="card card-flush h-xl-80" style="background-color: #f8f5ff">
                                                <!--begin::Body-->
                                                <div class="card-body text-center pt-5">
                                                    <div class="d-flex justify-content-center ">
                                                        <div>
                                                            <span class="d-block   h4  text-gray-800">Requesting Amount</span>
                                                            <div class="fs-2 fw-bolder mt-4" data-kt-countup="true"
                                                                data-kt-countup-value="{{ $earnings }}"
                                                                data-kt-countup-prefix="Rs ">0</div>
                                                        </div>
                                                        <div class="ms-md-5">
                                                            <img src="{{ asset('assets/images/cash.png') }}" class="mt-3"
                                                                alt="" height="60">
                                                        </div>
                                                    </div>
                                                    <!--end::Section-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                            <!--end::Card widget 11-->
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-10">
                                            <!--begin::Col-->
                                            <!--begin::Card widget 11-->
                                            <div class="card card-flush h-xl-80" style="background-color: #f8f5ff">
                                                <!--begin::Body-->
                                                <div class="card-body text-center pt-5">
                                                    <div class="d-flex justify-content-center  btn-active-light-success">
                                                        <div>
                                                            <span class="d-block   h4  text-gray-800">Account Number </span>
                                                            <div class="fs-2 fw-bolder mt-4">{{$payment_method->account_number}} </div>
                                                            
                                                             <input type="hidden"  name="payment_method_id" value="{{$payment_method->id}}">
                                                        </div>
                                                        <div class="ms-md-5">
                                                            <img src="{{ asset('assets/images/gift-box.png') }}"
                                                            class="mt-3" alt="" height="60">
                                                        </div>
                                                    </div>
                                                    <!--end::Section-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                            <!--end::Card widget 11-->
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                     
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-10">
                                            <!--begin::Col-->
                                            <!--begin::Card widget 11-->
                                            <div class="card card-flush h-xl-80" style="background-color: #f8f5ff">
                                                <!--begin::Body-->
                                                <div class="card-body text-center pt-5">
                                                    <div class="d-flex justify-content-center  btn-active-light-success">
                                                        <div>
                                                            <span class="d-block   h4  text-gray-800">Bank Name </span>
                                                            <div class="fs-2 fw-bolder mt-4">{{$payment_method->bank}} </div>
                                                            
                                                             <input type="hidden"  name="payment_method_id" value="{{$payment_method->id}}">
                                                        </div>
                                                        <div class="ms-md-5">
                                                            <img src="{{ asset('assets/images/gift-box.png') }}"
                                                            class="mt-3" alt="" height="60">
                                                        </div>
                                                    </div>
                                                    <!--end::Section-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                            <!--end::Card widget 11-->
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header cursor-pointer">
                                    <div class="card-title m-0"></div>
                                    <button type="submit" id="save_btn"
                                        class="btn btn-sm text-light btn-primary align-self-center ">Request Withdraw</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--end::Navbar-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
@endsection
