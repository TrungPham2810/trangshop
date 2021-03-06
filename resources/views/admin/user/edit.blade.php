@extends('admin.layout.admin')
@section('title')
    <title>Edit User</title>
@endsection
@section('css')
    <link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet" />
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('admin.layout.content-header', ['name'=>'User', 'action' => 'Edit'])
    <!-- Main content -->

        <form method="POST" action="{{ route('user.update', ['id'=>$user->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 p-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" required class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}" name="name" placeholder="Name Slider">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" required class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}" name="email" placeholder="Email">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" id="password" class="form-control" name="password" placeholder="Password">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">New Password</label>
                                <input type="password" id="new_password" class="form-control" name="new_password" placeholder="Password">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Confirm Password</label>
                                <input type="password" id="confirm_password" class="form-control" placeholder="Confirm Password">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">User Role</label>
                                <select class="form-control roles_select" id="roles" multiple="multiple" name="roles[]">
                                    @foreach($roles as $role)
                                        <option {{$currentRoles->contains('id', $role->id)? 'selected': ''}}
                                                value="{{$role->id}}">{{$role->display_name}}</option>
                                    @endforeach
                                </select>
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
    <script src="{{asset('admins/user/edit/edit.js')}}"></script>
@endsection