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
                        <li class="breadcrumb-item text-muted">Video</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Edit Video</li>
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
                                <h3 class="fw-bold ">Edit Video</h3>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Action-->
                            <a href="{{ route('videos.index') }}"
                                class="btn btn-sm text-light btn-primary align-self-center">Back</a>
                            <!--end::Action-->

                        </div>

                        <div>
                            <form class="Course_form form w-100" id="kt_video_form" method="put"
                                enctype="multipart/form-data" action="{{ route('videos.edit', $video->id) }}">
                                @csrf
                                <div class="row pt-6">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-10">
                                            <label for="vide_title" class="required form-label">Video Title</label>
                                            <input type="text" value="{{ $video->video_title }}" id="video_title"
                                                name="video_title" class="form-control form-control-solid"
                                                placeholder="Video Title" required />
                                            <div class="invalid-feedback" id="course_title_error"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-10">
                                            <label for="video_link" class="required form-label">Video Link</label>
                                            <input type="text" value="{{ $video->video_link }}" name="video_link"
                                                class="form-control form-control-solid" placeholder="Video Link" required />
                                            <div class="invalid-feedback" id="video_link_error"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-10">
                                            <label class="form-label fw-bolder text-dark fs-6">Course Video</label>
                                            <select class="form-select form-select-solid" name="courses_id"
                                                data-control="select2" data-placeholder="Select a Course">
                                                <option value="">Select a Course</option>

                                                <option value="{{ $video->courses->id }}" selected>
                                                    {{ $video->courses->course_title }}</option> --}}

                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->course_title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback" id="course_id_error"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-10">
                                            <label for="no_of_video" class="required form-label">Video Sequence</label>
                                            <input type="number" value="{{ $video->video_seq }}" name="video_seq"
                                                class="form-control form-control-solid" placeholder="Video Sequence"
                                                required />
                                            <div class="invalid-feedback" id="no_of_video_error"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-10">
                                            <label for="duartion" class="required form-label">Video Duration <mark> (in
                                                    minute)</mark></label>
                                            <input type="number" name="video_duration" value="{{ $video->video_duration }}"
                                                class="form-control form-control-solid" placeholder="Video Duration"
                                                required />
                                            @error('duartion')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-lg-6 col-sm-12 d-flex ">
                                        <div class="mb-10">
                                            <label for="duartion" class="required form-label">Video Type <mark> (Youtube or
                                                    Vimeo)</mark></label>
                                            <div class="d-flex mt-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="video_type"
                                                        id="bunny" value="1"
                                                        {{ $video->video_type == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="bunny">
                                                        Vimeo
                                                    </label>
                                                </div>
                                                <div class="form-check ms-5">
                                                    <input class="form-check-input" type="radio" name="video_type"
                                                        id="youtube" value="0"
                                                        {{ $video->video_type == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="youtube">
                                                        Youtube
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        @error('video_type')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-10">
                                            <label for="resource_link" class="required form-label">Video Resource Link</label>
                                            <input type="text" name="resource_link" class="form-control form-control-solid" id="resource_link" value="{{ $video->resource_link }}"
                                                placeholder="Video Resource Link"  />
                                              
                                        </div>
                                    </div> 
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-10">
                                            <label for="resource_text" class="required form-label">Video Resouce Text </label>
                                            <input type="text" name="resource_text" class="form-control form-control-solid" id="resource_text"  value="{{ $video->resource_text }}"
                                                placeholder="Video Resouce Text"  />
                                               
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header cursor-pointer">
                                    <div class="card-title m-0"></div>
                                    <button type="submit" id="save_btn"
                                        class="btn btn-sm text-light btn-primary align-self-center">Save</button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editForm = document.getElementById('kt_video_form');
            const saveButton = document.getElementById('save_btn');

            if (editForm && saveButton) {
                saveButton.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    if (validateForm(editForm)) {
                        showSaveConfirmation(editForm);
                    }
                });
            }
        });

        function validateForm(form) {
            let isValid = true;

            form.querySelectorAll('input[required]').forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            return isValid;
        }

        function showSaveConfirmation(form) {
            Swal.fire({
                title: 'Confirm',
                text: 'Are you sure you want to save the changes?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, save it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
@endsection
