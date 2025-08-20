@extends('admin.layout')
@section('title', 'Homepage Designer')

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

<!-- Tabs Navigation -->
<ul class="nav nav-tabs ms-2 sticky-top" id="homepageTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="carousel-tab" data-bs-toggle="tab" data-bs-target="#carousel" type="button" role="tab">
            <i class="fa-solid fa-images me-2"></i>Carousel
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="banner-tab" data-bs-toggle="tab" data-bs-target="#banner" type="button" role="tab">
            <i class="fa-solid fa-flag me-2"></i>Promo Banner
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="categories-tab" data-bs-toggle="tab" data-bs-target="#categories" type="button" role="tab">
            <i class="fa-solid fa-gem me-2"></i>Product Cards
        </button>
    </li>
</ul>

<div class="tab-content p-3">

    <div class="tab-pane show active" id="carousel" role="tabpanel">
        <div class="container my-5 mb-6">
            <div class="shadow-lg p-4 bg-white rounded">
                <h3 class="manage mb-2 text-center">Manage Carousel</h3>
                <div class="row g-4">
                    @foreach($carouselImages as $carousel)
                    <div class="col-md-4">
                        <div class="card p-3">
                            <div class="image-container">
                                <img src="{{ asset($carousel->image) }}" class="img-fluid" id="preview{{ $carousel->id }}">
                            </div>
                            <form action="{{ route('admin_carouselUpdate', $carousel->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="mt-2">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter title (Optional)" value="{{ $carousel->title }}">
                                </div>
                                <div class="mt-1">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" placeholder="Enter description (Optional)" rows="4">{{ $carousel->description }}</textarea>
                                </div>
                                <div class="mt-1">
                                    <label class="form-label">Choose Image</label>
                                    <input type="file" name="image" class="form-control" onchange="previewImage(event, {{ $carousel->id }})">
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="submitbtn px-4">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane " id="banner" role="tabpanel">
        <div class="container my-5">
            <div class="shadow-lg p-4 bg-white rounded">
                <h3 class="manage mb-4 text-center">Manage Promo Banner</h3>
                @foreach ($bannerImages as $banner)
                <div class="card p-4 mb-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <img src="{{ asset($banner->image) }}" class="img-fluid rounded w-100" id="bannerPreview{{ $banner->id }}">
                        </div>
                        <div class="col-lg-4">
                            <form action="{{ route('admin_bannerUpdate', $banner->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-2">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter title (Optional)" value="{{ $banner->title }}">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" rows="2" placeholder="Enter description (Optional)">{{ $banner->description }}</textarea>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Choose Image</label>
                                    <input type="file" name="image" class="form-control" onchange="previewBanner(event, {{ $banner->id }})">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="submitbtn px-4">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="tab-pane" id="categories" role="tabpanel">
        <div class="container my-5 mb-6">
            <div class="shadow-lg p-4 bg-white rounded">
                <h3 class="manage mb-2 text-center">Manage Products With Models</h3>
                <div class="row g-4">
                    @foreach($productImages as $product)
                    <div class="col-md-4">
                        <div class="card p-3">
                            <div class="image-container">
                                <img src="{{ asset($product->image) }}" class="img-fluid" id="preview{{ $product->id }}">
                            </div>
                            <form action="{{ route('admin_productWithModelsUpdate', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mt-2">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ $product->category_name }}" readonly>
                                </div>
                                <div class="mt-1">
                                    <label class="form-label">Choose Image</label>
                                    <input type="file" name="image" class="form-control" onchange="previewImage(event, {{ $product->id }})">
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="submitbtn px-4">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>


<hr style="color:#ffc433; padding:1px">


<script>
    function previewImage(event, id) {
        const [file] = event.target.files;
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview' + id).src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }

    function previewBanner(event, id) {
        const [file] = event.target.files;
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('bannerPreview' + id).src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection

