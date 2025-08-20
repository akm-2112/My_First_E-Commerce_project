@extends('admin.layout')
@section('title','Order')
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
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Customer</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Payment</th>
        <th>Name</th>
        <th>Metal</th>
        <th>price</th>
        <th>Order Date</th>
        <th>Change Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($orders as $order )

      <tr>
        <td>{{$order->oid}}</td>
        <td>{{$order->username}}</td>
        <td>{{$order->phone}}</td>
        <td style="white-space: pre-line;">{{$order->address}}</td>
        <td>{{$order->payment}}</td>
        <td style="white-space: pre-line;">{{$order->name}}</td>
        <td style="white-space: pre-line;">{{ $order->metal }}</td>
        <td>{{$order->price}}</td>
        <td>{{\Carbon\Carbon::parse($order->order_date)->format('Y-m-d')}}</td>
        <td>
          <a href="{{route('admin_changeStatus',$order->oid)}}" class="btn btn-link">
          <i class="fa-solid fa-circle-check fa-2xl"></i>
            <p class="mt-2 text-muted" style="font-size: 12px; font-weight:light;">Complete</p>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection