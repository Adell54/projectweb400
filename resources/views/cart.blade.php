@extends('layouts.master')
@section('content')

<!-- cart -->
<div class="cart-section mt-150 mb-150">
  
    <div class="container">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        <div class="row">
            
            <div class="col-lg-8 col-md-12">
            
                <div class="cart-table-wrap">
                    <table class="cart-table">
                        <thead class="cart-table-head">
                            <tr class="table-head-row">
                                <th class="product-remove"></th>
                                <th class="product-image">Product Image</th>
                                <th class="product-name">Name</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-total">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($cart && $cartItems->count() > 0)
                                @foreach($cartItems as $item)
                                <tr class="table-body-row">
                                    <td class="product-remove">
                                        <form action="{{ route('cart.remove', $item->id ) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background:none; border:none; color:#337ab7; cursor:pointer;">
                                                <i class="far fa-window-close"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="product-image">
                                        @if($item->product)
                                            <img src="data:image/jpeg;base64,{{ $item->product->image }}" alt="{{ $item->product->name }}">
                                        @else
                                            <img src="path/to/default-image.jpg" alt="Product image not available">
                                        @endif
                                    </td>
                                    <td class="product-name">{{ $item->product->name ?? 'Unknown Product' }}</td>
                                    <td class="product-price">${{ number_format($item->product->price ?? 0, 2) }}</td>
                                    <td class="product-quantity">{{ $item->quantity }}</td>
                                    <td class="product-total">
                                        ${{ number_format(($item->quantity * ($item->product->price ?? 0)), 2) }}
                                    </td>
                                </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="6" class="text-center">Your cart is empty.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="total-section">
                    <table class="total-table">
                        <thead class="total-table-head">
                            <tr class="table-total-row">
                                <th>Total</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="total-data">
                                <td><strong>Subtotal: </strong></td>
                                <td>${{ number_format($cartItems->sum(fn($item) => $item->quantity * $item->product->price), 2) }}</td>
                            </tr>
                            <tr class="total-data">
                                <td><strong>Shipping: </strong></td>
                                <td>$5.00</td>
                            </tr>
                            <tr class="total-data">
                                <td><strong>Total: </strong></td>
                                <td>${{ number_format($cartItems->sum(fn($item) => $item->quantity * $item->product->price) + 5, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="cart-buttons">
                        <a href="{{route('checkout')}}" class="boxed-btn black">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end cart -->

@endsection
