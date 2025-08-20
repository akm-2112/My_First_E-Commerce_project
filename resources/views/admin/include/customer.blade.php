@extends('admin.layout')
@section('title','Customer')
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
        <th>Customer ID</th>
        <th>Name</th>
        <th>Email</th>
        <th> </th>
      </tr>
    </thead>
    <tbody>
      @foreach ($customers as $customer )

      <tr>
        <td>{{$customer->id}}</td>
        <td>{{$customer->name}}</td>
        <td>{{$customer->email}}</td>
        <td>
          <a href="{{ route('admin_cusHistory', $customer->id) }}" class="btn d-inline-flex btn-sm btn-neutral mx-1">Order History</a>
        </td>
      </tr>
      @endforeach
      <div class="mt-5">{{$customers->links()}}</div>
    </tbody>
  </table>
</div>

@endsection