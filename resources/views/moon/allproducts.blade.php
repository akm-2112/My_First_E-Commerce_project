@extends('moon.layout')
@section('title','All Products')
@section('Content')

@if(session('success'))
<div class="alert alert-warning text-danger fade-message text-bolder text-center" style="font-size: larger;">
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
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-6 g-4">
        @foreach ($products as $product)
        <div class="col">
            <div class="card h-100 product-card">
                <div class="position-relative">
                    <img src="{{asset($product->image)}}" class="card-img-top img-fluid" alt="{{$product->name}}">
                    <form action="{{ route('saveWishlist', $product->id) }}" method="POST" >
                    @csrf
                    <button type="submit" class="wishlist-icon">
                        <i class="fa-regular fa-heart fa-lg"></i>
                    </button>
                </form>
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-center">{{$product->name}}</h5>
                    <p class="card-text text-muted text-center">{{number_format($product->price,2)}} GBP</p>
                    <div class="mt-auto text-center">
                        <a href="{{route('showDetail', $product->id)}}" class="view-detail">View Details</a>
                        <form action="{{ route('saveCart', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="addTocart mt-2 w-100">Add to Cart</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection