@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-primary">Orders</h3>
               
            </div>

            <!-- Filter and Search -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form id="filterForm" method="GET" action="{{ route('admin.orders.index') }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <select class="form-select w-auto" name="status" id="orderStatusFilter" onchange="document.getElementById('filterForm').submit();">
                                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                </select>
                            </div>
                            <div class="input-group w-50">
                                <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Search by Order ID or Customer Name">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="orderTable">
                            @foreach ($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status_color }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>${{ $order->total }}</td>
                                    <td class="action-buttons">
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#orderDetailsModal" onclick="viewOrderDetails({{ $order->id }})">View</button>
                                        <button class="btn btn-secondary btn-sm" onclick="updateOrderStatus({{ $order->id }})">Update Status</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Order Details Modal -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="orderDetailsContent">
                <!-- Order details will be loaded dynamically -->
            </div>
        </div>
    </div>
</div>

<script>
    function viewOrderDetails(orderId) {
        // Fetch and display order details dynamically using AJAX
        $.ajax({
            url: `/admin/orders/${orderId}`,
            method: 'GET',
            success: function (data) {
                $('#orderDetailsContent').html(data);
            }
        });
    }

    function updateOrderStatus(orderId) {
        // Update order status dynamically (AJAX or redirect to a status update page)
        window.location.href = `/admin/orders/${orderId}/edit`;
    }
</script>
@endsection
