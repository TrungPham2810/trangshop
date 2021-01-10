@extends('admin.layout.admin')
@section('title')
    <title>Add Role</title>
@endsection
@section('css')
    <link href="{{asset('admins/role/add/add.css')}}" rel="stylesheet" />
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.layout.content-header', ['name'=>'Role', 'action' => 'Add'])
        <!-- Main content -->
            <form method="POST" action="{{ route('role.store') }}"  enctype="multipart/form-data">
                @csrf
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 p-2">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" required class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" name="name" placeholder="Name">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Display Name</label>
                            <input type="text" required class="form-control @error('display_name') is-invalid @enderror" value="{{old('display_name')}}" name="display_name" placeholder="Display Name">
                            @error('display_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="card mb-3 col-md-12">
                        <div class="card-header">
                            <h4>
                                <label>
                                    <input
                                            name="permission[]"
                                            value=""
                                            class="check_all"
                                            type="checkbox">
                                    Check All
                                </label>
                            </h4>

                        </div>
                    </div>
                    @foreach($permission as $item)
                    <div class="col-sm-12 show_list_permission">
                        <div class="row">

                            <div class="card mb-3 col-md-12">
                                <div class="card-header">
                                    <h4>
                                        <label>
                                            <input class="checkbox_wrapper" type="checkbox">
                                            {{$item->display_name}}
                                        </label>
                                    </h4>

                                </div>
                                <div class="row">
                                    @foreach($item->permissionsChildrent as $itemChild)
                                        <div class="card-body col-md-3">
                                            <div class="card-title">
                                                <label ><input type="checkbox" class="checkbox_child" value="{{$itemChild->id}}" name="permission[]">{{$itemChild->display_name}}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>

                    </div>
                    @endforeach
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
    <script src="{{asset('admins/role/add/add.js')}}"></script>
@endsection