@extends('admin.layout')
@section('title','Sales')
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

<div class="container mt-5">
  <div class="customer-order-box bg-white p-4 shadow-sm rounded">
    <div class="customer-info p-3">
      <div class="d-flex justify-content-around">
        <h4 class="mb-1 text-border "><strong>Total Sales:</strong> {{ $totalSales }}</h4>
        <h4 class="mb-1 text-border "><strong>Total Earning:</strong> £{{ number_format($totalEarnings, 2) }}</h4>
      </div>
    </div>

    <hr style="border-top: 2px solid #ffc433; margin: 10px 0;">

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Customer</th>
          <th>Payment</th>
          <th>Category</th>
          <th>Name</th>
          <th>Metal</th>
          <th>price</th>
          <th>Sale Date</th>

        </tr>
      </thead>
      <tbody>
        @foreach ($sales as $sale )

        <tr>
          <td>{{$sale->oid}}</td>
          <td>{{$sale->username}}</td>
          <td>{{$sale->payment}}</td>
          <td>{{$sale->category_name}}</td>
          <td>{{$sale->name}}</td>
          <td style="white-space: pre-line;">{{ $sale->metal }}</td>
          <td>{{$sale->price}}</td>
          <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('Y-m-d') }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  @endsection