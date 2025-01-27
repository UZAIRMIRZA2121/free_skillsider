@extends('layouts.admin.master')

@section('admin')
    <style>
        .error {
            color: red;
        }

        .is-invalid {
            border-color: red;
        }

        .is-valid {
            border-color: green;
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
                        <li class="breadcrumb-item text-muted">Single student</li>
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
                    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                        <!--begin::Card header-->
                        <div class="card-header cursor-pointer">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Profile Details</h3>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Action-->
                            <a href="{{ route('users.index') }}"
                                class="btn btn-sm text-light btn-primary align-self-center">Back</a>
                            <!--end::Action-->
                            <!--begin::Card header-->

                        </div>
                        <!--begin::Input group-->
                        @if (Session::has('message'))
                            <div class=" text-danger">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <div class="card-body p-9">
                            <!-- Your form -->
                            <form id="kt_sign_up_form" method="POST" enctype="multipart/form-data"
                                action="{{ Auth::user()->role == 1 ? route('admin.update.profile', $single_user->id) : route('users.update', $single_user->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row fv-row mb-7">
                                    <x-validation-errors class="mb-4" />
                                    <!-- Begin::Col -->
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <label class="form-label fw-bolder text-dark fs-6">First Name<span
                                                class="text-danger">*</span></label>
                                        <input id="fname" class="form-control form-control-lg form-control-solid"
                                            type="text" name="first_name" readonly 
                                            value="{{ $single_user->first_name }}" />
                                    </div>
                                    <!-- End::Col -->
                                    <!-- Begin::Col -->
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <label class="form-label fw-bolder text-dark fs-6">Last Name<span
                                                class="text-danger">*</span></label>
                                        <input id="lname" class="form-control form-control-lg form-control-solid"
                                            type="text" name="last_name" readonly
                                            value="{{ $single_user->last_name }}" />
                                    </div>
                                    <!-- End::Col -->
                                </div>
                                <!-- End::Input group -->
                                <!-- Begin::Input group -->
                                <div class="row mb-7">
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <label class="form-label fw-bolder text-dark fs-6">Email<span
                                                class="text-danger">*</span></label>
                                        <input id="email" class="form-control form-control-lg form-control-solid"
                                            type="email" name="email" readonly value="{{ $single_user->email }}" />
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <label class="form-label fw-bolder text-dark fs-6">Mobile number<span
                                                class="text-danger">*</span></label>
                                        <input id="phone" class="form-control form-control-lg form-control-solid"
                                            type="number" name="phone" {{ $single_user->phone == null ? '' : 'readonly' }}
                                            value="{{ $single_user->phone }}" />
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <label class="form-label fw-bolder text-dark fs-6">Name on ID Card<span
                                                class="text-danger">*</span></label>
                                        <input id="id_card_name" class="form-control form-control-lg form-control-solid"
                                            type="text" name="id_card_name" required
                                            value="{{ $single_user->id_card_name }}" />
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-12 has-validation">
                                        <label class="form-label fw-bolder text-dark fs-6">ID card Number<span
                                                class="text-danger">*</span></label>
                                        <input id="id_card_number" class="form-control form-control-lg form-control-solid"
                                            type="text" name="id_card_number" required
                                            value="{{ $single_user->id_card_number }}" />
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <label class="form-label fw-bolder text-dark fs-6">Date of Birth<span
                                                class="text-danger">*</span></label>
                                        <input id="dob" class="form-control form-control-lg form-control-solid"
                                            type="date" name="dob" required value="{{ $single_user->dob }}" />
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <label class="form-label fw-bolder text-dark fs-6">Gender<span
                                                class="text-danger">*</span></label>
                                        <div class="d-flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="male"
                                                    value="male" {{ $single_user->gender == 'male' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check mx-2">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="female" value="female"
                                                    {{ $single_user->gender == 'female' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <label class="form-label fw-bolder text-dark fs-6">City<span
                                                class="text-danger">*</span></label>
                                        <input id="city" class="form-control form-control-lg form-control-solid"
                                            type="text" name="city" required value="{{ $single_user->city }}" />
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <label class="form-label fw-bolder text-dark fs-6">Post Code<span
                                                class="text-danger">*</span></label>
                                        <input id="pin_code" class="form-control form-control-lg form-control-solid"
                                            type="text" name="pin_code" required
                                            value="{{ $single_user->pin_code }}" />
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <label class="form-label fw-bolder text-dark fs-6">Select States<span class="text-danger">*</span></label>
                                        <select class="form-select form-select-solid" name="state" data-control="select2" data-placeholder="Select an option">
                                            <option></option>
                                            <option value="Punjab" {{ $single_user->state == 'Punjab' ? 'selected' : '' }}>Punjab</option>
                                            <option value="Sindh" {{ $single_user->state == 'Sindh' ? 'selected' : '' }}>Sindh</option>
                                            <option value="KPK" {{ $single_user->state == 'KPK' ? 'selected' : '' }}>KPK</option>
                                            <option value="Balouchistan" {{ $single_user->state == 'Balouchistan' ? 'selected' : '' }}>Balouchistan</option>
                                            <option value="Azad Kashmir" {{ $single_user->state == 'Azad Kashmir' ? 'selected' : '' }}>Azad Kashmir</option>
                                            <option value="Gilgit Bultistan" {{ $single_user->state == 'Gilgit Bultistan' ? 'selected' : '' }}>Gilgit Bultistan</option>
                                        </select>
                                        @error('state')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                 
                                    <div class="col-md-3 col-lg-3 col-sm-12">
                                        <label class="form-label fw-bolder text-dark fs-6">Profile Image<span
                                                class="text-danger">*</span></label>
                                        
                                                <input id="profile_image" class="form-control form-control-lg form-control-solid" 
                                                type="file" name="profile_photo_path" accept="image/jpeg,image/png"  style="width: 124px"
                                                onchange="updateFileName(this)" />
                                            <p class="text-danger">Profile image must be a file of type: jpg, jpeg, png and not
                                                greater than 300 kilobytes.</p>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-sm-12">
                                      
                                        <label class="form-label fw-bolder text-dark fs-6">Current Image</label> <br>
                                                <!--begin::Label-->
                                            <!--end::Input group-->
                                            @if (Auth::user()->profile_photo_path)
                                                <img src="{{ asset('profile-image/' . Auth::user()->profile_photo_path) }}"
                                                    height="140" width="140" class="rounded-3"
                                                    alt="user" />
                                            @else
                                                <img src="{{ asset('assets/images/defaultprofile.jpg') }}"
                                                    class="rounded-3 " height="140" width="140"
                                                    alt="user" />
                                            @endif
                                            <!--end::Image input-->
                                    </div>
                                    <div class="col-md-6 col-lg-12 col-sm-12">
                                        <label class="form-label fw-bolder text-dark fs-6">Address<span
                                                class="text-danger">*</span></label>
                                        <textarea id="address" class="form-control form-control-lg form-control-solid" name="address" cols="10"
                                            rows="4">{{ $single_user->address }}</textarea>
                                    </div>
                                </div>
                                <!-- End::Input group -->

                                <!-- Begin::Input group -->
                                <div class="row mb-7">
                                  
                                </div>
                                <!-- End::Input group -->

                                <!-- Begin::Actions -->
                                <div class="text-center">
                                    <button id="butsave" class="btn btn-primary my-5" style="float: right;"
                                        type="submit">
                                        {{ __('Update ') }}
                                    </button>
                                </div>
                                <!-- End::Actions -->
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
    @if (Auth::check() && Auth::user()->role == 0)
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger" style="background-color: #4d3185">
                        <h5 class="modal-title text-light" id="exampleModalLabel"
                            style="
                                            font-weight: 1000;
                                            font-size: 20px;">
                            <b>Must Watch This Video</b> </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-dark p-0">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" id="videoFrame" style="min-height: 300px; width: 100%;"
                                src="https://www.youtube.com/embed/792zl8eUE7w?si=KGzx-lnOVCsXr7cU"
                                title="YouTube video player" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <!-- Initialize jQuery validation -->
    <script>
        $(document).ready(function() {
            // Initialize form validation
            $("#kt_sign_up_form").validate({
                rules: {
                    first_name: {
                        required: true,
                        minlength: 2
                    },
                    last_name: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 15
                    },
                    id_card_name: {
                        required: true
                    },
                    id_card_number: {
                        required: true,
                        digits: true
                    },
                    dob: {
                        required: true,
                        date: true
                    },
                    gender: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    pin_code: {
                        required: true,
                        digits: true,
                        minlength: 5,
                        maxlength: 10
                    },
                    address: {
                        required: true
                    },
                    profile_photo_path: {
                        required: false,
                        extension: "jpg|jpeg|png",
                        filesize: 300000 // File size in bytes (300 KB)
                    }
                },
                messages: {
                    profile_photo_path: {
                        extension: "Please upload a file with one of the following extensions: jpg, jpeg, png",
                        filesize: "File must be less than 300 KB"
                    }
                },
                errorClass: "error",
                highlight: function(element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                }
            });

            // Custom method to validate file size
            $.validator.addMethod("filesize", function(value, element, maxSize) {
                if (element.files.length > 0) {
                    var fileSize = element.files[0].size;
                    return fileSize <= maxSize;
                }
                return true;
            }, "File size is too big.");
        });
    </script>



    <script>
        $(document).ready(function() {
            // Automatically open the modal on page load
            $('#myModal').modal('show');

            // Stop video when the modal is closed
            $('#myModal').on('hidden.bs.modal', function() {
                var $iframe = $(this).find('iframe');
                var tempSrc = $iframe.attr('src');
                $iframe.attr('src', '');
                $iframe.attr('src', tempSrc);
            });
        });
    </script>
    @push('custom-scripts')
        <script>
            function verifyStudent(verificationUrl) {
                Swal.fire({
                    title: 'Verify Student',
                    text: 'Are you sure you want to verify this student?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Verify',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#dc3545'
                }).then(result => {
                    if (result.isConfirmed) {
                        window.location.href = verificationUrl;
                    }
                });
            }

            function onClick(element) {
                document.getElementById("img01").src = element.src;
                document.getElementById("modal01").style.display = "block";
            }
        </script>
    @endpush
@endsection
