<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../">
    <title>skillsider</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />

    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-body">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-up -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid py-10">
                <!--begin::Content-->
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-800px py-5 px-10 py-lg-5 pb-lg-10 px-lg-15 mx-auto card">
                        <!--begin::Form-->

                        <!--begin::Heading-->
                        <div class="mb-10 text-center">
                            <!--begin::Logo-->
                            <a href="#" class="py-9 mx-5">
                                <img alt="Logo" src="{{ asset('assets/images/skillsider_logo.png') }}" class="h-70px" />
                            </a>
                            <!--end::Logo-->
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Create an Account</h1>
                            <!--end::Title-->
                            <!--begin::Link-->
                            <div class="text-gray-400 fw-bold fs-4">Already have an account?
                                <a href="{{ route('login') }}" class="link-success fw-bolder">Sign in here</a>
                            </div>
                            <!--end::Link-->
                            <!--begin::Link-->
                            <!-- <div class="text-gray-400 fw-bold fs-4">Affiliate Veification ?
                                <a href="{{ route('affiliate.veification') }}" class="link-primary fw-bolder">Click Here</a>
                            </div>-->
                            <!--end::Link-->
                        </div>
                        <div class="  alert-success py-4 h1 text-center">
                            Welcome to skillsider.pk!
                        </div>
                        <!--end::Heading-->
                        <!--begin::Separator-->
                        <div class="d-flex align-items-center mb-10">
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                            <span class="fw-bold text-gray-400 fs-7 mx-2">OR</span>
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>

                        </div>
                        @if (Session::has('error'))
                            <div class="alert  alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        @if (Session::has('registerd'))
                            <div class="alert  alert-success">
                                {{ Session::get('registerd') }}
                            </div>
                        @endif

                        <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" method="POST"
                            enctype="multipart/form-data" action="{{ route('registeration.submit') }}"
                            onsubmit="return validateForm();">
                            @csrf
                            <!--begin::Input group-->
                            @if (Session::has('message'))
                                <div class="alert alert-danger">
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                            <div class="row fv-row mb-7 ">
                                <!--<x-validation-errors class="mb-4" />-->
                                <!--begin::Col-->
                                <div class="col-xl-6">
                                    <label class="form-label fw-bolder text-dark fs-6">First Name<span
                                            class="text-danger">*</span></label>
                                    <x-input id="fname" class="form-control form-control-lg form-control-solid"
                                        type="text" name="first_name" value="{{ old('first_name') }}" required placeholder="Enter your First Name" />
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-6">
                                    <label class="form-label fw-bolder text-dark fs-6">Last Name<span
                                            class="text-danger">*</span></label>
                                    <x-input id="lname" class="form-control form-control-lg form-control-solid"
                                        type="text" name="last_name" value="{{ old('last_name') }}" required placeholder="Enter your Last Name" />
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--end::Col-->


                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-7">
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bolder text-dark fs-6">Email <span
                                            class="text-danger">*</span></label>
                                    <x-input id="email" class="form-control form-control-lg form-control-solid"
                                        type="email" name="email" :value="old('email')" required placeholder="Enter your Email Address" />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bolder text-dark fs-6">Mobile number<span
                                            class="text-danger">*</span></label>
                                    <x-input id="phone" class="form-control form-control-lg form-control-solid"
                                        type="number" name="phone" required value="{{ old('phone') }}" placeholder="Enter your Mobile number"/>
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row" data-kt-password-meter="true">
                                <!--begin::Wrapper-->
                                <div class="mb-1">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bolder text-dark fs-6">Password<span
                                            class="text-danger">*</span></label>
                                    <!--end::Label-->
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative mb-3">
                                        <x-input id="password" class="form-control form-control-lg form-control-solid"
                                            type="password" name="password" required autocomplete="new-password"  placeholder="Enter your Password" />

                                        <span
                                            class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                            data-kt-password-meter-control="visibility">
                                            <i class="bi bi-eye-slash fs-2"></i>
                                            <i class="bi bi-eye fs-2 d-none"></i>
                                        </span>
                                    </div>
                                    <!--end::Input wrapper-->
                                    <!--begin::Meter-->
                                    <div class="d-flex align-items-center mb-3"
                                        data-kt-password-meter-control="highlight">
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                    </div>
                                    <!--end::Meter-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Hint-->
                                <div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp;
                                    symbols.</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row" data-kt-password-meter="true">
                                <!--begin::Wrapper-->
                                <div class="mb-1">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bolder text-dark fs-6">Sponsor Code<span
                                            class="text-danger">*</span></label>
                                    <!--end::Label-->
                                    <!--begin::Input wrapper-->
                                    <div class="row">
                                        <div class="col-6 ">
                                            <x-input id="referral_code"
                                                class="form-control form-control-lg form-control-solid "
                                                type="text" name="referral_code" required placeholder="Enter Sponsor Code"
                                                value="{{ isset($referral_code) ? $referral_code : '' }}" />
                                            @error('referral_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <button type="button" class="btn btn-success w-100" id="search-sponsor">
                                                Search Sponsor
                                            </button>
                                        </div>
                                        <div class="col-12">
                                            <div class="alert alert-warning mt-1" id="sponsor-code-msg"
                                                style="display:none;"></div>
                                        </div>
                                    </div>
                                    <!--end::Input wrapper-->

                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Wrapper-->
                                <div class="my-2 " id="sponsor-code-details" style="display:none;">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="w-50">Name:</th>
                                            <td id="sponsor-name"></td>
                                        </tr>
                                        <tr>
                                            <th class="w-50">Number:</th>
                                            <td id="sponsor-number"></td>
                                        </tr>
                                        <tr>
                                            <th class="w-50">RANK:</th>
                                            <td id="sponsor-rank"></td>
                                        </tr>
                                        <tr>
                                            <th class="w-50">JOINING DATE:</th>
                                            <td id="sponsor-joining-date"></td>
                                        </tr>
                                    </table>
                                </div>
                                <!--end::Wrapper-->

                            </div>
                            <!--end::Input group=-->

                            <!--begin::Input group-->
                            <div class="row mb-7">
                                {{-- <div class="col-12  mb-7">
                                    <label class="form-label fw-bolder text-dark fs-6">Select States<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select form-select-solid" name="state"
                                        data-control="select2" data-placeholder="Select an option"
                                        value="{{ old('state') }}">
                                        <option></option>
                                        <option value="Punjab">Punjab</option>
                                        <option value="Sindh">Sindh</option>
                                        <option value="KPK">KPK</option>
                                        <option value="Balouchistan">Balouchistan</option>
                                        <option value="Azad Kashmir">Azad Kashmir</option>
                                        <option value="Gilgit Bultistan">Gilgit Bultistan</option>

                                    </select>
                                    @error('state')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> --}}




                                <!--begin::Heading-->
                                <div class="mt-10 text-center">
                                    <!--begin::Title-->
                                    <h1 class="text-dark mb-3">Choose Bundle</h1>
                                    <!--end::Title-->
                                    <div class="row mb-5 ">
                                        <!--begin::Radio group-->
                                        <div data-kt-buttons="true">
                                            <!--begin::Radio button-->
                                            @foreach ($packages as $key => $package)
                                                <label
                                                    class="btn  btn-outline-success btn-outline btn-outline-dashed btn-active-light-success d-flex flex-stack text-start p-6 mb-5    {{ $key === 0 ? '' : '' }}">
                                                    <!--end::Description-->
                                                    <div class="d-flex align-items-center me-2">
                                                        <div
                                                            class="form-check form-check-custom form-check-solid form-check-success me-6">

                                                            <input class="form-control form-check-input"
                                                                type="radio" name="package_id"
                                                                id="discount_percentage_{{ $key }}"
                                                                value="{{ $package->id }}"
                                                                data-price="{{ $package->price }}" data-discount="0"
                                                                data-name="{{ $package->package_title }}"
                                                                {{ $key === 0 ? '' : '' }} />


                                                            <!-- Add the 'checked' attribute to the first radio button -->
                                                        </div>
                                                        <!--end::Radio-->
                                                        <!--begin::Info-->
                                                        <div class="flex-grow-1">
                                                            <h2
                                                                class="d-flex align-items-center fs-3 fw-bold flex-wrap">
                                                                {{ $package->package_title }}
                                                            </h2>
                                                            <!--<div class="fw-semibold opacity-50">-->
                                                            <!--    Best for startups-->
                                                            <!--</div>-->
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                    <!--end::Description-->
                                                    <!--begin::Price-->
                                                    <div class="ms-5">
                                                        <span class="mb-2">Rs</span>
                                                        <span class="fs-2x fw-bold"
                                                            data-package-price="{{ $package->price }}"
                                                            data-package-id="{{ $package->id }}"
                                                            id="discounted_price_{{ $key }}">{{ $package->price }}
                                                        </span>

                                                        <span class="fs-7 opacity-50">/
                                                            <span data-kt-element="period">Bundle</span>
                                                        </span>
                                                    </div>
                                                    <!--end::Price-->
                                                </label>
                                                <!--end::Radio button-->
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                @error('package_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="col-12 mb-7 ">
                                    <table class="table table-bordered d-none"  id="tbl" style="display: none" >
                                        <thead>
                                            <tr>
                                                <th colspan="2" class="text-center">PURCHASE SUMMARY</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>PRODUCT</th>
                                                <th>SUBTOTAL</th>
                                            </tr>
                                            <tr>
                                                <th><span id="tbl-prdouct-name">No Selected</span></th>
                                                <th><span id="tbl-price"></span></th>
                                            </tr>
                                            <tr>
                                                <th>DISCOUNT</th>
                                                <th><span id="tbl-discount"></span></th>
                                            </tr>
                                            {{-- <tr>
                                                <th>Tax</th>
                                                <th><span id="tbl-tax">Inclusive of all taxes</span></th>
                                            </tr> --}}
                                            <tr>
                                                <th>TOTAL <span class="text-muted"> (Inclusive of all taxes)</span></th>
                                                <th><span id="tbl-total"></span></th>
                                            </tr>
                                           
                                        </tbody>
                                    </table>

                                </div>
                                <!--end::Heading-->
                                <div class="col-6 mb-7 ">
                                    <label class="form-label fw-bolder text-dark fs-6">Discount Code</label>
                                    <x-input id="coupon_code" class="form-control form-control-lg form-control-solid"
                                        type="text" name="coupon_code"  placeholder="Enter Discount Code"/>
                                    <div id="coupon_details"></div>

                                </div>
                                <div class="col-6 mb-7">
                                    <input type="button" class="btn btn-lg btn-success w-100  mt-8"
                                        id="apply_coupon_btn" value="Apply Discount">
                                </div>
                                <div class="col-12 col-md-6 mb-7">
                                    <label class="form-label fw-bolder text-dark fs-6" data-bs-toggle="modal"
                                        data-bs-target="#referral_code_modal">Payment method <span
                                            class="text-danger">*</span></label> <br>
                                    <input type="button" class="btn btn-lg btn-success w-100 "
                                        data-bs-toggle="modal" data-bs-target="#referral_code_modal"
                                        value="Payment Method">
                                </div>


                                <!-- Main modal for payment method -->
                                <div class="modal fade" id="payment_method_show" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Payment Method</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#referral_code_modal">Do you have a referral
                                                    code?</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Nested modal for referral code -->
                                <div class="modal fade" id="referral_code_modal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Do You Have a Referral
                                                    Code?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-dark">
                                                <p>Kya Ap ka contact kisi aise bandy se hai jis ka referral code use kar
                                                    k ap account bana sakein?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#given_model">Yes</button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#contact_modal">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Nested modal for given model -->
                                <div class="modal fade" id="given_model" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Official Account
                                                    Numbers</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-header">

                                                <div class="text-danger">
                                                    <h1 class="text-danger">Note</h1>
                                                    * Agar ap k pass referral link ya code dene wala koi nahi hai to
                                                    payment na karein. </br></br>

                                                    * Kisi aise bandy ko talash kariye jis ka referral code use kar k ap
                                                    account bana saky.</br></br>

                                                    * Fees pay karny k bad screenshot us bandy ko bhejiye jis ny apko
                                                    skillsider ki details di hein.</br>
                                                    </br>
                                                    * Nichy diye huy numbers k ilawa kisi or number py
                                                    payment na karein.

                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Logo</th>
                                                            <th>Bank</th>
                                                            <th>Account Name</th>
                                                            <th>Account Number</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($payment_methods as $payment_method)
                                                            <tr>
                                                                <td> <img
                                                                        src="{{ asset('payment-method-image/' . $payment_method->logo) }}"
                                                                        width="50" alt=""></td>
                                                                <td>{{ $payment_method->bank }}</td>
                                                                <td>{{ $payment_method->account_name }}</td>
                                                                <td>{{ $payment_method->account_number }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Nested modal for contact modal -->
                                <div class="modal fade" id="contact_modal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Don't Have a
                                                    Referral Code</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <span class="text-danger">*</span> Referral Code k bina ap ka account
                                                nahi bany ga. </br>

                                                <span class="text-danger">*</span> Agar Ap ka contact kisi aise bandy
                                                se hai jis ne ap ko SkillSider ki details di hein to kindly usko msg
                                                kariye usi ka referral code use kar k ap account bana sakein gy.</br>

                                                <span class="text-danger">*</span> Agar ap k pass referral link ya code
                                                dene wala koi nahi hai to payment na karein.</br>

                                                <span class="text-danger">*</span> Kisi aise bandy ko talash kariye jis
                                                ka referral code use kar k ap account bana saky.</br>

                                                <span class="text-success">Thank You</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-7">
                                    <label class="form-label fw-bolder text-dark fs-6">Transaction ID<span
                                            class="text-danger">*</span></label>
                                    <x-input id="payment_image"
                                        class="form-control form-control-lg form-control-solid" type="text"
                                        name="trxid" required  placeholder="Enter your Transaction ID"/>
                                    @error('trxid')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <i class="text-danger bi bi-exclamation-circle-fill" style="font-size: 20px;"></i>
                                    <span class="form-label fw-bolder text-dark fs-5"> NOTE</span>


                                    <label class="form-label fw-bolder text-dark fs-6">
                                        Due to the nature of the services and business, there is a <span
                                          > <a href="{{route('refund.policy') }}" target="_blank"   class="text-danger" rel="noopener noreferrer">STRICT NO REFUND POLICY.</a> </span>
                                        <span class="text-danger">*</span></label>
                                    </span>
                                </div>
                                </br>
                                </br>
                                <div class="col-12">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="noRefundPolicy"
                                            name="no_refund_policy">
                                        <label class="form-check-label text-dark  fw-bolder" for="noRefundPolicy">
                                            I agree with the <span class="text-danger  fs-6">No Refund Policy</span>
                                        </label>
                                    </div>
                                    </br>

                                    <!-- Input field with placeholder -->
                                    <div class="mb-3">
                                        <input type="text" style="height: 50px;" class="form-control"
                                            id="acceptanceInput" name="acceptance_input"
                                            placeholder="Type here ( I agree ) ">
                                    </div>
                                </div>

                                <!--end::Input group-->

                                <!--begin::Actions-->
                                <div class="text-center mt-5">

                                    <x-button class="btn btn-lg btn-success w-100 " type="submit">
                                        {{ __('Register ') }}<i class="fa-solid fa-arrow-right"></i>
                                    </x-button>
                                </div>
                                <!--end::Actions-->
                        </form>

                        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                            <div id="toast-container" class="toast-container">
                                <!-- Toast messages will be added here -->
                            </div>
                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
                    <!--begin::Links-->
                    <div class="d-flex flex-center fw-bold fs-6">
                        © 2025 SkillSider. All Rights Reserved
                    </div>
                    <!--end::Links-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-up-->

        <!--Referral Code Modal start-->
        <?php
        $referral_code = isset($_GET['referral_code']) ? $_GET['referral_code'] : null;
        ?>
        <!-- Bootstrap Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger " style="background-color: #4d3185">
                        <h5 class="modal-title text-light" id="exampleModalLabel"
                            style="
                        font-weight: 1000;
                        font-size: 20px;">
                            <b>Must Watch This Video</b> </h5>
                        <button type="button" class="btn-close fs-3 " data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-dark p-0">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" id="videoFrame"
                                style=" min-height: 300px; width: 100%; "
                                src="https://www.youtube.com/embed/uMC5gTeNOUw?si=R7SDGfQ17nBj2N64"
                                title="YouTube video player" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!--Referral Code Modal end-->


    </div>
    <!--end::Root-->
    <!--end::Main-->
    <!--begin::Javascript-->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <script>
        function validateForm() {
            // Get the checkbox and input field elements
            var checkbox = document.getElementById('noRefundPolicy');
            var inputField = document.getElementById('acceptanceInput');
    
            // Check if the checkbox is checked
            var isCheckboxChecked = checkbox.checked;
    
            // Normalize the input: remove non-alphanumeric characters, spaces, and convert to lowercase
            var normalizedInput = inputField.value
                .toLowerCase()               // Convert to lowercase
                .replace(/[^a-z]/g, "");     // Remove all non-alphabetic characters
    
            // Check if the normalized input matches "iagree"
            var isInputValid = normalizedInput === "iagree";
    
            // Perform validation
            if (!isCheckboxChecked) {
                Swal.fire({
                    title: 'Validation Error',
                    text: 'You must agree to the no refund policy.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return false;
            }
            if (!isInputValid) {
                Swal.fire({
                    title: 'Validation Error',
                    text: 'Please type "I agree" in the text field.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return false;
            }
    
            // If both conditions are met, allow form submission
            return true;
        }
    </script>
    
    
    
    


    <script>
        function getCheckedValue() {
            var radioButtons = document.getElementsByName("package_id");

            for (var i = 0; i < radioButtons.length; i++) {
                if (radioButtons[i].checked) {
                    return (radioButtons[i].id);
                }
            }
        }

        const couponCodeInput = document.getElementById('coupon_code');
        const couponDetailsContainer = document.getElementById('coupon_details');
        const applyCouponBtn = document.getElementById('apply_coupon_btn');

        // Add a flag to track whether the coupon has been applied
        let couponApplied = false;

        applyCouponBtn.addEventListener('click', function() {
            // Check if the coupon has already been applied


            // Get the coupon code from the input field
            let couponCode = couponCodeInput.value;

            axios.post('{{ route('coupons.check') }}', {
                    coupon_code: couponCode
                })
                .then(function(response) {
                    if (response.data.exists) {
                        const coupon = response.data.coupon;
                        console.log(coupon.pck_id); // For debugging, this will log an array like ["1", "3"]

                        couponDetailsContainer.innerHTML = `<span class="text-success">Discount Applied</span>`;
                        couponApplied = true;

                        // Update the displayed price for all packages
                        document.querySelectorAll('[id^="discounted_price_"]').forEach(function(
                            discountedPriceElement) {
                            let packagePrice = parseFloat(discountedPriceElement.getAttribute(
                                'data-package-price'));
                            let packageid = parseFloat(discountedPriceElement.getAttribute(
                                'data-package-id'));

                            // Check if the package ID is in the coupon's pck_id array
                            if (coupon.pck_id.includes(packageid.toString())) {
                                // Calculate the new discounted price only for the matching packages
                                let newDiscountedPrice = packagePrice - (packagePrice * coupon
                                    .percentage) / 100;

                                discountedPriceElement.textContent = newDiscountedPrice.toFixed(0);

                                // Update the data-discount attribute to reflect the new price
                                document.querySelector('[data-price="' + packagePrice + '"]')
                                    .setAttribute(
                                        "data-discount", newDiscountedPrice.toFixed(0)
                                    );
                            }
                        });

                        // Apply any additional logic or table updates
                        var radioId = getCheckedValue();
                        tblValues(radioId);
                    } else {
                        couponDetailsContainer.innerHTML =
                            `<span class="text-danger">Discount Code Not Found</span>`;
                        $("#tbl").hide();
                    }
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });
        });


        function tblValues(radioId) {
            if (document.getElementById(radioId).getAttribute("data-discount") == 0) {
                return false
            }
            $("#tbl").show();
            $("#tbl-prdouct-name").text($("#" + radioId).data("name"));
            $("#tbl-price").text($("#" + radioId).data("price"));
            $("#tbl-discount").text($("#" + radioId).data("price") - $("#" + radioId).data("discount"));
            $("#tbl-total").text($("#" + radioId).data("discount"));

        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Listen for change event on radio buttons
            document.querySelectorAll('input[name="package_id"]').forEach(function (radio) {
                radio.addEventListener("change", function () {
                    const radioId = this.id;
    
                    // Get the data attributes
                    const name = this.dataset.name;
                    const price = parseFloat(this.dataset.price);
                    const discount = parseFloat(this.dataset.discount);
                    const discountedPrice = price - discount;
   
                    // Update the table with the selected package data
                    document.querySelector("#tbl").classList.remove("d-none");
                    document.querySelector("#tbl").style.display = "table"; // Show the table
                    document.querySelector("#tbl-prdouct-name").textContent = name + ' x 1';
                    document.querySelector("#tbl-price").textContent = price;
                    document.querySelector("#tbl-discount").textContent = discount;
                    document.querySelector("#tbl-total").textContent = discountedPrice ;
                });
            });
    
            // Trigger change event for the initially checked radio button to populate the table on page load
            const checkedRadio = document.querySelector('input[name="package_id"]:checked');
            if (checkedRadio) {
                checkedRadio.dispatchEvent(new Event("change"));
            }
        });
    </script>
    
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="assets/js/custom/authentication/sign-up/general.js"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
    <script>
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000); // <-- time in milliseconds
        /////form validation///
        function scrollToTop() {
            var currentPosition = window.scrollY;
            if (currentPosition > 0) {
                window.scrollTo(0, currentPosition - 20); // Scroll up by 20 pixels
                window.requestAnimationFrame(scrollToTop); // Call the function recursively
            }
        }
    </script>
    <script>
        $('#search-sponsor').click(function() {

            var code = $('#referral_code').val();
            if (code === null || code.trim() === "") {
                $("#sponsor-code-msg").show();
                $("#sponsor-code-details").hide();
                $("#sponsor-code-msg").text("Please enter sponsor code");

            } else {
                $("#sponsor-code-msg").hide();
                $("#sponsor-code-details").show();
            }

            $.ajax({
                url: "{{ route('affiliate.verification.check.ajax') }}",
                method: 'POST',
                data: {
                    code: code,
                    _token: '{{ csrf_token() }}', // Include CSRF token for Laravel
                },
                success: function(response) {

                    if (response.exists) {
                        document.getElementById("sponsor-name").innerHTML = response.data.first_name;
                        document.getElementById("sponsor-number").innerHTML = response.data.phone;
                        document.getElementById("sponsor-rank").innerHTML = response.data.package
                            .package_title;
                        // Format the date here
                        let verifiedDate = new Date(response.data.verified_at);
                        let formattedDate = verifiedDate.toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });

                        document.getElementById("sponsor-joining-date").innerHTML = formattedDate;
                    } else {
                        document.getElementById("sponsor-name").innerHTML = '';
                        document.getElementById("sponsor-number").innerHTML = '';
                        document.getElementById("sponsor-joining-date").innerHTML = '';
                        $("#sponsor-code-msg").show();
                        $("#sponsor-code-msg").text("Sponsor code does not exist!");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error); // Log the error for debugging
                    $("#sponsor-code-msg").show();
                    $("#sponsor-code-msg").text("Something went wrong!");
                }
            });

        });




        // jQuery code to call tblValues on radio button change
        $(document).ready(function() {
            // Attach a change event listener to all radio buttons with the name "myRadio"
            $('input[name="package_id"]').change(function() {
                // Get the ID of the checked radio button
                var radioId = $(this).attr('id');

                // Call the tblValues function with the radioId parameter
                tblValues(radioId);
            });


        });
    </script>



    <!-- Your JavaScript to show the modal on page load -->
    <?php if (!isset($referral_code)) : ?>
    <script>
        // Use JavaScript to show the modal on page load
        window.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('myModal'));
            myModal.show();
        });
    </script>
    <?php endif; ?>



    <script>
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));

        myModal._element.addEventListener('hidden.bs.modal', function() {
            // Get the iframe inside the modal body
            var iframe = document.getElementById('videoFrame');

            // Reload the iframe to pause the video
            iframe.src = iframe.src;
        });
    </script>
</body>
<!--end::Body-->

</html>
