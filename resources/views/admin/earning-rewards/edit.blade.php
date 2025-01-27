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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Reward
                        Management</h1>
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
                        <li class="breadcrumb-item text-muted">Reward</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item text-muted">Reward Course</li>

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
                                <h3 class="fw-bold ">Edit Reward</h3>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Action-->
                            <a href="{{ route('earning-rewards.index') }}"
                                class="btn btn-sm text-light btn-primary align-self-center">Back</a>
                            <!--end::Action-->

                        </div>

                        <div>
                            <form class="Course_form form w-100" novalidate="novalidate" id="kt_course_form"
                            method="POST" enctype="multipart/form-data"
                            action="{{ route('earning-rewards.update', ['earning_reward' => $earningReward->id]) }}">
                          @csrf
                          @method('PUT')
                                    <div class="row  pt-6">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-10">
                                                <label class="required form-label">Reward Name</label>
                                                <input type="text" name="name" class="form-control form-control-solid"
                                                   value="{{$earningReward->name}}"  placeholder="Reward Name"  required />
    
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-10">
                                                <label class="required form-label">Reward </label>
                                                <input type="text" name="reward" class="form-control form-control-solid"
                                                   value="{{$earningReward->reward}}"  placeholder="Reward Amount" required min="1" />
    
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-10">
                                                <label class="required form-label">Target Amount</label>
                                                <input type="number" name="target_amount" class="form-control form-control-solid"
                                                    placeholder="Target Amount" required min="1"  value="{{$earningReward->target_amount}}" />
    
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <!--begin::Input group-->
                                            <label class="required form-label">Date</label>
                                            <div class="input-group mb-5">
    
                                                <input type="date" class="form-control" value="{{$earningReward->start_date}}"  placeholder="Start Date"
                                                    aria-label="Start Date" name="start_date" />
                                                <span class="input-group-text">To</span>
                                                <input type="date" class="form-control" value="{{$earningReward->end_date}}"  placeholder="End Date"
                                                    aria-label="End Date" name="end_date" />
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6 col-sm-12">
                                            <div class="mb-10">
                                                <label class="required form-label">Reward Image</label>
                                                <input type="file"  class="form-control form-control-solid"
                                                   value="{{$earningReward->image}}"  placeholder="Reward Amount" required min="1" name="image" />
    
                                            </div>
                                        </div> --}}
                                        <!--end::Input group-->
    
                                    </div>
    
                                    <div class="card-header cursor-pointer">
                                        <div class="card-title m-0"></div>
                                        <button type="submit" id="save_btn"
                                            class="btn btn-sm text-light btn-primary align-self-center ">Update</button>
                                    </div>
                            </form>

                       

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
