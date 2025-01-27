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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Package Management</h1>
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
                        <li class="breadcrumb-item text-muted">Packages</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Add Package</li>
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
                                <h3 class="fw-bold ">Add Package</h3>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Action-->
                            <a href="{{ route('packages.index') }}"
                                class="btn btn-sm text-light btn-primary align-self-center">Back</a>
                            <!--end::Action-->

                        </div>
                   
                        <div>
                            <form class="package_form form w-100" novalidate="novalidate" id="kt_sign_up_form"
                                method="POST" enctype="multipart/form-data" action="{{ route('packages.store') }}">
                                @csrf
                                <div class="row pt-6">
                                    <div class="col-lg-4 col-sm-12">
                                        <div class="mb-10">
                                            <label for="package_title" class="required form-label">Package Title</label>
                                            <input type="text" name="package_title"
                                                class="form-control form-control-solid" id="package_title"  value="{{ old('package_title') }}" placeholder="Package Title"
                                                 />
                                                 @error('package_title')
                                                 <span class="error text-danger">{{ $message }}</span>
                                                 @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <div class="mb-10">
                                            <label for="price" class="required form-label">Price</label>
                                            <input type="number" name="price" id="price" class="form-control form-control-solid"
                                                placeholder="Price" required  value="{{ old('price') }}"/>
                                                @error('price')
                                                <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        <div class="mb-10">
                                            <label for="color_code" class="required form-label">Color Code</label>
                                            <input type="text" name="color_code" id="color_code" class="form-control form-control-solid"
                                                placeholder="Color Code" required  value="{{ old('color_code') }}"/>
                                                @error('color_code')
                                                <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        <div class="mb-10">
                                            <label for="text_color_code" class="required form-label">Text Color Code</label>
                                            <input type="text" name="text_color_code" id="text_color_code" class="form-control form-control-solid"
                                                placeholder="Text Color Code" required  value="{{ old('text_color_code') }}"/>
                                                @error('color_code')
                                                <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-10">
                                            <label for="package_image" class="required form-label">Package Image</label>
                                            <input type="file" name="image" id="package_image" class="form-control form-control-solid"
                                                accept="image/png, image/jpeg, image/jpg"  value="{{ old('image') }}" required />
                                                @error('image')
                                                <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                        <div class="mb-10">
                                            <label for="first_percentage (%)" class="required form-label">First Percentage (%)</label>
                                            <input type="number" name="first_percentage" id="first_percentage" class="form-control form-control-solid"
                                               placeholder="First Percentage (%)"  value="{{ old('first_percentage') }}" required />
                                                @error('first_percentage')
                                                <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                        <div class="mb-10">
                                            <label for="second_percentage" class="required form-label">Second Percentage (%) </label>
                                            <input type="number" name="second_percentage" id="second-percentage" class="form-control form-control-solid"
                                               placeholder="Second Percentage (%)"  value="{{ old('second_percentage') }}" required />
                                                @error('second_percentage')
                                                <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="col-12 mb-5">
                                            <label for="courses" class="required form-label">Select Courses:</label>
                                            <div class="row">
                                                @foreach($courses as $course)
                                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
                                                        <div class="form-check" id="courses">
                                                            <input class="form-check-input course-checkbox" name="courseid" type="checkbox" value="{{ $course->id }}" id="{{ $course->id }}" />
                                                            <label class="form-check-label" for="{{ $course->id }}">
                                                                {{ $course->course_title }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
              
                                        
                                    </div>
                                    <input type="hidden" name="course_id" id="courses_id">
                                    </div>
                                    <div class="col-12 mb-5">
                                        <label for="package_image" class="required form-label">Description</label>
                                        <div id="editor"></div>
                                        <textarea name="description" style="display: none;"  value="{{ old('price') }}"></textarea>
                                        @error('description')
                                        <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    

                                <div class="card-header cursor-pointer">
                                    <div class="card-title m-0"></div>
                                    <button type="submit" id="save_btn"
                                        class="btn btn-sm text-light btn-primary align-self-center mb-5 mt-20">Save</button>
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
 var checkedValues = [];

// Get all checkbox elements with class 'course-checkbox'
var checkboxes = document.querySelectorAll('.course-checkbox');

// Add event listener to each checkbox
checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        if (this.checked) {
            // Checkbox is checked, add its value to the array
            checkedValues.push(this.value);
        } else {
            // Checkbox is unchecked, remove its value from the array
            var index = checkedValues.indexOf(this.value);
            if (index !== -1) {
                checkedValues.splice(index, 1);
            }
        }
    document.getElementById("courses_id").value =checkedValues;

        // alert(checkedValues);

    });
});

    </script>
    @if(session('success'))
    <script>
        Swal.fire({
            title: 'Success',
            text: '{{ session('success') }}',
            icon: 'success'
        });
    </script>
@endif
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Initialize Quill editor -->
    <script>
        const quill = new Quill('#editor', {
            theme: 'snow'
        });

        quill.on('text-change', () => {
            const html = quill.root.innerHTML;
            document.querySelector('textarea[name="description"]').value = html;
        });
    </script>
@endsection
