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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Students Management</h1>
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
                            <a href="{{ route('students.management.index') }}"
                                class="btn btn-sm text-light btn-primary align-self-center">Back</a>
                            <!--end::Action-->
                        </div>
                        <!--begin::Card header-->

                        <!--begin::Card body-->
                        <div class="card-body p-9">
                            <!--begin::Row-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-semibold text-muted">Full Name</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $single_students->first_name }}
                                        {{ $single_students->last_name }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->

                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-semibold text-muted">Email</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <span class="fw-semibold text-gray-800 fs-6">{{ $single_students->email }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-semibold text-muted">Package</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <span class="fw-semibold text-gray-800 fs-6">{{ $single_students->package->package_title }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-semibold text-muted">
                                    Contact Phone
                                    <span class="ms-1" data-bs-toggle="tooltip" aria-label="Phone number must be active"
                                        data-bs-original-title="Phone number must be active" data-kt-initialized="1">
                                        <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span></i> </span>
                                </label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-8 d-flex align-items-center">
                                    <span class="fw-bold fs-6 text-gray-800 me-2">{{ $single_students->phone }}</span>

                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-semibold text-muted">Status</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    @if ($single_students->status == 1)
                                        <span class="badge badge-lg badge-success">Verified</span>
                                    @else
                                        <span class="badge badge-lg badge-danger">Not Verified</span>
                                    @endif
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-semibold text-muted">
                                    State

                                    <span class="ms-1" data-bs-toggle="tooltip" aria-label="Country of origination"
                                        data-bs-original-title="Country of origination" data-kt-initialized="1">
                                        <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span></i> </span>
                                </label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-8">

                                    <span class="fw-bold fs-6 text-gray-800">{{ $single_students->state }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-semibold text-muted">Referral by</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span
                                        class="fw-semibold fs-6 text-gray-800 text-hover-primary">{{ $single_students->referral_by }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-semibold text-muted">Referral code</label>
                                <!--end::Label-->

                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $single_students->referral_code }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-10">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-semibold text-muted">Coupen code</label>
                                <!--begin::Label-->

                                <!--begin::Label-->
                                <div class="col-lg-8">
                                    <span class="fw-semibold fs-6 text-gray-800">{{ $single_students->coupen_code }}</span>
                                </div>
                                <!--begin::Label-->
                            </div>
                            <!--end::Input group-->
                             <!--begin::Input group-->
                             <div class="row mb-10">
                                <!--begin::Label-->
                                <label class="col-lg-4 fw-semibold text-muted">Paid Amount</label>
                                <!--begin::Label-->

                                <!--begin::Label-->
                                <div class="col-lg-8">
                                    <span
                                        class="fw-semibold fs-6 text-gray-800">{{ $single_students->paid_amount }}</span>
                                </div>
                                <!--begin::Label-->
                            </div>
                            <!--end::Input group-->


                            <!--begin::Notice-->

                            <br>
                            <!--end::Notice-->





                            <div class="w3-row-padding">
                                <div class="w3-container w3-third">
                                    <img src="{{ asset('payment_image/' . $single_students->payment_image) }}"
                                        style="width:100%;cursor:pointer" onclick="onClick(this)" class="w3-hover-opacity">
                                </div>

                            </div>
                            <div id="modal01" class="w3-modal" onclick="this.style.display='none'">
                                <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
                                <div class="w3-modal-content w3-animate-zoom" style="width:500px;">
                                    <img id="img01" style="width:100%; display:block; margin:0 auto; ">
                                </div>
                            </div>
                            <!--begin::Card header-->
                            <div class="card-header cursor-pointer">
                                <!--begin::Card title-->
                                <div class="card-title m-0">

                                </div>
                                <!--end::Card title-->
                                <!--begin::Action-->
                                @if ($single_students->status == 0)
                                   
                                <a href="#" class="btn btn-sm text-light btn-success align-self-center"
                                onclick="event.preventDefault(); verifyStudent('{{ route('students.management.verify', ['management' => $single_students->id]) }}');">
                                 Verify
                             </a>
                             @else
                                       
                                    <a href="#" class="btn btn-sm text-light btn-danger align-self-center"
                                onclick="event.preventDefault(); RejectStudent('{{ route('students.management.verify', ['management' => $single_students->id]) }}');">
                                 Reject
                             </a>
                                @endif

                                <!--end::Action-->


                            </div>
                            <!--begin::Card header-->
                        </div>
                        <!--end::Card body-->
                    </div>
                </div>
                <!--end::Navbar-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->

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
    
             function RejectStudent(verificationUrl) {
        Swal.fire({
            title: 'Reject Student',
            text: 'Are you sure you want to reject this student?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Reject',
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
