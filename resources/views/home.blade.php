@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<div class="row">

    <!-- Total Users -->
    <div class="col-md-6 col-lg-3">
        <div class="info-box bg-info">
            <span class="info-box-icon">
                <i class="fas fa-users"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Total Users</span>
                <span class="info-box-number">{{ $totalUsers }}</span>
            </div>
        </div>
    </div>

    <!-- Today Users -->
    <div class="col-md-6 col-lg-3">
        <div class="info-box bg-success">
            <span class="info-box-icon">
                <i class="fas fa-user-plus"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Today Users</span>
                <span class="info-box-number">{{ $todayUsers }}</span>
            </div>
        </div>
    </div>

</div>

<!-- ===== Chart Section ===== -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">User Registration Trend (Last 7 Days)</h3>
    </div>
    <div class="card-body">
        <canvas id="userChart"></canvas>
    </div>
</div>

<!-- ===== Latest Users Table ===== -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Latest Registered Users</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($latestUsers as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('userChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($days),
            datasets: [{
                label: 'User Registrations',
                data: @json($counts),
                borderWidth: 2,
                fill: false
            }]
        }
    });
</script>
@stop