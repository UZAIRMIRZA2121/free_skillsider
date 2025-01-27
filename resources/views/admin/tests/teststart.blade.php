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
                        Test Management</h1>
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
                        <li class="breadcrumb-item text-muted">Test Details</li>
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
                                <h3 class="fw-bold m-0">Test</h3>
                            </div>
                            <div class="card-title m-0">
                                <h2 class="fw-bold m-0">Time remaining: <span id="timer"></span></h2>
                            </div>
                        </div>

                        <form action="{{ route('submit.test') }}" method="POST">
                            @csrf
                            <input type="hidden" name="test_id" value="{{ $test->id }}">

                            <div class="form-group">
                                <h2 class="mb-4">Answer the following questions:</h2>
                                @foreach ($questions as $question)
                                    <div class="question-box mb-3">
                                        <p class="form-label mb-2">{{ $loop->iteration }}. {{ $question->question_text }}
                                            <span class="text-muted">[Correct Answer:
                                                {{ $question->correct_option }}]</span>
                                        </p>

                                        <!-- Options with responsive layout -->
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-lg-3 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input question-option" type="radio"
                                                        name="question_{{ $question->id }}" value="1"
                                                        id="option_1_{{ $question->id }}">
                                                    <label class="form-check-label fw-bold"
                                                        for="option_1_{{ $question->id }}">
                                                        {{ $question->option_1 }}
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-3 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input question-option" type="radio"
                                                        name="question_{{ $question->id }}" value="2"
                                                        id="option_2_{{ $question->id }}">
                                                    <label class="form-check-label fw-bold"
                                                        for="option_2_{{ $question->id }}">
                                                        {{ $question->option_2 }}
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-3 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input question-option" type="radio"
                                                        name="question_{{ $question->id }}" value="3"
                                                        id="option_3_{{ $question->id }}">
                                                    <label class="form-check-label fw-bold"
                                                        for="option_3_{{ $question->id }}">
                                                        {{ $question->option_3 }}
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-3 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input question-option" type="radio"
                                                        name="question_{{ $question->id }}" value="4"
                                                        id="option_4_{{ $question->id }}">
                                                    <label class="form-check-label fw-bold"
                                                        for="option_4_{{ $question->id }}">
                                                        {{ $question->option_4 }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Submit Button -->
                            </div>


                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary px-4 py-2 m-3" onclick="validateForm()">Submit Test</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--end::Navbar-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->

        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <script>
        function handleOptionChange(questionId, selectedOption) {
            // Get all labels for the current question
            const labels = document.querySelectorAll(`[name="question_${questionId}"] ~ label`);

            // Iterate over each label
            labels.forEach((label, index) => {
                // Apply text-success to the selected option and text-danger to others
                if (index + 1 === selectedOption) {
                    label.classList.add('text-success');
                } else {
                    label.classList.remove('text-success');

                }
            });
        }
    </script>
<script>
    <script>
    function validateForm() {
        const questions = document.querySelectorAll('.question-box');
        let isValid = true;

        questions.forEach((question) => {
            const options = question.querySelectorAll('.form-check-input');
            const isSelected = Array.from(options).some(option => option.checked);

            if (!isSelected) {
                isValid = false;
                question.classList.add('border', 'border-danger', 'p-2');
            } else {
                question.classList.remove('border', 'border-danger', 'p-2');
            }
        });

        if (!isValid) {
            alert('Please select at least one option for each question.');
        } else {
            // Submit the form or perform other actions here
            alert('Form submitted successfully!');
        }
    }
</script>

</script>

    <script>
        // Get the test's created_at timestamp from PHP
        const createdAt = new Date("{{ $test->created_at }}").getTime();
        console.log("Created At:", createdAt); // Debugging: Log created_at timestamp

        // Current time
        const now = new Date().getTime();
        console.log("Current Time:", now); // Debugging: Log current timestamp

        // Countdown duration: 15 minutes (15 * 60 * 1000 = 900000 milliseconds)
        const countdownDuration = 15 * 61 * 1000;
        console.log("Countdown Duration (in milliseconds):", countdownDuration); // Debugging: Log countdown duration

        // Calculate the time elapsed since the test was created
        const elapsedTime = now - createdAt;
        console.log("Elapsed Time (in milliseconds):", elapsedTime); // Debugging: Log elapsed time

        // If the elapsed time is greater than or equal to 15 minutes, show "Time's up!"
        if (elapsedTime >= countdownDuration) {
            console.log("Elapsed time is greater than or equal to countdown duration. Time's up!");
            document.getElementById("timer").innerHTML = "Time's up!";
            alert("Time's up!"); // Alert message
        } else {
            // Calculate remaining time
            const remainingTime = countdownDuration - elapsedTime;
            console.log("Remaining Time (in milliseconds):", remainingTime); // Debugging: Log remaining time

            // Calculate end time for countdown
            const endTime = now + remainingTime;
            console.log("End Time:", endTime); // Debugging: Log end time

            // Update the countdown every second
            const interval = setInterval(function() {
                // Get the current time
                const now = new Date().getTime();
                console.log("Current Time (inside interval):", now); // Debugging: Log current time inside interval

                // Calculate the time remaining
                const remainingTime = endTime - now;
                console.log("Remaining Time (inside interval):",
                    remainingTime); // Debugging: Log remaining time inside interval

                if (remainingTime <= 0) {
                    // If time is up, clear the interval, show the alert and update the timer text
                    clearInterval(interval);
                    document.getElementById("timer").innerHTML = "Time's up!";
                    alert("Time's up!"); // Alert message
                    console.log("Time's up!"); // Debugging: Log when time is up
                } else {
                    // Calculate minutes and seconds
                    const minutes = Math.floor(remainingTime / (1000 * 60));
                    const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

                    // Display the remaining time in MM:SS format
                    document.getElementById("timer").innerHTML = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
                    console.log("Updated Timer:",
                        `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`); // Debugging: Log updated timer
                }
            }, 1000); // Update every second
        }
    </script>
@endsection
