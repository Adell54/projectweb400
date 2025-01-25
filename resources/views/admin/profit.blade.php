@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Revenue Insights</h1>
    </div>

    <!-- Filter by Date Range -->
    <div class="card shadow-sm p-4 mb-4">
        <form method="GET" action="{{ route('admin.revenue') }}">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $startDate->toDateString()) }}">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $endDate->toDateString()) }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Revenue and Profit -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-6 border-end">
                    <h5 class="fw-bold">Total Revenue</h5>
                    <p class="text-success display-6">${{ number_format($totalRevenue, 2) }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold">Total Profit</h5>
                    <p class="text-success display-6">${{ number_format($totalProfit, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Status Overview -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold">Order Status Overview</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ordersByStatus as $status => $data)
                            <tr>
                                <td>{{ ucfirst($status) }}</td>
                                <td>{{ $data->count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Best-Selling Products -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="fw-bold">Best-Selling Products</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Total Sold</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bestSellingProducts as $item)
                            <tr>
                                <td>{{ $item->product_id }}</td>
                                <td>{{ $item->product->name }}</td> <!-- Ensure product relationship is loaded -->
                                <td>{{ $item->total_sold }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
