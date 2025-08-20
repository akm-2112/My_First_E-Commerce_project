@extends('moon.layout')
@section('title', 'Order Summary')

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

<div class="container mt-5">
    <div class="row justify-content-around">
        <div class="col-md-6">
            <h4 class="mb-4">Shipping Details</h4>
            <div class="card p-3 shadow-sm">
                <form action="{{ route('place_order') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $uname }}" required>
                    </div>
                    <div class="mb-3">
    <label class="form-label">Phone</label>
    <input type="tel" 
           name="phone" 
           id="phoneInput"
           class="form-control" 
           placeholder="e.g. 09123456789"
           pattern="[0-9]{3,15}" 
           title="Please enter only numbers (10-15 digits)"
           oninput="this.value = this.value.replace(/[^0-9]/g, '');"
           required>
</div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="3" required></textarea>
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <div>
                            <input type="radio" id="cash_on_deli" name="payment" value="cash_on_deli" checked>
                            <label for="cash_on_deli">Cash on Delivery</label>
                        </div>
                        <div>
                            <input type="radio" id="card_payment" name="payment" value="pay_with_card" required>
                            <label for="card_payment">Card Payment</label>
                        </div>
                    </div>

                    <div id="card-details" class="mb-3" style="display: none;">
                        <label class="form-label">Card Details</label>
                        <div id="card-element" class="form-control"></div>
                        <input type="hidden" name="stripeToken" id="stripe-token-id" required>
                    </div>

                    <input type="hidden" name="total" value="{{ $total }}">
                    <button type="submit" class="submitbtn mt-3 w-100">Place Order</button>
                </form>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-md-4">
            <h4 class="mb-4">Order Summary</h4>
            <div class="card p-3 shadow-sm sticky-summary">
                @foreach($cartItems as $item)
                <div class="d-flex justify-content-between border-bottom pb-2">
                    <img class="cartItemImg" src="{{asset($item->product->image)}}" alt="" style="width:80px; height:80px;">
                    <span>{{ $item->product->name }} (x{{ $item->qty }})</span>
                    <span>£{{ number_format($item->product->price * $item->qty, 2) }}</span>
                </div>
                @endforeach
                <div class="d-flex justify-content-between mt-3">
                    <strong>Total:</strong>
                    <strong>£{{ number_format($total, 2) }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stripe JS -->
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    
    document.addEventListener('DOMContentLoaded', function() {
        var cardPaymentRadio = document.getElementById('card_payment');
        var cashOnDeliveryRadio = document.getElementById('cash_on_deli');
        var cardDetailsDiv = document.getElementById('card-details');

        cardPaymentRadio.addEventListener('change', function() {
            if (this.checked) {
                cardDetailsDiv.style.display = 'block';
                cardElement.mount('#card-element');
            }
        });

        cashOnDeliveryRadio.addEventListener('change', function() {
            if (this.checked) {
                cardDetailsDiv.style.display = 'none';
            }
        });
    });

</script>

@endsection
