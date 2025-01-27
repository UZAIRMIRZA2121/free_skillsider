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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Student</h1>
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
                        <li class="breadcrumb-item text-muted">My Package</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->

            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Navbar-->
                <div class=" mb-5 mb-xxl-8">
                    <div class="card-body pt-9 pb-0">
                        <div class="row">
                            @foreach ($packages as $package)
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 ">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="new-arrival-product image-container">
                                            <div class="new-arrivals-img-contnent image-container ">
                                                <a href="{{Route('student.single_package_course', ['id' => $package->id]) }}" >
                                                     <img class="" src="{{asset('packages_image/'.$package->image)}}" alt=""  width="100%" height="170px" >
                                                </a>
                                            </div>
                                            <div class="new-arrival-content text-center mt-3">
                                                <h4><a href="" class="">{{$package->package_title}}</a></h4>
                                                <a href="{{(Auth::user()->package_id >= $package->id) ? Route('student.single_package_course', ['id' => $package->id]) :  Route('student-profile.index') }}"><button type="button"
                                                        class="btn btn-primary">{{( Auth::user()->package_id >= $package->id) ? 'Active' : 'Upgrade' }}
                                                    </button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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
