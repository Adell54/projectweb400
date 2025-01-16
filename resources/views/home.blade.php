



@extends('layouts.master')
@section('content')
<style>
	  /* Product Cards */
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
            /* Ensures cards are of equal height */
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
            ;
        }
	</style>


	<!-- features list section -->
	<div class="list-section pt-80 pb-25">
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
	<!-- end features list section -->

	<div class="mt-150 mb-150">

<h3 class="text-center ">A collection of products </h3>

	</div>

	<!-- product section -->
	<div class="mt-100 mb-100">
		<div class="row product-lists">
			@foreach ($products->slice(0, 6) as $product)
				<div class="col-lg-4 col-md-6 mb-4">
					<div class="single-product-item">
						<div class="product-image">
							<a href="singleproduct">
								<img src="data:image/jpeg;base64,{{ $product->image }}" alt="{{ $product->name }}"
									class="img-fluid">
							</a>
						</div>
						<h3>{{ $product->name }}</h3>
						<p class="product-price"><span>{{ $categoryMap[$product->category_id] ?? 'Unknown' }}</span>
							${{ $product->price }}</p>
						<a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
					</div>
				</div>
			@endforeach
		</div>
	</div>
	
	
	<!-- end product section -->

	
	
