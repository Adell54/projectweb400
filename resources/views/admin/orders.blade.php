@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-primary">Orders</h3>
                <a href="{{ url('/admin/addorder') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Add Order
                </a>
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
                            <!-- Example Orders -->
                            <tr>
                                <td>#101</td>
                                <td>John Doe</td>
                                <td>Jan 8, 2025</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>$120.50</td>
                                <td class="action-buttons">
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#orderDetailsModal" onclick="viewOrderDetails('#101')">View</button>
                                    <button class="btn btn-secondary btn-sm" onclick="updateOrderStatus('#101')">Update Status</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#102</td>
                                <td>Jane Smith</td>
                                <td>Jan 7, 2025</td>
                                <td><span class="badge bg-success">Delivered</span></td>
                                <td>$45.99</td>
                                <td class="action-buttons">
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#orderDetailsModal" onclick="viewOrderDetails('#102')">View</button>
                                    <button class="btn btn-secondary btn-sm" onclick="updateOrderStatus('#102')">Update Status</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#103</td>
                                <td>Mark Brown</td>
                                <td>Jan 5, 2025</td>
                                <td><span class="badge bg-danger">Canceled</span></td>
                                <td>$0.00</td>
                                <td class="action-buttons">
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#orderDetailsModal" onclick="viewOrderDetails('#103')">View</button>
                                    <button class="btn btn-secondary btn-sm" onclick="updateOrderStatus('#103')">Update Status</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
            <div class="modal-body">
                <!-- Customer Info -->
                <h5>Customer Information</h5>
                <p><strong>Name:</strong> <span id="customerName">John Doe</span></p>
                <p><strong>Email:</strong> <span id="customerEmail">john.doe@example.com</span></p>
                <p><strong>Phone:</strong> <span id="customerPhone">+1 234 567 8901</span></p>

                <!-- Order Info -->
                <h5>Order Information</h5>
                <p><strong>Order ID:</strong> <span id="orderId">#101</span></p>
                <p><strong>Order Date:</strong> <span id="orderDate">Jan 8, 2025</span></p>
                <p><strong>Status:</strong> <span id="orderStatus" class="badge bg-warning">Pending</span></p>
                <p><strong>Total:</strong> <span id="orderTotal">$120.50</span></p>

                <!-- Products in Order -->
                <h5>Products</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="orderProducts">
                        <tr>
                            <td>Product A</td>
                            <td>2</td>
                            <td>$50.00</td>
                            <td>$100.00</td>
                        </tr>
                        <tr>
                            <td>Product B</td>
                            <td>1</td>
                            <td>$20.50</td>
                            <td>$20.50</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

<script>
    function viewOrderDetails(orderId) {
        // Add code to fetch and display order details based on orderId
    }

    function updateOrderStatus(orderId) {
        // Add code to update order status based on orderId
    }
</script>
@endsection
