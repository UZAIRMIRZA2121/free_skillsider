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
                        <li class="breadcrumb-item text-muted">Edit Package</li>
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
                            <form class="package_form form w-100" novalidate="novalidate" id="kt_edit_form"
                                enctype="multipart/form-data" action="{{ route('packages.update', $package->id) }}"
                                method="POST">

                                @csrf
                                @method('PUT')
                                <div class="row pt-6">
                                    <div class="row pt-6">
                                        <div class="col-lg-4 col-sm-12">
                                            <div class="mb-10">
                                                <label for="package_title" class="required form-label">Package Title</label>
                                                <input type="text" name="package_title"
                                                    class="form-control form-control-solid"
                                                    value="{{ $package->package_title }}" placeholder="Package Title"
                                                    required />
                                                <div class="invalid-feedback" id="package_title_error"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-12">
                                            <div class="mb-10">
                                                <label for="price" class="required form-label">Price</label>
                                                <input type="number" name="price" class="form-control form-control-solid"
                                                    value="{{ $package->price }}" placeholder="Price" required />
                                                <div class="invalid-feedback" id="price_error"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <div class="mb-10">
                                                <label for="color_code" class="required form-label">Color Code</label>
                                                <input type="text" name="color_code" id="color_code" class="form-control form-control-solid"
                                                    placeholder="Color code" required  value="{{ $package->color_code }}"/>
                                                    @error('color_code')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <div class="mb-10">
                                                <label for="text_color_code" class="required form-label">Text Color Code</label>
                                                <input type="text" name="text_color_code" id="text_color_code" class="form-control form-control-solid"
                                                    placeholder="Text color code" required  value="{{ $package->text_color_code }}"/>
                                                    @error('color_code')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                        </div>
                                      
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-10">
                                                <label for="package_image" class="required form-label">Package Image</label>
                                                <input type="file" name="image" class="form-control form-control-solid"
                                                    accept="image/png, image/jpeg, image/jpg" />
                                                <div class="invalid-feedback" id="image_error"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                            <div class="mb-10">
                                                <label for="first_percentage (%)" class="required form-label">First Percentage (%)</label>
                                                <input type="number" name="first_percentage" id="first_percentage" class="form-control form-control-solid"
                                                   placeholder="First Percentage (%)"  value="{{ $package->first_percentage }}" required />
                                                    @error('first_percentage')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                            <div class="mb-10">
                                                <label for="second_percentage" class="required form-label">Second Percentage (%) </label>
                                                <input type="number" name="second_percentage" id="second_percentage" class="form-control form-control-solid"
                                                   placeholder="Second Percentage (%)"  value="{{ $package->second_percentage }}" required />
                                                    @error('second_percentage')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                        </div>
                                       @foreach($commission_structure as $struture)
                                        <div class="col-lg-3 col-sm-12">
                                            <div class="mb-10">
                                                <label for="commission_structure" class="required form-label">{{$struture->secondPackage->package_title}} </label>
                                                <input type="number" name="amount[{{ $struture->id }}]" id="commission_structure" class="form-control form-control-solid"
                                                   placeholder="Amount"  value="{{ $struture->amount ?? 'Amount' }}"  />
                                            </div>
                                        </div>
                                      @endforeach
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-10">
                                                <label for="package_image" class="required form-label">Current Image  </label>
                                                <br>
                                                <img src="{{ asset('packages_image/' . $package->image) }}" width="100"
                                                    alt="" />
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                    $courseIds = explode(',', $package->course_id); // Convert the string to an array
                                 @endphp
                                 
                                 @foreach ($courses as $course)
                                     <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
                                         <div class="form-check" id="courses">
                                             <input
                                                 class="form-check-input course-checkbox" 
                                                 {{ in_array($course->id, $courseIds) ? 'checked' : '' }}
                                                 type="checkbox" 
                                                 value="{{ $course->id }}"
                                                 id="{{ $course->id }}" />
                                             <label class="form-check-label" for="{{ $course->id }}">
                                                 {{ $course->course_title }}
                                             </label>
                                         </div>
                                     </div>
                                 @endforeach
                                 <input type="hidden" name="course_id" id="courses_id" value="{{$package->course_id}}">
                                 
                                    <div class="col-12">

                                        <div id="editor">{!! html_entity_decode($package->description) !!}</div>
                                        <textarea name="description" style="display: none;"> {!! html_entity_decode($package->description) !!}</textarea>
                                    </div>
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
    
        // Iterate through checkboxes to initialize checkedValues array
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                checkedValues.push(checkbox.value);
            }
    
            // Add event listener to each checkbox
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
    
                // Update the input field's value with the selected values
                document.getElementById("courses_id").value = checkedValues.join(',');
    
                // Display an alert to show the selected values
                // alert(checkedValues);
            });
        });
    </script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editForm = document.getElementById('kt_edit_form');
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
            document.querySelector('textarea[name="description"]').value = html;
        });
    </script>


@endsection
