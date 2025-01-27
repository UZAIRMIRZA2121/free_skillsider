@extends('layouts.admin.master')

@section('admin')
{{--<style>--}}
{{--    /* Style for the striped table */--}}
{{--    .striped-table {--}}
{{--        width: 100%;--}}
{{--        border-collapse: collapse;--}}
{{--    }--}}

{{--    .striped-table th{--}}
{{--        background-color: #ff6f79;--}}
{{--    }--}}
{{--    .striped-table td {--}}
{{--        padding: 8px;--}}
{{--        border: 1px solid #ccc;--}}
{{--    }--}}

{{--    /* Style for even rows (white) */--}}
{{--    .striped-table tr:nth-child(even) {--}}
{{--        background-color:	#FFB6C1;--}}
{{--    }--}}

{{--    /* Style for odd rows (red) */--}}
{{--    .striped-table tr:nth-child(odd) {--}}
{{--        background-color: white;--}}

{{--    }--}}
{{--</style>--}}

<style>
    .t_heade{
        background-color :#4d3185;
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
                        <li class="breadcrumb-item text-muted">Leaderboard</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->

            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card  ">
                    <div class=" ">
                        <div class="card-header cursor-pointer w-100 text-center">
                            <h1 class="d-block m-auto">    <img src="{{ asset('sidebaricon/award-badge.png') }}" alt=""
                                width="35px">Leaderboard</h1>
                         
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <div class="row">
                            <div class="col-lg-12">
                                <section class="content">
                                    <div class="container-fluid">
                                        <div class="row">

                                            <div class="col-md-4">

                                                <div class="card card-primary card-outline  text-center">

                                                    <!-- /.card-header -->
                                                    <div class="card-body p-3">
                                                        <h5 class=" " style="color:#404E67;"><strong>Top
                                                                7 Days</strong></h5>
                                                        <div id="example3_wrapper"
                                                            class="dataTables_wrapper dt-bootstrap4 no-footer">

                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <table style="color: rgb(27, 159, 235);"
                                                                           id="example3"
                                                                           class="table  table-bordered  no-footer dtr-inline table-striped"
                                                                           role="grid" aria-describedby="example3_info">
                                                                        <thead class="t_heade ">
                                                                        <tr role="row">
                                                                            <th class="sorting_disabled text-light" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1" style="width: 75px;
                                                                                aria-label=" Name: activate to sort column ascending"> Profile</th>
                                                                            <th class="sorting_disabled text-light" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1"
                                                                                aria-label=" Name: activate to sort column ascending"
                                                                                style="width: 75px;"> Name</th>

                                                                            <th class="sorting_disabled text-light" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="Amount: activate to sort column ascending"
                                                                                style="width: 78px;">Amount</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id="inner1">
                                                                            @foreach ($topEarnings_7_days as $earning)
                                                                                <tr role="row" class="">
                                                                                    <td class="" tabindex="0">
                                                                                        @if ($earning->user->profile_photo_path)
                                                                                            <img src="{{ asset('profile-image/'.$earning->user->profile_photo_path) }}"
                                                                                                class="rounded-3"
                                                                                                alt="user"  height="50" width="50"/>
                                                                                        @else
                                                                                            <img src="{{ asset('assets/images/defaultprofile.jpg') }}"
                                                                                                class="rounded-3"
                                                                                                alt="user"  height="50" width="50" />
                                                                                        @endif

                                                                                    </td>
                                                                                    <td class="align-middle"> <b>{{ $earning->user->first_name }}
                                                                                        {{ $earning->user->last_name }}</b> </td>
                                                                                    <td class="align-middle" style="
                                                                                        width: 93px;
                                                                                    "><b>Rs{{ number_format($earning->total_amount , 0)}}</b></td>
                                                                               
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-5"></div>
                                                                <div class="col-sm-12 col-md-7"></div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-4">

                                                <div class="card card-primary card-outline  text-center">

                                                    <!-- /.card-header -->
                                                    <div class="card-body p-3">
                                                        <h5 class="" style="color:#404E67;"><strong>Top 30 days
                                                            </strong></h5>
                                                        <div id="example3_wrapper"
                                                            class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-6"></div>
                                                                <div class="col-sm-12 col-md-6"></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <table style="color: rgb(27, 159, 235);"
                                                                           id="example3"
                                                                           class="table  table-bordered  no-footer dtr-inline table-striped"
                                                                           role="grid" aria-describedby="example3_info">
                                                                        <thead class="t_heade ">
                                                                        <tr role="row">

                                                                              <th class="sorting_disabled text-light" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1" style="width: 75px;
                                                                                aria-label=" Name: activate to sort column ascending"> Profile</th>
                                                                            <th class="sorting_disabled text-light" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1"
                                                                                aria-label=" Name: activate to sort column ascending"
                                                                                style="width: 75px;"> Name</th>

                                                                            <th class="sorting_disabled text-light" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="Amount: activate to sort column ascending"
                                                                                style="width: 78px;">Amount</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id="inner1">
                                                                          
                                                                            @foreach ($topEarnings_30_days as $earning)
                                                                                <tr role="row" class="">
                                                                                    <td class="" tabindex="0">
                                                                                        @if ($earning->user->profile_photo_path)
                                                                                            <img src="{{ asset('profile-image/'.$earning->user->profile_photo_path) }}"
                                                                                                class="rounded-3"
                                                                                                alt="user"  height="50" width="50"/>
                                                                                        @else
                                                                                            <img src="{{ asset('assets/images/defaultprofile.jpg') }}"
                                                                                                class="rounded-3"
                                                                                                alt="user"  height="50" width="50" />
                                                                                        @endif

                                                                                    </td>
                                                                                    <td class="align-middle"> <b>{{ $earning->user->first_name }}
                                                                                        {{ $earning->user->last_name }}</b> </td>
                                                                                  <td class="align-middle" style="
                                                                                        width: 93px;
                                                                                    "><b>Rs{{ number_format($earning->total_amount , 0)}}</b></td>
                                                                             
                                                                             </tr>
                                                                        
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-5"></div>
                                                                <div class="col-sm-12 col-md-7"></div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-4">

                                                <div class="card card-primary card-outline  text-center">

                                                    <!-- /.card-header -->
                                                    <div class="card-body p-3">
                                                        <h5 class="" style="color:#404E67;"><strong>All
                                                                Time</strong></h5>
                                                        <div id="example3_wrapper"
                                                            class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-6"></div>
                                                                <div class="col-sm-12 col-md-6"></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <table style="color: rgb(27, 159, 235);"
                                                                        id="example3"
                                                                        class="table  table-bordered  no-footer dtr-inline table-striped"
                                                                        role="grid" aria-describedby="example3_info">
                                                                        <thead class="t_heade">
                                                                            <tr role="row">

                                                                                  <th class="sorting_disabled text-light" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1" style="width: 75px;
                                                                                aria-label=" Name: activate to sort column ascending"> Profile</th>
                                                                            <th class="sorting_disabled text-light" tabindex="0"
                                                                                aria-controls="example1" rowspan="1"
                                                                                colspan="1"
                                                                                aria-label=" Name: activate to sort column ascending"
                                                                                style="width: 75px;"> Name</th>

                                                                                <th class="sorting_disabled text-light" tabindex="0"
                                                                                    aria-controls="example1" rowspan="1"
                                                                                    colspan="1"
                                                                                    aria-label="Amount: activate to sort column ascending"
                                                                                    style="width: 78px;">Amount</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="inner1">
                                                                            @foreach ($topEarnings_AllTime as $earning)
                                                                                <tr role="row" class="">
                                                                                    <td class="" tabindex="0">
                                                                                        @if ($earning->user->profile_photo_path)
                                                                                            <img src="{{ asset('profile-image/'.$earning->user->profile_photo_path) }}"
                                                                                                 class="rounded-3"
                                                                                                alt="user"  height="50" width="50"/>
                                                                                        @else
                                                                                            <img src="{{ asset('assets/images/defaultprofile.jpg') }}"
                                                                                                class="rounded-3"
                                                                                                alt="user"  height="50" width="50" />
                                                                                        @endif

                                                                                    </td>
                                                                                    <td class="align-middle"> <b>{{ $earning->user->first_name }}
                                                                                        {{ $earning->user->last_name }}</b> </td>
                                                                                <td class="align-middle" style="
                                                                                        width: 93px;
                                                                                    "><b>Rs{{ number_format($earning->total_amount , 0)}}</b></td>
                                                                             
                                                                              </tr>
                                                                            
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-5"></div>
                                                                <div class="col-sm-12 col-md-7"></div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.container-fluid -->
                                </section>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
@endsection
