@extends('admin.layout.admin')
@section('title')
    <title>List Menu</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
    @include('admin.layout.content-header', ['name'=>'Menu', 'action' => 'List'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 p-2">
                        <a href="{{route('menus.create')}}" class="btn btn-primary float-right">Add Menu</a>
                    </div>
                    <div class="col-sm-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $menu)
                                <tr>
                                    <td>{{$menu->id}}</td>
                                    <td>{{$menu->name}}</td>
                                    <td>{{$menu->parent_id}}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{route('menus.edit', ['id'=>$menu->id])}}">Edit</a>
                                        <a class="btn btn-danger" href="{{route('menus.delete', ['id'=>$menu->id])}}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-12">
                        {{ $data->links() }}
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection