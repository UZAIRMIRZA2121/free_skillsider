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
                                    // Get the current reward's earnings (from controller)
                                $rewardEarnings = \App\Models\Earning::where('user_id', Auth::id())
                                    ->whereDate('created_at', '>=', $earningRewards->start_date) // Include start date
                                    ->whereDate('created_at', '<=', $earningRewards->end_date) // Include end date
                                    ->sum('amount'); // Sum up the 'amount' column to get total earnings

                                    use Carbon\Carbon;
                                    $endDate = Carbon::parse($earningRewards->end_date); // Parse the end date to a Carbon instance
                                    $currentDate = Carbon::now();

                                @endphp
                                <tr class="text-center">
                                    <td> {{ $i++ }} </td>
                                    <td>{{ $earningRewards->name }}</td>
                                    <td>
                                        @if (is_numeric($earningRewards->reward))
                                            Rs{{ $earningRewards->reward }}
                                        @else
                                            {{ $earningRewards->reward }}
                                        @endif
                                    </td>

                                    <td>
                                        @if ($earningRewards->image)
                                            <img src="{{ asset($earningRewards->image) }}" alt="Reward Image"
                                                style="width: 100px; height: auto;">
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <td>{{ $earningRewards->target_amount }}</td>

                                    <td>{{ $earningRewards->start_date }}</td>
                                    <td>{{ $earningRewards->end_date }}</td>
                                    <td>
                                        @php
                                         
                                            // Check if the end date is in the past
                                            if ($endDate->isPast()) {
                                                $status = 'Expired';
                                                $badgeClass = 'badge-danger'; // Red badge for expired
                                            } else {
                                                // Calculate the remaining days
                                                $remainingDays = $endDate->diffInDays($currentDate);
                                                $status =
                                                    $remainingDays > 1
                                                        ? "$remainingDays days remaining"
                                                        : '1 day remaining'; // Handle 1 day remaining
                                                $badgeClass = 'badge-success'; // Green badge for remaining
                                            }
                                        @endphp

                                        @if ($status === 'Expired')
                                            <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                                        @else
                                            <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $remainingAmount = $earningRewards->target_amount - $rewardEarnings;
                                    
                                            if ($earningRewards->target_amount <= $rewardEarnings) {
                                                // Target amount is greater than the reward earnings
                                                $statusMessage = 'Congratulations';
                                                $badgeClass = 'badge-success'; // Green badge for success
                                            } else {
                                                // Reward earnings have met or exceeded the target amount
                                                $statusMessage = "$remainingAmount";
                                                $badgeClass = 'badge-danger'; // Red badge for danger
                                            }
                                        @endphp
                                    
                                        <span class="badge {{ $badgeClass }}">
                                            {{ $statusMessage }} 
                                        </span>
                                    </td>
                                    <td>Rs {{ $rewardEarnings }}</td>
                                    <td>
                                        @php
                                          $remainingAmount = $earningRewards->target_amount - $rewardEarnings;
                                            
                                            // Check if the claimReward object exists
                                            if ($claimReward) {
                                                // If claimReward exists, check the claim status
                                                if ($claimReward->status == 'pending') {
                                                    // If the status is pending, show a "Processing" badge
                                                    $statusMessage = 'Processing';
                                                    $badgeClass = 'badge-warning'; // Yellow badge for processing
                                                    $button = ''; // No button, just show the "Processing" badge
                                                } elseif ($claimReward->status == 'completed') {
                                                    // If the status is completed, show a "Completed" badge
                                                    $statusMessage = 'Completed';
                                                    $badgeClass = 'badge-success'; // Green badge for success
                                                    $button = ''; // No button, just show the "Completed" badge
                                                } else {
                                                    // If the claimReward status is not 'pending' or 'completed', check the target amount
                                                    if ($earningRewards->target_amount <= $rewardEarnings) {
                                                        $statusMessage = 'Claim Reward';
                                                        $badgeClass = 'badge-success'; // Green badge for success
                                                        $button = '<a href="' . route('earning-rewards.claim', ['earning_reward' => $earningRewards->id]) . '" class="btn btn-sm text-light btn-success">Claim Reward</a>';
                                                    } else {
                                                        // If the target amount is greater than the reward earnings
                                                        $statusMessage = "$remainingAmount remaining";
                                                        $badgeClass = 'badge-danger'; // Red badge for danger
                                                        $button = ''; // No button, just show the remaining amount
                                                    }
                                                }
                                            } else {
                                                // If claimReward does not exist, check the target amount
                                                if ($earningRewards->target_amount <= $rewardEarnings) {
                                                    $statusMessage = 'Claim Reward';
                                                    $badgeClass = 'badge-success'; // Green badge for success
                                                    $button = '<a href="' . route('earning-rewards.claim', ['earning_reward' => $earningRewards->id]) . '" class="btn btn-sm text-light btn-success">Claim Reward</a>';
                                                } else {
                                                    // If the target amount is greater than the reward earnings
                                                    $statusMessage = "$remainingAmount remaining";
                                                    $badgeClass = 'badge-danger'; // Red badge for danger
                                                    $button = ''; // No button, just show the remaining amount
                                                }
                                            }
                                        @endphp
                                    
                                    
                                        <!-- Display the status message with the appropriate badge -->
                                        <span class="badge {{ $badgeClass }}">
                                            {{ $statusMessage }} 
                                        </span>
                                    
                                        <!-- If the target amount is met or exceeded and the status is not pending, show the claim button -->
                                        {!! $button !!}
                                    </td>
                                    




                                </tr>
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
