@extends('admin.layout')

@section('content')

<h5>Customer Information</h5>
<p><strong>Name:</strong> {{ $order->user->name }}</p>
<p><strong>Email:</strong> {{ $order->user->email }}</p>
<p><strong>Phone:</strong> {{ $order->phone }}</p>
<p><strong>Address:</strong> {{ $order->location }}</p>

<h5>Order Information</h5>
<p><strong>Order ID:</strong> #{{ $order->id }}</p>
<p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
<p><strong>Status:</strong> 
    <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'delivered' ? 'success' : 'info') }}">
        {{ ucfirst($order->status) }}
    </span>
</p>

<h5>Change Order Status</h5>
@foreach(['pending', 'delivered', 'canceled'] as $status)
    @if($order->status !== $status)
        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to change the order status to {{ $status }}?');">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="{{ $status }}">
            <button type="submit" class="btn btn-{{ $status == 'pending' ? 'warning' : ($status == 'delivered' ? 'success' : 'danger') }}">
                {{ ucfirst($status) }}
            </button>
        </form>
    @endif
@endforeach

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
        @foreach ($orderItems as $orderItem)
            @php
                $product = $products->find($orderItem->product_id);
            @endphp
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $orderItem->quantity }}</td>
                <td>${{ number_format($product->price, 2) }}</td>
                <td>${{ number_format($orderItem->quantity * $product->price, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" class="text-end"><strong>Delivery Charge:</strong></td>
            <td>${{ number_format(3, 2) }}</td>
        </tr>
        <tr>
            <td colspan="3" class="text-end"><strong>Total:</strong></td>
            <td>${{ number_format($order->total_price + 3, 2) }}</td>
        </tr>
    </tfoot>
</table>

@endsection
