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
                    {{-- <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Discount Codes</h1> --}}
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
                        <li class="breadcrumb-item text-muted">Discount Details</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card  mb-2">
                    <div class="card-header cursor-pointer w-100 text-center">
                        <h1 class="d-block m-auto"> <span> <img src="{{ asset('sidebaricon/coupon.png') }}" alt=""
                                    width="30px" class="mx-3 mb-3">Discount Codes</span></h1>
                        
                    </div>
            </div>
                <!--begin::Navbar-->
                <div class="card mb-5 mb-xxl-8">
                    <div class="card-body pt-0  pb-0">
                        <div class="card-header cursor-pointer">
                            <!--begin::Card title-->
                           
                            <!--end::Card title-->
                        
                        </div>
                        <table id="kt_datatable_dom_positioning"
                            class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                    <th>Sr.No</th>
                                    <th>Coupon Name</th>
                                    <th>Coupon Code</th>
                                    <th>Discount</th>
                                    <th>Status</th>
                                    <th>Packages</th>
                                    {{-- <th>Start Date</th>
                                    <th>End Date</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td> {{ $i++ }} </td>
                                        <td>{{ $coupon->name ?? 'N/A' }}</td>
                                        <td> <b> {{ $coupon->code }}</b></td>
                                        <td>{{ $coupon->percentage }} <b>%</b></td>
                                        <td>
                                            @if ($coupon->status == 1)
                                                <span class="badge badge-lg badge-success">Active</span>
                                            @else
                                                <span class="badge badge-lg badge-danger">Deactivate</span>
                                            @endif
                                        </td>
                                        <td>
                                            @foreach($coupon->packages as $package)
                                                @php
                                                    $after_dis_amount = ceil($package->price - ($package->price * $coupon->percentage) / 100);
                                                @endphp
                                                {{ $package->package_title }} 
                                                <del class="text-danger">{{ $package->price }}</del> 
                                                <b class="text-success">{{ $after_dis_amount }}</b>  
                                                <br>
                                            @endforeach
                                        </td>
                                        {{-- <td>{{ $coupon->start_time }}</td>
                                        <td>{{ $coupon->end_time }}</td> --}}
                                        <td>
                                            <div class="d-flex gx-3">
                                                <!-- Add the data-coupon-code attribute -->
                                                <button class="btn btn-sm btn-light-info menu-link copy-btn" 
                                                        data-coupon-code="{{ $coupon->code }}">Copy Code</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>
                <!--end::Navbar-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    // Attach click event to all copy buttons
    document.querySelectorAll(".copy-btn").forEach(function (button) {
        button.addEventListener("click", function () {
            // Get the coupon code from the data attribute
            const couponCode = this.getAttribute("data-coupon-code");

            // Reference to the current button
            const currentButton = this;

            // Copy the coupon code to the clipboard
            navigator.clipboard.writeText(couponCode).then(function () {
                // Change button text to "Copied"
                currentButton.textContent = "Code Copied";

                // Optionally, reset the button text after 2 seconds
                setTimeout(function () {
                    currentButton.textContent = "Copy Code";
                }, 2000);
            }).catch(function (error) {
                // Handle any errors
                console.error("Failed to copy code: ", error);
            });
        });
    });
});


    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success',
                text: '{{ session('success') }}',
                icon: 'success'
            });
        </script>
    @endif
    @push('custom-scripts')
        <script>
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 3000); // <-- time in milliseconds
            $("#kt_datatable_dom_positioning").DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom": "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">"
            });

            /////sweet--alert---///
            const deleteButtons = document.querySelectorAll('[id^="delete-package-"]');

            deleteButtons.forEach(button => {
                button.addEventListener('click', e => {
                    const packageId = button.id.split('-')[2]; // Extract the package ID from the button's ID
                    e.preventDefault();

                    Swal.fire({
                        title: 'Delete Package',
                        text: 'Are you sure you want to delete this package?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Delete',
                        cancelButtonText: 'Cancel',
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6'
                    }).then(result => {
                        if (result.isConfirmed) {
                            const deleteForm = document.getElementById('delete-form-' + packageId);
                            deleteForm.submit();
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
