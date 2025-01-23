@extends('layouts.master')

@section('content')
<!-- check out section -->
<div class="checkout-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-accordion-wrap">
                    <div class="accordion" id="accordionExample">
                        <!-- Billing Address Accordion -->
                        <div class="card single-accordion">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Billing Address
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="billing-address-form">
                                        <h4 class="text-center">Please fill in your address and contact information:</h4>
                                        <form action="{{ route('placeOrder') }}" method="POST">
                                            @csrf
                                        
                                            <!-- Address and Phone Inputs -->
                                            <p><input type="text" name="location" placeholder="Address" value="{{ old('location') }}" required></p>
                                            <p><input type="tel" name="phone" placeholder="Phone" value="{{ old('phone') }}" required></p>
                                            
                                            <button type="submit" class="btn btn-primary">Place Order</button>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                   
                    
                    </div>
                </div>
            </div>

            <!-- Order Summary Section -->
            <div class="col-lg-4">
                <div class="order-details-wrap">
                    <table class="order-details">
                        <thead>
                            <tr>
                                <th>Your Order Details</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody class="order-details-body">
                            @foreach ($cartItems as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>${{ number_format($item->quantity * $item->product->price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tbody class="checkout-details">
                            <tr>
                                <td>Subtotal</td>
                                <td>${{ number_format($subtotal, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Shipping</td>
                                <td>${{ number_format($shippingCost, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>${{ number_format($totalPrice, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end check out section -->
@endsection
