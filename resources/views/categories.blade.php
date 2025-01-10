@extends('layouts.master')
@section('content')
    <!-- Categories section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3>Our Product Categories </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet
                            beatae optio.</p>
                    </div>
                </div>
            </div>

            <div class="row product-lists">


               
                    @foreach ($categories as $item)
                        <div class="col-lg-4 col-md-6 text-center3 ">
                            <div class="product-image">


                                <img src="data:image/jpeg;base64,{{ $item->image }}" alt="{{ $item->name }}">


                            </div>
                            <h3>{{ $item->name }}</h3>
                            <h6>{{ $item->description }}</h6>
                    @endforeach

                       

                       





            </div>
        </div>
    </div>
    </div>
    <!-- end product section -->
@endsection
