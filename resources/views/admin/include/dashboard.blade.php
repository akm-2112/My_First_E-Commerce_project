@extends('admin.layout')
@section('title','Dashboard')
@section('content')
<div class="row mt-8 ms-2">
  <div class="col-md-2">
    <div class="dashboard_card card bg-primary shadow-sm">
      <div class="card-body text-center">
        <a href="{{ route('admin_customer') }}" class="stretched-link text-white text-decoration-none">
          <h5 class="card-title">Customers</h5>
          <h2>{{ $users }}</h2>
          <i class="fa-solid fa-users fa-2x"></i>
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="dashboard_card card bg-success shadow-sm">
      <div class="card-body text-center">
        <a href="{{ route('admin_product') }}" class="stretched-link text-white text-decoration-none">
          <h5 class="card-title">Products</h5>
          <h2>{{ $products }}</h2>
          <i class="fa-solid fa-truck fa-2x"></i>
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="dashboard_card card bg-warning shadow-sm">
      <div class="card-body text-center">
        <a href="{{ route('admin_order') }}" class="stretched-link text-white text-decoration-none">
          <h5 class="card-title">Orders</h5>
          <h2>{{ $orders }}</h2>
          <i class="fa-solid fa-clipboard-list fa-2x"></i>
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-2">
    <div class="dashboard_card card bg-info shadow-sm">
      <div class="card-body text-center">
        <a href="{{ route('admin_bookMessage') }}" class="stretched-link text-white text-decoration-none">
          <h5 class="card-title">Appointments</h5>
          <h2>{{ $appointments }}</h2>
          <i class="fa-solid fa-calendar-days fa-2x"></i>
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-2">
    <div class="dashboard_card card bg-danger shadow-sm">
      <div class="card-body text-center">
        <a href="{{ route('admin_message') }}" class="stretched-link text-white text-decoration-none">
          <h5 class="card-title">Messages</h5>
          <h2>{{ $messages }}</h2>
          <i class="fa-solid fa-envelope fa-2x"></i>
        </a>
      </div>
    </div>
  </div>
</div>

<div class="container mt-5">
  <div class="row">
    <!-- Sales Chart -->
    <div class="col-md-6">
      <h4 class="text-center">Sales by Day</h4>
      <canvas id="saleChart" style="max-height: 300px;"></canvas>
    </div>
    <!-- Orders Chart -->
    <div class="col-md-6">
      <h4 class="text-center">Orders by Day</h4>
      <canvas id="orderChart" style="max-height: 300px;"></canvas>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var saleChartCanvas = document.getElementById('saleChart').getContext('2d');
    var orderChartCanvas = document.getElementById('orderChart').getContext('2d');

    var saleChart = new Chart(saleChartCanvas, {
      type: 'line',
      data: {
        labels: @json($saleDays),
        datasets: [{
          label: 'Total Sales',
          data: @json($saleTotal),
          backgroundColor: ['#fa6f48', '#3a6e55', '#60a9fc', '#856fbd', '#a3558e', '#84cf7c'],
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    var orderChart = new Chart(orderChartCanvas, {
      type: 'bar',
      data: {
        labels: @json($orderDays),
        datasets: [{
          label: 'Total Orders',
          data: @json($orderTotal),
          backgroundColor: ['#fa6f48', '#3a6e55', '#60a9fc', '#856fbd', '#a3558e', '#84cf7c'],
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  });
</script>

@endsection