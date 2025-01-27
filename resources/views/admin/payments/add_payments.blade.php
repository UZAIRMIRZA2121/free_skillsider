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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Payment
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
                        <li class="breadcrumb-item text-muted">Payments</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Add Payment</li>
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
                                <h3 class="fw-bold ">Add Payment</h3>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Action-->
                            <a href="{{ Auth::user()->role == 1 ? route('payment.admin.index') : route('student.payments') }}"
                                class="btn btn-sm text-light btn-primary align-self-center">Back</a>
                             


                            <!--end::Action-->

                        </div>

                        <div>
                            <form class="package_form form w-100" novalidate="novalidate" id="kt_sign_up_form"
                                method="POST" enctype="multipart/form-data"
                                action="{{ Auth::user()->role == 1 ? route('payment.admin.store') : route('payments.store') }}">
                                @csrf
                                <div class="row pt-6">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-10">
                                            <label for="bank" class="required form-label">Bank</label>
                                            <input type="text" name="bank" class="form-control form-control-solid"
                                                value="{{ old('bank') }}" placeholder="Bank" />
                                            @error('bank')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    @if (Auth::user()->role == 1)
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-10">
                                                <label for="logo" class="form-label">Logo</label>
                                                <input type="file" name="logo" id="logo"
                                                    class="form-control form-control-solid"
                                                    accept="image/png, image/jpeg, image/jpg" value="{{ old('Logo') }}" />

                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-10">
                                            <label for="account_name" class="required form-label">Account Name</label>
                                            <input type="text" name="account_name"
                                                class="form-control form-control-solid" placeholder="Account Name" required
                                                value="{{ old('account_name') }}" />
                                            @error('account_name')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-10">
                                            <label for="account_number" class="required form-label">Account Number</label>
                                            <input type="text" name="account_number"
                                                class="form-control form-control-solid" placeholder="Account Number"
                                                required value="{{ old('account_number') }}" />
                                            @error('account_number')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
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
