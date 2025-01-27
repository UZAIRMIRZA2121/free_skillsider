@extends('layouts.admin.master')

@section('admin')
<style>
    @media (max-width: 768px) {
    .nav-tabs {
        display: flex;
        flex-direction: column;
    }
}

</style>

    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    {{-- <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Earning</h1> --}}
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
                        <li class="breadcrumb-item text-muted">Earning Details</li>
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
                    <div class=" ">
                        <div class="card-header cursor-pointer w-100 text-center">
                            <h1 class="d-block m-auto"> <span> <img src="{{ asset('sidebaricon/money-withdraw.png') }}" alt=""
                                        width="30px" class="mx-3 ">Withdrawals</span></h1>
                            
                        </div>
                    </div>
                </div>
                <!--begin::Navbar-->
                <div class="card mb-5 mb-xxl-8">
                    <div class="card-body pt-9 pb-0">
                        <div class="card-header cursor-pointer">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Withdrawal Details</h3>
                            </div>
                       
                             <!-- end::Card title -->
                            @if (isset($requests_date) && isset($currentDate))
                            
                                @if ($requested_amount == 0 && $un_paid_amount >= 450 && $currentDate > $requests_date)
                                    <!-- begin::Action -->
                                    <a href="{{ route('earnings.edit', Auth::user()->id) }}"
                                       class="btn btn-sm text-light btn-primary align-self-center">Withdraw</a>
                                    <!-- end::Action -->
                                @else
                                <a 
                                class="btn btn-sm text-light btn-primary align-self-center"
                                onclick="showWithdrawError()">Withdraw</a>
                             
                                @endif
                               
                            
                            @endif
                       
                        </div>
 
                        <div class="row  pt-6">
                            <ul class="nav nav-tabs flex-nowrap text-nowrap">
                                <div class="col-sm-12 col-md-4 col-lg-4 ">
                                <li class="nav-item w-100  me-0 mb-md-2">
                                    <a class="nav-link w-100 active btn btn-flex btn-active-light-success d-flex justify-content-center align-items-center"
                                        data-bs-toggle="tab" href="#kt_vtab_pane_4">
                                        <span class="svg-icon fs-2"><svg>...</svg></span>
                                        <!--begin::Body-->
                                        <div class="card-body text-center pt-5">
                                            <div class="d-flex justify-content-center ">
                                                <div>
                                                    <span class="d-block   h4  text-gray-800">Total Withdrawal</span>
                                                    <div class="fs-2 fw-bolder mt-4" data-kt-countup="true"
                                                        data-kt-countup-value="{{$transectionCount}}"
                                                        data-kt-countup-prefix="Rs ">0</div>
                                                </div>
                                                <div class="ms-md-5">
                                                    <img src="{{ asset('assets/images/gift-box.png') }}" class="mt-3"
                                                        alt="" height="60">
                                                </div>
                                            </div>
                                            <!--end::Section-->
                                        </div>
                                        <!--end::Body-->
                                    </a>
                                </li>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <li class="nav-item w-100 me-0 mb-md-2">
                                    <a class="nav-link w-100 btn btn-flex  d-flex justify-content-center align-items-center btn-active-light-info"
                                        data-bs-toggle="tab" href="#kt_vtab_pane_5">
                                        <span class="svg-icon fs-2"><svg>...</svg></span>
                                        <!--begin::Body-->
                                        <div class="card-body text-center pt-5">
                                            <div class="d-flex justify-content-center ">
                                                <div>
                                                    <span class="d-block   h4  text-gray-800">Requested Amount</span>
                                                    <div class="fs-2 fw-bolder mt-4" data-kt-countup="true"
                                                        data-kt-countup-value="{{ $requested_amount }}"
                                                        data-kt-countup-prefix="Rs ">0</div>
                                                </div>
                                                <div class="ms-md-5">
                                                    <img src="{{ asset('assets/images/cash.png') }}" class="mt-3"
                                                        alt="" height="60">
                                                </div>
                                            </div>
                                            <!--end::Section-->
                                        </div>
                                        <!--end::Body-->
                                    </a>
                                </li>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 ">
                                <li class="nav-item w-100  me-0 mb-md-2">
                                    <a class="nav-link w-100 btn btn-flex  d-flex justify-content-center align-items-center btn-active-light-danger"
                                        data-bs-toggle="tab" href="#kt_vtab_pane_6">
                                        <span class="svg-icon fs-2"><svg>...</svg></span>
                                        <!--begin::Body-->
                                        <div class="card-body text-center pt-5">
                                            <div class="d-flex justify-content-center ">
                                                <div>
                                                    <span class="d-block   h4  text-gray-800">Available Balance</span>
                                                    <div class="fs-2 fw-bolder mt-4" data-kt-countup="true"
                                                        data-kt-countup-value="{{ $un_paid_amount }}"
                                                        data-kt-countup-prefix="Rs ">0</div>
                                                </div>
                                                <div class="ms-md-5">
                                                    <img src="{{ asset('assets/images/cash.png') }}" class="mt-3"
                                                        alt="" height="60">
                                                </div>
                                            </div>
                                            <!--end::Section-->
                                        </div>
                                        <!--end::Body-->
                                    </a>
                                </li>
                            </div>
                            </ul>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="kt_vtab_pane_4" role="tabpanel">
                                <table id="kt_datatable_dom_positioning1"
                                    class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                                    <thead>
                                        <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                            <th>Sr.No</th>
                                            <th>Name</th>
                                            <th>Payment Assign By</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Receipt</th>
                                            <th>Settled At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($transections as $transection)
                                            @php
                                                $student_name = \App\Models\User::where('id', $transection->user_id)->value('first_name');
                                                $assign_by_user = \App\Models\User::where('id', $transection->assign_by_id)->first();
                                                
                                            @endphp
                                            <tr>
                                                <td> {{ $i++ }} </td>
                                                <td>{{ $student_name }}</td>
                                                <td class="text-capitalize">{{ $assign_by_user->first_name }}{{ $assign_by_user->last_name }}</td>
                                                <td>{{ $transection->amount }}</td>
                                                <td><span class="badge badge-lg badge-success">Paid</span></td>
                                                <td>
                                                    <div class="w3-row-padding">
                                                        <div class="w3-container w3-third" data-toggle="modal" data-target="#modal01">
                                                            <img
                                                            src="{{asset('receipt-image/'.$transection->receipt)}}" alt="" width="80"
                                                                style="cursor: pointer"
                                                                onclick="onClick(this)"
                                                                class="w3-hover-opacity"
                                                            >
                                                        </div>
                                                    </div>
                                                    <img >
                                                </td>

                                                <td>{{ $transection->updated_at->format('Y-m-d') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show " id="kt_vtab_pane_5" role="tabpanel">

                                <table id="kt_datatable_dom_positioning2"
                                    class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                                    <thead>
                                        <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                            <th>Sr.No</th>
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>Payment Type</th>
                                            <th>Status</th>
                                            <th>Joined at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($requests as $request)
                                            @php
                                                $student_name = \App\Models\User::where('id', $request->user_by_id)->value('first_name');
                                                
                                            @endphp
                                            <tr>
                                                <td> {{ $i++ }} </td>
                                                <td>{{ $student_name }}</td>
                                                <td>{{ $request->amount }}</td>
                                                <td class="text-capitalize">{{ $request->percentage_type }}</td>
                                                <td>
                                                    <span class="badge badge-lg badge-info">Requested</span>
                                                </td>
                                                <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show " id="kt_vtab_pane_6" role="tabpanel">
                                <table id="kt_datatable_dom_positioning3"
                                    class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                                    <thead>
                                        <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                            <th>Sr.No</th>
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>Payment Type</th>
                                            <th>Status</th>
                                            <th>Joined at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($un_paids as $un_paid)
                                            @php
                                                $student_name = \App\Models\User::where('id', $un_paid->user_by_id)->value('first_name');
                                                
                                            @endphp
                                            <tr>
                                                <td> {{ $i++ }} </td>
                                                <td>{{ $student_name }}</td>
                                                <td>{{ $un_paid->amount }}</td>
                                                <td class="text-capitalize">{{ $un_paid->percentage_type }}</td>
                                                <td>
                                                    <span class="badge badge-lg badge-danger">UnPaid</span>
                                                </td>
                                                <td>{{ $un_paid->created_at->format('Y-m-d') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Navbar-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
        <div class="modal fade" id="modal01" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div>
    
      <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-header  bg-danger" style="background-color: #4d3185">
                <h5 class="modal-title text-light" id="exampleModalLabel" style="
                font-weight: 1000;
                font-size: 20px;" ><b>Must Watch This Video</b> </h5>
                        <button type="button" class="btn-close fs-3 " data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body bg-dark p-0">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" id="videoFrame" style="min-height: 300px; width: 100%;" src="https://www.youtube.com/embed/MWUxzzjHgiE?si=NArCUrprOdlKGqVc" title="YouTube video player" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!--end::Content wrapper-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showWithdrawError() {
            // Updated error message with "You can only request once within 24 hours"
            var errorMessage = 'Sorry, you can only request a withdrawal once within 24 hours. Please try again after 24 hours.';
    
            // Display the SweetAlert with the updated message
            Swal.fire({
                title: 'Error',
                text: errorMessage,  // Updated error message
                icon: 'error'
            });
        }
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
    @if (session('error'))
        <script>
            Swal.fire({
                title: 'Error',
                text: '{{ session('error') }}',
                icon: 'error'
            });
        </script>
    @endif
    
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
            function onClick(element) {
        var modal = document.getElementById("modal01");
        var img = document.getElementById("img01");
        img.src = element.src;
        modal.style.display = "block";

        // Add code here to close the modal when desired.
    }
            $("#kt_datatable_dom_positioning1").DataTable({
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
            $("#kt_datatable_dom_positioning2").DataTable({
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
            $("#kt_datatable_dom_positioning3").DataTable({
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
        </script>
    @endpush
@endsection
