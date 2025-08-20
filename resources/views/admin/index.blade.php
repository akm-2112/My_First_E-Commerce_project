@extends('admin.loginLayout')
@section('title','Admin Login')
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


<div class="container py-5 text-muted">
    <div class="row justify-content-center">
        <div class="col-lg-3">
            <div class="bg-white p-5 rounded-3 shadow-lg text-center">
                <img src="{{ asset('images/Moonbig.png') }}" alt="Moon Jewelry Logo" class="img-fluid mt-4 mb-4" style="max-width: 150px;">

                <h1 class="mb-3">Admin Login</h1>

                <form action="{{route('admin_login')}}" method="POST" class="mx-auto" style="max-width: 400px; text-align: left;">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="submitbtn w-100">Log In</button>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection