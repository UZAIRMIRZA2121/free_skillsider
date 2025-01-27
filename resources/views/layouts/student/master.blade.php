
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
   
    <!-- slice slide carasoul -->
         
    <link rel="stylesheet" type="text/css" href="{{ asset('studens-asset/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('studens-asset/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('studens-asset/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('studens-asset/css/query.css') }}">
    <link rel="stylesheet" href="{{ asset('studens-asset/css/general.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" />
    <title>SkillSider.pk</title>
    <!-- font awesome solid -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @media (max-width: 576px) {
            .sm-text-size {
                font-size: 20px;
            }
        }
    </style>
   <style>
    /* Custom styles for centering the menu */
    @media (min-width: 768px) {
      .navbar-nav {
        margin: auto;
        display: flex;
        justify-content: center;
      }
    }

    /* Custom styles to remove border around the toggle button */
    .navbar-toggler {
      border: none;
    }

    .navbar-toggler:focus {
      outline: none;
      box-shadow: none;
    }
    .dropdown-menu::before{
        border:none;
    }
    .navbar-toggler{
        font-size: x-large;
    color: #f46f22;
        
    }
    .main-nav-link{
        
        font-size:large!important;
    }
  </style>
     <style>
      .whatsapp-button {
          position: fixed;
          bottom: 20px;
          right: 20px;
          z-index: 1000;
          background-color: #25D366; /* WhatsApp Green */
          color: white;
          border-radius: 50%;
          width: 60px; /* Increased for larger icon */
          height: 60px; /* Increased for larger icon */
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 3rem; /* Font size for the button */
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
          cursor: pointer;
          transition: background-color 0.3s ease; /* Transition for button background */
      }

      .whatsapp-button:hover {
          background-color: #128C7E; /* Darker green on hover */
      }

      .whatsapp-button i {
          font-size: 2.5rem !important; /* Font size for the icon */
          color: white; /* Default icon color */
          transition: color 0.3s ease, transform 0.3s ease; /* Transition for icon color and scaling */
      }

      .whatsapp-button:hover i,
      .whatsapp-button.active i {
          color: orange !important; /* Change icon color to orange */
          transform: scale(1.1); /* Scale up the icon slightly */
      }

      .form-container {
          position: fixed;
          bottom: 100px; /* Adjust the position above the button */
          right: 20px;
          z-index: 999;
          background-color: #fff;
          border: 1px solid #ccc;
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
          border-radius: 5px;
          padding: 15px;
          width: 300px; /* Adjust width as needed */
          transform: translateY(20px); /* Initial position */
          opacity: 0; /* Initial opacity */
          transition: all 0.3s ease; /* Transition for smooth animation */
          display: none; /* Initially hidden */
      }

      .form-container.show {
          display: block; /* Show the form when active */
          transform: translateY(0); /* Move to original position */
          opacity: 1; /* Full opacity */
      }

      /* New class to set the icon color to orange with !important */
      .icon-active {
          color: orange !important; /* Change icon color to orange */
      }
  </style>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var navbarToggler = document.querySelector('.navbar-toggler');
      var menuIsOpen = false;

      navbarToggler.addEventListener('click', function () {
        menuIsOpen = !menuIsOpen;
        updateToggleButton();
      });

      function updateToggleButton() {
        var icon = menuIsOpen ? '✕' : '☰';
        navbarToggler.innerHTML = icon;
      }
    });
  </script>
  
</head>

<body>
   @include('layouts.student.header') 
   
 
  
    @yield('main')

    @include('layouts.student.footer')

 <style>
  /* Keyframes for shake animation */
@keyframes shake {
    0% { transform: translateX(0); }
    25% { transform: translateY(-2px); }
    50% { transform: translateY(2px); }
    75% { transform: translateX(-2px); }
    100% { transform: translateX(2px); }
}

/* Add the shake animation to the button */
.whatsapp-button.shake {
    animation: shake 0.5s ease-in-out;
    animation-iteration-count: infinite; /* Loop animation if you want it to shake continuously */
}

 </style>
 <!-- WhatsApp Button -->
<!-- WhatsApp Button with link -->
<a href="https://www.whatsapp.com/channel/0029VazEIc8A89MgoiA0zn1f" target="_blank">
  <div class="whatsapp-button icon-active" id="whatsappButton">
      <i class="fab fa-whatsapp"></i>
  </div>
</a>

 
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="{{ asset('studens-asset/slick/slick.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('studens-asset/js/query.js') }}"></script>
     <!-- bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script>
// Add shake class to the WhatsApp button when the page loads
const whatsappButton = document.getElementById("whatsappButton");

// Add the shake animation when the page loads
window.addEventListener("load", () => {
    whatsappButton.classList.add("shake");
});

// Optionally, remove the shake animation after it finishes
whatsappButton.addEventListener("animationend", () => {
    whatsappButton.classList.remove("shake");
});

        $('#check-code-button').click(function () {
          
            var code = $('#code').val();
           
            $.ajax({
                url: "{{route('affiliate.verification.check.ajax')}}",
                method: 'POST',
                data: {
                    code: code,
                    _token: '{{ csrf_token() }}', // Include CSRF token for Laravel
                },
                success: function (response) {
                    if (response.exists) { 
                        document.getElementById("no-found").style.display = 'none'
                        document.getElementById("found").style.display = 'block'
                        document.getElementById("username").innerHTML = response.data.username
                        document.getElementById("ref-code").innerHTML = response.data.code
                        document.getElementById("joining-date").innerHTML = response.data.date
                        $('#codeExistsModal').modal('show');
                    } else {
                        document.getElementById("no-found").style.display = 'block'
                        document.getElementById("found").style.display = 'none'
                        $('#codeExistsModal').modal('show');
                        document.getElementById("no-found").innerHTML = "Referral code does not exist"
                    }
                },
                error: function () {
                    alert('An error occurred while checking the code.');
                }
            });
         });
         
    </script>
    
<script>
    // Custom jQuery to close the dropdown when a menu item is clicked on mobile
    $(document).ready(function() {

      $('#dropdown').on('click', function(event) {
          $('#dropdown-menu').toggle();
      });
    });
  </script>

    
</body>

</html>
