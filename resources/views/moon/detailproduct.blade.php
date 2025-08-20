@extends('moon.layout')
@section('title','All Products | Details')
@section('Content')

@if(session('success'))
<div class="alert alert-success text-success fade-message text-center">
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="alert alert-warning text-danger fade-message text-center">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<script>
   setTimeout(function() {
        let messages = document.querySelectorAll('.fade-message');
        messages.forEach((message) => {
            message.style.transition = "opacity 0.5s ease";
            message.style.opacity = "0";
            setTimeout(() => {
                message.style.display = "none";
            }, 500);
        });
    }, 3000);
</script>

<div class="container my-5">
    <div class="row g-4">
        <!-- Images -->
        <div class="col-lg-6">
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded shadow">
        </div>

        <!-- Product Details -->
        <div class="col-lg-6">

            <h1 class="display-5 text-uppercase fw-bold">{{ $product->name }}</h1>

            <p class="h4 text-muted my-3">{{ number_format($product->price, 2) }} GBP</p>

            <p class="text-secondary mb-4">{{ $product->description }}</p>

            <div class="mt-4 d-flex align-items-center">
                <form action="{{route('saveCart', $product->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="submitbtn" style="width:280px;">Add To Cart</button>
                </form>

                <form action="{{ route('saveWishlist', $product->id) }}" method="POST" >
                    @csrf
                    <button type="submit" class="btn btn-lg border-3 px-4">
                        <i class="fa-regular fa-heart fa-xl"></i>
                    </button>
                </form>
            </div>

            <div class="mt-4" style="width:250px;">
                <ul class="navbar-nav mt-4 text-muted">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route("book") }}"><i class="fa-solid fa-calendar-days fa-lg me-4"></i> Book an Appointment</a>
                    </li>
                </ul>
                <ul class="navbar-nav mt-4 text-muted">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('location') }}"><i class="fa-solid fa-location-dot fa-xl me-4"></i>Moon's Locations</a>
                    </li>
                </ul>
                <ul class="navbar-nav mt-4 text-muted">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-phone fa-lg me-4"></i>Order By Phone:01-223223</a>
                    </li>
                </ul>
            </div>
            <div class="mt-4 ">
                <h5 class="fw-bold text-uppercase mb-3">Related Products</h5>
                <div class="row gx-1">
                    @foreach ($relatedProducts as $related)
                    <div class="col-3">
                        <a href="{{route('showDetail',['id'=>$related->id])}}" class="text-decoration-none">
                            <div class="relatedCard card product-card">
                                <img src="{{asset($related->image)}}" alt="" class="relatedImg card-img-top">
                                <div class="card-body text-center text-muted">
                                    <p class="card-title">{{$related->metal}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endsection