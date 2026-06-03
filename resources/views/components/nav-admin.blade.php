<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <form action="{{ Route('logout') }}" method="post">
        @csrf
        <button type="submit" class="nav-link bg-transparent border-0"
          onclick="return confirm('Apakah anda yakin ingin logout?')">
          <i class="nav-icon fas fa-sign-out-alt"></i>
        </button>
      </form>
    </li>
  </ul>
</nav>