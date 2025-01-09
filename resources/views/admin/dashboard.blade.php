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
                    <p class="card-text fs-4">$50,000</p>
                </div>
            </div>
        </div>
        <!-- Total Orders -->
        <div class="col-md-3">
            <div class="card bg-gradient-success mb-3 shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text fs-4">1,230</p>
                </div>
            </div>
        </div>
        <!-- Total Products -->
        <div class="col-md-3">
            <div class="card  bg-gradient-warning mb-3 shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text fs-4">450</p>
                </div>
            </div>
        </div>
        <!-- Total Customers -->
        <div class="col-md-3">
            <div class="card  bg-gradient-danger mb-3 shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Total Customers</h5>
                    <p class="card-text fs-4">920</p>
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
                        const ctx = document.getElementById('salesChart').getContext('2d');
                        const salesChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                                datasets: [{
                                    label: 'Sales',
                                    data: [1200, 1500, 1800, 1700, 1900, 2200],
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
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Product A
                            <span class="badge bg-primary rounded-pill">120 sold</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Product B
                            <span class="badge bg-primary rounded-pill">100 sold</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Product C
                            <span class="badge bg-primary rounded-pill">85 sold</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Product D
                            <span class="badge bg-primary rounded-pill">70 sold</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Product E
                            <span class="badge bg-primary rounded-pill">65 sold</span>
                        </li>
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
                            <tr>
                                <td>1</td>
                                <td>John Doe</td>
                                <td>$200</td>
                                <td><span class="badge bg-warning text-dark">Pending</span></td>
                                <td>2025-01-01</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jane Smith</td>
                                <td>$350</td>
                                <td><span class="badge bg-success text-white">Delivered</span></td>
                                <td>2025-01-03</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Mark Wilson</td>
                                <td>$150</td>
                                <td><span class="badge bg-danger text-white">Cancelled</span></td>
                                <td>2025-01-05</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Sarah Connor</td>
                                <td>$400</td>
                                <td><span class="badge bg-success text-white">Delivered</span></td>
                                <td>2025-01-06</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Emily Davis</td>
                                <td>$250</td>
                                <td><span class="badge bg-warning text-dark">Pending</span></td>
                                <td>2025-01-07</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
