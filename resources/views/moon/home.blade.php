@extends('moon.layout')
@section('title', 'Home')
@section('Content')

<!-- Carousel-->
<section>
    <div id="demo" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach($carouselImages as $index => $carousel)
            <button type="button" data-bs-target="#demo" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></button>
            @endforeach
        </div>

        <div class="carousel-inner">
            @foreach($carouselImages as $index => $carousel)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ asset($carousel->image) }}" alt="Carousel" class="d-block w-100">
                <div class="carousel-caption">
                    <h3>{{ $carousel->title }}</h3>
                    <p>{{ $carousel->description }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</section>

<!--Product Cards-->
<section class="container my-5">
    <div class="row text-center">
        <hr style="color:#ffc433;">
        @foreach($productImages->take(3) as $product)
        <div class="col-lg-4 col-md-6 mb-4">
            <a href="{{ route('show_category',$product->category_name) }}" class="nav-link cartWishlist text-bold">
                <div class="card h-100">
                    <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->category_name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->category_name }}</h5>
                        View All
                    </div>
                </div>
            </a>
        </div>
        @endforeach
        <hr style="color:#ffc433;">
    </div>
</section>

<!-- Banner -->
<section class="container my-5">
    <div class="row text-center">
        <hr style="color:#ffc433;">
        @if($bannerImages->count() > 0)
        <div class="col-lg-12">
            <a href="{{route('showallproducts')  }}" class="nav-link cartWishlist text-bold">
                <div class="card h-100">
                    <img src="{{ asset($bannerImages[0]->image) }}" class="card-img-top" alt="Banner">
                    <div class="card-body">
                        <h5 class="card-title">{{ $bannerImages[0]->title }}</h5>
                        <p>{{ $bannerImages[0]->description }}</p>
                    </div>
                </div>
            </a>
        </div>
        @endif
        <hr style="color:#ffc433;">
    </div>
</section>

<!--Product Cards 2-->
<section class="container my-5">
    <div class="row text-center">
        <hr style="color:#ffc433;">
        @foreach($productImages->skip(3)->take(3) as $product)
        <div class="col-lg-4 col-md-6 mb-4">
            <a href="{{ route('show_category',$product->category_name) }}" class="nav-link cartWishlist text-bold">
                <div class="card h-100">
                    <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->category_name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->category_name }}</h5>
                        View All
                    </div>
                </div>
            </a>
        </div>
        @endforeach
        <hr style="color:#ffc433;">
    </div>
</section>

<!-- Second Banner Section -->
<section class="container my-5">
    <div class="row text-center">
        <hr style="color:#ffc433;">
        @if($bannerImages->count() > 1)
        <div class="col-lg-12">
            <a href="#" class="nav-link cartWishlist text-bold">
                <div class="card h-100">
                    <img src="{{ asset($bannerImages[1]->image) }}" class="card-img-top" alt="Banner">
                    <div class="card-body">
                        <h5 class="card-title">{{ $bannerImages[1]->title }}</h5>
                        <p>{{ $bannerImages[1]->description }}</p>
                    </div>
                </div>
            </a>
        </div>
        @endif
        <hr style="color:#ffc433;">
    </div>
</section>

<section class="container my-5">
    <div class="row text-center">
        <hr style="color:#ffc433;">
        @if($bannerImages->count() > 2)
        <div class="col-lg-12">
            <a href="#" class="nav-link cartWishlist text-bold">
                <div class="card h-100">
                    <img src="{{ asset($bannerImages[2]->image) }}" class="card-img-top" alt="Banner">
                    <div class="card-body">
                        <h5 class="card-title">{{ $bannerImages[2]->title }}</h5>
                        <p>{{ $bannerImages[2]->description }}</p>
                    </div>
                </div>
            </a>
        </div>
        @endif
        <hr style="color:#ffc433;">
    </div>
</section>

@endsection