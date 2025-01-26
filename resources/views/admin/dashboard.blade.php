@extends('admin.layout')
@section('content')
    <div class="container-fluid py-4">
        <!-- Statistics Cards -->
        <div class="row">
            <!-- Total Sales -->
            <div class="col-md-3">
                <div class="card bg-gradient-primary mb-3 shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">Total Sales</h5>
                        <p class="card-text fs-4">${{ number_format($totalSales, 2) }}</p>
                    </div>
                </div>
            </div>
            <!-- Total Orders -->
            <div class="col-md-3">
                <div class="card bg-gradient-success mb-3 shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">Total Orders</h5>
                        <p class="card-text fs-4">{{ $totalOrders }}</p>
                    </div>
                </div>
            </div>
            <!-- Total Products -->
            <div class="col-md-3">
                <div class="card bg-gradient-warning mb-3 shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">Total Products</h5>
                        <p class="card-text fs-4">{{ $totalProducts }}</p>
                    </div>
                </div>
            </div>
            <!-- Total Customers -->
            <div class="col-md-3">
                <div class="card bg-gradient-danger mb-3 shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">Total Customers</h5>
                        <p class="card-text fs-4">{{ $totalCustomers }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Insights -->
        <div class="row mt-4">
            <!-- Sales Chart -->
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h5>Monthly Sales Overview</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="salesChart"></canvas>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            const salesData = @json($salesData);
                            const ctx = document.getElementById('salesChart').getContext('2d');
                            const salesChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                                    datasets: [{
                                        label: 'Sales',
                                        data: salesData,
                                        borderColor: '#007bff',
                                        tension: 0.3,
                                        fill: true,
                                        backgroundColor: 'rgba(0, 123, 255, 0.1)',
                                        borderWidth: 2,
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'top',
                                        },
                                    },
                                },
                            });
                        </script>
                    </div>
                </div>
            </div>
            <!-- Most Sold Items -->
            <div class="col-lg-4">
                <div class="card shadow-lg">
                    <div class="card-header bg-success text-white">
                        <h5>Top 5 Most Sold Items</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($topProducts as $product)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $product->name }}
                                    <span class="badge bg-primary rounded-pill">{{ $product->total_sold }} sold</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-warning text-dark">
                        <h5>Recent Orders</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentOrders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->user->name}}</td>
                                        <td>${{ number_format($order->total_price, 2) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $order->status === 'delivered' ? 'success' : ($order->status === 'pending' ? 'warning text-dark' : 'danger') }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
