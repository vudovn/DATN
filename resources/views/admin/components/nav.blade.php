<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="z-index: 1 !important;">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('home') }}" class="nav-link">Trang chủ</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('auth.logout') }}">
          <i class="bi bi-arrow-right-square fw-bold"></i>
        </a>
      </li>
    </ul>
  </nav>