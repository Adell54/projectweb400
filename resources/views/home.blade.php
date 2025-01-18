@extends('layouts.master')
@section('content')

<style>
    /* Hero Section */
    .hero-section {
        background-color: #f9f9f9;
        color: black;
        padding: 60px 0;
        text-align: center;
    }

    .hero-section h1 {
        font-size: 48px;
        margin-bottom: 20px;
    }

    .hero-section p {
        font-size: 18px;
        margin-bottom: 30px;
    }

    .hero-section a {
        background-color:#F28123;
        color: white;
        padding: 15px 30px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .hero-section a:hover {
        background-color: #F28123;
    }

    /* Features Section */
    .list-section {
        background-color: #f9f9f9;
        padding: 60px 0;
    }

    .list-box {
        
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        transition: box-shadow 0.3s ease;
    }

    

    .list-box .list-icon {
        font-size: 48px;
        margin-bottom: 20px;
        color: orange;
    }

    /* Product Section */
    .product-section {
        padding: 80px 0;
    }

    .single-product-item {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        background-color: #fff;
        transition: box-shadow 0.3s ease;
        height: 100%;
    }

    .single-product-item:hover {
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }

    .product-image img {
        width: 100%;
        max-width: 200px;
        max-height: 200px;
        object-fit: cover;
        border-radius: 10px;
    }

    .cart-btn {
        margin-top: 15px;
        background-color: orange;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .cart-btn:hover {
        background-color: #F28123;
    }
</style>


<!-- Features List Section -->
<div class="list-section pt-60 pb-25">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="list-box d-flex align-items-center">
                    <div class="list-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <div class="content">
                        <h3>Free Shipping</h3>
                        <p>When order over $75</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="list-box d-flex align-items-center">
                    <div class="list-icon">
                        <i class="fas fa-phone-volume"></i>
                    </div>
                    <div class="content">
                        <h3>24/7 Support</h3>
                        <p>Get support all day</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="list-box d-flex justify-content-start align-items-center">
                    <div class="list-icon">
                        <i class="fas fa-sync"></i>
                    </div>
                    <div class="content">
                        <h3>Refund</h3>
                        <p>Get refund within 3 days!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<!-- Hero Section -->
<div class="hero-section">
    <div class="content">
        <h1>Welcome to Our Store</h1>
        <p>Your one-stop destination for the best products at unbeatable prices.</p>
        <a href="#products">Shop Now</a>
    </div>
</div>



<!-- Product Section -->
<div id="products" class="product-section mt-80 mb-80">
	
    <div class="container">
        <h3 class="text-center mb-10">Explore Our Latest Products</h3>
        <div class="row product-lists">
            @foreach ($products->random(6) as $product)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="single-product-item">
                        <div class="product-image">
                            <a href="{{ route('products.show', $product->id) }}">
                                <img src="data:image/jpeg;base64,{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid">
                            </a>
                        </div>
                        <h3>{{ $product->name }}</h3>
                        <p class="product-price"><span>{{ $categoryMap[$product->category_id] ?? 'Unknown' }}</span> ${{ $product->price }}</p>
                        <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
