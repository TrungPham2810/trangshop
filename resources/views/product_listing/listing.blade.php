@extends('layouts.master')

@section('title')
    <title>Product Listing | Trang Shop</title>
@endsection

@section('content')
    @include('components.header')
    <section>
        <div class="container">
            <div class="row">
                @include('home.components.sidebar')
                <div class="col-sm-9 padding-right">
                    @include('product_listing.components.feature_product')

                </div>
            </div>
        </div>
    </section>
    @include('components.footer')
@endsection
