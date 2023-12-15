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
            <a href="#"><b>GỬI EMAIL THÀNH CÔNG</b></a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">xin chào {{ $name }} </p>
                <p class="login-box-msg">chúng tôi đã gửi cho bạn đường link đến {{ $email }} để thay đổi mật
                    khẩu, vui lòng check email
                </p>

                @include('admin.alert')


            </div>

        </div>
    </div>


    {{-- footer --}}
    @include('partials.foot')
</body>

</html>
