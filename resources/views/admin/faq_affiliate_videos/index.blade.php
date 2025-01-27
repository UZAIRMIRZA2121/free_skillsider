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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"></h1>
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
                        <li class="breadcrumb-item text-muted">Video Details</li>
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
                                <h3 class="fw-bold m-0">Videos</h3>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Action-->
                            <a href="{{ route('faq_affiliate_videos.create') }}"
                                class="btn btn-sm text-light btn-primary align-self-center">Add Video</a>
                            <!--end::Action-->

                        </div>

                        <table id="kt_datatable_dom_positioning"
                            class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                    <th>Sr.No</th>
                                    <th>Video Title</th>
                                     <th>Video Link</th>
                                     <th>Video Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($videos as $video)
                                    <tr>
                                        <td> {{ $i++ }} </td>
                                        <td>{{$video->title}}</td>
                                        <td>{{$video->video_link}}</td>
                                        @if($video->type == 1)
                                        <td>Faq</td>
                                        @elseif($video->type == 0)
                                         <td>Affiliate</td>
                                         @else
                                         <td></td>
                                        @endif
                                        <td class="  text-start d-flex">
                                            <!--begin::Menu-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('faq_affiliate_videos.edit',$video->id) }}"
                                                        class="menu-link px-3 btn btn-warning" data-kt-docs-table-filter="edit_row">
                                                        Edit
                                                    </a>
                                                    {{-- <a href="{{ route('courses.update', ['videos' => $course->id]) }}">Update Package</a> --}}

                                                </div>
                                              
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <p>
                                                        <a type="button" id="delete-videos-{{$video->id }}" class="menu-link px-3 btn btn-danger">
                                                            Delete
                                                        </a>
                                                    <form id="delete-form-{{$video->id }}"
                                                        action="{{ route('faq_affiliate_videos.destroy',$video->id) }}"
                                                        method="POST" >
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                   
                                                    </p>
                                                </div>
                                                <!--end::Menu item-->
                                          
                                        </td>


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
    <script>
            /////sweet--alert---///
         
                const deleteButtons = document.querySelectorAll('[id^="delete-videos-"]');

deleteButtons.forEach(button => {
    button.addEventListener('click', e => {
        const packageId = button.id.split('-')[2]; // Extract the package ID from the button's ID
        e.preventDefault();

        Swal.fire({
            title: 'Delete Package',
            text: 'Are you sure you want to delete this video?',
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
    @if(session('success'))
    <script>
        Swal.fire({
            title: 'Success',
            text: '{{ session('success') }}',
            icon: 'success'
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            title: 'error',
            text: '{{ session('success') }}',
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
    @endpush
@endsection
