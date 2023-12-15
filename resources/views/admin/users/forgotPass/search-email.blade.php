<!DOCTYPE html>
<html lang="en">

<head>
    @section('title')
        <title>Quên mật khẩu</title>
    @endsection
    @include('partials.head')
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Tìm tài khoản của bạn</b></a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Vui lòng nhập email hoặc số di động để tìm kiếm tài khoản của bạn.</p>
                @include('admin.alert')
                <form action="{{ route('forgot-password') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block ">Tìm Kiếm</button>
                        </div>

                    </div>
                </form>


                <p class="mb-1">
                    <a href="{{ route('login') }}">Login</a>
                </p>
                <p class="mb-0">
                    <a href="#" class="text-center">Register a new membership</a>
                </p>
            </div>

        </div>
    </div>


    {{-- footer --}}
    @include('partials.foot')
</body>

</html>
