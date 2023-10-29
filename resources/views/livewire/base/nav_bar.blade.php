<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">Home</a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        
        
      </li>

      
      
      
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown border-left border-right mr-5">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <img src="{{ asset('assets/images/logo/proadmin.jpg') }}" alt="user_image" class="img-circle elevation-3" style="opacity: .8; width: 35px;">&nbsp;&nbsp;&nbsp;
          <span><strong> @auth {{ auth()->user()->name }} @endif <i class=" fas fa-angle-down"></i></strong></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          
          <div class="dropdown-divider"></div>
          <a href="{{ route('profile.show') }}" class="dropdown-item">
            <i class="fas fa-address-card mr-2"></i> Profile Settings
          </a>

          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt mr-2"></i>Logout
          </a>
          <form id="logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
          </form>

        </div>
      </li>


    </ul>
  </nav>
  <!-- /.navbar