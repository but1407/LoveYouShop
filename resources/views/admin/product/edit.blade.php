@extends('layouts.admin')

@section('title')
    <title>Update Product</title>
@endsection

@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admins/product/add/add.css') }}" rel="stylesheet" />
@endsection


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name' => 'Product', 'key' => 'Edit'])
        @include('admin.alert')

        <!-- Main content -->
        <form action="{{ route('admin.products.update', ['id' => $product->id]) }}" method="post"
            enctype="multipart/form-data">
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
                                            <input type="text" name="name" value="{{ $product->name }}"
                                                class="form-control" placeholder="Nhập tên sản phẩm">
                                        </div>
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
                                        <label>Tags sản phẩm</label>
                                        <select name="tags[]" class="form-control js-example-tokenizer"
                                            multiple="multiple">
                                            @foreach ($product->tags as $tagId)
                                                <option value="{{ $tagId->name }}" selected>{{ $tagId->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="menu">Giá Gốc</label>
                                            <input type="number" name="price" value="{{ $product->price }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="menu">Ảnh đại diện</label>
                                    <input type="file" class="form-control-file" id="upload"
                                        name="feature_image_path">
                                    <div id="image_show_face" class="col-md-4 container_img_detail">
                                        <div class="row">
                                            <img class="feature_image" src="{{ $product->feature_image_path }}"
                                                alt="">
                                        </div>
                                    </div>
                                    <input type="hidden" name="thumb_1" id="thumb_1">
                                </div>

                                <div class="form-group">
                                    <label for="menu">Ảnh Sản Phẩm</label>
                                    <input type="file" class="form-control-file" id="upload" name="image_path[]"
                                        multiple>
                                    <div id="image_show_product" class="col-md-12">
                                        <div class="row">
                                            @foreach ($product->images as $image_path)
                                                <div class="col-md-3 container_img_detail">
                                                    <img class="image_detail_product" src="{{ $image_path->image_path }}"
                                                        alt="">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <input type="hidden" name="thumb_2" id="thumb_2">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Mô Tả Chi Tiết</label>
                                    <textarea name="contents" id="content" class="form-control tinymce_editor_init" rows="3" vallue="">{{ $product->content }}</textarea>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
                                </div>

                            </div>

                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
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
