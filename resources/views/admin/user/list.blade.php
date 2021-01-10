@extends('admin.layout.admin')
@section('title')
    <title>List Users</title>
@endsection
@section('css')
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
    @endif
    @include('admin.layout.content-header', ['name'=>'User', 'action' => 'List'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 p-2">
                        <div class="dropdown show float-right mr-5">
                            <a href="{{route('user.create')}}" class="btn btn-primary float-right">Add User</a>
                        </div>
                        {{--<a href="{{route('config.create')}}" class="btn btn-primary float-right">Add Config</a>--}}
                    </div>
                    <div class="col-sm-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                @foreach($data as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td></td>
                                        <td>
                                            <a class="btn btn-info" href="{{route('user.edit', ['id'=>$user->id])}}">Edit</a>
                                            <button class="btn btn-danger delete_user" data-url="{{route('user.delete', ['id'=>$user->id])}}">Delete</button>
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
    <script src="{{asset('admins/user/list/list.js')}}"></script>
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@10.js')}}"></script>
@endsection