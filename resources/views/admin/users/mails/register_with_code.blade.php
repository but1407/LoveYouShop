<!DOCTYPE html>
<html lang="en">

<head>
    @section('title')
        <title>{{ $title }}</title>
    @endsection
    @section('title')
        <title>{{ $title }}</title>
    @endsection
    @include('partials.head')
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>ĐĂNG KÝ VỚI OTP</b></a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Chúng tôi đã gửi cho bạn mã Otp tới {{ $user }} </p>
                <p class="login-box-msg">Vui lòng truy cập Gmail để xác nhận mã Otp</p>

                @include('admin.alert')
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <h1>{{ $error }}</h1>
                    @endforeach
                @endif
                <form action="{{ route('verification.verify_OTP') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="otp_token" class="form-control" placeholder="Nhập mã Otp">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <input type="text" name="otp_time" class="form-control" id="count" hidden>
                    <p>Time remaining: <span id="countdown"></span></p>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    </div>


    {{-- footer --}}
    @include('partials.foot')

    @section('js')
        <script>
            < script >
                var countdownElement = document.getElementById('countdown');
            var secondsRemaining = 60;

            function updateCountdown() {
                if (secondsRemaining > 0) {
                    secondsRemaining--;
                    countdownElement.innerHTML = secondsRemaining + 's';
                } else {
                    countdownElement.innerHTML = 'Expired';
                }
            }

            setInterval(updateCountdown, 1000);
        </script>
        <script>
            var countdownElement = document.getElementById('countdown');
            var countdown = document.getElementById('count');

            var secondsRemaining = 60;

            function updateCountdown() {
                if (secondsRemaining > 0) {
                    secondsRemaining--;
                    countdownElement.innerHTML = secondsRemaining + 's';
                    countdown.value = secondsRemaining;

                } else {
                    countdownElement.innerHTML = 'Expired';
                    countdown.innerHTML = 'Expired';

                }
            }

            setInterval(updateCountdown, 1000);
        </script>
    @endsection
</body>

</html>
