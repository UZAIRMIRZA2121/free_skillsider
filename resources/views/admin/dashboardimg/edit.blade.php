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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">FDashboard Image's Management</h1>
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
                        <li class="breadcrumb-item text-muted">Dashboard Image</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Edit Dashboard Image</li>
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
                <!--begin::Navbar-->
                <div class="card mb-5 mb-xxl-8">
                    <div class="card-body pt-0  pb-0">
                        <div class="card-header cursor-pointer">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bold ">Dashboard Image</h3>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Action-->
                            <a href="{{ route('dashboard.images.index') }}"
                                class="btn btn-sm text-light btn-primary align-self-center">Back</a>
                            <!--end::Action-->

                        </div>

                        <div>
                           <form action="{{ route('dashboard.images.update', $dashboardImage->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row pt-6">
        <!-- Image Upload Field -->
        <div class="col-lg-6 col-sm-12">
            <div class="mb-10">
                <label for="image" class="required form-label">Image</label>
                <input type="file" name="image" class="form-control form-control-solid" />
            </div>
        </div>

        <!-- Current Image Display -->
        <div class="col-lg-6 col-sm-12">
            <div class="mb-10">
                <label for="currentImage" class="required form-label">Current Image</label><br>
                <img class="ms-10 mt-5" src="{{ asset('thumbnails/' . $dashboardImage->image) }}" alt="" width="300">
            </div>
        </div>

        <!-- Visibility Radio Buttons -->
        <div class="col-lg-6 col-sm-12">
            <label for="visibility" class="required form-label">Publish</label>
            <div class="d-flex">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="visibility" id="public" value="public" {{ $dashboardImage->visibility == 'public' ? 'checked' : '' }}>
                    <label class="form-check-label mx-1" for="public">Public</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="visibility" id="private" value="private" {{ $dashboardImage->visibility == 'private' ? 'checked' : '' }}>
                    <label class="form-check-label mx-1" for="private">Private</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="visibility" id="both" value="both" {{ $dashboardImage->visibility == 'both' ? 'checked' : '' }}>
                    <label class="form-check-label mx-1" for="both">Both</label>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="card-header cursor-pointer">
        <div class="card-title m-0"></div>
        <button type="submit" id="save_btn" class="btn btn-sm text-light btn-primary align-self-center mb-5 mt-20">Update</button>
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
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success',
                text: '{{ session('success') }}',
                icon: 'success'
            });
        </script>
    @endif
@endsection
