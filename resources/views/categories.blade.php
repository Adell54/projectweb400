@extends('layouts.master')
@section('content')
    <style>
        
        .card {
            border: 1px solid #ddd; 
            border-radius: 10px; 
            overflow: hidden;
            transition: all 0.3s ease; 
        }

       
        .card:hover {
            border-color: orange; 
            transform: scale(1.05); 
            background: linear-gradient(to bottom, #fff, #fdf2e9);
        }

        
        .card img {
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid #ddd; 
        }

       
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
        }

        
        .card-text {
            font-size: 0.9rem;
            color: #555;
        }

        
        .card-body {
            padding: 15px;
        }
    </style>

    <!-- Categories section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3>Our Product Categories</h3>
                        <p>Discover a world of cutting-edge technology and smart solutions across laptops, smartphones, gaming consoles, home appliances, and more – designed to elevate your digital lifestyle.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($categories as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <a href="products?category={{$item->id}}" class="text-decoration-none">
                            <div class="card text-center shadow-sm h-100 d-flex flex-column">
                                <img src="data:image/jpeg;base64,{{ $item->image }}" alt="{{ $item->name }}" class="card-img-top img-fluid">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $item->name }}</h5>
                                    <p class="card-text text-muted">{{ $item->description }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End categories section -->
@endsection
