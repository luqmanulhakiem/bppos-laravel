<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- User Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i> {{ auth()->user()->username }}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Admin</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Profil
          </a>
          <div class="dropdown-divider"></div>
          
        <a class="dropdown-item d-flex align-items-center" href="{{route('request-logout')}}" 
              onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
              <i class="fas fa-arrow-left mr-2"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('request-logout') }}" method="POST" class="d-none">
            @csrf
        </form>

          <div class="dropdown-divider"></div>
          
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer"></a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>