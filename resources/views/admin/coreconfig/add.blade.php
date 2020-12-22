@extends('admin.layout.admin')
@section('title')
    <title>Add Config</title>
@endsection
@section('css')
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.layout.content-header', ['name'=>'Config', 'action' => 'Add'])
        <!-- Main content -->
            <form method="POST" action="{{ route('config.store') }}"  enctype="multipart/form-data">
                @csrf
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 p-2">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Config Key (don't have space, special charactor, capitalize letter.)</label>
                            <input type="text" pattern="[a-z0-9_^]+" class="form-control @error('config_key') is-invalid @enderror" value="{{old('config_key')}}" name="config_key" placeholder="Key">
                            @error('config_key')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Config Value</label>
                            @if(request()->type === 'Text')
                                <input type="text" class="form-control @error('config_value') is-invalid @enderror" value="{{old('config_value')}}" name="config_value"/>
                            @elseif(request()->type === 'Textarea')
                                <textarea rows="3" name="config_value" class="form-control tinymce_editor_int @error('config_value') is-invalid @enderror">{{old('config_value')}}</textarea>
                            @endif
                            @error('config_value')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
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