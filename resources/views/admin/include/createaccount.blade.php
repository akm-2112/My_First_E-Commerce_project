@extends('admin.layout')
@section('title','Account')
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


<div class="container py-5 mt-10 text-muted">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="bg-white p-5 rounded-3 shadow-lg text-center">
                <img src="{{ asset('images/Moonbig.png') }}" alt="Moon Jewelry Logo" class="img-fluid mt-4 mb-4" style="max-width: 150px;">

                <h3 class="mb-3">Create an Account</h3>

                <form action="{{ route('admin_addAccount') }}" method="POST" class="mx-auto" style="max-width: 400px; text-align: left;">

                    @csrf
                    <div class="mb-3">
                        <label for="user" class="form-label">Username:</label>
                        <input type="text" class="form-control" style="width:300px;" id="email" name="name" placeholder="Enter your Username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" style="width:300px;" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" style="width:300px;" id="password" name="password" placeholder="Enter your password" required>
                    </div>

                    <button type="submit" class="submitbtn mt-4" style="width:300px;">Create</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection