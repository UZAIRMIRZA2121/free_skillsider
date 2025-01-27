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
                    {{-- <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Certificates Management</h1> --}}
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
                        <li class="breadcrumb-item text-muted">Certificates Details</li>
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
                        <h1 class="d-block m-auto"> <span> <img src="{{ asset('sidebaricon/certificate.png') }}" alt=""
                                    width="30px" class="mx-3 mb-3">Certificates</span></h1>
                        
                    </div>
            </div>
                <!--begin::Navbar-->
                <div class="card mb-5 mb-xxl-8">
                    <div class="card-body pt-0  pb-0">
                        <div class="card-header cursor-pointer">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Course Certificates</h3>
                            </div>
                        </div>
                        <!--end::Card title-->
                        <form action="{{ route('tests.start') }}" method="POST">
                            @csrf
                            <div class="row justify-content-start">
                                <!-- Blade Template -->
                                <div class="col-md-3 ">
                                    {{-- <label for="course_id" class="form-label">Courses</label> --}}
                                    <div class="input-group mt-3">
                                        <select name="course_id" id="course_id"
                                            class="form-control form-control-solid form-select " required>
                                            <option value="">Select a Course <i class="fas fa-chevron-down"></i>
                                            </option>
                                            @foreach ($completedCourses as $course)
                                                <option value="{{ $course->id }}">{{ $course->course_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 mt-3 d-flex justify-content-start align-items-center">
                                    <button type="submit" class="btn btn-success disabled" disabled>Start Test <i
                                            class="fa-solid fa-arrow-right  " aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </form>
                        <table id="kt_datatable_dom_positioning"
                            class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Status</th>
                                    <th>Results</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tests as $test)
                                    {{-- @if ($test->status == 'passed' || $test->status == 'failed') --}}
                                    <tr>
                                        <td>{{ $test->course->course_title }}</td>
                                        <td>
                                            @if ($test->status == 'passed')
                                                <i class="fa fa-check text-success fs-3" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-times text-danger fs-3 " aria-hidden="true"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('test.review', $test->id) }}" class="btn btn-sm btn-primary">
                                                View Result
                                            </a>
                                        </td>
                                        <td>
                                            @if ($test->status == 'failed')
                                                <div class="d-flex justify-content-start">
                                                    <form action="{{ route('tests.start') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="course_id"
                                                            value="{{ $test->course_id }}">
                                                        <button type="submit"
                                                            class="btn btn-sm {{ $test->created_at->diffInHours(Carbon\Carbon::now()) > 24 ? 'btn-success' : 'btn-danger' }}  mx-2">ReAttempt</button>
                                                    </form>
                                                </div>
                                            @else
                                                <div class="d-flex justify-content-start">
                                                    <a href="{{ route('download.certificate', ['course_id' => $test->course_id]) }}"
                                                        class="btn btn-sm btn-primary" style="float: right;">
                                                        Download Certificate
                                                    </a>

                                                </div>
                                            @endif

                                        </td>
                                    </tr>
                                    {{-- @endif --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Instructions:</h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Passing Score:</strong> 80%. You need to score 80% or more to pass the test.
                            </li>
                            <li class="list-group-item">
                                <strong>Certificate:</strong> You can download your course completion certificate only if
                                you pass the test.
                            </li>
                            <li class="list-group-item">
                                <strong>One Attempt Limit:</strong> After completing the test and downloading your
                                certificate, you will not be able to attempt the test again.
                            </li>
                            <li class="list-group-item">
                                <strong>Reattempt Policy:</strong> If you fail the test, you will have to wait 2 days before
                                attempting the test again.
                            </li>
                            <li class="list-group-item">
                                <strong>Time Limit:</strong> The time limit for the test is 15 minutes. Be sure to complete
                                it within this time.
                            </li>
                            <li class="list-group-item">
                                <strong>Page Refresh:</strong> Do not refresh the page until you complete the test to avoid
                                losing your progress.
                            </li>
                            <li class="list-group-item">
                                <strong>Warning:</strong> If you refresh the page, your test progress may be lost. Ensure
                                that you're ready to take the test before starting.

                            </li>
                        </ul>

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
    <!-- jQuery for AJAX -->

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
                title: 'error',
                text: '{{ session('error') }}',
                icon: 'error'
            });
        </script>
    @endif
    @push('custom-scripts')
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

            /////sweet--alert---///

            const deleteButtons = document.querySelectorAll('[id^="delete-course-"]');

            deleteButtons.forEach(button => {
                button.addEventListener('click', e => {
                    const packageId = button.id.split('-')[2]; // Extract the package ID from the button's ID
                    e.preventDefault();

                    Swal.fire({
                        title: 'Delete Package',
                        text: 'Are you sure you want to delete this Rank?',
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
