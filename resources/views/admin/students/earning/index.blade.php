@extends('layouts.admin.master')

@section('admin')



<style>
    .carousel-item img {
        height: auto;
        max-height: 700px;
        /* Set this to your desired maximum height */
    }

    .package-card {
        width: 300px;
        /* Set a width for your package cards */
        border: 1px solid #ddd;
        /* Optional: border for card */
        border-radius: 8px;
        /* Optional: rounded corners */
        overflow: hidden;
        /* To handle overflow */
        transition: transform 0.3s;
        /* Optional: transition effect */
    }

    .package-card:hover {
        transform: scale(1.09);
        /* Optional: scale effect on hover */
    }

    .package_inner_body {
        padding: 15px;
        /* Add some padding */
    }

    /* Optional: Style for text */
    .package_text {
        font-size: 1.2em;
        /* Adjust font size */
        margin: 0;
        /* Remove default margin */
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
         
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1 d-none">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Rewards  </li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        
        <!--begin::Toolbar-->
        <div class="container package_container  ">
            <div class="card  mb-2">
                <div class="card-header cursor-pointer w-100 text-center">
                    <h1 class="d-block m-auto"> <span> <img src="{{ asset('sidebaricon/giftbox.png') }}" alt=""
                                width="30px" class="mx-3 mb-3">Rewards</span></h1>
                    
                </div>
        </div>
            <div class="package-body card">
                <div id="gold-package" class="package" style="display: block;">
                    <div class="packages_body_inner">
                        <div class="d-flex justify-content-center">
                            @foreach($earningRewards as $reward)
                            <a href="{{ route('single_reward', ['id' => $reward->id]) }}">
                                <div class="package-card text-center m-2" style="background-color: #f9f9f9">
                                    <div class="overflow-hidden">
                                        <img src="{{ asset($reward->image) }}" class="img img-thumbnail" alt="" height="250">
                                    </div>
                                    <div class="package_inner_body">
                                        <p class="package_text fw-bolder">
                                            <a href="{{ route('single_reward', ['id' => $reward->id]) }}">
                                                {{ $reward->name }}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



@endsection