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
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <select class="form-select w-auto" id="orderStatusFilter">
                                <option value="all">All</option>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="shipped">Shipped</option>
                                <option value="delivered">Delivered</option>
                                <option value="canceled">Canceled</option>
                            </select>
                        </div>
                        <div class="input-group w-50">
                            <input type="text" class="form-control" id="searchOrders" placeholder="Search by Order ID or Customer Name">
                            <button class="btn btn-primary">Search</button>
                        </div>
                    </div>
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
                                
                            
                            <!-- Example Orders -->
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->user->name}}</td>
                                <td>{{$order->created_at}}</td>
                                <td><span class="badge bg-warning">{{$order->status}}</span></td>
                                <td>{{$order->total_price}}$</td>
                                <td class="action-buttons">
                                    <button class="btn btn-info btn-sm"   onclick="viewOrderDetails({{$order->id}})">View</button>
                                    <button class="btn btn-secondary btn-sm" onclick="">Update Status</button>
                                </td>
                            </tr>
                            @endforeach
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Bootstrap and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>


<script>
    function viewOrderDetails(id) {
        // Navigate to your route to view order details
        window.location.href = `/admin/orders/details/${id}`;
    }
    </script>
    





@endsection