@extends('admin.layout.admin')
@section('title')
    <title>Add Product</title>
@endsection
@section('css')
    <link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet" />
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.layout.content-header', ['name'=>'Product', 'action' => 'Add'])
        <!-- Main content -->
            <form method="POST" action="{{ route('product.store') }}">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 p-2">

                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" required name="product_name" id="" placeholder="Name Menu">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Price</label>
                                <input type="text" class="form-control" required name="product_price" id="" placeholder="Name Menu">
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
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Image</label>
                                <input type="file" class="form-control-file"  name="feature_image_path" id="" placeholder="Name Menu">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Gallery Image</label>
                                <input type="file" multiple class="form-control-file"  name="gallery_image[]" id="" placeholder="Name Menu">
                            </div>





                    </div>

                    <div class="col-sm-12">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Content</label>
                            <textarea rows="8" name="content" class="form-control tinymce_editor_int"></textarea>
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
    <script src="{{asset('admin/product/add/add.js')}}"></script>

@endsection