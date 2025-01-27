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
                    {{-- <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Payment Management</h1> --}}
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
                        <li class="breadcrumb-item text-muted">Payments Details</li>
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
                    <div class=" ">
                        <div class="card-header cursor-pointer w-100 text-center">
                            <h1 class="d-block m-auto"> <span> <img src="{{ asset('sidebaricon/bank.png') }}" alt=""
                                        width="30px" class="mx-3 mb-3">Bank Details</span></h1>
                            
                        </div>
                    </div>
                </div>
                <!--begin::Navbar-->
                <div class="card mb-5 mb-xxl-8">
                    <div class="card-body pt-0  pb-0">
                        <div class="card-header cursor-pointer">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Your Accounts</h3>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Action-->
                            <a href="{{ Auth::user()->role == 1 ? route('payment.admin.create'):  route('payments.create')}}"
                                class="btn btn-sm text-light btn-primary align-self-center {{$exist ? "d-none" : "" }}">Add Payment</a>
                            <!--end::Action-->
                        </div>
                        <table id="kt_datatable_dom_positioning"
                            class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                    <th>Sr.No</th>
                                    @if (Auth::user()->role == 1)
                                    <th>Logo</th>
                                    @endif
                                    <th>Bank Name</th>
                                    <th>Account Nme</th>
                                    <th>Account Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($payment_methods as $payment_method)
                                    <tr>
                                        <td> {{ $i++ }} </td>
                                        @if (Auth::user()->role == 1)
                                        <td>
                                            <img src="{{ asset('payment-method-image/' . $payment_method->logo) }}"
                                                width="50" alt="">
                                        </td>
                                        @endif
                                        <td><b>{{ $payment_method->bank }}</b></td>
                                        <td>{{ $payment_method->account_name }}</td>
                                        <td>{{ $payment_method->account_number }}</td>
                                        <td class=" d-flex  text-start">
                                            <a href="{{ Auth::user()->role == 1 ? route('payment.admin.edit', ['payment' => $payment_method->id]):route('payments.edit', ['payment' => $payment_method->id])  }}"
                                                        class="menu-link px-3 btn btn-primary btn-sm mx-2" data-kt-docs-table-filter="edit_row">
                                                        Edit
                                                    </a>
                                                    @if(auth::user()->role == 1)
                                                    <form method="POST" action="{{ route('payment.admin.delete', $payment_method->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="menu-link px-3 btn btn-danger btn-sm mx-2" type="submit">Delete </button>
                                                    </form>
                                                    @endif
                                          
                                        </td>
                                    </tr>
                                    {{-- <h1>{{ $package->description }}</h1> --}}
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

            const deleteButtons = document.querySelectorAll('[id^="delete-payments-"]');

            deleteButtons.forEach(button => {
                button.addEventListener('click', e => {
                    const packageId = button.id.split('-')[2]; // Extract the package ID from the button's ID
                    e.preventDefault();

                    Swal.fire({
                        title: 'Delete Package',
                        text: 'Are you sure you want to delete this payment method?',
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
