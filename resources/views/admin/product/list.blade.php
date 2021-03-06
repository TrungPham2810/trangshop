@extends('admin.layout.admin')
@section('title')
    <title>List Product</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('admins/product/list/list.css')}}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
    @endif
    @include('admin.layout.content-header', ['name'=>'Product', 'action' => 'List'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 p-2">
                        <a href="{{route('product.create')}}" class="btn btn-primary float-right">Add Product</a>
                    </div>
                    <div class="col-sm-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                            @foreach($data as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td><img class="small_image_product" style="" src="{{asset($product->feature_image_path)}}" alt="{{$product->feature_image_name}}"></td>
                                    <td>{{$product->name}}</td>
                                    <td>{{number_format($product->price)}}</td>
                                    <td>{{optional($product->category)->name}}</td>
                                    
                                    <td>
                                        <a class="btn btn-info" href="{{route('product.edit', ['id'=>$product->id])}}">Edit</a>
                                        <button class="btn btn-danger delete_product" data-url="{{route('product.delete', ['id'=>$product->id])}}">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-12">

                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <script src="{{asset('admins/product/list/list.js')}}"></script>
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@10.js')}}"></script>
@endsection