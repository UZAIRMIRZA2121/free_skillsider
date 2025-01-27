@extends('layouts.admin.master')

@section('admin')



<style>
    .carousel-item img {
        height: auto;
        max-height: 700px;
        /* Set this to your desired maximum height */
    }

    .package-card {
        width: 300px;
        /* Set a width for your package cards */
        border: 1px solid #ddd;
        /* Optional: border for card */
        border-radius: 8px;
        /* Optional: rounded corners */
        overflow: hidden;
        /* To handle overflow */
        transition: transform 0.3s;
        /* Optional: transition effect */
    }

    .package-card:hover {
        transform: scale(1.09);
        /* Optional: scale effect on hover */
    }

    .package_inner_body {
        padding: 15px;
        /* Add some padding */
    }

    /* Optional: Style for text */
    .package_text {
        font-size: 1.2em;
        /* Adjust font size */
        margin: 0;
        /* Remove default margin */
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
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Market Tool</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1 d-none">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Marketing Tools </li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div class="container   card ">
       

        <div class="package-body card-body">
            <h1>{{ $marketTool->title }}</h1>
            <div id="gold-package" class="package table-responsive" style="display: block;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Name</th>
                            <th>Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($links as $link)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $link->name }}</td>
                                <td><a href="{{ $link->link }}" target="_blank">{{ $link->link }}</a></td>
                                <td>
                                    @if (Str::contains($link->link, 'youtube.com') || Str::contains($link->link, 'youtu.be') || Str::contains($link->link, 'drive.google.com'))
                                        <!-- View Button to open the video or link -->
                        <!-- Copy Link Button with Font Awesome Icon -->
                        <button type="button" class="btn btn-secondary" onclick="copyToClipboard('{{ $link->link }}')">
                            <i class="fa fa-copy"></i> 
                        </button>

                                    @endif
                                </td>
                            </tr>
                
                
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        </div>
    </div>
</div>
</div>
<script>
    // Function to copy the link to the clipboard
    function copyToClipboard(link) {
        navigator.clipboard.writeText(link).then(() => {
Swal.fire({
    title: 'Success',
    text: 'Link copied to clipboard!',
    icon: 'success',
    confirmButtonText: 'Okay',  // Customize button text
    background: '#f0f0f0',      // Change background color
    color: '#333',               // Change text color
    toast: true,                 // Enable toast mode
    position: 'top-end',         // Change position of the toast
    showConfirmButton: false,    // Hide the confirm button for toast
    timer: 3000,                 // Auto-close after 3 seconds
});

        }).catch(err => {
            console.error('Failed to copy: ', err);
        });
    }
</script>


@endsection