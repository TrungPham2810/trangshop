@extends('admin.layout.admin')
@section('title')
    <title>Edit Category</title>
@endsection
@section('css')
    <link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('admins/product/edit/edit.css')}}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('admin.layout.content-header', ['name'=>'Slider', 'action' => 'Edit'])
    <!-- Main content -->

        <form method="POST" action="{{ route('product.update', ['id'=>$product->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 p-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" value="{{$product->name}}" required name="product_name" id="" placeholder="Name Menu">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Price</label>
                                <input type="number" class="form-control" value="{{$product->price}}"  required name="product_price" id="" placeholder="Name Menu">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Category</label>
                                <select class="form-control select2_init" id="exampleFormControlSelect1" name="category" required>
                                    <option value="0">Please Select Category...</option>
                                    {!! $htmlSelect !!}
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tags</label>
                                <select class="form-control tags_select" name="tags[]" multiple="multiple">
                                    @foreach($product->tags as $tag)
                                        <option value="{{$tag->name}}" selected>{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Image</label>
                                <input type="file" class="form-control-file"  name="feature_image_path" id="" placeholder="Name Menu">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <img class="main_image_product" src="{{asset($product->feature_image_path)}}" alt="{{asset($product->feature_image_name)}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Gallery Image</label>
                                <input type="file" multiple class="form-control-file"  name="gallery_image[]" id="" placeholder="Name Menu">

                                <div class="col-sm-12">
                                    <div class="row">
                                        @foreach($product->images as $productImage)
                                            <div>
                                                <img class="gallery_image_product" src="{{asset($productImage->image_path)}}" alt="{{asset($productImage->image_name)}}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Content</label>
                                <textarea rows="8" name="contents" class="form-control tinymce_editor_int">{{$product->content}}</textarea>
                            </div>
                        </div>

                        <div class="col-sm-12">

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

        </form>

        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js')

    <script src="{{asset('vendor/select2/select2.min.js')}}"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="{{asset('admins/product/add/add.js')}}"></script>

@endsection