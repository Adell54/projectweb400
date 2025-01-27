@extends('layouts.master')

@section('content')
<div class="container mt-80 mb-80">
    <h2 >My Orders</h2>

    <!-- Display Success or Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Current Orders Section -->
    <div class="mt-8- mb-80">
        <h4 >Current Orders</h4>
        @php
            $currentOrders = $orders->filter(fn($order) => $order->status == 'pending');
        @endphp
        @if($currentOrders->isNotEmpty())
            @foreach($currentOrders as $order)
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Order Summary -->
                            <div>
                                <h6 class="mb-1">Order ID: <span class="text-primary">#{{ $order->id }}</span></h6>
                                <p class="mb-1"><strong>Status:</strong> 
                                    <span class="badge bg-warning">{{ ucfirst($order->status) }}</span>
                                </p>
                                <p class="mb-1"><strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
                                <p class="mb-1"><strong>Total:</strong> ${{ number_format($order->total_price + 3, 2) }}</p>
                            </div>
                            <!-- Cancel Button -->
                            <form action="{{ route('user.orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger btn-sm">Cancel Order</button>
                            </form>
                        </div>
                        <!-- Order Items -->
                        <div class="mt-3">
                            <h6>Items</h6>
                            <ul class="list-group list-group-flush">
                                @foreach($order->items as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
                                        <span>${{ number_format($item->price, 2) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-muted">You have no current orders.</p>
        @endif
    </div>

    <!-- Completed Orders Section -->
    <div class="mb-5">
        <h4 class="text-success">Completed Orders</h4>
        @php
            $completedOrders = $orders->filter(fn($order) => $order->status == 'delivered');
        @endphp
        @if($completedOrders->isNotEmpty())
            @foreach($completedOrders as $order)
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Order Summary -->
                            <div>
                                <h6 class="mb-1">Order ID: <span class="text-primary">#{{ $order->id }}</span></h6>
                                <p class="mb-1"><strong>Status:</strong> 
                                    <span class="badge bg-success">{{ ucfirst($order->status) }}</span>
                                </p>
                                <p class="mb-1"><strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
                                <p class="mb-1"><strong>Total:</strong> ${{ number_format($order->total_price + 3, 2) }}</p>
                            </div>
                        </div>
                        <!-- Order Items -->
                        <div class="mt-3">
                            <h6>Items</h6>
                            <ul class="list-group list-group-flush">
                                @foreach($order->items as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
                                        <span>${{ number_format($item->price, 2) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-muted">You have no completed orders.</p>
        @endif
    </div>

    <!-- Canceled Orders Section -->
    <div>
        <h4 class="text-danger">Canceled Orders</h4>
        @php
            $canceledOrders = $orders->filter(fn($order) => $order->status == 'canceled');
        @endphp
        @if($canceledOrders->isNotEmpty())
            @foreach($canceledOrders as $order)
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Order Summary -->
                            <div>
                                <h6 class="mb-1">Order ID: <span class="text-primary">#{{ $order->id }}</span></h6>
                                <p class="mb-1"><strong>Status:</strong> 
                                    <span class="badge bg-danger">{{ ucfirst($order->status) }}</span>
                                </p>
                                <p class="mb-1"><strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
                                <p class="mb-1"><strong>Total:</strong> ${{ number_format($order->total_price + 3, 2) }}</p>
                            </div>
                        </div>
                        <!-- Order Items -->
                        <div class="mt-3">
                            <h6>Items</h6>
                            <ul class="list-group list-group-flush">
                                @foreach($order->items as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
                                        <span>${{ number_format($item->price, 2) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-muted">You have no canceled orders.</p>
        @endif
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links('components.pagination') }}
    </div>
</div>
@endsection
