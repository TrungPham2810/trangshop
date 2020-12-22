@extends('admin.layout.admin')
@section('title')
    <title>List Slider</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('admins/slider/list/list.css')}}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
    @endif
    @include('admin.layout.content-header', ['name'=>'Slider', 'action' => 'List'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 p-2">
                        <a href="{{route('slider.create')}}" class="btn btn-primary float-right">Add Slider</a>
                    </div>
                    <div class="col-sm-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                            @foreach($data as $slider)
                                <tr>
                                    <td>{{$slider->id}}</td>
                                    <td><img class="small_image_product" style="" src="{{asset($slider->image_path)}}" alt="{{$slider->image_name}}"></td>
                                    <td>{{$slider->name}}</td>
                                    <td>{{$slider->description}}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{route('slider.edit', ['id'=>$slider->id])}}">Edit</a>
                                        <button class="btn btn-danger delete_slider" data-url="{{route('slider.delete', ['id'=>$slider->id])}}">Delete</button>
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
    <script src="{{asset('admins/slider/list/list.js')}}"></script>
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@10.js')}}"></script>
@endsection