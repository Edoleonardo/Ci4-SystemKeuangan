<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Mas Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>/dist/css/adminlte.min.css">
    <script src="/plugins/jquery/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>TokoMas</b> Login</a>
            </div>
            <div class="card-body">
                <!-- <p class="login-box-msg">Sign in to start your session</p> -->

                <form action="/masuklogin" name="masuklogin" id="masuklogin" class="masuklogin" method="post">
                    <?= csrf_field(); ?>
                    <div class="input-group mb-3">
                        <!-- <div class="form-group">
                            <label>Jenis</label>
                            <div id="validationServerUsernameFeedback" class="invalid-feedback jenismsg">
                            </div>
                        </div> -->
                        <input type="text" name="username1" id="username1" class="form-control" value="<?= (isset($_COOKIE['username1'])) ? $_COOKIE['username1'] : '' ?>" placeholder="Masukan Username">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback username1msg">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password1" id="password1" class="form-control" value="<?= (isset($_COOKIE['password1'])) ? $_COOKIE['password1'] : '' ?>" placeholder="Masukan Password">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback password1msg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember" <?= (isset($_COOKIE['password1'])) ? 'checked' : '' ?>>
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">login</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    <script>
        $('.masuklogin').submit(function(e) {
            e.preventDefault()
            let form = $('.masuklogin')[0];
            let data = new FormData(form)
            $.ajax({
                type: "POST",
                data: data,
                url: "<?php echo base_url('masuklogin'); ?>",
                dataType: "json",
                contentType: false,
                processData: false,
                cache: false,
                success: function(hasil) {
                    if (hasil.error) {
                        if (hasil.error.username1) {
                            $('#username1').addClass('is-invalid')
                            $('.username1msg').html(hasil.error.username1)
                        } else {
                            $('#username1').removeClass('is-invalid')
                            $('.username1msg').html('')
                        }
                        if (hasil.error.password1) {
                            $('#password1').addClass('is-invalid')
                            $('.password1msg').html(hasil.error.password1)
                        } else {
                            $('#password1').removeClass('is-invalid')
                            $('.password1msg').html('')
                        }

                    } else {
                        $('#password1').removeClass('is-invalid')
                        $('.password1msg').html('')
                        $('#username1').removeClass('is-invalid')
                        $('.username1msg').html('')
                        if (hasil == 'gagal') {
                            $('#password1').addClass('is-invalid')
                            $('#username1').addClass('is-invalid')
                            $('.password1msg').html('Username / Password Salah')
                        } else {
                            window.location.href = '/'
                        }
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        })
    </script>
    <!-- jQuery -->
    <script src="<?= base_url(); ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>/dist/js/adminlte.min.js"></script>
</body>

</html>