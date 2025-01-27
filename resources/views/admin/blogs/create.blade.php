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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Blogs Management</h1>
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
                        <li class="breadcrumb-item text-muted">Blogs</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item text-muted">Add Blogs</li>

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
                                <h3 class="fw-bold ">Add Blogs</h3>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Action-->
                            <a href="{{ route('blogs.index') }}"
                                class="btn btn-sm text-light btn-primary align-self-center">Back</a>
                            <!--end::Action-->

                        </div>

                        <div>
                            <form class="Blogs_form form w-100" novalidate="novalidate" id="kt_sign_up_form" method="POST" enctype="multipart/form-data" action="{{ route('blogs.store') }}">
                                @csrf
                                <div class="row pt-6">
                                    <!-- Blog Title -->
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-10">
                                            <label for="Blogs_title" class="required form-label">Blogs Title</label>
                                            <input type="text" name="title" class="form-control form-control-solid" value="{{ old('title') }}" placeholder="Blogs Title" required />
                                            @error('title')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                     <!-- Blog Image -->
                                     <div class="col-lg-6 col-sm-12">
                                        <div class="mb-10">
                                            <label for="Blogs_img" class="form-label">Blog Image</label>
                                            <input type="file" name="img" class="form-control form-control-solid" accept="image/*" />
                                            @error('img')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                            
                                    <!-- Blog Description -->
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="mb-10">
                                            <label for="Blogs_desc" class="required form-label">Blog Description</label>
                                            <textarea name="desc" class="form-control form-control-solid" rows="4" placeholder="Blog Description" required>{{ old('desc') }}</textarea>
                                            @error('desc')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                            <br>
                            <!-- Blog Description -->
                            <div class="col-lg-12 col-sm-12">
                                <div class="mb-10">
                                    <label for="Blogs_desc" class="required form-label">Blog Description</label>
                                    <div id="editor"></div>
                                    <textarea name="long_desc" id="desc" class="form-control form-control-solid" rows="4" placeholder="Blog Description" style="display:none;">{{ old('desc') }}</textarea>
                                    @error('desc')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                                   
                                </div>
                            
                                <div class="card-header cursor-pointer">
                                    <div class="card-title m-0"></div>
                                    <button type="submit" id="save_btn" class="btn btn-sm text-light btn-primary align-self-center">Save</button>
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

<!-- Quill.js Initialization Script -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
   // Initialize the Quill editor
   var quill = new Quill('#editor', {
       theme: 'snow',
       modules: {
           toolbar: [
               [{ 'header': '1' }, { 'header': '2' }, { 'font': [] }],
               [{ 'list': 'ordered'}, { 'list': 'bullet' }],
               ['bold', 'italic', 'underline'],
               ['link'],
               ['image']  // This is to allow image insertion
           ]
       }
   });

   // Handle image upload in Quill editor
   quill.getModule('toolbar').addHandler('image', function() {
       var input = document.createElement('input');
       input.setAttribute('type', 'file');
       input.setAttribute('accept', 'image/*');
       input.click();

       input.onchange = function() {
           var file = input.files[0];
           var formData = new FormData();
           formData.append('image', file);

           // Make the AJAX request to upload the image
           fetch('{{ route('blogs.upload_image') }}', {
               method: 'POST',
               body: formData,
               headers: {
                   'X-CSRF-TOKEN': '{{ csrf_token() }}'  // CSRF token for security
               }
           })
           .then(response => response.json())
           .then(data => {
               if (data.success) {
                   // Insert the image URL into the editor
                   var imageUrl = data.url;
                   var range = quill.getSelection();
                   quill.insertEmbed(range.index, 'image', imageUrl);
               } else {
                   alert('Image upload failed!');
               }
           })
           .catch(error => {
               console.error('Error:', error);
               alert('Error uploading image.');
           });
       };
   });

   // Sync the Quill editor content with the hidden textarea before form submission
   document.querySelector('#kt_sign_up_form').onsubmit = function() {
       var descContent = quill.root.innerHTML;
       document.querySelector('#desc').value = descContent;
   };
</script>
    
@endsection
