@extends('layouts.master')
@section('content')
<style>
    /* Filters Section */
    .filters-section {
        margin-bottom: 30px;
        text-align: center;
    }

    .filters-section .product-filters {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .filters-section .product-filters a {
        padding: 10px 15px;
        border: 2px solid #F28123;
        border-radius: 25px;
        background-color: transparent;
        color: black;
        font-size: 14px;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .filters-section .product-filters a:hover,
    .filters-section .product-filters a.active {
        background-color: #F28123;
        color: white;
    }

    /* Price Filter */
    .price-filter-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .price-filter input {
        width: 100px;
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }

    .price-filter button {
        padding: 5px 15px;
        background-color: #F28123;
        color: white;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    .price-filter button:hover {
        background-color: darkorange;
    }
    .product-name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 200px; /* You can adjust this value as needed */
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

    .single-product-item h3 {
        font-size: 16px;
        font-weight: bold;
        margin: 10px 0;
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100%;
    }

    .cart-btn {
        margin-top: 15px;
        background-color: #F28123;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .cart-btn:hover {
        background-color: darkorange;
    }
</style>

<div class="product-section mt-150 mb-150">
    <div class="container">

        <!-- Search Bar -->
        <div class="search-bar-wrapper mb-4">
            <form method="GET" action="{{ route('products.index') }}" class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search for products..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Filters Section -->
        <div class="filters-section">
            <!-- Category Filters -->
            <div class="product-filters">
                <a href="{{ route('products.index') }}" class="{{ request('category') ? '' : 'active' }}">All</a>
                @foreach ($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->id]) }}"
                        class="{{ request('category') == $category->id ? 'active' : '' }}">{{ $category->name }}</a>
                @endforeach
            </div>

            <!-- Price Filter -->
            <div class="price-filter-wrapper">
                <form method="GET" action="{{ route('products.index') }}" class="price-filter">
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    <input type="text" name="search" value="{{ request('search') }}" hidden>
                    <input type="number" name="min_price" placeholder="Min Price" value="{{ request('min_price') }}">
                    <input type="number" name="max_price" placeholder="Max Price" value="{{ request('max_price') }}">
                    <button type="submit">Filter</button>
                </form>
            </div>
        </div>

        <!-- Product List -->
        <div class="row product-lists">
            @foreach ($products as $product)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="single-product-item">
                        <div class="product-image">
                            <a href="{{ route('products.show', $product->id) }}">
                                <img src="data:image/jpeg;base64,{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid">
                            </a>
                        </div>
                        <h3 class="product-name">{{ $product->name }}</h3>
                        <p class="product-price">
                            <span>{{ $categoryMap[$product->category_id] ?? 'Unknown' }}</span> ${{ number_format($product->price,1) }}
                        </p>
                        <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form d-inline">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            @if (Auth::check())
                                <button type="submit" class="cart-btn">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                            @else
                                <button type="button" class="cart-btn" onclick="showLogin()">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div>
            {{ $products->links('components.pagination') }}
        </div>
    </div>
</div>

<script>
    function showLogin() {
        window.location.href='/login';
    }
</script>
@endsection
