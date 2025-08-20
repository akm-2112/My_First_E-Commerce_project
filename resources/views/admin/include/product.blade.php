@extends('admin.layout')
@section('title','Products')
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

<form method="GET" action="{{ route('admin_product') }}" class="mb-4 mt-2">
  <div class="row align-items-center">
    <div class="col-auto ms-4">
      <select name="category" class="form-control form-select" style="width: 180px; padding: 6px 10px;">
        <option value="">All Categories</option>
        @foreach($products as $cat)
          <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
            {{ $cat->name }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="col-auto me-">
      <button type="submit" class="btn btn-light rounded-circle p-1" style="width: 35px; height: 35px;" title="Filter">
      <i class="fa-solid fa-arrow-right"></i>
      </button>
    </div>
  </div>
</form>



<div class="container mt-5">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Category</th>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Metal</th>
        <th>Description</th>
        <th>Edit</th>
        <th>Remove</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($products as $product )

      <tr>
        <td>{{$product->category->name}}</td>
        <td><img src="{{asset($product->image)}}" alt="" style="width:50px; height:50px;"></td>
        <td>{{$product->name}}</td>
        <td>{{$product->price}}</td>
        <td style="white-space: pre-line;">{{$product->metal}}</td>
        <td style="white-space: pre-line;">{{$product->description}}</td>
        <td>
          <a href="{{route('admin_productEdit',$product->id)}}" class="btn btn-link" alt="Edit">
            <i class="fa-solid fa-pen-to-square fa-xl"></i>
            <p class="mt-2 text-muted" style="font-size: 11px; font-weight:lighter;">Edit</p>
          </a>
        </td>
        <td>
          <a href="{{route('admin_productDelete',$product->id)}}" class="btn btn-link" alt="Remove">
            <i class="fa-solid fa-xmark fa-2xl"></i>
            <p class="mt-2 text-muted" style="font-size: 11px; font-weight:lighter;">Remove</p>
          </a>
        </td>
      </tr>
      @endforeach
      <div class="mt-5">{{$products->links()}}</div>
    </tbody>
  </table>
</div>
@endsection