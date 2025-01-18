@extends('layouts.master')
@section('content')


<!-- single product -->
<div class="single-product mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="single-product-img">
                    <img src="data:image/jpeg;base64,{{ $product->image }}" alt="{{ $product->name }}">
                </div>
            </div>
            <div class="col-md-7">
                <div class="single-product-content">
                    <h3>{{ $product->name }}</h3>
                    <p><strong>Category: </strong>{{ $categoryMap[$product->category_id] ?? 'Unknown' }}</p>
                    <p class="single-product-pricing">$ {{ $product->price }}</p>
                    <p>{{ $product->description }}</p>
                    <div class="single-product-form">
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <label for="quantity">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" required>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                       
                            <button type="submit" class="cart-btn">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end single product -->




<!-- more products -->
<div class="more-products mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">Related</span> Products</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($products->where('category_id', $product->category_id)->take(3) as $relatedProduct)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="single-product-item">
                    <div class="product-image">
                        <a href="{{route('products.show',$relatedProduct->id)}}">
                            <img src="data:image/jpeg;base64,{{ $relatedProduct->image }}" alt="{{ $relatedProduct->name }}" class="img-fluid">
                        </a>
                    </div>
                    <h3>{{ $relatedProduct->name }}</h3>
                    <p class="product-price">
                        <span>{{ $categoryMap[$relatedProduct->category_id] ?? 'Unknown' }}</span> ${{ $relatedProduct->price }}
                    </p>
                    <a href="cart.html" class="cart-btn">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- end more products -->

@endsection
