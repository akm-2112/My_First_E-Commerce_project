@extends('moon.layout')
@section('title','Privacy Policy')
@section('Content')
<div class="container py-5 text-muted">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="bg-white p-5 rounded-3 shadow-lg text-center">

                <img src="{{ asset('images/Moonbig.png') }}" alt="Moon Jewelry Logo" class="img-fluid mb-4" style="max-width: 150px;">

                <h2 class="mb-4">Privacy Policy</h2>
                <p class="mb-4">
                    At <span class="text-warning fw-bold">Moon Jewelry</span>, we are committed to protecting your privacy. This policy outlines how we collect, use, and safeguard your personal information.
                </p>
                <p>
                    Information We Collect <br>
                    We may collect personal information such as your name, email address, phone number, and payment details when you make a purchase or create an account. We also collect non-personal information like browsing behavior and IP addresses.</p>
                <p>How We Use Your Information <br>
                Your information is used to process orders, improve our services, and communicate with you about promotions, updates, and new arrivals. We do not sell or share your information with third parties for marketing purposes.</p>
                <p> Security <br>
                We implement industry-standard security measures to protect your data from unauthorized access, alteration, or disclosure. However, no online platform is 100% secure, and we cannot guarantee absolute security.</p>
                <p>Your Rights <br>
                You have the right to access, update, or delete your personal information at any time. You can also opt out of receiving marketing communications by following the unsubscribe link in our emails.</p>
                <p>Third-Party Links <br>
                Our website may contain links to third-party sites. We are not responsible for the privacy practices or content of these sites.</p>
                <p>Changes to This Policy <br>
                We may update this policy periodically. Any changes will be posted on this page, and your continued use of the website constitutes acceptance of the updated policy.
                </p>
            </div>
        </div>
    </div>
</div>


@endsection