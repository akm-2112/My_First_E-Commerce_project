@extends('admin.layout')
@section('title','Appointment')
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
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Appointment Date</th>
        <th>Appointment Time</th>
        <th>Message</th>
        <th>Remove</th>

      </tr>
    </thead>
    <tbody>
      @foreach ($bookMsg as $msg )

      <tr>
        <td>{{$msg->name}}</td>
        <td>{{$msg->email}}</td>
        <td>{{$msg->phone}}</td>
        <td>{{ $msg->appointment_date }}</td>
        <td>{{ $msg->appointment_time }}</td>
        <td style="white-space: pre-line;">{{$msg->appointment_message}}</td>
        <td>
          <a href="{{route('admin_deleteAppointments',$msg->id)}}" class="btn btn-link" alt="Remove">
            <i class="fa-solid fa-xmark fa-2xl"></i>
            <p class="mt-2 text-muted" style="font-size: 11px; font-weight:lighter;">Remove</p>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection