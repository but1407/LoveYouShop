@extends('layouts.admin')

@section('title')
    <title>Add Setting</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name' => 'Setting', 'key' => 'Add'])
        @include('admin.alert')

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('admin.settings.store') . '?type=' . request()->type }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Config Key</label>
                                <input type="text" class="form-control" name="config_key" placeholder="Nhập Config Key">
                            </div>
                            <div class="form-group">
                                <label>Config Value</label>
                                @if (request()->type === 'text')
                                    <input type="text" class="form-control" name="config_value"
                                        placeholder="Nhập Config value" value="{{ old('config_value') }}">
                                @elseif (request()->type === 'textarea')
                                    <textarea class="form-control" name="config_value" rows="5" placeholder="Nhập Config value">{{ old('config_value') }}</textarea>
                                @endif
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
