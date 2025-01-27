
<nav class="navbar navbar-expand-lg navbar-light header bg-white sticky-top" style="
padding-bottom: 0px !important;
"> 
  <div class="container-fluid">

    <!-- Logo on the left -->
    
     <div class="main-logo-div">
        <a href="{{route('std.index')}}" class="navbar-brand">
            <img src="{{ asset('assets/images/skillsider_logo.png')}}" alt="Logo" class="main-logo h-50" >
        </a>
    </div>

    <!-- Custom toggle button for small screens -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      ☰ <!-- Default icon, will be updated by JavaScript -->
    </button>

    <!-- Centered navigation menu with dropdown and login button -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item ">
          <a class="nav-link main-nav-link" href="{{route('std.index')}}">Home</a>
        </li>
        <li class="nav-item dropdown px-lg-1" id="dropdown">
    <a class="nav-link dropdown-toggle main-nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       Courses
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="dropdown-menu">
      <a class="dropdown-item main-nav-link px-0" href="{{route('free.courses')}}" data-bs-auto-close="true" >Free Courses</a>
      <hr class="my-0 mb-1"/>
      <a class="dropdown-item main-nav-link px-0" href="https://skillsider.pk/home#section-new-course" data-bs-auto-close="true">Premium Courses</a>
      <hr class="my-0 mb-1"/>
      {{-- @php
      $packages =  App\Models\Packages::all(); 
  @endphp
  @if($packages->count() > 0)
      @foreach ($packages as $package)
          <a class="dropdown-item main-nav-link px-0" href="{{ route('single.package', ['id' => $package->id]) }}" data-bs-auto-close="true">{{$package->package_title}}</a>
          <hr class="my-0 mb-1"/>
      @endforeach
  @else
      <p>No Package available right now</p> 
  @endif --}}
    </div>
</li>


        <li class="nav-item px-lg-1">
          <a class="nav-link main-nav-link" href="{{route('about.us')}}">About</a>
        </li>
        <li class="nav-item px-lg-1">
          <a class="nav-link main-nav-link" href="{{route('blog')}}">Blog</a>
        </li>
        <li class="nav-item px-lg-1">
          <a class="nav-link main-nav-link" href="{{route('student.review')}}">Reviews</a>
        </li>
        <li class="nav-item px-lg-1">
          <a class="nav-link main-nav-link" href="{{route('contact.us')}}">Contact</a>
        </li>
      
        
      </ul>

      <!-- Login button - visible on small screens -->
      
      <div class="d-flex d-lg-none">
       @if(Auth::check())
            <a  href="{{route('login.page')}}">
             <button class="btn btn-outline-primary main__btn rounded-pill " type="button">Dashboard</button>
            </a>
            @else
            <a  href="{{route('login.page')}}">
             <button class="btn btn-outline-primary main__btn rounded-pill " type="button">Login / SignUp</button>
            </a>
               
            
            @endif
      </div>
    </div>

    <!-- Login button on the right - visible on larger screens -->
    <div class="d-none d-lg-flex">
     
        @if(Auth::check())
            
            <a  href="{{route('login.page')}}">
             <button class="btn btn-outline-primary main__btn rounded-pill nav-btn-2" type="button">Dashboard</button>
            </a>
            @else
            <a  href="{{route('login.page')}}">
             <button class="btn btn-outline-primary main__btn rounded-pill nav-btn-2" type="button">Login / SignUp</button>
            </a>
               
            
            @endif
    </div>

  </div>
</nav>
   

    <span class="btn-mobile-nav" style="display:none!important">
        
    </span>

