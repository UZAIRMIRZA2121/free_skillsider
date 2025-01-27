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
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Edit Market Tool</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1 d-none">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Market Tool Management</li>
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
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card mb-5 mb-xxl-8">
                <div class="card-body pt-0 pb-0">
                    <div class="card-header cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Edit Market Tool</h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form action="{{ route('market_tools.update', $tool->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Add this line for PUT request -->
                        <div class="row pt-6">
                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-10">
                                    <label for="title" class="required form-label">Title</label>
                                    <input type="text" name="title" class="form-control form-control-solid" value="{{ old('title', $tool->title) }}" required/>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="mb-10">
                                    <label for="img" class="required form-label">Image</label>
                                    <input type="file" name="img" class="form-control form-control-solid" />
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="mb-10">
                                    <label for="img" class="required form-label">Current Image</label> <br>
                                    <img src="{{ asset('uploads/market_tools/' . $tool->img) }}" alt="Current Image" style="max-width: 100px; max-height: 100px;"/>
                                </div>
                            </div>
                        </div>
                
                        <!-- Table with dynamic rows for links -->
                        <table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead>
                                <tr>
                                    <th>Resource Name</th>
                                    <th>Link</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="resource-rows">
                                @foreach ($links as $index => $link)
                                <tr>
                                    <td>
                                        <input type="hidden" name="resources[{{ $index }}][id]" value="{{ $link->id }}"/> <!-- Hidden field for ID -->
                                        <input type="text" name="resources[{{ $index }}][name]" class="form-control form-control-solid" value="{{ old('resources.' . $index . '.name', $link->name) }}" placeholder="Enter resource name" required/>
                                    </td>
                                    <td>
                                        <input type="text" name="resources[{{ $index }}][link]" class="form-control form-control-solid" value="{{ old('resources.' . $index . '.link', $link->link) }}" placeholder="Enter link" required/>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger remove-row-btn">-</button>
                                    </td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary add-row-btn">+</button>
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
                    <!--end::Form-->
                </div>
            </div>
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
let rowCount = {{ count($links) }};  // Initialize row count based on existing links

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
                <input type="text" name="resources[${rowCount}][name]" class="form-control form-control-solid" placeholder="Enter resource name"/>
            </td>
            <td>
                <input type="text" name="resources[${rowCount}][link]" class="form-control form-control-solid" placeholder="Enter link"/>
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
