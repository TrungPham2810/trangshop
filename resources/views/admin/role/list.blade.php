@extends('admin.layout.admin')
@section('title')
    <title>List Roles</title>
@endsection
@section('css')
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
    @endif
    @include('admin.layout.content-header', ['name'=>'Roles', 'action' => 'List'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 p-2">
                        <div class="dropdown show float-right mr-5">
                            <a href="{{route('role.create')}}" class="btn btn-primary float-right">Add Role</a>
                        </div>
                        {{--<a href="{{route('config.create')}}" class="btn btn-primary float-right">Add Config</a>--}}
                    </div>
                    <div class="col-sm-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                @foreach($data as $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->display_name}}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{route('role.edit', ['id'=>$role->id])}}">Edit</a>
                                            <button class="btn btn-danger delete_role" data-url="{{route('role.delete', ['id'=>$role->id])}}">Delete</button>
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
    <script src="{{asset('admins/role/list/list.js')}}"></script>
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@10.js')}}"></script>
@endsection