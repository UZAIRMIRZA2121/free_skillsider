@extends('layouts.admin.master')

@section('admin')
    <style>
        /* Optional: Add some styling to make it clear the cell is clickable */
        td {
            cursor: pointer;
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
                    {{-- <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">My
                        Affiliates</h1> --}}
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
                        {{-- <li class="breadcrumb-item text-muted ">My Affiliates</li> --}}
                        <!-- Email Search Bar -->
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
                            <h1 class="d-block m-auto"> <span> <img src="{{ asset('sidebaricon/team.png') }}" alt=""
                                        width="30px" class="mx-3 mb-3">My Affiliates</span></h1>
                        </div>
                    </div>
                </div>
                <div class="card  mb-2 ">

                    <div class="card-header cursor-pointer ">
                        @if (Auth::user()->role == 0)
                            <div class="row " style="align-items: center;">
                                <div class="col-lg-6 col-sm-12  ">
                                    <!--begin::Action-->
                                    <div class="input-group ">
                                        <!--begin::Input-->
                                        <input id="kt_clipboard_1" type="text" class="form-control"
                                            placeholder="{{ route('register.by.referal', ['referral_code' => Auth::user()->referral_code]) }}"
                                            value="{{ route('register.by.referal', ['referral_code' => Auth::user()->referral_code]) }}"
                                            readonly />
                                        <!--end::Input-->
                                        <!--begin::Button-->
                                        <button class="btn btn-light-primary" data-clipboard-target="#kt_clipboard_1">
                                            Copy your Affiliate Link
                                    </div>
                                    <!--end::Action-->
                                </div>
                                <div class="col-lg-6 col-sm-12 ">
                                    <div class="input-group ">
                                        <!--begin::Input-->
                                        <input id="kt_clipboard_2" type="text" class="form-control"
                                            placeholder="{{ route('paymennt.link') }}" value="{{ route('paymennt.link') }}"
                                            readonly />
                                        <!--end::Input-->

                                        <!--begin::Button-->
                                        <button class="btn btn-light-primary" data-clipboard-target="#kt_clipboard_2">
                                            Copy Skillsider Payment Link
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
                <!--begin::Navbar-->

                <div class="card mb-5 mb-xxl-8">
                    <div class="card-body pt-9 pb-0">
                        <div class="card-header cursor-pointer w-100">
                            <!--begin::Card title-->
                            <div class="card-title m-0 w-100">

                                @if (Auth::user()->role == 1)
                                    <form action="{{ route('search.students') }}" method="GET">

                                        <div class="row form-group">
                                            <div class="col-lg-8 col-sm-12">
                                                <input type="text" name="query" value="{{ old('query') }}"
                                                    class="form-control w-100"
                                                    placeholder="Search name or email or refrrral code">
                                            </div>
                                            <div class="col-lg-2 col-sm-6 d-flex">
                                                <button type="submit" class="btn btn-primary mx-2 my-1">Search</button>
                                                <button type="reset" id="reset-btn"
                                                    class="btn btn-primary  mx-2 my-1">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <form action="{{ route('search.std') }}" method="GET">
                                        <div class="row form-group">
                                            <div class="col-lg-8 col-sm-12">
                                                <input type="text" name="query" value="{{ old('query') }}"
                                                    class="form-control w-100"
                                                    placeholder="Search name or email or refrrral code">
                                            </div>
                                            <div class="col-lg-2 col-sm-6 d-flex">
                                                <button type="submit" class="btn btn-primary mx-2 my-1">Search</button>
                                                <button type="reset" id="reset-btn"
                                                    class="btn btn-primary  mx-2 my-1">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif



                            </div>
                            <!--end::Card title-->

                        </div>




                        <table id="kt_datatable_dom_positioning"
                            class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Joined at</th>
                                    <th>Status</th>
                                    <th>Course</th>
                                    @if (Auth::user()->role == 1 || Auth::user()->role == 2)
                                        <th>Mobile Number</th>
                                        <th>Trx ID</th>
                                        <th>Coupon Code</th>
                                        <th>Recieved Amount</th>
                                        <th>Commission Amount</th>
                                        <th>Refferal Code</th>
                                        <th>Refferal By</th>
                                        <td>Action</td>
                                    @endif

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($students as $student)
                                    <tr>
                                        <td> {{ $i++ }} </td>
                                        <td ondblclick="copyToClipboard(this, 'name')">{{ $student->first_name }}
                                            {{ $student->last_name }}</td>


                                        @if (Auth::user()->role == 1 || Auth::user()->role == 2)
                                            <td>
                                                <a class="text-dark email-link" data-student-id="{{ $student->id }}"
                                                    data-email="{{ $student->email }}"
                                                    data-new_ref_by_code="{{ $student->referral_by }}"
                                                    data-first-name="{{ $student->first_name }}"
                                                    data-last-name="{{ $student->last_name }}"
                                                    data-phone="{{ $student->phone }}"
                                                    ondblclick="copyToClipboard(this, 'email')">
                                                    {{ $student->email }}
                                                </a>
                                            </td>
                                        @else
                                            <td>{{ $student->email }}</td>
                                        @endif
                                        <td>{{ $student->created_at }}</td>
                                        <td>
                                            @if ($student->status == 1)
                                                <span class="badge badge-lg badge-success">Verified</span>
                                            @else
                                                <span class="badge badge-lg badge-danger">Not Verified</span>
                                            @endif
                                        </td>
                                        <td class="text-uppercase">
                                            <span class="badge badge-lg"
                                                style="background-color:  {{ $student->package->color_code }}; color: {{ $student->package->text_color_code }};">{{ $student->package->package_title }}</span>

                                        </td>

                                        @if (Auth::user()->role == 1 || Auth::user()->role == 2)
                                            <td>{{ $student->phone }}</td>
                                            <td>{{ $student->trx_id }}</td>
                                            <td>{{ $student->coupen_code ? $student->coupen_code : 'Not Use' }}</td>
                                            <td>{{ $student->paid_amount }}</td>
                                            @php
                                                $earnings = App\Models\Earning::where('user_by_id', $student->id)
                                                    ->where('percentage_type', '!=', 'Upgarde Package')
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
                                            <!--<td class="text-uppercase">{{ $student->package->package_title }}</td>-->

                                            <td>


                                                <span class="badge badge-lg"
                                                    style="background-color:  {{ $student->package->color_code }}; color: {{ $student->package->text_color_code }};">
                                                    {{ $student->referral_code }}</span>

                                            </td>
                                            @php
                                                $ref_by_user = App\Models\User::where(
                                                    'referral_code',
                                                    $student->referral_by,
                                                )->first();
                                            @endphp
                                            <td>

                                                <span class="badge badge-lg"
                                                    style="background-color:  {{ $ref_by_user->package->color_code }}; color: {{ $ref_by_user->package->text_color_code }};">{{ $student->referral_by }}</span>
                                            </td>
                                            <td class="  text-end">

                                                @php
                                                    $studentId = $student->id;
                                                @endphp
                                                <a class="btn btn-light btn-active-light-primary btn-sm  menu-dropdown"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                                    data-kt-menu-flip="top-end">
                                                    Actions
                                                </a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4 "
                                                    data-kt-menu="true"
                                                    style="z-index: 107; position: fixed; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-78.5px, 229px, 0px);"
                                                    data-popper-placement="bottom-end">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('students.management.show', ['management' => $studentId]) }}"
                                                            class="menu-link px-3">
                                                            Preview
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    @if ($student->status == 0)
                                                        <div class="menu-item px-3">

                                                            <a href="" class="menu-link px-3"
                                                                onclick="event.preventDefault(); verifyStudent('{{ route('students.management.verify', ['management' => $studentId]) }}');">
                                                                Verify
                                                            </a>
                                                        </div>
                                                    @else
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="" class="menu-link px-3"
                                                                onclick="event.preventDefault(); RejectStudent('{{ route('students.management.verify', ['management' => $studentId]) }}');">
                                                                Reject
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    @endif
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <p>
                                                            <a type="button" id="delete-users-{{ $student->id }}"
                                                                class="menu-link px-3"
                                                                data-student-id="{{ $student->id }}">
                                                                Delete
                                                            </a>
                                                        <form id="delete-form-{{ $student->id }}"
                                                            action="{{ route('students.management.delete', $student->id) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        </p>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <div class="d-block my-3">
                            {{ $students->links('pagination::bootstrap-5') }}

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


    <!-- Modal -->
    <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="package_form form w-100" novalidate="novalidate" id="kt_edit_form"
                    action="{{ route('update.email') }}" method="POST">
                    @csrf
                    <input type="hidden" name="student_id" id="student_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Email Address</h5>

                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="new_email">New Email Address:</label>
                                    <input type="email" class="form-control" name="new_email" id="new_email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="new_ref_by_code">New Reference By Code:</label>
                                    <input type="text" class="form-control" name="new_ref_by_code"
                                        id="new_ref_by_code">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First name:</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last name:</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone:</label>
                                    <input type="text" class="form-control" name="phone" id="phone">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-primary">Update Email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (Auth::check() && Auth::user()->role == 0)
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-light" id="exampleModalLabel"
                            style="
                    font-weight: 1000;
                    font-size: 20px;"><b>Must
                                Watch This Video</b> </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-dark p-0">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" id="videoFrame" style="min-height: 300px; width: 100%;"
                                src="https://www.youtube.com/embed/obz63SUKtkA?si=0eM5kQkmdRGPL2sr"
                                title="YouTube video player" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <script src="assets/plugins/global/plugins.bundle.js"></script>

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
    <script>
        function copyToClipboard(element, type) {
            // Determine the content to copy based on the type
            var content;
            if (type === 'name') {
                content = element.innerText;
            } else if (type === 'email') {
                content = element.getAttribute('data-email');
            }

            // Create a temporary input element to hold the content
            var tempInput = document.createElement('input');
            document.body.appendChild(tempInput);

            // Set the input's value to the content
            tempInput.value = content;

            // Select the input's text content
            tempInput.select();

            // Copy the selected text to the clipboard
            document.execCommand('copy');

            // Remove the temporary input element
            document.body.removeChild(tempInput);

            // Show Toastr notification
            toastr.success(`The ${type} has been copied to your clipboard.`);
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.email-link').click(function(e) {
                e.preventDefault();

                var studentId = $(this).data('student-id');
                var email = $(this).data('email');
                var ref_by_code = $(this).data('new_ref_by_code');
                var first_name = $(this).data('first-name');
                var last_name = $(this).data('last-name');
                var phone = $(this).data('phone');

                $('#student_id').val(studentId);
                $('#new_email').val(email);
                $('#new_ref_by_code').val(ref_by_code);
                $('#first_name').val(first_name);
                $('#last_name').val(last_name);
                $('#phone').val(phone);
                $('#emailModal').modal('show');
            });
        });

        // For the first button
        const target1 = document.getElementById('kt_clipboard_1');
        const button1 = target1.nextElementSibling;

        // Init clipboard for the first button
        var clipboard1 = new ClipboardJS(button1, {
            target: target1,
            text: function() {
                return target1.value;
            }
        });

        // Success action handler for the first button
        clipboard1.on('success', function(e) {
            const currentLabel = button1.innerHTML;

            // Exit label update when already in progress
            if (button1.innerHTML === 'Copied!') {
                return;
            }

            // Update button label to indicate successful copy
            button1.innerHTML = 'Copied!';
        });

        // For the second button
        const target2 = document.getElementById('kt_clipboard_2');
        const button2 = target2.nextElementSibling;

        // Init clipboard for the second button
        var clipboard2 = new ClipboardJS(button2, {
            target: target2,
            text: function() {
                return target2.value;
            }
        });

        // Success action handler for the second button
        clipboard2.on('success', function(e) {
            const currentLabel = button2.innerHTML;

            // Exit label update when already in progress
            if (button2.innerHTML === 'Copied!') {
                return;
            }

            // Update button label to indicate successful copy
            button2.innerHTML = 'Copied!';
        });
    </script>
    @if (Auth::user()->role == 1)
        <script>
            document.getElementById('reset-btn').addEventListener('click', function() {
                // Redirect to the students.management.index route
                window.location.href = "{{ route('students.management.index') }}";
            });
        </script>
    @else
        <script>
            document.getElementById('reset-btn').addEventListener('click', function() {
                // Redirect to the students.management.index route
                window.location.href = "{{ route('students.index') }}";
            });
        </script>
    @endif

    <script>
        /////sweet--alert---///

        const deleteButtons = document.querySelectorAll('[id^="delete-users-"]');

        deleteButtons.forEach(button => {
            button.addEventListener('click', e => {
                const packageId = button.id.split('-')[2]; // Extract the package ID from the button's ID
                e.preventDefault();

                Swal.fire({
                    title: 'Delete Student',
                    text: 'Are you sure you want to delete this student?',
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
    @push('custom-scripts')
        <script>
            $("#kt_datatable_dom_positioning").DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom": "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end '>" +
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
        </script>
    @endpush
@endsection
