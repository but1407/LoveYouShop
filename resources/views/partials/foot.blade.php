<!-- jQuery -->
<script src="adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/template/admin/plugins/jquery/jquery.min.js"></script>

<script src="/template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="/template/admin/dist/js/adminlte.min.js?v=3.2.0"></script>

<script src="adminlte/dist/js/adminlte.min.js"></script>

<script src="/template/admin/js/main.js"></script>
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
</script>
