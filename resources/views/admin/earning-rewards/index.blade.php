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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Reward
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
                        <li class="breadcrumb-item text-muted">Reward Details</li>
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
                                <h3 class="fw-bold m-0">Rewards</h3>
                            </div>
                            <!--end::Card title-->
                            @if (Auth::user()->role == 1)
                                <!--begin::Action-->
                                <a href="{{ route('earning-rewards.create') }}"
                                    class="btn btn-sm text-light btn-primary align-self-center">Add Reward</a>
                                <!--end::Action-->
                                @else
                                  <!--begin::Action-->
                            <a href="{{ route('claim-rewards.index') }}"
                                class="btn btn-sm text-light btn-primary align-self-center">Claimed Rewards</a>
                            <!--end::Action-->
                            @endif
                        </div>

          <table id="kt_datatable_dom_positioning"
    class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
    <thead>
        <tr class="fw-bolder fs-6 text-gray-800 px-7">
            <th>Sr.No</th>
            <th>Name</th>
            <th>Reward</th>
            <th>Image</th>
            <th>Target Amount</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Remaining Days</th>
            <th>Remaining Amount</th>
            <th>Total Earnings</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($earningRewards as $Reward)
            @php
             
    // Get the current reward's earnings (from controller)
    $rewardEarnings = \App\Models\Earning::where('user_id', Auth::id())
        ->whereDate('created_at', '>=', $Reward->start_date) // Include start date
        ->whereDate('created_at', '<=', $Reward->end_date)   // Include end date
        ->sum('amount'); // Sum up the 'amount' column to get total earnings

    
            @endphp

            <tr class="text-center">
                <td> {{ $i++ }} </td>
                <td>{{ $Reward->name }}</td>
                
                <td>
                    @if (is_numeric($Reward->reward))
                        Rs{{ $Reward->reward }}
                    @else
                        {{ $Reward->reward }}
                    @endif
                </td>

                <td>
                    @if ($Reward->image)
                        <img src="{{ asset($Reward->image) }}" alt="Reward Image" style="width: 100px; height: auto;">
                    @else
                        N/A
                    @endif
                </td>
                
                <td>Rs{{ $Reward->target_amount }}</td>
                <td>{{ $Reward->start_date }}</td>
                <td>{{ $Reward->end_date }}</td>

                <td>
                    @php
                        // Calculate remaining days
                        $endDate = $Reward->end_date
                            ? \Carbon\Carbon::parse($Reward->end_date)->startOfDay()
                            : \Carbon\Carbon::create(2124, 10, 1)->startOfDay(); // Default date if end_date is null

                        $currentDate = \Carbon\Carbon::now()->startOfDay();
                        $remainingDays = ($endDate->timestamp - $currentDate->timestamp) / (60 * 60 * 24);
                        $remainingDays = intval($remainingDays); // Convert to integer
                    @endphp

                    @if($Reward->end_date)
                        @if ($remainingDays >= 1)
                            {{ $remainingDays }} days left
                        @elseif ($remainingDays === 0)
                            <span class="badge badge-warning">Last Day</span>
                        @else
                            <span class="badge badge-danger">Expired</span>
                        @endif
                    @endif
                </td>

                {{-- Display remaining amount based on earnings --}}
                <td>
                    @if ($Reward->target_amount > $rewardEarnings)
                        <span class="badge badge-danger">Rs {{ number_format($Reward->target_amount - $rewardEarnings, 0) }}</span>
                    @else
                        <span class="badge badge-success">Achieved</span>
                    @endif
                </td>

                {{-- Show Total Earnings for this reward --}}
                <td>Rs {{ number_format($rewardEarnings, 0) }}</td>
              

                {{-- Actions (Admin/User) --}}
                @if (Auth::user()->role == 1)
                    <td class="  text-start">
                        <a href="#"
                            class="btn btn-light btn-active-light-primary btn-sm  menu-dropdown"
                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                            data-kt-menu-flip="top-end">
                            Actions
                        </a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4 "
                            data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="{{ route('earning-rewards.edit', ['earning_reward' => $Reward->id]) }}"
                                    class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                                    Edit
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <p>
                                    <a type="button" id="delete-course-{{ $Reward->id }}"
                                        class="menu-link px-3">
                                        Delete
                                    </a>
                                    <form id="delete-form-{{ $Reward->id }}"
                                        action="{{ route('earning-rewards.destroy', $Reward->id) }}"
                                        method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </p>
                            </div>
                        </div>
                    </td>
                @else
                    @php
                        $claimrewardpending = \App\Models\ClaimReward::where('user_id', Auth::id())
                            ->where('reward_id', $Reward->id)
                            ->where('status', 'pending')
                            ->first();
                        $claimrewardcompleting = \App\Models\ClaimReward::where('user_id', Auth::id())
                            ->where('reward_id', $Reward->id)
                            ->where('status', 'completed')
                            ->first();
                    @endphp

                    {{-- Check if the reward is claimed or pending --}}
                    @if ($Reward->target_amount >= $rewardEarnings)
                    <td><span class="badge badge-danger">Eneligible </span></td>
                    @else
                        @if ($claimrewardpending)
                            <td><span class="badge badge-info">Pending</span></td>
                        @elseif($claimrewardcompleting)
                            <td><span class="badge badge-success">Delivered</span></td>
                        @else
                            <td>
                              <a href="{{ route('earning-rewards.claim', ['earning_reward' => $Reward->id]) }}"
                                    class="btn btn-sm text-light btn-success">Claim Reward</a> 
                            </td>
                        @endif
                    
                    @endif
                @endif
            </tr>
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
                        title: 'Delete Review',
                        text: 'Are you sure you want to delete this Review?',
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
