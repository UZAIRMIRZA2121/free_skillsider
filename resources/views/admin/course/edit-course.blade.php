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
                        <li class="breadcrumb-item text-muted">Edit Course</li>

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
                                <h3 class="fw-bold ">Edit Course</h3>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Action-->
                            <a href="{{ route('courses.index') }}"
                                class="btn btn-sm text-light btn-primary align-self-center">Back</a>
                            <!--end::Action-->

                        </div>

                        <div>
                            <form class="Course_form form w-100" novalidate="novalidate" id="kt_course_form"
                            method="POST" enctype="multipart/form-data"
                            action="{{ route('courses.update', $courses->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row pt-6">
                                <!-- Course Title -->
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-10">
                                        <label for="Course_title" class="required form-label">Course Title</label>
                                        <input type="text" name="course_title"
                                            class="form-control form-control-solid" placeholder="Course Title"
                                            value="{{ $courses->course_title }}" required />
                                        <div class="invalid-feedback" id="Course_title_error"></div>
                                    </div>
                                </div>
                        
                                <!-- Course Image -->
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-10">
                                        <label for="image" class="required form-label">Course Image</label>
                                        <input type="file" name="image" class="form-control form-control-solid" />
                                        @error('image')
                                        <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                        
                                <!-- Display Current Image -->
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-10">
                                        <label for="current_image" class="form-label">Current Course Image</label> <br>
                                        <img class="ms-10 mt-5" src="{{ asset('course-image/' . $courses->image) }}" alt="" width="100">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-10">
                                        <label for="seq" class="required form-label">Course Sequence</label>
                                        <input type="number" name="course_seq" class="form-control form-control-solid" id="seq"   value="{{ $courses->course_seq }}" required />
                                        @error('seq')
                                        <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Course Type -->
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-10">
                                        <label class="required form-label">Course Type</label>
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="course_type" id="free_course"
                                                    value="0" {{ $courses->course_type == 0 ? 'checked' : '' }} />
                                                <label class="form-check-label" for="free_course">Free</label>
                                            </div>
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="course_type" id="paid_course"
                                                    value="1" {{ $courses->course_type == 1 ? 'checked' : '' }} />
                                                <label class="form-check-label" for="paid_course">Paid</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course_type" id="both_course"
                                                    value="2" {{ $courses->course_type == 2 ? 'checked' : '' }} />
                                                <label class="form-check-label" for="both_course">Both</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- Submit Button -->
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
            const editForm = document.getElementById('kt_course_form');
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
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Initialize Quill editor -->
    <script>
        const quill = new Quill('#editor', {
            theme: 'snow'
        });

        quill.on('text-change', () => {
            const html = quill.root.innerHTML;
            document.querySelector('textarea[name="content"]').value = html;
        });
    </script>
@endsection
