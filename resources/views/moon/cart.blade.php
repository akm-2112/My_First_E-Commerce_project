@extends('moon.layout')
@section('title','Cart')
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


<?php
$subtotal = 0
?>
<div class="container my-5">
    <div class="row">
        <div class="col-lg-7">
            <h2 class="mb-4">Shopping Cart</h2>
            <div class="cartItems">
                @foreach ($cartItems as $item )
                <?php
                $subtotal += $item->price * $item->qty;
                ?>
                <div class="cartItem d-flex align-items-center  p-4 mb-3">
                    <img class="cartItemImg" src="{{asset($item->image)}}" alt="">
                    <div class="cartItemDetails  ms-3">
                        <h5 class="itemName">{{$item->name}}</h5>
                        <p class="itemMetal text-muted">{{$item->metal}}</p>
                        <form action="{{ route('saveWishlist',$item->id) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <button type="submit" class="nav-link cartWishlist text-bold p-0 border-0 bg-transparent" style="color: #0041C2;">
                                Save for later
                            </button>
                        </form>
                    </div>
                    <p class="itemPrice ms-auto">£{{number_format($item->price,2)}} </p>
                    <a href="{{route('cartItemRemove',$item->cart_id)}}" class="removeCross ms-4"><i class=" cross fa-regular fa-x fa-lg"></i></a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-4">
            <div class="orderSummary p-4">
                <h4 class="mb-3">Order Summary</h4>
                <div class="d-flex justify-content-between">
                    <p>Subtotal</p>
                    <p>£{{number_format($subtotal,2)}}</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Shipping</p>
                    <p>£{{number_format(0,2)}}</p>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <p>Total</p>
                    <p>£{{number_format($subtotal,2)}}</p>
                </div>
                <form action="{{route('order_detail')}}" method="Get">
                @csrf
                <button class="submitbtn mt-3">Proceed To Checkout</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection