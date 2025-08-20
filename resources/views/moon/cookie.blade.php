@extends('moon.layout')
@section('title','About Us')
@section('Content')
<div class="container py-5 text-muted">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="bg-white p-5 rounded-3 shadow-lg text-center">

                <img src="{{ asset('images/Moonbig.png') }}" alt="Moon Jewelry Logo" class="img-fluid mb-4" style="max-width: 150px;">

                <h2 class="mb-4">Privacy Policy</h2>
                <p class="mb-4">
                     <span class="text-warning fw-bold">Moon Jewelry</span> uses cookies to enhance your browsing experience and provide personalized services. Cookies help us remember your preferences, analyze website traffic, and deliver relevant ads. You can manage or disable cookies through your browser settings, but this may affect the functionality of our website. We may also use third-party cookies for analytics and advertising, governed by their respective policies. This policy may be updated to reflect changes in our practices or legal requirements.
                </p>
            </div>
        </div>
    </div>
</div>


@endsection