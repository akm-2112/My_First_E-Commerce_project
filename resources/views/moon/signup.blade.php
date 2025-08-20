@extends('moon.layout')
@section('title','Sign Up')
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

<div class="container my-5" style="max-width:900px;">
    <div class="row justify-content-between">
        <!-- Already Have an Account Section -->
        <div class="diver col-md-5 text-center border-end border-1 pe-4">
            <h3 class="mt-3">Already a Moon member?</h3>
            <p class="mt-3" style="font-weight:lighter">Sign in to stay updated, shop faster, and enjoy a seamless experience.</p>
            <div class="regsignlink">
                <a href="{{route('signin')}}" class="regsignlink btn mt-3 text-decoration-underline">Sign In</a>
            </div>
        </div>

        <!-- Create an Account Section -->
        <div class="col-md-6 ps-4">
            <h3 class="mb-4">Create an Account</h3>
            <form action="{{route('signupPost')}}" method="Post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" style="width:300px;" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" style="width:300px;" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter your password" name="password" style="width:300px;" required>
                </div>
                <div class="mb-3">
                    <label for="passwordConfirm" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" id="pwd" name="password_confirmation" placeholder="Enter your password again" style="width:300px;" required>
                </div>
                <button type="submit" class="submitbtn" style="width:300px;">Register</button>
            </form>
        </div>
    </div>
</div>


@endsection