    <!-- header -->
    <header class="header_vd">
        <!-- header top -->
        <div class="py-1 pt-xxl-6">
            <div class="overflow-hidden">
                <div class="row">
                    <div class="col-md-3">
                        <div class="box_left_vd social-icons align-items-center justify-content-center">
                            <p>
                                <a href="#" class="social-icons_link"><i class="fa-brands fa-facebook-f"></i></a>
                            </p>
                            <p>
                                <a href="#" class="social-icons_link"><i class="fa-brands fa-twitter"></i></a>
                            </p>
                            <p>
                                <a href="#" class="social-icons_link"><i class="bi bi-instagram"></i></a>
                            </p>
                            <p>
                                <a href="#" class="social-icons_link"><i class="fa-brands fa-linkedin-in"></i></a>
                            </p>
                            <p>
                                <a href="#" class="social-icons_link"><i class="bi bi-youtube"></i></a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <a href="{{ route('client.home') }}"><img class="logo_vd_top" src="/client_asset/image/logo.png"
                                alt="logo_sieuthinoithat" /></a>
                    </div>
                    <div class="col-md-3">
                        <div class="box_right_vd align-items-center justify-content-center">
                            <!-- wishlist -->
                            <div class="list-inline-item me-7 text-center">
                                <a href="" class="text-muted position-relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                        <path
                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                        </path>
                                    </svg>
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-stnt">
                                        1
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                    <div class="list_icon_text_vd">
                                        <small>Wishlist</small>
                                    </div>
                                </a>
                            </div>

                            <!-- giỏ hàng -->
                            <div class="list-inline-item me-7 text-center">
                                <a class="text-muted position-relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-shopping-bag">
                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                    </svg>
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-stnt">
                                        1
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                    <div class="list_icon_text_vd">
                                        <small>Giỏ hàng</small>
                                    </div>
                                </a>
                            </div>

                            <!-- tài khoản -->
                            <div
                                class="list-inline-item me-7   @if (!Auth::check()) me-lg-0 @endif text-center">
                                <a href="{{ route('client.account.index') }}" class="text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <div class="list_icon_text_vd">
                                        <small>Tài khoản</small>
                                    </div>
                                </a>
                            </div>

                            <!-- đăng xuất -->
                            @if (Auth::check())
                                <div class="list-inline-item me-7 me-lg-0 text-center">
                                    <a href="{{ route('client.auth.logout') }}" class="text-muted"
                                        data-bs-toggle="modal" data-bs-target="#userModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-log-out">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                        </svg>
                                        <div class="list_icon_text_vd">
                                            <small>Đăng xuất</small>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- header center -->
        <div class="py-5 header_menu_vd">
            <div class="container">
                <div class="row w-100 align-items-center gx-lg-2 gx-0">
                    <div class="col-xxl-3 col-lg-3 col-md-6 col-5">
                        <a href=""><img class="logo_vd" src="/client_asset/image/logo.png"
                                alt="logo_sieuthinoithat" /></a>
                    </div>
                    <div class="col-xxl-6 col-lg-5 d-none d-lg-block">
                        <form action="" method="get" class="header_search">
                            <div class="input-group justify-content-center">
                                <input style="max-width: 500px" name="q" class="form-control rounded"
                                    type="text" placeholder="Tìm kiếm sản phẩm..." />
                                <span class="input-group-append">
                                    <button typre="submit"
                                        class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-search">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65">
                                            </line>
                                        </svg>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2 col-xxl-3 text-end col-md-6 col-7">
                        <div class="list-inline">
                            <div class="list-inline-item d-inline-block d-lg-none">
                                <!-- Button -->
                                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#navbar-default" aria-controls="navbar-default"
                                    aria-label="Toggle navigation">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                        fill="currentColor" class="bi bi-text-indent-left text-stnt"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- menu -->
        <nav class="navbar navbar-expand-lg navbar-light navbar-default py-0 pb-lg-4"
            aria-label="Offcanvas navbar large">
            <div class="container">
                <div class="offcanvas offcanvas-start" tabindex="-1" id="navbar-default"
                    aria-labelledby="navbar-defaultLabel">
                    <div class="offcanvas-header pb-1">
                        <a href=""><img src="/client_asset/image/logo.png"
                                alt="eCommerce HTML Template" /></a>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body justify-content-center">
                        <div class="d-block d-lg-none mb-4">
                            <form action="#">
                                <div class="input-group">
                                    <input class="form-control rounded" type="search"
                                        placeholder="Tìm kiếm sản phẩm..." />
                                    <span class="input-group-append">
                                        <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end"
                                            type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-search">
                                                <circle cx="11" cy="11" r="8"></circle>
                                                <line x1="21" y1="21" x2="16.65" y2="16.65">
                                                </line>
                                            </svg>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>

                        <!-- menu -->
                        <div>
                            <ul class="navbar-nav align-items-center">
                                <li class="nav-item w-100 w-lg-auto">
                                    <a class="nav-link active" href="">Trang chủ</a>
                                </li>

                                <li class="nav-item w-100 w-lg-auto">
                                    <a class="nav-link" href="">Giới thiệu</a>
                                </li>

                                <li class="nav-item dropdown w-100 w-lg-auto dropdown-fullwidth">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">Sản phẩm</a>
                                    <div class="dropdown-menu pb-0">
                                        <div class="row p-2 p-lg-4 menu_drop_vd">
                                            {{-- format bằng cách nào --}}
                                            @foreach (getCategory('other') as $item)
                                                <div class="col-lg-3 col-12 mb-4 mb-lg-0">
                                                    <a class="dropdown-item"
                                                        href="{{ route('client.category.index', $item->slug) }}">{{ $item->name }}</a>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="menu_drop_img_vd">
                                            <div class="">
                                                <img src="/client_asset/image/header/Chair.png" alt="" />
                                            </div>
                                            <div class="">
                                                <img src="/client_asset/image/header/Bed.png" alt="" />
                                            </div>
                                            <div class="">
                                                <img src="/client_asset/image/header/Lamp.png" alt="" />
                                            </div>
                                            <div class="">
                                                <img src="/client_asset/image/header/plant_pot.png" alt="" />
                                            </div>
                                            <div class="">
                                                <img src="/client_asset/image/header/Table.png" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item dropdown w-100 w-lg-auto menu_drop_vd">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">Phòng</a>
                                    <ul class="dropdown-menu">
                                        @foreach (getCategory('room') as $item)
                                            <li><a class="dropdown-item"
                                                    href="{{ route('client.category.index', $item->slug) }}">{{ $item->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- end menu -->
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- end header -->
