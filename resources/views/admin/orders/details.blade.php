@extends('admin.layout')

@section('content')



<h5>Customer Information</h5>
<p><strong>Name:</strong> {{ $order->user->name }}</p>
<p><strong>Email:</strong> {{ $order->user->email }}</p>
<p><strong>Phone:</strong> {{ $order->phone }}</p>

<h5>Order Information</h5>
<p><strong>Order ID:</strong> #{{ $order->id }}</p>
<p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
<p><strong>Status:</strong> 
    <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'delivered' ? 'success' : 'info') }}">
        {{ ucfirst($order->status) }}
    </span>
</p>
<p><strong>Total:</strong> ${{ number_format($order->total_price, 2) }}</p>

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
    <tbody>
        @foreach ($products as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->price, 2) }}</td>
                <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection