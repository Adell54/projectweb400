@extends('layouts.master')
@section('content')
    <style>
        /* Category Filters */
        .product-filters ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .product-filters ul li {
            margin: 0;
        }

        .product-filters ul li a {
            display: inline-block;
            padding: 10px 20px;
            border: 2px solid #F28123;
            ;
            border-radius: 25px;
            background-color: transparent;
            color: black;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .product-filters ul li a:hover {
            background-color: #F28123;
            ;
            color: white;
        }

        .product-filters ul li.active a {
            background-color: #F28123;
            ;
            color: white;
        }

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

        /* Search Bar */
        .search-bar-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .search-bar-wrapper .input-group {
            width: 50%;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .search-bar-wrapper .form-control {
            border-top-left-radius: 25px;
            border-bottom-left-radius: 25px;
            border: 2px solid #ddd;
        }

        .search-bar-wrapper .btn {
            border-top-right-radius: 25px;
            border-bottom-right-radius: 25px;
            background-color: #F28123;
            ;
            border: 2px solid #F28123;
            ;
            color: white;
        }


        .search-bar-wrapper .btn:hover {
            background-color: darkorange;
            border-color: darkorange;
        }
    </style>

    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">

            <!-- Search Bar -->
            <div class="search-bar-wrapper">
                <form method="GET" action="{{ route('products.index') }}" class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search for products..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Product Filters -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
                            <li class="{{ request('category') ? '' : 'active' }}">
                                <a href="{{ route('products.index') }}">All</a>
                            </li>
                            @foreach ($categories as $category)
                                <li class="{{ request('category') == $category->id ? 'active' : '' }}">
                                    <a
                                        href="{{ route('products.index', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Product List -->
            <div class="row product-lists">
                @foreach ($products as $product)
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

            <!-- Pagination -->

            <div>
                {{ $products->links() }}
            </div>


        </div>

            <!-- end products -->
        @endsection
