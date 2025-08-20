@extends('admin.layout')
@section('title','Appointment')
@section('content')

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
    <div class="customer-order-box bg-white p-4 shadow-sm rounded">
        <div class="customer-info p-3">
            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="mb-1 text-bolder">{{ $customer->name }}</h4>
                    <p class="mb-3 text-muted">{{ $customer->email }}</p>
                </div>
                <p class="mb-0 "><strong>Total Orders:</strong> {{ $totalOrders }}</p>
                <p class="mb-0 "><strong>Total Spent:</strong> £{{ number_format($totalSpent, 2) }}</p>
            </div>
        </div>

        <hr style="border-top: 2px solid #ffc433; margin: 10px 0;">

        <div class="order-history" style="max-height: 500px; overflow-y: auto; padding-right: 10px;">
            @foreach ($orders as $order)
            <div class="orderItem p-3 mb-3 border rounded shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="orderID">Order #{{ $order->id }}</h5>
                    <p class="orderStatus text-muted">Status: <strong>{{ ucfirst($order->order_status) }}</strong></p>
                </div>
                <p class="orderDate text-muted">Placed on: {{ $order->created_at->format('d M Y') }}</p>

                <div class="orderDetails">
                    @foreach ($order->orderDetails as $detail)
                    <div class="orderProduct d-flex align-items-center p-3 border-bottom">
                        <img class="orderProductImg" src="{{ asset($detail->product->image) }}" alt="" style="width: 80px; height: 80px; object-fit: cover;">
                        <div class="orderProductDetails ms-3">
                            <h6 class="productName mb-1">{{ $detail->product->name }}</h6>
                            <p class="productQty text-muted">Quantity: {{ $detail->qty }}</p>
                        </div>
                        <p class="productPrice ms-auto text-muted">{{ number_format($detail->product->price * $detail->qty, 2) }} GBP</p>
                    </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <p class="totalAmount text-dark">Total: <strong>{{ number_format($order->total, 2) }} GBP</strong></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection