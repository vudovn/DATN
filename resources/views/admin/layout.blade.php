<!-- 
     ----------------------------------------------
    |         Đừng Bao Giờ Đi Ăn Một Mình !        |
     ----------------------------------------------
            \   ^__^
             \  (oo)\_______
                (__)\       )\/\
                    ||----w |
                    ||     ||
======V=====V=V=========V===========VV=V=======V========= 
-->
<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.components.head')
  </head>
  <body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr" data-pc-theme_contrast="" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
      <div class="loader-track">
        <div class="loader-fill"></div>
      </div>
    </div>
    <!-- [ Pre-loader ] End -->
    @include('admin.components.sidebar')
    <!-- [ Header Topbar ] start -->
    <header class="pc-header">
      <div class="header-wrapper">
        <!-- [Mobile Media Block] start -->
        <div class="me-auto pc-mob-drp">
          <ul class="list-unstyled">
            <!-- ======= Menu collapse Icon ===== -->
            <li class="pc-h-item pc-sidebar-collapse">
              <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="pc-h-item pc-sidebar-popup">
              <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="pc-h-item d-none d-md-inline-flex">
              <form class="form-search">
                <i class="search-icon">
                  <svg class="pc-icon">
                    <use xlink:href="#custom-search-normal-1"></use>
                  </svg>
                </i>
                <input type="search" class="form-control" placeholder="Ctrl + K" />
              </form>
            </li>
          </ul>
        </div>
      </div>
    </header>
    <!-- [ Header ] end -->
    <div class="pc-container">
      <div class="pc-content">
        @yield('template')
        <input type="hidden" name="model" id="model" value="{{ ucfirst($config['model']??'model') }}">
      </div>
    </div>
    @include('admin.components.footer')
    @include('admin.components.alert')
    @include('admin.components.script')
    
  </body>

</html>