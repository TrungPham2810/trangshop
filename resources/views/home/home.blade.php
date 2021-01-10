
@extends('layouts.master')

@section('title')
    <title>Home | Trang Shop</title>
@endsection

@section('content')
@include('components.header')
@include('home.components.slider')
    <section>
        <div class="container">
            <div class="row">
                @include('home.components.sidebar')
                <div class="col-sm-9 padding-right">
                    <!--features_items-->
                    @include('home.components.feature_product')
                    <!--features_items-->

                    <!--category-tab-->
                    @include('home.components.category_tab')
                    <!--/category-tab-->

                    <!--/recommended_items-->
                    @include('home.components.recommended_product')
                    <!--/recommended_items-->

                </div>
            </div>
        </div>
    </section>
@include('components.footer')
@endsection
