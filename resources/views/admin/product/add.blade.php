@extends('layouts.admin')

@section('title')
    <title>Add Product</title>
@endsection

@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admins/product/add/add.css') }}" rel="stylesheet" />
@endsection


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name' => 'menus', 'key' => 'Add'])
        @include('admin.alert')

        <!-- Main content -->
        <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="menu">Tên Sản Phẩm</label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Nhập tên sản phẩm">
                                        </div>
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>chọn danh Mục</label>
                                            <select class="form-control select2_init" name="category_id">
                                                <option value="">danh mục cha</option>
                                                {!! $htmlOptions !!}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="menu">Tags sản phẩm</label>
                                        <select name="tags[]"
                                            class="form-control js-example-tokenizer @error('name') is-invalid @enderror"
                                            multiple="multiple" value="{{ old('tags') }}">

                                        </select>
                                        @error('tags')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="menu">Giá Gốc</label>
                                            <input type="number" name="price" value="{{ old('price') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="menu">Ảnh đại diện</label>
                                    <input type="file" class="form-control-file" id="upload"
                                        name="feature_image_path">
                                    <div id="image_show_face">
                                    </div>
                                    <input type="hidden" name="thumb_1" id="thumb_1">
                                </div>

                                <div class="form-group">
                                    <label for="menu">Ảnh Sản Phẩm</label>
                                    <input type="file" class="form-control-file" id="upload" name="image_path[]"
                                        multiple>
                                    <div id="image_show_product">

                                    </div>
                                    <input type="hidden" name="thumb_2" id="thumb_2">
                                </div>

                                {{-- <div class="form-group">
                                    <label>Kích Hoạt</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" value="1" type="radio" id="active"
                                            name="active" checked="">
                                        <label for="active" class="custom-control-label">Có</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" value="0" type="radio" id="no_active"
                                            name="active">
                                        <label for="no_active" class="custom-control-label">Không</label>
                                    </div>
                                </div>
                            </div> --}}


                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Mô Tả Chi Tiết</label>
                                    <textarea name="contents" id="content" class="form-control tinymce_editor_init" rows="3">{{ old('content') }}</textarea>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
                                </div>

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
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src='https://cdn.tiny.cloud/1/no-api-key/tinymce/4/tinymce.min.js'></script>

    <script src="{{ asset('admins/product/add/add.js') }}"></script>
    <script src="{{ asset('template/admin/js/main.js') }}"></script>
@endsection
