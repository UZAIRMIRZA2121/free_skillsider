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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Coupon Management</h1>
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
                        <li class="breadcrumb-item text-muted">Add Coupen</li>
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
                                <h3 class="fw-bold ">Add Coupen</h3>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Action-->
                            <a href="{{ route('packages.index') }}"
                                class="btn btn-sm text-light btn-primary align-self-center">Back</a>
                            <!--end::Action-->

                        </div>

                        <div>
                            <form class="package_form form w-100" novalidate="novalidate" id="kt_sign_up_form"
                            method="POST" enctype="multipart/form-data" action="{{ route('coupons.store') }}">
                          @csrf
                          <div class="row pt-6">
                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-10">
                                    <label for="coupen_code" class="required form-label">Coupon Name</label>
                                    <input type="text" name="name" class="form-control form-control-solid" value="{{ old('name') }}"
                                           placeholder="Coupon Code" />
                                    @error('name')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                              <div class="col-lg-6 col-sm-12">
                                  <div class="mb-10">
                                      <label for="coupen_code" class="required form-label">Coupon Code</label>
                                      <input type="text" name="code" class="form-control form-control-solid" value="{{ old('code') }}"
                                             placeholder="Coupon Code" />
                                      @error('code')
                                          <span class="error text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>
                              </div>
                      
                              <div class="col-lg-6 col-sm-12">
                                  <div class="mb-10">
                                      <label for="percentage" class="required form-label">Percentage (%)</label>
                                      <input type="number" name="percentage" class="form-control form-control-solid" placeholder="Percentage" 
                                             required value="{{ old('percentage') }}" />
                                      @error('percentage')
                                          <span class="error text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>
                              </div>
                              <!-- Start Date -->
                              <div class="col-lg-6 col-sm-12">
                                  <div class="mb-10">
                                      <label for="start_date" class="required form-label">Start Date</label>
                                      <input type="date" name="start_date" class="form-control form-control-solid" value="{{ old('start_date') }}" required />
                                      @error('start_date')
                                          <span class="error text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>
                              </div>
                      
                              <!-- End Date -->
                              <div class="col-lg-6 col-sm-12">
                                  <div class="mb-10">
                                      <label for="end_date" class="required form-label">End Date</label>
                                      <input type="date" name="end_date" class="form-control form-control-solid" value="{{ old('end_date') }}" required />
                                      @error('end_date')
                                          <span class="error text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>
                              </div>
                              <div class="col-lg-6 col-sm-12">
                                <div class="mb-10">
                                    <label class="required form-label">All Packages</label>
                                    <div class="form-check">
                                        <!-- Loop through all packages and create a checkbox for each one -->
                                        @foreach ($all_packages as $package)
                                            <div class="form-check mt-3">
                                                <input class="form-check-input" type="checkbox" name="all_packages[]" value="{{ $package->id }}"
                                                       id="package_{{ $package->id }}" {{ in_array($package->id, old('all_packages', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="package_{{ $package->id }}">
                                                    {{ $package->package_title }} <!-- Display package name -->
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('all_packages')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                      
                          </div>
                      
                          <div class="card-header cursor-pointer">
                              <div class="card-title m-0"></div>
                              <button type="submit" id="save_btn" class="btn btn-sm text-light btn-primary align-self-center mb-5 mt-20">Save</button>
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
