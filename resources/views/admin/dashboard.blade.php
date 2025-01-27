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
                                        style="background-color:#f8f5ff; 
                                     
                                    border: 3px solid #ead9d775; 
                                    border-radius: 10px; 
                                    background-image: url('{{ env('APP_URL') }}/profile_bg.jpg');; 
                                    background-size: cover; 
                                    background-position: center; 
                                    background-repeat: no-repeat;">

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

                                            <div class="mt-7 ms-5 ps-5 ">
                                                <div class="d-flex justify-content-start gx-10 mb-2">
                                                    <h1 style="font-size: 18px">{{ Auth::user()->first_name }}
                                                        {{ Auth::user()->last_name }}</h1>
                                                </div>

                                                @if (Auth::user()->role == 0)
                                                    <div class="d-flex justify-content-start gx-10">
                                                        @php
                                                            // Define images for each package
                                                            $images = [
                                                                1 => 'verified_skill_sider.png',
                                                                2 => 'employee_of_the_month_skill_sider.png',
                                                                3 => 'best_seller_pro_skill_sider.png',
                                                                4 => 'diamond_skill_sider.png',
                                                            ];
                                                            $package = Auth::user()->package; // Get the user's package
$img = $images[$package->id] ?? 'default.png'; // Fallback to 'default.png' if no image is found
                                                        @endphp
                                                        @if ($package)
                                                            <span class="badge badge-lg d-flex align-items-center"
                                                                style="background-color:{{ $package->color_code }}; color: {{ $package->text_color_code }}; line-height: 1; border-radius: 10px 1px 10px 1px; 
                                                                    border-bottom: 3px solid rgba(0, 0, 0, 0.3); border-right: 3px solid rgba(0, 0, 0, 0.3);">
                                                                {{-- <img src="{{ asset('sidebaricon/' . $img) }}" alt="" class="me-1" width="20px"> --}}
                                                                {{ $package->package_title }}
                                                            </span>
                                                        @endif
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
                            <style>
                                .mobile_responisve {
                                    background-color: #f8f5ff;
                                    min-height: 100px;
                                    height: 100px;
                                    border: 3px solid #ead9d775;
                                    border-radius: 10px;
                                }

                                .mobile_responisve .row {
                                    margin: 1.25rem;
                                }

                                #top-box {
                                    height: 100px;
                                    background-color: #f8f5ff;
                                    border: 3px solid #ead9d775;
                                    border-radius: 10px;
                                }

                                #top-inner-box {
                                    margin-top: 18px !important;
                                }

                                #top-box-heading {
                                    font-size: large;
                                }
                                #top-inner-box h1 {
                                        font-size: 2rem ;
                                        font-weight: 800;
                                    }


                                @media (max-width: 768px) {
                                    .mobile_responisve {
                                        height: 72px !important;

                                        min-height: 0px;
                                    }

                                    #top-box {

                                        height: 72px !important;
                                    }

                                    #top-inner-box h1 {
                                        font-size: 1.7rem ;
                                        font-weight: 800;
                                    }

                                    #top-inner-box {
                                        margin-top: 5px !important;
                                    }
                                    #top-box-heading {
                                    font-size: 1.15rem ;
                                    font-weight: 600;

                                }


                                    .mobile_responisve .row {
                                        margin: 10px

                                    }
                                }
                            </style>
                            @if (Auth::user()->role == 0)
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-sm-0 mt-md-2 ">
                                    <div class="card shadow-sm" style="border-radius: 15px;">
                                        <div id="top-box" class="container overflow-hidden btn-active-light-info">
                                            <div class="row gx-5   m-2 " id="top-inner-box">
                                                <div class="col-8">
                                                    <span class="font-weight-bold text-gray-800"
                                                        id="top-box-heading">Today's</span>
                                                    <h1 class="mt-2 gordita-bold counter-value   fw-bold"
                                                        data-kt-countup="true" data-kt-countup-value="{{ $today_earning }}"
                                                        data-kt-countup-prefix="Rs "
                                                        style="font-weight: 800!important;color: #00CC32;">0
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
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="card shadow-sm" style="border-radius: 15px;">
                                        <div id="top-box" class="container overflow-hidden">
                                            <div class="row gx-5  m-2" id="top-inner-box">
                                                <div class="col-8">
                                                    <span class="text-gray-800 " id="top-box-heading">Last 7 Days</span>
                                                    <h1 class="mt-3 gordita-bold counter-value " data-kt-countup="true"
                                                        data-kt-countup-value="{{ $last7Days_earning }}"
                                                        data-kt-countup-prefix="Rs "
                                                        style="font-weight: 800;color: #1abae3;">0</h1>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <img src="{{ asset('assets/images/hand.png') }}" class="opacity-25 "
                                                        alt="" height="50">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="card shadow-sm" style="border-radius: 15px;">
                                        <div id="top-box" class="container overflow-hidden">
                                            <div class="row gx-5  m-2" id="top-inner-box">
                                                <div class="col-8">
                                                    <span class="text-gray-800" id="top-box-heading">Last 30 Days</span>
                                                    <h1 class="mt-2 gordita-bold counter-value " data-kt-countup="true"
                                                        data-kt-countup-value="{{ $last30Days_earning }}"
                                                        data-kt-countup-prefix="Rs "
                                                        style="font-weight: 800;color: #00CC32;">0</h1>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <img src="{{ asset('assets/images/bar-chart.png') }}"
                                                        class="opacity-25 " alt="" height="50">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="card shadow-sm" style="border-radius: 15px;">
                                        <div id="top-box" class="container overflow-hidden">
                                            <div class="row gx-5  m-2" id="top-inner-box">
                                                <div class="col-8">
                                                    <span class="   text-gray-800" id="top-box-heading">Total
                                                        Earning</span>
                                                    <h1 class="mt-2 gordita-bold counter-value" data-kt-countup="true"
                                                        data-kt-countup-value="{{ $all_time__earning }}"
                                                        data-kt-countup-prefix="Rs "
                                                        style="font-weight: 800;color: #E0115F;">0</h1>
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
                                            style="background-color:#FFF7F5;min-height: 100px !important;">
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
                                        <div class="container overflow-hidden" style="background-color:#FFF7F5;">
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
                                        <div class="container overflow-hidden" style="background-color:#FFF7F5;">
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
                                        <div class="container overflow-hidden" style="background-color:#FFF7F5;">
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
                                        <div class="container overflow-hidden" style="background-color:#FFF7F5;">
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
                                        <div class="container overflow-hidden" style="background-color:#FFF7F5;">
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


                    <div class="row mb-5"
                        style="
                    display: block;
                    margin: auto;
                ">
                        <div class="card  card-bordered">
                            <div class="col-12 mt-3 ms-5 ">
                                <h2>Sales Details</h2>
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
                                <canvas id="kt_chartjs_2" class="mh-400px"></canvas>
                            </div>
                        </div>
                    </div>


                    @if (Auth::user()->role == 3)
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

                @if (Auth::user()->role == 0)
                    <!--begin::Content-->
                @endif
            </div>
            <!--end::Content-->
        </div>



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
            </script>



            <script>
                $(document).ready(function() {
                    showGraph('all');
                });
                $('.graph-filter-button').click(function() {
                    $(".graph-filter-button").removeClass("select active");
                    $(".graph-filter-button").addClass("noselect");
                    $(this).removeClass("noselect active");
                    $(this).addClass("select");
                    var dateValue = $(this).val();
                    showGraph(dateValue); // Call the function from the module
                });


                function showGraph(dateValue) {
                    var graphTarget = $("#kt_chartjs_2");

                    // Check if there's an existing chart and destroy it
                    if (window.barGraph) {
                        window.barGraph.destroy();
                    }

                    $.ajax({
                        url: '{{ route('fetch.graph.data') }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}',
                        },
                        data: {
                            date: dateValue
                        },
                        success: function(data) {
                            console.log(data);
                            var graphDate = [];
                            var graphAmount = [];

                            // Fill graphDate and graphAmount with the data
                            for (var i in data) {
                                graphDate.push(data[i].my_date);
                                graphAmount.push(data[i].total_amount);
                            }
                            // Prepare the chart data
                            var chartdata = {
                                labels: graphDate,
                                datasets: [{
                                    label: '',
                                    borderColor: '#4d3185',
                                    data: graphAmount
                                }]
                            };
                            // Create the chart
                            window.barGraph = new Chart(graphTarget, {
                                type: 'line',
                                data: chartdata,
                                options: {
                                    scales: {
                                        y: {
                                            ticks: {
                                                // Custom callback to format the Y-axis labels as "10k", "20k", etc.
                                                callback: function(value) {
                                                    // If the value is greater than or equal to 5000, display it in "k" format
                                                    if (value >= 500) {
                                                        return (value / 1000) +
                                                            'k'; // Display as "10k", "20k", etc.
                                                    }
                                                    return value; // Otherwise, display the value as it is
                                                }
                                            }
                                        }
                                    }
                                }
                            });

                        },
                        error: function() {
                            alert('Failure from PHP side!!!');
                        }
                    });
                }
            </script>


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
