@extends('layouts.admin')

@section('title')
    <title>Product</title>
@endsection
@section('css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('admins/product/index/list.css') }}">
@endsection
@section('js')
    <script src="{{ asset('sweetalert/sweetalert2/sweetalert2.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script type="module" src="{{ asset('admins/product/index/list.js') }}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Product', 'key' => 'list'])
        @include('admin.alert')
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <form class="" method="get" role="search">
                            <div class="form-row">
                                <div class="col-md-4 mb-4">
                                    <label for="full_name">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ request()->name }}" placeholder='Tên sản phẩm'>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="full_name">Tên danh mục</label>
                                    <input type="text" class="form-control" id="name" name="category" value=""
                                        placeholder='Tên danh mục'>
                                </div>

                            </div>
                            <div class="">
                                <button class="btn btn-success" type="submit">Tìm Kiếm</button>&nbsp;
                            </div>
                        </form>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên Sản phẩm</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Ảnh đại diện</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {!! \App\Helpers\helper::product($products) !!}

                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    {{ $products->links('pagination::bootstrap-4') }}
                </div>
                <div class="col-md-3 pull-right float-right">
                    Tổng: {{ number_format($products->total()) }} kết quả
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

<style>
    .noanimation:hover,
    .noanimation {
        text-decoration: none;
        color: inherit;
    }
</style>
