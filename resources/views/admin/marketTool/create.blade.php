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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Market Tool Management</h1>
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
                        <li class="breadcrumb-item text-muted">Market Tool Details</li>
                        <!--end::Item-->
                          <!--begin::Item-->
                          <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Add</li>
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
                                <h3 class="fw-bold ">Market tool</h3>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Action-->
                            <a href="{{ route('market_tools.index') }}"
                                class="btn btn-sm text-light btn-primary align-self-center">Back</a>
                            <!--end::Action-->

                        </div>

                        <div>
                            <form action="{{ route('market_tools.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row pt-6">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-10">
                                            <label for="question" class="required form-label">Title</label>
                                            <input type="text" name="title" class="form-control form-control-solid"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-10">
                                            <label for="question" class="required form-label">Image</label>
                                            <input type="file" name="img" class="form-control form-control-solid"/>
                                        </div>
                                    </div>
                                </div>
                            
                                <!-- Table with dynamic rows -->
                                <table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                                    <thead>
                                        <tr>
                                            <th>Resource name</th>
                                            <th>Link</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="resource-rows">
                                        <tr>
                                            <td>
                                                <input type="text" name="resources[0][name]" class="form-control form-control-solid" placeholder="Enter resource name"/>
                                            </td>
                                            <td>
                                                <input type="text" name="resources[0][link]" class="form-control form-control-solid" placeholder="Enter  link"/>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary add-row-btn">
                                                    +
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            
                                <div class="card-header cursor-pointer">
                                    <div class="card-title m-0"></div>
                                    <button type="submit" id="save_btn" class="btn btn-sm text-light btn-primary align-self-center mb-5 mt-20">
                                        Save
                                    </button>
                                </div>
                            </form>
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
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success',
                text: '{{ session('success') }}',
                icon: 'success'
            });
        </script>
    @endif
    <!-- JavaScript to handle dynamic row addition -->
<script>
    let rowCount = 1;  // Initialize row count

    // Event listener for "Add Row" button
    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('add-row-btn')) {
            addNewRow();
        }
    });

    function addNewRow() {
        // Template for a new row
        const newRow = `
            <tr>
                <td>
                    <input type="text" name="resources[${rowCount}][name]" class="form-control form-control-solid"  placeholder="Enter resource name"/>
                </td>
                <td>
                    <input type="text" name="resources[${rowCount}][link]" class="form-control form-control-solid" placeholder="Enter  link"/>
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger remove-row-btn">-</button>
                </td>
            </tr>
        `;

        // Append new row to the table
        document.getElementById('resource-rows').insertAdjacentHTML('beforeend', newRow);

        // Increment the row count for the next row
        rowCount++;
    }

    // Event listener to handle row removal
    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-row-btn')) {
            e.target.closest('tr').remove();
        }
    });
</script>
@endsection
