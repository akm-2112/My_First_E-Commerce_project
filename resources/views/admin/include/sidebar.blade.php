<!-- Dashboard -->
<div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary container-fluid">

    <!-- Start Vertical Navigation Bar -->
    <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-light border-bottom border-bottom-lg-0 border-end-lg"
        id="navbarVertical">
        <div class="container">
            <div class="d-flex">
                <img src="{{asset('images/MoonLogo.png')}}" alt="">
            </div>
            <div class="collapse navbar-collapse " id="navbarResponsive">
                <!-- Navigation -->
                <div class="d-flex">
                    <div class="ms-3">
                        <p class="p-0 m-0 text-gold fw-bold text-uppercase">{{auth('admin')->user()->name}}</p>
                        <p class="p-0 m-0">Admin</p>
                    </div>
                </div>

                <hr class="navbar-divider my-1 opacity-70">

                <ul class="navbar-nav ">
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('admin_dashboard')}}">
                            <i class="fa fa-house"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin_order')}}">
                            <i class="fa-solid fa-clipboard-list"></i> Order
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin_product')}}">
                            <i class="fa-solid fa-truck"></i> Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin_newproduct')}}">
                            <i class="fa-solid fa-folder-open"></i> Add Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin_customer')}}">
                            <i class="fa-solid fa-id-badge"></i> Customer
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin_sale')}}">
                            <i class="fa-solid fa-receipt"></i> Sale
                        </a>
                    </li>

                </ul>
                <!-- Divider -->
                <hr class="navbar-divider my-3 opacity-70">

                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin_message') }}">
                            <i class="fa-solid fa-envelope"></i> Message
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin_bookMessage') }}">
                            <i class="fa-solid fa-calendar-days"></i>Appointment
                        </a>
                    </li>
                </ul>
                <!-- Divider -->
                <hr class="navbar-divider my-3 opacity-70">
             
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin_createaccount')}}">
                            <i class="fa-regular fa-address-card"></i>Create new Admin Account
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin_homepage') }}">
                            <i class="fa-solid fa-paintbrush"></i> Homepage Designer
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin_setting') }}">
                            <i class="fa-solid fa-gear"></i>Profile Setting
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin_logout')}}">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    {{-- End Vertical Navigation Bar --}}
    <!-- Main content -->
    <div class="h-screen flex-grow-1 overflow-y-lg-auto">
        <!-- Header -->
        <header class="bg-surface-primary border-bottom pt-6">
            <div class="container-fluid">
                <div class="mb-npx">
                    <div class="row align-items-center">
                        <div class="col-sm-6 col-md-4 mb-4 mb-sm-0">
                            <!-- Title -->
                            <h1 class="h2 mb-0 ls-tight" style="color: #ffb700;">{{ $title }}</h1>
                        </div>
                        <div class="col-sm-6 col-md-4 mb-4 mb-sm-0">

                            <form action="{{ route('admin_search') }}" method="get">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    <input type="text" name="search" id="" placeholder="Search . . . "
                                        class="w-100 form-control ms-2">
                                </div>
                            </form>
                        </div>
                        <!-- Actions -->
                        <div class="col-sm-6 col-md-4 text-sm-end">
                            <div class="mx-n1">
                                <!-- <a href="#" class="btn d-inline-flex btn-sm btn-neutral border-base mx-1">
                                    <span class="">
                                        <i class="fa-solid fa-bell h5 d-block m-auto"><sup class="text-danger"></sup></i>
                                    </span>
                                </a> -->
                               
                                <a href="{{route('admin_newproduct')}}" class="btn d-inline-flex btn-sm btn-neutral mx-1">
                                    <span class="m-auto">
                                        <i class="fa-solid fa-circle-plus"></i>
                                    </span>
                                    <span class="ms-2 p-1">Add Product</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        @yield('content')
    </div>
</div>