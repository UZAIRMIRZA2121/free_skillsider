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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Course Management</h1>
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
                        <li class="breadcrumb-item text-muted">Course</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item text-muted">Add Course</li>

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
                                <h3 class="fw-bold ">Add Course</h3>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Action-->
                            <a href="{{ route('courses.index') }}"
                                class="btn btn-sm text-light btn-primary align-self-center">Back</a>
                            <!--end::Action-->

                        </div>

                        <div>
                            <form class="Course_form form w-100" novalidate="novalidate" id="kt_sign_up_form"
                            method="POST" enctype="multipart/form-data" action="{{ route('courses.store') }}">
                            @csrf
                            <div class="row pt-6">
                                <!-- Course Title -->
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-10">
                                        <label for="Course_title" class="required form-label">Course Title</label>
                                        <input type="text" name="course_title" class="form-control form-control-solid"
                                            value="{{ old('course_title') }}" placeholder="Course Title" required />
                                        @error('course_title')
                                        <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                        
                                <!-- Course Image -->
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-10">
                                        <label for="image" class="required form-label">Course Image</label>
                                        <input type="file" name="image" class="form-control form-control-solid" required />
                                        @error('image')
                                        <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                 <!-- Course seq -->
                                 <div class="col-lg-6 col-sm-12">
                                    <div class="mb-10">
                                        <label for="seq" class="required form-label">Course Sequence</label>
                                        <input type="number" name="course_seq" class="form-control form-control-solid" id="seq" required />
                                        @error('seq')
                                        <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                      
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-10">
                                        <label class="required form-label">Course Type</label>
                                        <div class="d-flex align-items-center">
                                            <!-- Free Course -->
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="course_type" id="free_course" value="free"
                                                    class="form-check-input" {{ old('course_type') == 0 ? 'checked' : '' }} required />
                                                <label class="form-check-label" for="free_course">Free</label>
                                            </div>
                                            <!-- Paid Course -->
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="course_type" id="paid_course" value="paid" checked
                                                    class="form-check-input" {{ old('course_type') == 1 ? 'checked' : '' }} required />
                                                <label class="form-check-label" for="paid_course">Paid</label>
                                            </div>
                                             <!-- Both Course -->
                                             <div class="form-check form-check-inline">
                                                <input type="radio" name="course_type" id="both_course" value="paid"
                                                    class="form-check-input" {{ old('course_type') == 2 ? 'checked' : '' }} required />
                                                <label class="form-check-label" for="both_course">Both</label>
                                            </div>
                                        </div>
                                        @error('course_type')
                                        <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        
                            <!-- Submit Button -->
                            <div class="card-header cursor-pointer">
                                <div class="card-title m-0"></div>
                                <button type="submit" id="save_btn" class="btn btn-sm text-light btn-primary align-self-center">Save</button>
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
