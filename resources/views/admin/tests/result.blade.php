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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Result</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1 d-none">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Dashboard</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Result Details</li>
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
                    <div class="card-body pt-0 pb-0">
                        <div class="card-header cursor-pointer">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Result</h3>
                            </div>

                            @if ($status == 'passed')
                                <div class="card-title m-0">
                                    <h3 class="fw-bold m-0">
                                        <a href="" class="btn btn-primary btn-sm" style="float: right;">
                                            Download Certificate
                                        </a>
                                    </h3>
                                </div>
                            @endif
                            @if ($status == 'failed')
                                <div class="row justify-content-start">
                                    <div class="col-md-6 mt-3 d-flex justify-content-start align-items-center">
                                    <a href="{{ route('tests.index')}}" class="btn btn-primary btn-sm d-flex" style="float: right;">
                                          <span>Back</span>   
                                            <span><i class=" ms-2 fa-solid fa-arrow-right"></i></span>
                                        </a>  
                                    </div>
                                </div>
                            @endif 

                        </div>
                        <div class="mt-4">
                            <p><strong>Total Questions:</strong> {{ $totalQuestions }}</p>
                            <p><strong>Correct Answers:</strong> {{ $correctAnswers }}</p>
                            <p><strong>Result:</strong> {{ $status }}</p>
                        </div>

                        <div class="mt-4">
                            <h3>Question Details:</h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Question</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $index => $detail)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $detail['question'] }}</td>
                                            <td>
                                                @if ($detail['is_correct'])
                                                    <i class="fa fa-check text-success fs-3" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-times text-danger fs-3 " aria-hidden="true"></i>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
    @if ($status == 'failed')
        @php
            $totalQuestions = $totalQuestions; // Ensure $totalQuestions is assigned here
            $correctAnswers = $correctAnswers; // Ensure $correctAnswers is assigned here

            // Calculate the percentage
            $percentage = ($correctAnswers / $totalQuestions) * 100;
            // Format the percentage (optional: rounding to 2 decimal places)
            $formattedPercentage = number_format($percentage, 0);
            // Prepare the message text
            $text = "You gave $correctAnswers out of $totalQuestions right answers from your selected course and your result percentage is $formattedPercentage%.";
        @endphp
    @endif
    @if ($status == 'passed')
        @php
            $totalQuestions = $totalQuestions; // Ensure $totalQuestions is assigned here
            $correctAnswers = $correctAnswers; // Ensure $correctAnswers is assigned here

            // Calculate the percentage
            $percentage = ($correctAnswers / $totalQuestions) * 100;
            // Format the percentage (optional: rounding to 2 decimal places)
            $formattedPercentage = number_format($percentage, 0);
            // Prepare the message text
            $text = "Congratulations! You have passed the test. You gave $correctAnswers out of $totalQuestions right answers from your selected course and your result percentage is $formattedPercentage%.";
        @endphp
    @endif

    @if ($status == 'passed')
        <script>
            Swal.fire({
                title: 'Success',
                text: '{{ $text }}',
                icon: 'success'
            });
        </script>
    @endif

    @if ($status == 'failed')
        <script>
            Swal.fire({
                title: 'Error',
                text: '{{ $text }}',
                icon: 'error'
            });
        </script>
        {{-- <script>
            document.getElementById('reAttemptBtn').addEventListener('click', function() {

                var nextAttemptTime = @json($nextAttemptTime);

                // Check if nextAttemptTime is available
                if (nextAttemptTime) {
                    Swal.fire({
                        title: 'Error',
                        text: `You have already attended the test. You can attend the test once in 24 hours. You can attempt the test after ${nextAttemptTime}`,
                        icon: 'error'
                    });
                } else {
                    // Handle the case when there is no next attempt time (if applicable)
                    Swal.fire({
                        title: 'Info',
                        text: 'You can attempt the test now!',
                        icon: 'info'
                    });
                }
            });
        </script> --}}
    @endif
@endsection
