@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-primary">Orders</h3>
                <div>
                    <span class="badge bg-warning">Pending: {{ $pendingCount }}</span>
                    <span class="badge bg-success">Delivered: {{ $deliveredCount }}</span>
                    <span class="badge bg-danger">Canceled: {{ $canceledCount }}</span>
                </div>
            </div>

            <!-- Filter and Search -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <select class="form-select w-auto" id="orderStatusFilter" onchange="filterOrders()">
                                <option value="all">All</option>
                                <option value="pending">Pending</option>
                                <option value="delivered">Delivered</option>
                                <option value="canceled">Canceled</option>
                            </select>
                        </div>
                        <div class="input-group w-50">
                            <input type="text" class="form-control" id="searchOrders" placeholder="Search by Customer Name" onkeyup="searchOrders()">
                            <button class="btn btn-primary" onclick="searchOrders()">Search</button>
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
                                <th onclick="sortTable(0)">Order ID</th>
                                <th onclick="sortTable(1)">Customer</th>
                                <th onclick="sortTable(2)">Order Date</th>
                                <th onclick="sortTable(3)">Status</th>
                                <th onclick="sortTable(4)">Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="orderTable">
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td><span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'delivered' ? 'success' : 'danger') }}">{{ ucfirst($order->status) }}</span></td>
                                <td>${{ number_format($order->total_price + 3, 2) }}</td>
                                <td class="action-buttons">
                                    <button class="btn btn-info btn-sm" onclick="viewOrderDetails({{ $order->id }})">View</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div>
        {{ $orders->links('components.pagination') }}
    </div>
</div>

<script>
    function filterOrders() {
        var filter = document.getElementById("orderStatusFilter").value;
        var rows = document.getElementById("orderTable").getElementsByTagName("tr");
        for (var i = 0; i < rows.length; i++) {
            var status = rows[i].getElementsByTagName("td")[3].innerText.toLowerCase();
            if (filter === "all" || status === filter) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    function searchOrders() {
        var input = document.getElementById("searchOrders").value.toLowerCase();
        var rows = document.getElementById("orderTable").getElementsByTagName("tr");
        for (var i = 0; i < rows.length; i++) {
            var customer = rows[i].getElementsByTagName("td")[1].innerText.toLowerCase();
            if (customer.includes(input)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    function sortTable(n) {
        var table = document.getElementById("orderTable");
        var rows = Array.from(table.getElementsByTagName("tr"));
        var sortedRows = rows.sort(function(a, b) {
            var x = a.getElementsByTagName("td")[n].innerText.toLowerCase();
            var y = b.getElementsByTagName("td")[n].innerText.toLowerCase();
            return x.localeCompare(y);
        });
        for (var i = 0; i < sortedRows.length; i++) {
            table.appendChild(sortedRows[i]);
        }
    }

    function viewOrderDetails(id) {
        window.location.href = `/admin/orders/details/${id}`;
    }
</script>

@endsection
