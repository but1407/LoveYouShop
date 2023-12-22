@extends('layouts.admin')

@section('title')
    <title>Add Menus</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name' => 'menus', 'key' => 'Add'])
        @include('admin.alert')

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('admin.menus.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên Menu</label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập tên danh mục">
                            </div>
                            <div class="form-group">
                                <label>Chọn Menu cha</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Menu cha</option>
                                    {!! $optionSelect !!}

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
