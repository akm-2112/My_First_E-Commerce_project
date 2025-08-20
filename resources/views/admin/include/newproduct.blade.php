@extends('admin.layout')
@section('title','Add Products')
@section('content')


<div class="container py-5 mt-10 text-muted">
  <div class="row justify-content-center">
    <div class="col-lg-4">
      <div class="bg-white p-5 rounded-3 shadow-lg ">

        <div class="d-flex justify-content-center mt-6">
          <form action="{{route('admin_addProduct')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="text" class="form-label border-top-20px">Category:</label>
              <select name="category" id="category" class="form-control" style="width:300px;" required>
                <option value="" class="">Select a category</option>
                @foreach ($categories as $category)
                <option value="{{$category->id}}" class="">{{$category->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="text" class="form-label">Name:</label>
              <input type="text" class="form-control" style="width:300px;" id="name" name="name" placeholder="Enter jewelry's name..." required>
            </div>
            <div class="mb-3">
              <label for="text" class="form-label">Price:</label>
              <input type="text" class="form-control" style="width:300px;" id="price" name="price" placeholder="Enter jewelry's price" required>
            </div>
            <div class="mb-3">
              <label for="text" class="form-label">Metal:</label>
              <input type="text" class="form-control" style="width:300px;" id="metal" name="metal" placeholder="Enter jewelry's metal" required>
            </div>
            <div class="mb-3">
              <label for="text" class="form-label">Description:</label>
              <textarea class="form-control" style="width:300px;" id="description" name="description" placeholder="Enter jewelry's description" required></textarea>
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">Image:</label>
              <img id="imgPreview" alt="" style="width:100px; height:100px;">
            </div>
            <div class="mb-3">
              <input type="file" class="form-control" style="width:300px;" id="Image" name="image" required>
            </div>
            <button type="submit" class="submitbtn" style="width:300px;">Add Product</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('Image').addEventListener('change', function(event) {
    const [file] = event.target.files;
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const imgPreview = document.getElementById('imgPreview');
        imgPreview.src = e.target.result;
        imgPreview.style.display = 'block';
      }
      reader.readAsDataURL(file);
    }
  });
</script>
@endsection