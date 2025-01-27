<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <base href="../../../">
    <title>skillsider</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="assets/images/logo.png" />
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
                        <div class=" text-center">
                            <!--begin::Logo-->
                            <a href="#" class="py-9 mx-5">
                                <img alt="Logo" src="{{ asset('assets/images/logo.png') }}" class="h-70px" />
                            </a>
                            <!--end::Logo-->
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Payments Details</h1>
                            <!--end::Title-->
                            <!--begin::Link-->
                            <!--<div class="text-gray-400 fw-bold fs-4">Already have an account?-->
                            <!--    <a href="{{ route('login') }}" class="link-primary fw-bolder">Sign in here</a> -->
                            <!--</div>-->
                            <!--end::Link-->
                           
                   
                        </div>
                          <div class="  alert-success py-4 h1 text-center">
                                    Weclome to skillsider.pk!
                                </div>
                        <!--end::Heading-->
                      <div class="modal-body text-danger">
                        <span class="fs-3 fw-bold text-danger">Note</span>
                    <ul>
                        <li>Nichy diye huy numbers k ilawa kisi or number py payment na karein.</li>  </br>
                        <li>Numbers change hoty rehty hein jab ap payment krny lagy to website se number lazmi check kariye ga.</li> </br>
                        <li>Fees pay karny k bad screenshot us bandy ko bhejiye jis ny apko skillsider ki details di hein or payment done ka text msg kariye.</li>
                    </ul>
                </div>
                      
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
                    <td> <img src="{{ asset('payment-method-image/' . $payment_method->logo) }}" width="50" alt=""></td>
                    <td>{{ $payment_method->bank }}</td>
                    <td>{{ $payment_method->account_name }}</td>
                    <td>{{ $payment_method->account_number }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

                       
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


</div>
         <!--Referral Code Modal end-->
        
        
    </div>
    <!--end::Root-->
    <!--end::Main-->
    <!--begin::Javascript-->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
            if (couponApplied) {
                alert('Coupon has already been applied.');
                return;
            }

            // Get the coupon code from the input field
            let couponCode = couponCodeInput.value;

            axios.post('{{ route('coupons.check') }}', {
                    coupon_code: couponCode
                })
                .then(function(response) {
                    if (response.data.exists) {
                        const coupon = response.data.coupon;
                        console.log(coupon)
                        couponDetailsContainer.innerHTML = `<span class="text-success">Valid Coupon</span>`;
                        couponApplied = true;


                        // Update the displayed price for all packages
                        document.querySelectorAll('[id^="discounted_price_"]').forEach(function(
                            discountedPriceElement
                        ) {
                            let packagePrice = parseFloat(
                                discountedPriceElement.getAttribute('data-package-price')
                            );
                            // Calculate the new discounted price
                            let newDiscountedPrice = packagePrice - (packagePrice * coupon.percentage)/100;
                           
                            discountedPriceElement.textContent = newDiscountedPrice.toFixed(0);
                            
                            document.querySelector('[data-price="'+packagePrice+'"]').setAttribute("data-discount", newDiscountedPrice.toFixed(0));
                            
                            
                        });
                        
                        var radioId = getCheckedValue();
                            tblValues(radioId)
                    } else {
                        couponDetailsContainer.innerHTML = `<span class="text-danger">Coupon Not Found</span>`;
                              $("#tbl").hide();
                    }
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });
        });
        
        
         function tblValues(radioId){
             if(document.getElementById(radioId).getAttribute("data-discount") == 0 ){
                 return false
             }
             $("#tbl").show();
             $("#tbl-prdouct-name").text($("#"+radioId).data("name"));
             $("#tbl-price").text($("#"+radioId).data("price"));
             $("#tbl-discount").text($("#"+radioId).data("price") - $("#"+radioId).data("discount"));
             $("#tbl-total").text($("#"+radioId).data("discount"));
             
         }
      
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
        $('#search-sponsor').click(function () {
         
            var code = $('#referral_code').val();
            if (code === null || code.trim() === "") {
             $("#sponsor-code-msg").show();
              $("#sponsor-code-details").hide();
             $("#sponsor-code-msg").text("Please enter sponsor code");
          
            }
            else{
              $("#sponsor-code-msg").hide();
               $("#sponsor-code-details").show();
            }
           
            $.ajax({
                url: "{{route('affiliate.verification.check.ajax')}}",
                method: 'POST',
                data: {
                    code: code,
                    _token: '{{ csrf_token() }}', // Include CSRF token for Laravel
                },
                success: function (response) {
                    if (response.exists) {
                        document.getElementById("sponsor-name").innerHTML = response.data.username
                        document.getElementById("sponsor-number").innerHTML = response.data.code
                        //document.getElementById("sponsor-rank").innerHTML = response.data.date
                        document.getElementById("sponsor-joining-date").innerHTML = response.data.date
                    } else {
                      document.getElementById("sponsor-name").innerHTML = ''
                        document.getElementById("sponsor-number").innerHTML = ''
                        //document.getElementById("sponsor-rank").innerHTML = response.data.date
                        document.getElementById("sponsor-joining-date").innerHTML = ''
                        $("#sponsor-code-msg").show();
                        $("#sponsor-code-msg").text("Sponsor code does not exist!");
                    }
                },
                error: function () {
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
        window.addEventListener('DOMContentLoaded', function () {
            var myModal = new bootstrap.Modal(document.getElementById('myModal'));
            myModal.show();
        });
    </script>
<?php endif; ?>



<script>
    var myModal = new bootstrap.Modal(document.getElementById('myModal'));
    
    myModal._element.addEventListener('hidden.bs.modal', function () {
        // Get the iframe inside the modal body
        var iframe = document.getElementById('videoFrame');
        
        // Reload the iframe to pause the video
        iframe.src = iframe.src;
    });
</script>
</body>
<!--end::Body-->

</html>
