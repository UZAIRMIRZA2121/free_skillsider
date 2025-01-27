<style>
    /* Initial CSS to set visibility to visible */
    .app-navbar {
        visibility: visible;
        transition: visibility 1s ease-in-out;
    }

    /* Class to hide the navbar */
    .app-navbar-hidden {
        visibility: hidden;
        transform: translateY(-100%);
    }

    .notification-dropdown {
        z-index: 1050;
        border-radius: 0.25rem;
        max-height: 300px;
        overflow-y: auto;
    }
    .notification-dropdown-mobile {
        z-index: 999;
        border-radius: 0.25rem;
        max-height: 300px;
        overflow-y: auto;
    }
</style>


<!--begin::Header-->
<div id="kt_app_header" class="app-header bg-white sticky-top">

    <!--begin::Header container-->
    <div class="w-100 d-none d-lg-flex m-auto justify-content-center" id="">
        <!-- Transparent Buttons -->
        <a href="{{ route('std.index') }}" class="btn btn-outline-light">Home</a>
        <a class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
            aria-expanded="false">
            Courses
        </a>
        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
            @php
                $packages = App\Models\Packages::all();
            @endphp
            @if ($packages)

                @foreach ($packages as $package)
                    <li><a class="dropdown-item b"
                            href="{{ route('single.package', ['id' => $package->id]) }}">{{ $package->package_title }}
                            Packages</a></li>
                @endforeach
            @else
                <li>No Package available right now</li>
            @endif
        </ul>
        <a href="{{ route('about.us') }}" class="btn btn-outline-light">About Us</a>
        <a href="{{ route('contact.us') }}" class="btn btn-outline-light">Contact</a>
        <a href="{{ route('blog') }}" class="btn btn-outline-light">Blog</a>
        <!--end::User menu-->
        <!-- Bell Icon at the end -->

        <!-- ... (other navbar content) ... -->
    </div>
    @if (Auth::user()->role == 0)
        <div class="d-none d-lg-flex me-3 justify-content-between position-relative">
            <!-- Bell Icon with Notification Dropdown -->
            <a href="javascript:void(0);" id="notification-toggle"
                class="d-lg-flex m-auto btn btn-outline-light justify-content-end position-relative">

                @php
                    $unreadNotifications = Auth::user()->unreadNotifications; // Get unread notifications for the logged-in user

                    $unreadCount = $unreadNotifications->count(); // Count unread notifications
                    $notifications = App\Models\Notification::whereHas('notificationUsers', function ($query) {
    $query->where('user_id', Auth::id());
        })
        ->with(['notificationUsers' => function ($query) {
            $query->where('user_id', Auth::id());
        }])
        ->orderBy('created_at', 'desc')
        ->get();


                @endphp

   
                @if ($unreadCount > 0)
                    <i class="fa fa-bell " aria-hidden="true" style="font-size: 25px;color: #4a219c;">
                        <span
                            class="badge position-absolute top-0  rounded-circle"
                            style="font-size: 14px; padding: 3px 7px; background-color: #f46f22; transform: translate(50%, 0%) !important">
                            {{ $unreadCount }}
                        </span>
                    </i>
                @else
                    <i class="fa fa-bell " aria-hidden="true" style="font-size: 25px; color: #4a219c;"></i>
                @endif
            </a>

            <!-- Notification Dropdown -->
            <div id="notification-dropdown" 
                class="notification-dropdown d-none bg-white shadow rounded position-absolute top-100 end-0 mt-2 p-5"
                style="width: 500px;">
                <h3 class="text-dark border-bottom pb-2">Notifications</h3>
                <ul class="list-unstyled mb-0">
                    @php
                        $new_notification = null;
                    @endphp
                    @forelse($notifications as $notification)
                        @foreach ($notification->notificationUsers as $notificationUser)
                            @php
                                $new_notification = $notificationUser->is_read;

                            @endphp
                        @endforeach
                        @if($notificationUser->user_id == Auth::id())
                        <li class="mb-5">
                            <a href="{{ route('notification.show', $notification->id) }}"
                                class="text-decoration-none text-dark">
                                <div class="d-flex justify-content-between align-items-start">
                                    <!-- Title -->
                                    <div>
                                        <span class="fw-bold d-block h5">
                                            @if (!$new_notification)
                                            <!-- Red dot for unread notification -->
                                            {{-- <span class="badge bg-danger rounded-circle"
                                                style="width: 5px; height: 5px; display: inline-block;"></span> --}}
                                            @else
                                            {{-- <span class="badge bg-success rounded-circle"
                                            style="width: 5px; height: 5px; display: inline-block;"></span> --}}
                                            @endif
                                            {{ $notification->title ?? 'New Notification' }}
                                          
                                        </span>
                                        <!-- Message -->
                                        <span class="text-muted d-block">
                                            {{ \Illuminate\Support\Str::limit($notification->message, 50, '...') }}
                                        </span>
                                    </div>
                                    <!-- Timestamp -->
                                    <small
                                        class="text-muted ms-3">{{ $notification->created_at->diffForHumans() }}</small>
                                </div>
                            </a>
                        </li>
                        @endif
                    @empty
                        <li class="text-muted text-center">No new notifications</li>
                    @endforelse
                </ul>

            </div>


            <!-- Hidden Form to Mark Notifications as Read -->
            <form id="mark-as-read-form" action="{{ route('std.all.notifications') }}" method="POST"
                style="display: none;">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            </form>
        </div>

        <script>
            // Function to toggle the visibility of the navbar
            function toggleNavbarVisibility() {
                const navbar = document.getElementById('appNavbar');
                if (window.scrollY > 50) { // Adjust the scroll threshold as needed
                    navbar.classList.add('app-navbar-hidden');
                } else {
                    navbar.classList.remove('app-navbar-hidden');
                }
            }
        
            // Attach the scroll event listener
            window.addEventListener('scroll', toggleNavbarVisibility);
        </script>
        
    @endif


    <div class="bg-white d-lg-none">
        <!--begin::Logo image-->

        <a href="{{ route('dashboard') }}" class="text-dark">
            <img alt="Logo" src="{{ asset('assets/images/skillsider_logo.png') }}"
                class="h-50px app-sidebar-logo-default ms-5 mt-3" />
        </a>
    </div>
    <div class="d-block d-lg-none d-flex align-items-center justify-content-end m-auto me-5" title="Show sidebar menu">
        @if (Auth::user()->role == 0)
        <div class=" d-lg-flex me-3 justify-content-between position-relative">
            <!-- Bell Icon with Notification Dropdown -->
            <a href="javascript:void(0);" id="notification-toggle-mobile"
                class="d-lg-flex m-auto btn btn-outline-light justify-content-end position-relative">

                @php
                    $unreadNotifications = Auth::user()->unreadNotifications; // Get unread notifications for the logged-in user

                    $unreadCount = $unreadNotifications->count(); // Count unread notifications
                    $notifications = App\Models\Notification::whereHas('notificationUsers', function ($query) {
    $query->where('user_id', Auth::id());
})
->with(['notificationUsers' => function ($query) {
    $query->where('user_id', Auth::id());
}])
->orderBy('created_at', 'desc')
->get();


                @endphp

                @if ($unreadCount > 0)
                    <i class="fa fa-bell " aria-hidden="true" style="font-size: 25px; color: #4a219c;">
                        <span
                            class="badge position-absolute top-0 start-50 translate-middle-x rounded-circle"
                            style="font-size: 14px; padding: 3px 7px; background-color: #f46f22; transform: translate(-15%, 15%) !important">
                            {{ $unreadCount }}
                        </span>
                    </i>
                @else
                    <i class="fa fa-bell " aria-hidden="true" style="font-size: 25px; color: #4a219c;"></i>
                @endif
            </a>

            <!-- Notification Dropdown -->
            <div id="notification-dropdown-mobile"  
                class="notification-dropdown-mobile d-none bg-white shadow rounded position-absolute top-100 end-0 mt-2 p-3"
                style="width:300px; z-index:99999">
                <h3 class="text-dark border-bottom pb-2">Notifications</h3>
                <ul class="list-unstyled mb-0">
                    @php
                        $new_notification = null;
                    @endphp
                    @forelse($notifications as $notification)
                        @foreach ($notification->notificationUsers as $notificationUser)
                            @php
                                $new_notification = $notificationUser->is_read;

                            @endphp
                        @endforeach
                        <li class="mb-5">
                            <a href="{{ route('notification.show', $notification->id) }}"
                                class="text-decoration-none text-dark">
                                <div class="d-flex justify-content-between align-items-start">
                                    <!-- Title -->
                                    <div>
                                        <span class="fw-bold d-block h5">
                                            @if (!$new_notification)
                                            <!-- Red dot for unread notification -->
                                            {{-- <span class="badge bg-danger rounded-circle"
                                                style="width: 5px; height: 5px; display: inline-block;"></span> --}}
                                            @else
                                            {{-- <span class="badge bg-success rounded-circle"
                                            style="width: 5px; height: 5px; display: inline-block;"></span> --}}
                                            @endif
                                            {{ $notification->title ?? 'New Notification' }}
                                          
                                        </span>
                                        <!-- Message -->
                                        <span class="text-muted d-block">
                                            {{ \Illuminate\Support\Str::limit($notification->message, 30, '...') }}
                                        </span>
                                    </div>
                                    <!-- Timestamp -->
                                    <small
                                        class="text-muted ms-3">{{ $notification->created_at->diffForHumans() }}</small>
                                </div>
                            </a>
                        </li>

                    @empty
                        <li class="text-muted text-center">No new notifications</li>
                    @endforelse
                </ul>

            </div>


            <!-- Hidden Form to Mark Notifications as Read -->
            <form id="mark-as-read-form" action="{{ route('std.all.notifications') }}" method="POST"
                style="display: none;">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            </form>
        </div>

        <script>
            // Function to toggle the visibility of the navbar
            function toggleNavbarVisibility() {
                const navbar = document.getElementById('appNavbar');
                if (window.scrollY > 50) { // Adjust the scroll threshold as needed
                    navbar.classList.add('app-navbar-hidden');
                } else {
                    navbar.classList.remove('app-navbar-hidden');
                }
            }
        
            // Attach the scroll event listener
            window.addEventListener('scroll', toggleNavbarVisibility);
        </script>
        
    @endif

        <div class="btn btn-icon btn-active-color-primary w-30px h-30px" id="kt_app_sidebar_mobile_toggle">
            <ion-icon class="icon-mobile-nav" id="bar-icon" name="menu" style=" color: #f5772e !important;">
            </ion-icon>
        </div>
    </div>
    <!--end::Header container-->
</div>
<script>
    // Toggle Notification Dropdown Visibility
    document.getElementById('notification-toggle-mobile').addEventListener('click', function() {
        const dropdown = document.getElementById('notification-dropdown-mobile');
        dropdown.classList.toggle('d-none');
    });

    // Close dropdown if clicked outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('notification-dropdown-mobile');
        const toggle = document.getElementById('notification-toggle-mobile');

        if (!dropdown.contains(event.target) && !toggle.contains(event.target)) {
            dropdown.classList.add('d-none');
        }
    });
</script>
<script>
    // Toggle Notification Dropdown Visibility
    document.getElementById('notification-toggle').addEventListener('click', function() {
        const dropdown = document.getElementById('notification-dropdown');
        dropdown.classList.toggle('d-none');
    });

    // Close dropdown if clicked outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('notification-dropdown');
        const toggle = document.getElementById('notification-toggle');

        if (!dropdown.contains(event.target) && !toggle.contains(event.target)) {
            dropdown.classList.add('d-none');
        }
    });
</script>
