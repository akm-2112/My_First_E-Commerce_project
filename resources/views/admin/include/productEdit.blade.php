@extends('admin.layout')
@section('title','Product | Edit')
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

@foreach ($product as $p)
<div class="d-flex justify-content-center mt-6">
    <form action="{{ route('admin_productUpdate', $p->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-2">
            <label for="category" class="form-label">Category:</label>
            <input type="text" class="form-control" style="width:300px;" id="category" name="category" value="{{ $p->category->name }}" disabled>
        </div>
        <div class="mb-2">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" style="width:300px;" id="name" name="name" value="{{ $p->name }}">
        </div>
        <div class="mb-2">
            <label for="price" class="form-label">Price:</label>
            <input type="text" class="form-control" style="width:300px;" id="price" name="price" value="{{ $p->price }}">
        </div>
        <div class="mb-2">
            <label for="metal" class="form-label">Metal:</label>
            <input type="text" class="form-control" style="width:300px;" id="metal" name="metal" value="{{ $p->metal }}">
        </div>
        <div class="mb-2">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" style="width:300px;" id="description" name="description">{{ $p->description }}</textarea>
        </div>

        <!-- Image Section -->
        <div class="mb-2 text-center">
            <label class="form-label d-block">Product Image:</label>
            <img id="imgPreview" src="{{ asset($p->image) }}" alt="Product Image"
                 style="width:150px; height:150px; border-radius:10px; border:1px solid #ddd; padding:5px;">
            
            
            <div class="mt-3">
                <label for="image" class="form-label">Upload New Image:</label>
                <input type="file" class="form-control" style="width:300px;" id="image" name="image">
            </div>
        </div>

        <button type="submit" class="submitbtn w-100 mb-6">Update Product</button>
    </form>
</div>
@endforeach

<script>
  document.getElementById('image').addEventListener('change', function(event) {
    const [file] = event.target.files;
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('imgPreview').src = e.target.result; 
      }
      reader.readAsDataURL(file);
    }
  });
</script>
@endsection
