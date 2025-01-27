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
                        <li class="breadcrumb-item text-muted">Video</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Add Video</li>
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
                                <h3 class="fw-bold ">Add Video</h3>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Action-->
                            <a href="{{ route('videos.index') }}"
                                class="btn btn-sm text-light btn-primary align-self-center">Back</a>
                            <!--end::Action-->

                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <div>
                            <form action="{{ route('faq_affiliate_videos.store') }}" method="POST">
                                @csrf
                            <div class="row pt-6">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-10">
                                        <label for="vide_title" class="required form-label">Video Title</label>
                                        <input type="text" name="title" class="form-control form-control-solid"
                                            placeholder="Video Title"  required/>
                                            @error('video_title')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-10">
                                        <label for="video_link" class="required form-label">Video Link</label>
                                        <input type="text" name="video_link" class="form-control form-control-solid"
                                            placeholder="Video Link" required />
                                            @error('video_link')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>
                                 <div class="col-lg-6 col-sm-12 d-flex ">
                                    <div class="mb-10">
                                          <label for="duartion" class="required form-label">Video Type <mark> (Faq or Affiliate)</mark></label>
                                        <div class="d-flex mt-3">
                                            <div class="form-check">
                                                
                                              <input class="form-check-input" type="radio" name="type" id="faq" value="1" checked>
                                              <label class="form-check-label" for="faq">
                                                FAQ
                                              </label>
                                              
                                            </div>
                                           <div class="form-check ms-5">
                                              <input class="form-check-input" type="radio" name="type" id="affiliate" value="0" >
                                              <label class="form-check-label" for="affiliate">
                                                Affiliate
                                              </label>
                                            </div>
                                        </div>
                                    </div>
                                            @error('duartion')
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

@endsection
