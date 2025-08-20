@extends('moon.layout')
@section('title','Book an Appointment')
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


<div class="container py-5 text-muted">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="bg-white p-5 rounded-3 shadow-lg text-center">
                <img src="{{ asset('images/Moonbig.png') }}" alt="Moon Jewelry Logo" class="img-fluid mb-4" style="max-width: 150px;">

                <h3 class="mb-4">Book an Appointment</h3>

                <form action="{{ route('bookAppointment') }}" method="POST" class="mx-auto" style="max-width: 400px; text-align: left;">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Preferred Date</label>
                        <input type="date" class="form-control" id="date" name="date" min="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="time" class="form-label">Preferred Time</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Additional Note: (optional)</label>
                        <textarea class="form-control" id="message" name="message" rows="4" ></textarea>
                    </div>

                    <button type="submit" class="submitbtn w-100">Send Message</button>
                </form>

                <hr>
                <h5 class="mb-4" style="font-size:medium; text-align:left;">Book with Phone</h5>
                <p><i class="fa-solid fa-phone me-4"></i><strong>09 343 434 34</strong></p>
                <p><i class="fa-solid fa-phone me-4"></i><strong>09 343 434 34</strong></p>
                <p><i class="fa-solid fa-phone me-4"></i><strong>09 343 434 34</strong></p>

            </div>
        </div>

    </div>
</div>

@endsection