<?php

use App\Http\Controllers\ProductController;

if (ProductController::countItem() > 0)
  $count = ProductController::countItem();
else
  $count = "";

if (ProductController::wishlistCountItem() > 0)
  $wishcount = ProductController::wishlistcountItem();
else
  $wishcount = "";


$controller = new ProductController();
$giftJewelryDropdownItems = $controller->getGiftJewelryDropdown();
$loveDropdown = $controller->getSingleCategoryDropdown('Engagement Rings');
$accessoriesDropdown = $controller->getSingleCategoryDropdown('Accessories');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Moon</title>

</head>

<body>
  <!-- Top Header -->
  <header class="bg-white shadow-sm">
    <div class="top-bar d-flex justify-content-between align-items-center p-2">
      <!-- left -->
      <div class="links">
        <a href="{{route('contactUs')}}" alt="Contact Us"><i class="fa-solid fa-headset fa-xl"></i></a>
        <a href="{{route('location')}}" alt="Moon's location"><i class="fa-solid fa-location-dot fa-xl"></i></a>
        <a href="{{route('book')}}"><i class="fa-solid fa-calendar-days fa-xl" alt="Book an Appointment"></i></a>
      </div>
      <!-- logo -->
      <div class="logo text-center">
        <a href="/moon"><img src="{{ asset('images/MoonLogo.png') }}" alt="Moon Logo"></a>
      </div>
      <!-- right -->
      <div class="righticons d-flex align-items-center">
        <a href="{{route('home')}}" class="text-dark me-4" alt="Home"><i class="fa-solid fa-house fa-xl"></i></a>

        @if(!Auth::check())
        <a href="{{route('signin')}}" class="text-dark me-4" alt="Sign in"><i class="fa-solid fa-user fa-xl"></i></a>
        @else
        <div class="dropdown">
          <a href="#" class="text-dark dropdown-toggle me-4 signdrop" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->name }}

          </a>
          <!-- Dropdown-->
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li>
              <a class="dropdown-item" href="{{route('get_current')}}" alt="Ordered List">Ordered List</a>
            </li>
            <li>
              <a class="dropdown-item" href="{{route('logout')}}" alt="Log Out">Log Out</a>
            </li>
          </ul>
        </div>
        @endif
        <a href="{{route('showWishlist')}}" class="text-dark me-4" alt="wishlist"><i class="fa-regular fa-heart fa-xl"></i><sup style="vertical-align: super; font-size:smaller; padding-left: 3px; color: red;">{{$wishcount}}</sup></a>

        <a href="{{route('showCart')}}" class="text-dark" alt="cart"><i class="fa-solid fa-cart-shopping fa-xl"></i><sup style="vertical-align: super; font-size:smaller; padding-left: 3px; color: red;">{{$count}}</sup></a>
      </div>
    </div>
  </header>

  <!-- Navigation -->
  <nav class="bg-light border-top">
    <div class="container">
      <ul class="nav justify-content-center py-2">

        <li class="nav-item dropdown">
          <a href="#" class="nav-link text-dark" data-bs-toggle="dropdown">Gifts</a>
          <div class="dropdown-menu p-4 custom-dropdown">
            <div class="container-fluid">
              <div class="row text-muted">
                @foreach ($giftJewelryDropdownItems as $item)
                <div class="col-md-2 text-center">
                  <a href="{{ route('show_category', $item['slug']) }}" class="nav-link text-dark">
                    <h6 class="dropdown-title">{{ $item['name'] }}</h6>
                    <img src="{{ asset($item['image']) }}" class="img-fluid dropdown-img" alt="{{ $item['name'] }}">
                  </a>
                </div>
                @endforeach
              </div>
              <div class="row">
                <div class="col text-center mt-3">
                  <a href="{{ route('showallproducts') }}" class="dropdown-viewall">View All Products</a>
                </div>
              </div>
            </div>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a href="#" class="nav-link text-dark" data-bs-toggle="dropdown">Jewelry</a>
          <div class="dropdown-menu p-4 custom-dropdown">
            <div class="container-fluid">
              <div class="row text-muted">
                @foreach ($giftJewelryDropdownItems as $item)
                <div class="col-md-2 text-center">
                  <a href="{{ route('show_category', $item['slug']) }}" class="nav-link text-dark">
                    <h6 class="dropdown-title">{{ $item['name'] }}</h6>
                    <img src="{{ asset( $item['image']) }}" class="img-fluid dropdown-img" alt="{{ $item['name'] }}">
                  </a>
                </div>
                @endforeach
              </div>
              <div class="row">
                <div class="col text-center mt-3">
                  <a href="{{ route('showallproducts') }}" class="dropdown-viewall">View All</a>
                </div>
              </div>
            </div>
          </div>
        </li>

        @if($loveDropdown)
        <li class="nav-item dropdown">
          <a href="#" class="nav-link text-dark" data-bs-toggle="dropdown">Love & Engagement</a>
          <div class="dropdown-menu p-4 custom-dropdown">
            <div class="container-fluid">
              <div class="row justify-content-center text-muted">
                @foreach ($loveDropdown['products'] as $product)
                <div class="col-md-2 text-center">
                  <a href="{{ route('show_category', $loveDropdown['category_slug']) }}" class="nav-link text-dark">
                    <img src="{{ asset($product->image) }}" class="img-fluid dropdown-img" alt="{{ $product->name }}">
                  </a>
                </div>
                @endforeach
              </div>
              <div class="row">
                <div class="col text-center mt-3">
                  <a href="{{ route('show_category', $loveDropdown['category_slug']) }}" class="dropdown-viewall">View All {{ $loveDropdown['category_name'] }}</a>
                </div>
              </div>
            </div>
          </div>
        </li>
        @endif

        @if($accessoriesDropdown)
        <li class="nav-item dropdown">
          <a href="#" class="nav-link text-dark" data-bs-toggle="dropdown">Accessories</a>
          <div class="dropdown-menu p-4 custom-dropdown">
            <div class="container-fluid">
              <div class="row justify-content-center text-muted">
                @foreach ($accessoriesDropdown['products'] as $product)
                <div class="col-md-2 text-center">
                  <a href="{{ route('show_category', $accessoriesDropdown['category_slug']) }}" class="nav-link text-dark">
                    <img src="{{ asset( $product->image) }}" class="img-fluid dropdown-img" alt="{{ $product->name }}">
                  </a>
                </div>
                @endforeach
              </div>
              <div class="row">
                <div class="col text-center mt-3">
                  <a href="{{ route('show_category', $accessoriesDropdown['category_slug']) }}" class="dropdown-viewall">View All {{ $accessoriesDropdown['category_name'] }}</a>
                </div>
              </div>
            </div>
          </div>
        </li>
        @endif
        <!-- all products -->
        <li class="nav-item"><a href="{{route('showallproducts')}}" class="nav-link text-dark">Moon's All Products</a></li>
        <!-- search -->
        <li class="nav-item dropdown">
          <div class="search-icon">
            <div class="divider"></div>
            <a href="#" class="nav-link text-dark" data-bs-toggle="dropdown"><i class="fa-solid fa-magnifying-glass fa-lg" style="color: #000000;"></i></a>
            <div class="dropdown-menu p-3">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-5 mx-auto text-center">
                    <ul class="list-unstyled ">
                      <form class="d-flex" action="{{ route('search') }}" method="get">
                        <input class="form-control form-control-lg" type="search" name="search" id="search" placeholder="Search....">
                        <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass fa-xl" style="color: #000000;"></i></button>
                      </form>
                      <div class="dvlist">
                        <li>
                          <h1>Suggestion :</h1>
                        </li>
                        <li><a href="#" class="dropdown-item">
                            <p>Rings</p>
                          </a>
                        </li>
                        <li><a href="#" class="dropdown-item">
                            <p>Earrings</p>
                          </a>
                        </li>
                        <li><a href="#" class="dropdown-item">
                            <p>Necklaces</p>
                          </a>
                        </li>
                      </div>

                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </li>

      </ul>
    </div>
  </nav>
</body>

</html>