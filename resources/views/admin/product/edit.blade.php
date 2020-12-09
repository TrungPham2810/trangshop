@extends('admin.layout.admin')
@section('title')
    <title>Edit Category</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('admin.layout.content-header', ['name'=>'Menu', 'action' => 'Edit'])
    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 p-2">
                        <form method="POST" action="{{ route('menus.update', ['id'=>$menu->id]) }}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Menu Name</label>
                                <input type="text" id="exampleInputEmail1" class="form-control" required name="menu_name" value="{{$menu->name}}"  placeholder="Name Menu">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Parent</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="menu_parent" required>
                                    <option value="0">Please Select Menu...</option>
                                    {!! $htmlSelect !!}
                                </select>
                            </div>


                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection