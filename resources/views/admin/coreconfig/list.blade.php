@extends('admin.layout.admin')
@section('title')
    <title>List Core Config</title>
@endsection
@section('css')
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
    @endif
    @include('admin.layout.content-header', ['name'=>'Config', 'action' => 'List'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 p-2">
                        <div class="dropdown show float-right mr-5">
                            <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Add Config
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{route('config.create').'?type=Text'}}">Text</a>
                                <a class="dropdown-item" href="{{route('config.create').'?type=Textarea'}}">Textarea</a>
                            </div>
                        </div>
                        {{--<a href="{{route('config.create')}}" class="btn btn-primary float-right">Add Config</a>--}}
                    </div>
                    <div class="col-sm-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Key</th>
                                <th>value</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                @foreach($data as $config)
                                    <tr>
                                        <td>{{$config->id}}</td>
                                        <td>{{$config->config_key}}</td>
                                        <td>{{$config->config_value}}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{route('config.edit', ['id'=>$config->id])}}">Edit</a>
                                            <button class="btn btn-danger delete_config" data-url="{{route('config.delete', ['id'=>$config->id])}}">Delete</button>
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
    <script src="{{asset('admins/coreconfig/list/list.js')}}"></script>
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@10.js')}}"></script>
@endsection