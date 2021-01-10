@extends('admin.layout.admin')
@section('title')
    <title>Add Permissions</title>
@endsection
@section('css')
    <link href="{{asset('admins/role/add/add.css')}}" rel="stylesheet" />
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.layout.content-header', ['name'=>'Permissions', 'action' => 'Add'])
        <!-- Main content -->
            <form method="POST" action="{{ route('permission.store') }}"  enctype="multipart/form-data">
                @csrf
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 p-2">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Select Module</label>

                            <select class="form-control" name="module_name" id="">
                                <option>Select Module</option>
                                @foreach(config('permissions.table_module') as $table)
                                    <option value="{{$table}}">{{$table}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="card mb-3 col-md-12">
                        <div class="row">
                            @foreach(config('permissions.module_action') as $action)
                            <div class="col-md-3">
                                <div class="">
                                    <label>
                                        <input
                                                name="action[]"
                                                value="{{$action}}"
                                                type="checkbox">
                                        {{$action}}
                                    </label>
                                </div>
                            </div>
                            @endforeach
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
    <script src="{{asset('admins/role/add/add.js')}}"></script>
@endsection