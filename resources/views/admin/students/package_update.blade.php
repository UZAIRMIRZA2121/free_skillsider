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
                    {{-- <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Students Management</h1> --}}
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
                <div class="card  mb-2">
                    <div class="card-header cursor-pointer w-100 text-center">
                        <h1 class="d-block m-auto"> <span> <img src="{{ asset('sidebaricon/upgrade.png') }}" alt=""
                                    width="30px" class="mx-3 mb-3">Package Upgrade</span></h1>
                        
                    </div>
            </div>
                <!--begin::Navbar-->
                <div class="card mb-5 mb-xxl-8">
                    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                        <!--begin::Card header-->
                        <div class="card-header cursor-pointer">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                {{-- <h3 class="fw-bold m-0">Profile Details</h3> --}}
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
                            @if (Auth::user()->role == 0)
                            <div class="" id="kt_tab_pane_3" role="tabpanel">
                                <form class="form w-100" id="kt_sign_up_form" method="POST"
                                    enctype="multipart/form-data"
                                    action="{{ route('package.upgrade', Auth::user()->id) }}">
                                    @csrf
                                    <div class="row mb-5 ">
                                        <!--begin::Radio group-->
                                        <div data-kt-buttons="true">
                                            <!--begin::Radio button-->
                                            @foreach ($packages as $key => $package)
                                                <?php
                                                $current_price = Auth::user()->package->price;
                                                $next_price = $package->price;
                                                $new_price = $next_price - $current_price;
                                                // echo $new_price;
                                                ?>
                                                <label
                                                    class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-6 mb-5   {{ Auth::user()->package_id == $package->id ? 'active' : (Auth::user()->package_id >= $package->id ? 'disabled' : '') }}">
                                                    <!--end::Description-->
                                                    <div class="d-flex align-items-center me-2">
                                                        <div
                                                            class="form-check form-check-custom form-check-solid form-check-primary me-6">
                                                            <input class="form-control form-check-input"
                                                                {{ Auth::user()->package_id == $package->id ? 'disabled' : '' }}
                                                                type="radio" name="package_id"
                                                                value="{{ $package->id }}"
                                                                data-id="{{ $package->price }}" />


                                                            <!-- Add the 'checked' attribute to the first radio button -->
                                                        </div>
                                                        <!--end::Radio-->
                                                        <!--begin::Info-->
                                                        <div class="flex-grow-1">
                                                            <h2
                                                                class="d-flex align-items-center fs-3 fw-bold flex-wrap">
                                                                {{ $package->package_title }}
                                                            </h2>
                                                            <div class="fw-semibold opacity-50">
                                                                {{-- Best for startups --}}
                                                            </div>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                    <!--end::Description-->
                                                    <!--begin::Price-->
                                                    @if($new_price < 0)
                                                    <div class="ms-5">
                                                        {{-- <span class="mb-2">Rs</span> --}}
                                                        <span class="fs-1x fw-bold"
                                                            data-package-price=" {{ $package->price }}"
                                                            id="discounted_price_{{ $key }}">
                                                          <b>Can't Select</b>  
                                                        </span>
                                                    </div>
                                                    @elseif($new_price > 0)
                                                    <div class="ms-5">
                                                        <span class="mb-2">Rs</span>
                                                        <span class="fs-2x fw-bold"
                                                            data-package-price=" {{ $package->price }}"
                                                            id="discounted_price_{{ $key }}">
                                                            {{ $new_price }}
                                                        </span>

                                                        {{-- <span class="fs-7 opacity-50">/
                                                            <span data-kt-element="period">Course</span>
                                                        </span> --}}
                                                    </div>
                                                    @else
                                                    <div class="ms-5">
                                                        {{-- <span class="mb-2">Rs</span> --}}
                                                        <span class="fs-1x fw-bold"
                                                            data-package-price=" {{ $package->price }}"
                                                            id="discounted_price_{{ $key }}">
                                                         <b> Already Subscribe</b>  
                                                        </span>
                                                    </div>






                                                    @endif
                                                    <!--end::Price-->
                                                </label>
                                                <!--end::Radio button-->
                                            @endforeach

                                        </div>
                                        <div class="col-6 mb-7">
                                            <label class="form-label fw-bolder text-dark fs-6" data-bs-toggle="modal"
                                                data-bs-target="#payment_method_show">Payment method <span
                                                    class="text-danger">*</span></label> <br>
                                            <input type="button" class="btn btn-lg btn-primary w-100 "
                                                data-bs-toggle="modal" data-bs-target="#payment_method_show"
                                                value="Payment Method">
                                        </div>

                                        <div class="col-6 mb-7">
                                            <label class="form-label fw-bolder text-dark fs-6">Transaction ID <span
                                                class="text-danger">*</span></label>
                                            <x-input id="payment_image"
                                                class="form-control form-control-lg form-control-solid" type="text"
                                                name="trx_id" required />
                                            @error('payment_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        {{-- <div class="col-12 mb-7">
                                            <label class="form-label fw-bolder text-dark fs-6">Message</label>
                                            <textarea id="payment_image" class="form-control form-control-lg form-control-solid" name="message" required></textarea>
                                            @error('payment_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div> --}}
                                    </div>
                                    <!--begin::Actions-->
                                    <div class="text-end pb-5">

                                        <x-button class="btn btn-lg btn-primary w-10" type="submit">
                                           Request Upgrade <i class="fa-solid fa-arrow-right"></i>
                                        </x-button>
                                    </div>
                                    <!--end::Actions-->
                                </form>


                            </div>
                        @endif
                         
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
   <!-- Modal -->
   <div class="modal fade" id="payment_method_show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Do You Have a Referral
                    Code?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="row modal-body  ">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Bank</th>
                            <th>Account Name</th>
                            <th>Account Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payment_methods as $payment_method)
                            <tr>
                                <td> <img src="{{ asset('payment-method-image/' . $payment_method->logo) }}"
                                        width="50" alt=""></td>
                                <td>{{ $payment_method->bank }}</td>
                                <td>{{ $payment_method->account_name }}</td>
                                <td>{{ $payment_method->account_number }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>


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
