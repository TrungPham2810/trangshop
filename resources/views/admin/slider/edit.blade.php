@extends('admin.layout.admin')
@section('title')
    <title>Edit Slider</title>
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

        <form method="POST" action="{{ route('slider.update', ['id'=>$slider->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 p-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{$slider->name}}" name="name" id="" placeholder="Name Slider">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <textarea rows="3" name="description" class="form-control tinymce_editor_int @error('description') is-invalid @enderror">{{$slider->description}}</textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Image</label>
                                <input type="file" class="form-control-file"  name="image" id="" placeholder="Name Menu">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <img class="main_image_product" src="{{asset($slider->image_path)}}" alt="{{asset($slider->image_name)}}">
                                    </div>
                                </div>
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
@endsection