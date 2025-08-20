@extends('moon.layout')
@section('title','Sign In')
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

<div class="container my-5" style="max-width:900px">
    <div class="row justify-content-center">
        <!-- Sign In Section -->
        <div class="diver col-md-5 border-end border-1">
            <h3>Sign In</h3>
            <p>Please sign in to your Moon Account.</p>
            <form action="{{route('signinPost')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" style="width:300px;" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" style="width:300px;" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="submitbtn" style="width:300px;">Sign In</button>
            </form>
           
        </div>


        <!-- Create an Account Section -->
        <div class="createsection col-md-5">
            <h3>Create an Account</h3>
            <p>Register a Moon Account to unlock special offers, faster checkouts, and personalized recommendations!</p>
            <div class="regsignlink"><a href="{{route('signup')}}">Register Now</a></div>
        </div>
    </div>
</div>

@endsection