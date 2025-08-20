@extends('moon.layout')
@section('title','Location')
@section('Content')
<div class="container py-5 ">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="bg-white p-5 rounded-3 shadow-lg text-center">
                <img src="{{ asset('images/Moonbig.png') }}" alt="Moon Jewelry Logo" class="img-fluid mb-4" style="max-width: 120px;">

                <h3 class="mb-2 text-muted">Moon's Location</h3>
                
                <hr>
                <h5 class="mb-4 text-start fw-bold text-muted">London</h5>
                <div class="text-start mb-4">
                    <i class="fa-solid fa-map-pin me-2"></i>
                    <strong>Branch  :</strong>
                    <div class="ms-4">27 Clements Ln, City of London, London EC4N 7AE, United Kingdom</div>
                </div>
                <hr>
                <h5 class="mb-4 text-start fw-bold text-muted">Bangkok</h5>
                <div class="text-start mb-4">
                    <i class="fa-solid fa-map-pin me-2"></i>
                    <strong>Branch  :</strong>
                    <div class="ms-4">Central World, 1st Floor, B112 - B113 4, 5 Ratchadamri Rd, Pathum Wan, Bangkok 10330, Thailand</div>
                </div>

                <hr>
                <h5 class="mb-4 text-start fw-bold text-muted">Yangon</h5>
                <div class="text-start mb-4">
                    <i class="fa-solid fa-map-pin me-2"></i>
                    <strong>Branch-1 :</strong>
                    <div class="ms-4">Rm A/104, 1st Flr, Jewellery Mall, Time City Complex, Kamaryut Township, Yangon, Myanmar</div>
                </div>

                <div class="text-start mb-4">
                    <i class="fa-solid fa-map-pin me-2"></i>
                    <strong>Branch-2 :</strong>
                    <div class="ms-4">307, Shwe Dagon Pagoda Rd., Corner of Maw Koon Tike St., Pha Yar Gyi Ward, Dagon Township, Yangon, Myanmar</div>
                </div>

                <div class="text-start mb-4">
                    <i class="fa-solid fa-map-pin me-2"></i>
                    <strong>Branch-3 :</strong>
                    <div class="ms-4">711, Maha Bandoola Rd., Latha Township, Yangon, Myanmar</div>
                </div>



                <hr>
                <h5 class="mb-4 text-start fw-bold text-muted">Mandalay</h5>
                <div class="text-start mb-4">
                    <i class="fa-solid fa-map-pin me-2"></i>
                    <strong>Branch-1 :</strong>
                    <div class="ms-4"> Ocean Mingalar Mandalay, Shop 119 - 120, Ground Floor , 73 St ,Chan Mya Tharzi Township , Mandalay, Myanmar</div>
                </div>

                <div class="text-start mb-4">
                    <i class="fa-solid fa-map-pin me-2"></i>
                    <strong>Branch-2 :</strong>
                    <div class="ms-4">Mandalay Yatanar Mall Gems & Jewellery Shopping Mall, Mandalay, Myanmar</div>
                </div>

                
            </div>
        </div>
    </div>
</div>


@endsection