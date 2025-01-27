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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Students
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
                        <li class="breadcrumb-item text-muted">Students Upgrade Request</li>
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
                                <h3 class="fw-bold m-0">Student</h3>
                            </div>
                    
                        </div>
                        <div class="card-title m-0">
                            <!-- Card title -->
                            <ul class="nav nav-tabs flex-nowrap text-nowrap" role="tablist">
                                <!-- Approved Tab -->
                                <li class="nav-item w-100 me-0 mb-md-2" role="presentation">
                                    <a class="nav-link w-100 btn btn-flex btn-active-light-success d-flex justify-content-center align-items-center {{ Route::currentRouteName() == 'upgrade.approved.index' ? 'active' : '' }}"
                                        href="{{ route('upgrade.approved.index') }}" aria-selected="{{ Route::currentRouteName() == 'upgrade.approved.index' ? 'true' : 'false' }}" role="tab">
                                        <span class="svg-icon fs-2"><svg>...</svg></span>
                                        <span class="d-flex flex-column align-items-start text-center">
                                            <span class="fs-4 fw-bold">Approved</span>
                                            <span class="fs-7">Upgraded Users</span>
                                        </span>
                                    </a>
                                </li>
                                <!-- Requests Tab -->
                                <li class="nav-item w-100 me-0 mb-md-2" role="presentation">
                                    <a class="nav-link w-100 btn btn-flex btn-active-light-info d-flex justify-content-center align-items-center {{ Route::currentRouteName() == 'upgrade.request.index' ? 'active' : '' }}"
                                        href="{{ route('upgrade.request.index') }}" aria-selected="{{ Route::currentRouteName() == 'upgrade.request.index' ? 'true' : 'false' }}" role="tab">
                                        <span class="svg-icon fs-2"><svg>...</svg></span>
                                        <span class="d-flex flex-column align-items-start text-center">
                                            <span class="fs-4 fw-bold">Requests</span>
                                            <span class="fs-7">Pending Requests</span>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        
                        <table id="kt_datatable_dom_positioning"
                            class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Current Package</th>
                                    <th>Upgrade Package </th>
                                    <th>Package Price</th>
                                    <th>Commision Amount Price</th>
                                    <th>Transaction ID</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp

                                @if ($all_requests->isEmpty())
                                    <p>No records found.</p>
                                @else
                                    @foreach ($all_requests as $all_request)
                                        @if ($all_request->user)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $all_request->user->first_name }}</td>
                                                <td>{{ $all_request->user->email }}</td>
                                                <td>{{ $all_request->user->package->package_title }}</td>
                                                <td>{{ $all_request->package->package_title }}</td>

                                                <td>{{ $all_request->amount }}</td>
                                                @php
                                                    $earnings = App\Models\Earning::where(
                                                        'user_by_id',
                                                        $all_request->user->id,
                                                    )
                                                        ->where('percentage_type', '=', 'Upgarde Package')
                                                        ->where('package_id', $all_request->package->id)
                                                        ->get();
                                                @endphp
                                                <td>
                                                    @if ($earnings->isNotEmpty())
                                                        @forelse ($earnings as $earning)
                                                            {{ $earning->amount }}
                                                        @empty
                                                            No Earnings
                                                        @endforelse
                                                    @else
                                                        <span>0.00</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $all_request->trx_id }}
                                                </td>
                                                @if ($all_request->status == 0)
                                                    <td> <span class="badge badge-lg badge-primary">Requested</span></td>
                                                @else
                                                    <td> <span class="badge badge-lg badge-success">Accepted</span></td>
                                                @endif

                                                <td class="text-end ">
                                                    <!--begin::Menu item-->
                                                    @if ($all_request->status == 0)
                                                        <div class="d-flex ">
                                                            <a href="{{ route('upgrade.request.accept', ['id' => $all_request->id, 'status' => 1]) }}"
                                                                class="menu-link btn-sm btn btn-success px-3 m-2">Accept</a>

                                                            <!--end::Menu-->

                                                            <!-- Delete Form -->
                                                            <form id="delete-form-{{ $all_request->id }}"
                                                                action="{{ route('upgrade.request.delete', $all_request->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <!-- Add a class to target for JavaScript handling -->
                                                                <button type="submit"
                                                                    class="btn-sm m-2 btn btn-danger px-3 delete-btn">Delete</button>
                                                            </form>
                                                    @endif
                                                </td>


                                            </tr>
                                        @endif
                                    @endforeach
                                @endif


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
    <div class="modal fade" id="modal01" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Receipt</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="img01" src="" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Your JavaScript for SweetAlert and Form Submission -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all delete buttons
            const deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = this.closest('form'); // Find the parent form element

                    // Show SweetAlert confirmation dialog
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this request!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // If user confirms, submit the form
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    @push('custom-scripts')
        <script>
            function onClick(element) {
                var modal = document.getElementById("modal01");
                var img = document.getElementById("img01");
                img.src = element.src;
                modal.style.display = "block";

                // Add code here to close the modal when desired.
            }
        </script>
        <script>
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
        </script>
    @endpush
@endsection
