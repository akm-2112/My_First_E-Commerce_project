@extends('moon.layout')
@section('title','Wishlist')
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
    <div class="row">
        <div class="col-lg-10">
            <h2 class="mb-4">Shopping Wishlist</h2>
            <div class="cartItems">
                @foreach ($wishlistItems as $item )
                <div class="cartItem d-flex align-items-center  p-4 mb-3">
                    <img class="cartItemImg" src="{{asset($item->image)}}" alt="">
                    <div class="cartItemDetails  ms-3">
                        <h5 class="itemName">{{$item->name}}</h5>
                        <p class="itemMetal text-muted">{{$item->metal}}</p>
                        <a href="{{route('showDetail', $item->id)}}" class="nav-link cartWishlist text-bold" style="color: #0041C2;">View Details</a>
                    </div>
                    <p class="itemPrice ms-auto text-muted">{{number_format($item->price,2)}} GBP</p>
                    <div class=" cartItem d-flex justify-content-between">
                    <form action="{{ route('saveCart', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link mb-3 p-0 border-0 bg-transparent text-dark">
                            <i class="fa-solid fa-cart-shopping fa-xl"></i>
                        </button>
                    </form>
                    </div>
                    <a href="{{route('wishlistItemRemove',$item->wishlist_id)}}" class="removeCross ms-4"><i class=" cross fa-regular fa-x fa-lg"></i></a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection