<!DOCTYPE html>
<html lang="en">

<head>
    @section('title')
        <title>Đổi mật khẩu</title>
    @endsection
    @include('partials.head')
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>ĐỔI MẬT KHẨU</b></a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">đổi mật khẩu của bạn</p>
                @include('admin.alert')
                <form action="" method="post">
                    @csrf
                    <h5 class="login-box-msg"> <b>{{ $email }}</b> </k5>
                        <div class="input-group mb-3">
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="confirm_password" class="form-control"
                                placeholder="Confirm your Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Change</button>
                        </div>

                </form>

            </div>
        </div>
    </div>


    {{-- footer --}}
    @include('partials.foot')
</body>

</html>
