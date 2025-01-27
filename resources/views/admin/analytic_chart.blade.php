@extends('layouts.admin.master')

@section('admin')
    <style>
        .active {
            background: #574087 !important;
            color: #fff !important;
        }

        .noselect {
            background: #fff;
            color: #574087;
        }

        /* Define hover styles for .noselect */
        .noselect:hover {
            background: #f8f5ff;
            /* Change background color on hover */
            color: inherit;
            /* Inherit text color from parent */
        }

        .bordered-img {
            border-radius: 50%;
            /* Ensure the image is rounded */
            border: 2px solid rgb(123, 212, 79);
            padding: 2px !important;
        }
    </style>
    <!--begin::Content wrapper-->
    <div class="d-flex  flex-column card flex-column-fluid">
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid mt-2">
            <!--begin::Content container-->
            <div id="kt_app_content_container " class="app-container container-xxl">
                <!--<h1 style="background: yellow;padding: 10px;border-radius: 20px;">Order pending wali Whatsapp abhi work nahi kar rahi new order register karwany k liye user ki Gmail or Fees screenshot is number py bhejiye 03131448482 Whatsapp only</h1>-->

                <div class="row ">
                    <!--begin::Body-->

                    <!--end::Col-->
                    <div class="settings-top-widget" data-intro="Keep track of all your earnings">
                        <div class="row gx-3 gy-2 mb-5">
                            <div class="col-xl-12 mb-4 showOnlyMob pt-2 ">
                                <!--begin::Col-->

                                <!--begin::Card widget 11-->
                                <div class="card card-flush h-xl-80" style="border-radius: 15px;">
                                    <!--begin::Body-->
                                    <div class="card-body text-center p-3 pt-2"
                                        style="background-color:#f8f5ff;min-height: 72px !important;border: 3px solid #ead9d775;border-radius: 10px;">
                                        <div class="d-flex">
                                            <!--begin::Section-->
                                            <div class="">
                                                @if (Auth::user()->profile_photo_path)
                                                    <img src="{{ asset('profile-image/' . Auth::user()->profile_photo_path) }}"
                                                        class="shadow-lg rounded-circle bordered-img" width="90px"
                                                        height="90px" alt="user" />
                                                @else
                                                    <img src="{{ asset('assets/images/defaultprofile.jpg') }}"
                                                        class="shadow-lg rounded-circle bordered-img" width="100px"
                                                        height="100px" alt="user"
                                                        style="border: 2px solid rgb(123, 212, 79);">
                                                @endif
                                            </div>
                                            <div class="mt-7 ms-5 ps-5">

                                            </div>
                                            <div class="mt-7 ms-5 ps-5">
                                                <div class="d-flex justify-content-start gx-10">
                                                    <h1>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h1>
                                                </div>
                                                @if (Auth::user()->role == 0)
                                                    <div class="d-flex justify-content-start gx-10">
                                                        <span
                                                            class="p-2 badge badge-lg badge-success">{{ Auth::user()->package->package_title }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!--end::Section-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Card widget 11-->

                            </div>
                            @if (Auth::user()->role == 0)
                                <div class="col-xl-3 col-lg-6 col-sm-6 mt-sm-0 mt-md-2">
                                    <div class="card shadow-sm" style="border-radius: 15px;">
                                        <div class="container overflow-hidden btn-active-light-info"
                                            style="background-color:#f8f5ff;min-height: 72px !important;;border: 3px solid #ead9d775;border-radius: 10px;">
                                            <div class="row gx-5  m-2">
                                                <div class="col-8">
                                                    <span class=" h5 font-weight-bold text-gray-800">Today's</span>
                                                    <h1 class="mt-2 gordita-bold counter-value   fw-bold"
                                                        data-kt-countup="true" data-kt-countup-value="{{ $today_earning }}"
                                                        data-kt-countup-prefix="Rs "
                                                        style="font-size: 20px;font-weight: 800!important;color: #00CC32;">0
                                                    </h1>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <img src="{{ asset('assets/images/cash.png') }}" class="opacity-25"
                                                        alt="" height="50">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6">
                                    <div class="card shadow-sm" style="border-radius: 15px;">
                                        <div class="container overflow-hidden"
                                            style="background-color:#f8f5ff;min-height: 72px !important;;border: 3px solid #ead9d775;border-radius: 10px;">
                                            <div class="row gx-5  m-2">
                                                <div class="col-8">
                                                    <span class="h5  text-gray-800 ">Last 7 Days</span>
                                                    <h1 class="mt-3 gordita-bold counter-value " data-kt-countup="true"
                                                        data-kt-countup-value="{{ $last7Days_earning }}"
                                                        data-kt-countup-prefix="Rs "
                                                        style="font-size: 20px;font-weight: 800;color: #1abae3;">0</h1>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <img src="{{ asset('assets/images/hand.png') }}" class="opacity-25 "
                                                        alt="" height="50">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6">
                                    <div class="card shadow-sm" style="border-radius: 15px;">
                                        <div class="container overflow-hidden"
                                            style="background-color:#f8f5ff;min-height: 72px !important;;border:3px solid #ead9d775;border-radius: 10px;">
                                            <div class="row gx-5  m-2">
                                                <div class="col-8">
                                                    <span class="h5   text-gray-800">Last 30 Days</span>
                                                    <h1 class="mt-2 gordita-bold counter-value " data-kt-countup="true"
                                                        data-kt-countup-value="{{ $last30Days_earning }}"
                                                        data-kt-countup-prefix="Rs "
                                                        style="font-size: 20px;font-weight: 800;color: #00CC32;">0</h1>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <img src="{{ asset('assets/images/bar-chart.png') }}"
                                                        class="opacity-25 " alt="" height="50">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-sm-6">
                                    <div class="card shadow-sm" style="border-radius: 15px;">
                                        <div class="container overflow-hidden"
                                            style="background-color:#f8f5ff;min-height: 72px !important;border: 3px solid #ead9d775;border-radius: 10px;">
                                            <div class="row gx-5  m-2">
                                                <div class="col-8">
                                                    <span class="h5   text-gray-800">Total Earning</span>
                                                    <h1 class="mt-2 gordita-bold counter-value" data-kt-countup="true"
                                                        data-kt-countup-value="{{ $all_time__earning }}"
                                                        data-kt-countup-prefix="Rs "
                                                        style="font-size: 20px;font-weight: 800;color: #E0115F;">0</h1>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <img src="{{ asset('assets/images/gift-box.png') }}"
                                                        class="opacity-25 " alt="" height="50">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-xl-4 col-lg-6 col-sm-6">
                                    <div class="card shadow-sm">
                                        <div class="container overflow-hidden"
                                            style="background-color:#FFF7F5;min-height: 72px !important;">
                                            <div class="row gx-5  m-3">
                                                <div class="col-8">
                                                    <span class="h5   text-gray-800"></span>
                                                    <h1 class="mt-2 gordita-bold counter-value text-danger"
                                                        data-kt-countup="true"
                                                        data-kt-countup-value="{{ $totalPaid }}"
                                                        data-kt-countup-prefix=" "
                                                        style="font-size: 20px;font-weight: 800;">0</h1>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <img src="{{ asset('assets/images/gift-box.png') }}"
                                                        class="opacity-25 " alt="" height="50">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-sm-6">
                                    <div class="card shadow-sm">
                                        <div class="container overflow-hidden"
                                            style="background-color:#FFF7F5;min-height: 72px !important;">
                                            <div class="row gx-5  m-3">
                                                <div class="col-8">
                                                    <span class="h5   text-gray-800"></span>
                                                    <h1 class="mt-2 gordita-bold counter-value text-danger"
                                                        data-kt-countup="true"
                                                        data-kt-countup-value="{{ $totalRequested }}"
                                                        data-kt-countup-prefix=" "
                                                        style="font-size: 20px;font-weight: 800;">0</h1>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <img src="{{ asset('assets/images/gift-box.png') }}"
                                                        class="opacity-25 " alt="" height="50">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-sm-6">
                                    <div class="card shadow-sm">
                                        <div class="container overflow-hidden"
                                            style="background-color:#FFF7F5;min-height: 72px !important;">
                                            <div class="row gx-5  m-3">
                                                <div class="col-8">
                                                    <span class="h5   text-gray-800"></span>
                                                    <h1 class="mt-2 gordita-bold counter-value text-danger"
                                                        data-kt-countup="true"
                                                        data-kt-countup-value="{{ $totalUnRequested }}"
                                                        data-kt-countup-prefix=" "
                                                        style="font-size: 20px;font-weight: 800;">0</h1>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <img src="{{ asset('assets/images/gift-box.png') }}"
                                                        class="opacity-25 " alt="" height="50">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--STudent record total   verify  unverify  -->
                                <div class="col-xl-4 col-lg-6 col-sm-6">
                                    <div class="card shadow-sm">
                                        <div class="container overflow-hidden"
                                            style="background-color:#FFF7F5;min-height: 72px !important;">
                                            <div class="row gx-5  m-3">
                                                <div class="col-8">
                                                    <span class="h5   text-gray-800"></span>
                                                    <h1 class="mt-2 gordita-bold counter-value text-danger"
                                                        data-kt-countup="true"
                                                        data-kt-countup-value="{{ $total_student_count }}"
                                                        data-kt-countup-prefix=" "
                                                        style="font-size: 20px;font-weight: 800;">0</h1>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <img src="{{ asset('assets/images/gift-box.png') }}"
                                                        class="opacity-25 " alt="" height="50">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-sm-6">
                                    <div class="card shadow-sm">
                                        <div class="container overflow-hidden"
                                            style="background-color:#FFF7F5;min-height: 72px !important;">
                                            <div class="row gx-5  m-3">
                                                <div class="col-8">
                                                    <span class="h5   text-gray-800"></span>
                                                    <h1 class="mt-2 gordita-bold counter-value text-danger"
                                                        data-kt-countup="true"
                                                        data-kt-countup-value="{{ $verifyl_student_count }}"
                                                        data-kt-countup-prefix=" "
                                                        style="font-size: 20px;font-weight: 800;">0</h1>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <img src="{{ asset('assets/images/gift-box.png') }}"
                                                        class="opacity-25 " alt="" height="50">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-sm-6">
                                    <div class="card shadow-sm">
                                        <div class="container overflow-hidden"
                                            style="background-color:#FFF7F5;min-height: 72px !important;">
                                            <div class="row gx-5  m-3">
                                                <div class="col-8">
                                                    <span class="h5   text-gray-800"></span>
                                                    <h1 class="mt-2 gordita-bold counter-value text-danger"
                                                        data-kt-countup="true"
                                                        data-kt-countup-value="{{ $unverify_student_count }}"
                                                        data-kt-countup-prefix=" "
                                                        style="font-size: 20px;font-weight: 800;">0</h1>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <img src="{{ asset('assets/images/gift-box.png') }}"
                                                        class="opacity-25 " alt="" height="50">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if (Auth::user()->role == 3)
                        <div class="row mb-5">
                            <div class="card  card-bordered">
                                <div class="col-12 mt-3 ms-5 ">
                                    <h2>Sales Details</h2>
                                </div>
                                <div class="col-6 mt-3  ">
                                    <div class="d-flex">
                                        <input type="date" id="startDate" class="form-control" placeholder="Start Date">
                                        <input type="date" id="endDate" class="form-control" placeholder="End Date">
                                        <button type="button" class="btn btn-primary btn-sm py-1" id="filterDateRange">
                                            Filter
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 mt-3 d-flex justify-content-end">
                                    <div>
                                        <button type="button" class="btn active btn-sm graph-filter-button py-1"
                                            value="all">
                                            ALL

                                        </button>
                                        <button type="button" class="btn noselect btn-sm graph-filter-button py-1"
                                            value="1w">
                                            1W

                                        </button>
                                        <button type="button" class="btn noselect btn-sm graph-filter-button py-1"
                                            value="1m">
                                            1M

                                        </button>
                                        <button type="button" class="btn noselect btn-sm graph-filter-button py-1"
                                            value="6m">
                                            6M

                                        </button>
                                        <button type="button" class="btn noselect btn-sm graph-filter-button py-1"
                                            value="1y">
                                            1Y
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 m-md-5">
                                    <canvas id="admin" class="mh-400px"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="card  card-bordered">
                                <div class="col-12 mt-3 ms-5 ">
                                    <h2>Number of Users from Different Regions</h2>
                                </div>
                                <div class="col-12 m-md-5">
                                    <div id="kt_docs_google_chart_column"></div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

              
            </div>
            <!--end::Content-->
        </div>
        @if (Auth::user()->role == 0)
   
      
        <!-- Modal Structure -->
        <div class="modal fade" id="welcomeModal" tabindex="-1" aria-labelledby="welcomeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="welcomeModalLabel">Important Notification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="closeModalButton"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('newcommissionstructure.jpg') }}" alt="Welcome Image" class="img-fluid"
                            height="50">
                        <p class="mt-3">Welcome to skillsider.pk!</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Show the modal on page load
                const welcomeModal = new bootstrap.Modal(document.getElementById('welcomeModal'));
                welcomeModal.show();

                // Optionally add custom logic for the close button
                document.getElementById('closeModalButton').addEventListener('click', function() {
                    welcomeModal.hide(); // Explicitly hide the modal programmatically
                    console.log('Modal closed'); // Optional debug or additional logic
                });
            });
        </script>





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
        @if (session('error'))
            <script>
                Swal.fire({
                    title: 'Error',
                    text: '{{ session('error') }}',
                    icon: 'error'
                });
            </script>
        @endif


        @push('custom-scripts')
   
            @if (Auth::user()->role == 3)
            <script>
                // Pass PHP array to JavaScript
                var data = @json($data);
            
                // Function to filter data based on predefined date range (1w, 1m, 6m, 1y)
                function filterDataByRange(range) {
                    var filteredData = [];
                    var currentDate = new Date();
                    var pastDate = new Date();
            
                    // If the range is 'all', return all data
                    if (range === 'all') {
                        return data;
                    }
            
                    // Set the pastDate based on the selected range
                    if (range === '1w') {
                        pastDate.setDate(currentDate.getDate() - 7);
                    } else if (range === '1m') {
                        pastDate.setMonth(currentDate.getMonth() - 1);
                    } else if (range === '6m') {
                        pastDate.setMonth(currentDate.getMonth() - 6);
                    } else if (range === '1y') {
                        pastDate.setFullYear(currentDate.getFullYear() - 1);
                    }
            
                    // Filter the data based on the selected range
                    for (var i = 0; i < data.length; i++) {
                        var date = new Date(data[i][0]); // Assuming the date is in the format that JavaScript can parse
                        if (date >= pastDate) {
                            filteredData.push(data[i]);
                        }
                    }
            
                    return filteredData;
                }
            
                // Function to filter data based on custom date range
                function filterDataByDate(startDate, endDate) {
                    var filteredData = [];
                    
                    // Convert the dates to JavaScript Date objects
                    startDate = new Date(startDate);
                    endDate = new Date(endDate);
            
                    // Filter the data based on the custom date range
                    for (var i = 0; i < data.length; i++) {
                        var date = new Date(data[i][0]); // Assuming the date is in the format that JavaScript can parse
                        if (date >= startDate && date <= endDate) {
                            filteredData.push(data[i]);
                        }
                    }
            
                    return filteredData;
                }
            
                // Function to update the chart with the filtered data
                function updateChart(data) {
                    var graphDate = [];
                    var graphAmount = [];
            
                    // Loop through the filtered data
                    for (var i = 0; i < data.length; i++) {
                        graphDate.push(data[i][0]); // Date values for X-axis
                        graphAmount.push(data[i][1]); // Amount values for Y-axis
                    }
            
                    // Set up the chart data and options
                    var chartData = {
                        labels: graphDate, // Dates for X-axis
                        datasets: [{
                            label: 'Total Amount', // Chart label
                            borderColor: '#4d3185', // Line color
                            backgroundColor: 'rgba(77, 49, 133, 0.2)', // Fill color under the line
                            data: graphAmount, // Y-axis data
                            fill: true, // Fill the area under the line
                            borderWidth: 2, // Line thickness
                            tension: 0.4 // Smooth the line curve
                        }]
                    };
            
                    // Create or update the chart
                    var ctx = document.getElementById('admin').getContext('2d');
                    if (window.skillsierChart) {
                        skillsierChart.data = chartData;
                        skillsierChart.update();
                    } else {
                        skillsierChart = new Chart(ctx, {
                            type: 'line',
                            data: chartData,
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: true, // Show the legend
                                        position: 'top' // Position of the legend
                                    }
                                },
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Dates' // X-axis label
                                        }
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'Values' // Y-axis label
                                        },
                                        ticks: {
                                            stepSize: 1 // Control Y-axis step size
                                        }
                                    }
                                }
                            }
                            });
                        }
                    }
                
            
                // Initialize chart with all data by default
                updateChart(data);
            
                // Handle button click events to filter data by predefined ranges (1w, 1m, 6m, 1y)
                $('.graph-filter-button').on('click', function() {
                    var range = $(this).val(); // Get the value of the clicked button
                    var filteredData = filterDataByRange(range); // Filter data based on selected range
                    updateChart(filteredData); // Update the chart with filtered data
            
                    // Optionally, toggle active class for styling
                    $('.graph-filter-button').removeClass('active');
                    $(this).addClass('active');
                });
            
                // Handle filter button click to filter data based on the custom date range
                $('#filterDateRange').on('click', function() {
                    var startDate = $('#startDate').val(); // Get the start date from the input
                    var endDate = $('#endDate').val(); // Get the end date from the input
            
                    // Check if both dates are provided
                    if (startDate && endDate) {
                        var filteredData = filterDataByDate(startDate, endDate); // Filter data based on custom date range
                        updateChart(filteredData); // Update the chart with the filtered data
                    } else {
                        alert("Please select both start and end dates.");
                    }
                });
            </script>
            
            
            @endif
            @if (Auth::user()->role == 0)
                <script>
                    $(document).ready(function() {
                        // Initial call to show the graph with default 'all' data
                        showGraph('all');
                    });

                    // Click event for filter buttons
                    $('.graph-filter-button').click(function() {
                        // Update active button styling
                        $(".graph-filter-button").removeClass("select active").addClass("noselect");
                        $(this).removeClass("noselect active").addClass("select");

                        // Get the value for the date filter and update the graph
                        var dateValue = $(this).val();
                        showGraph(dateValue); // Call function to update the graph
                    });

                    // Function to show the graph based on the selected date filter
                    function showGraph(dateValue) {
                        var graphTarget = $("#admin_data");

                        // Check if there's an existing chart and destroy it before creating a new one
                        if (window.barGraph) {
                            window.barGraph.destroy();
                        }

                        // AJAX request to fetch graph data based on the date value
                        $.ajax({
                            url: '{{ route('fetch.graph.data') }}', // Update with your correct route
                            type: 'POST',
                            headers: {
                                'X-CSRF-Token': '{{ csrf_token() }}', // Make sure CSRF token is correct in Laravel
                            },
                            data: {
                                date: dateValue
                            },
                            success: function(data) {
                                var graphDate = [];
                                var graphAmount = [];

                                // If no data is found, use demo data
                                if (data.length > 0) {
                                    // Demo data
                                    for (var i = 1; i <= 5; i++) {
                                        graphDate.push('2024-12-' + (i < 10 ? '0' + i : i)); // Example demo dates
                                        graphAmount.push(Math.floor(Math.random() * 100) + 1); // Random demo amounts
                                    }
                                } else {
                                    // Process the data returned from the server
                                    for (var i in data) {
                                        graphDate.push(data[i].my_date); // Date values for X-axis
                                        graphAmount.push(data[i].total_amount); // Amount values for Y-axis
                                    }
                                }

                                // Prepare the data for the chart
                                var chartData = {
                                    labels: graphDate,
                                    datasets: [{
                                        label: 'Total Amount', // Chart label
                                        borderColor: '#4d3185', // Line color
                                        backgroundColor: 'rgba(77, 49, 133, 0.2)', // Fill color under the line
                                        data: graphAmount,
                                        fill: true, // Fill the area under the line
                                        borderWidth: 2, // Line thickness
                                        tension: 0.4 // Smooth the line curve
                                    }]
                                };

                                // Create the chart
                                window.barGraph = new Chart(graphTarget, {
                                    type: 'line',
                                    data: chartData,
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: {
                                                display: true, // Show the legend
                                                position: 'top' // Position of the legend
                                            }
                                        },
                                        scales: {
                                            x: {
                                                title: {
                                                    display: true,
                                                    text: 'Dates' // X-axis label
                                                }
                                            },
                                            y: {
                                                title: {
                                                    display: true,
                                                    text: 'Values' // Y-axis label
                                                },
                                                ticks: {
                                                    stepSize: 1 // Control Y-axis step size
                                                }
                                            }
                                        }
                                    }
                                });
                            },
                            error: function() {
                                alert('Error occurred while fetching data. Please try again later.');
                            }
                        });
                    }
                </script>
            @endif

            <script src="https://www.gstatic.com/charts/loader.js"></script>
            <script>
                google.charts.load('current', {
                    packages: ['corechart']
                });

                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    // Create the data table.
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Region');
                    data.addColumn('number', 'Number of Users');

                    // Here, you can use the PHP variables directly by echoing them out
                    var studentCounts = [
                        ['Punjab', {{ $total_student_count_punjab }}],
                        ['Sindh', {{ $total_student_count_sindh }}],
                        ['KPK', {{ $total_student_count_kpk }}],
                        ['Gilgit Bultistan', {{ $total_student_count_Gilgit }}]
                    ];

                    data.addRows(studentCounts);

                    // Set chart options.
                    var options = {
                        title: '',
                        subtitle: 'By Region',
                        colors: ['#4e3286']
                    };

                    // Instantiate and draw the chart.
                    var chart = new google.visualization.ColumnChart(document.getElementById('kt_docs_google_chart_column'));
                    chart.draw(data, options);
                }
            </script>
        @endpush


    @endsection
