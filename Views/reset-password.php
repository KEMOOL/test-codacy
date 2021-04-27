<!--
=========================================================
Material Kit - v2.0.7
=========================================================

Product Page: https://www.creative-tim.com/product/material-kit
Copyright 2020 Creative Tim (https://www.creative-tim.com/)

Coded by Creative Tim

=========================================================

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="/favicon.ico">
    <link rel="icon" type="image/png" href="/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Reset Password | BKK
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="/plugins/material-kit/css/material-kit.css?v=2.0.7" rel="stylesheet" />
    <style>
        .login-card .card-header {
            margin-left: 20px;
            margin-right: 20px;
            margin-top: -40px;
            padding: 20px 0;
            margin-bottom: 15px;
        }

        .login-card .text-divider {
            margin-top: 30px;
            margin-bottom: 0px;
            text-align: center;
        }

        /* .login-card .card-body {
                padding: 0px 30px 0px 10px;
            } */

        .login-card .form-check {
            padding-top: 27px;
        }

        .login-card .form-check label {
            margin-left: 18px;
        }

        .login-card .form-check .form-check-sign {
            padding-right: 27px;
        }

        .login-card .input-group {
            padding-bottom: 7px;
            margin: 27px 0 0 0;
        }

        /* .login-card .form {
            min-height: 250px;
        } */

        .is-focused [class^='bmd-label'],
        .is-focused [class*=' bmd-label'] {
            color: #007bff;
        }

        .form-control,
        .is-focused .form-control {
            background-image: linear-gradient(to top, #007bff 2px, rgba(156, 39, 176, 0) 2px), linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px);
        }
    </style>
</head>

<body class="landing-page sidebar-collapse">
    <div class="page-header header-filter" style="background-image: url('/user/img/motif batik PU.jpeg'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 ml-auto mr-auto">

                    <div class="row">
                        <div class="col-md-12" style="text-align: center; bottom: 20px;">
                            <img class="img" src="/img/logo.png" style="height: 150px;">
                        </div>
                    </div>

                    <div class="card login-card">

                        <?= csrf_field() ?>
                        <div class="card-header text-center" style="background:#007BFF;">
                            <h4 class="card-title text-white">Reset Password</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            if (session()->getFlashdata('error')) { ?>
                                <div class="alert alert-danger" role="alert" style="border-radius: 7px;">
                                    <?= session()->getFlashdata('error'); ?>
                                </div>
                            <?php
                            }
                            if (session()->getFlashdata('success')) { ?>
                                <div class="alert alert-success" role="alert" style="border-radius: 7px;">
                                    <?= session()->getFlashdata('success'); ?>
                                </div>
                            <?php
                            }
                            if ($user) { ?>
                                <form class="form" method="post" id="form_reset" action="/resetpassword/reset">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <label for="password_baru">Password Baru</label>
                                        <input type="password" class="form-control" id="password_baru" name="password_baru" aria-describedby="password_baru" placeholder="Masukkan Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="konfirmasi_password">Password Baru</label>
                                        <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" aria-describedby="konfirmasi_password" placeholder="Masukkan Password">
                                    </div>
                                    <div class="footer text-center mt-5">
                                        <button type="submit" class="btn btn-wd" style="background-color: #007BFF; text-transform:none; ">
                                            <b><i class="material-icons"></i> Reset Password</b>
                                        </button>
                                    </div>
                                </form>
                            <?php
                            } else {
                            ?>
                                <form class="form" method="post" action="/resetpassword/cek">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Masukkan Alamat Email">
                                    </div>
                                    <div class="footer text-center mt-5">
                                        <button type="submit" class="btn btn-wd" style="background-color: #007BFF; text-transform:none; ">
                                            <b><i class="material-icons"></i> Reset Password</b>
                                        </button>
                                    </div>
                                </form>
                            <?php } ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="text-align: center; padding: 10px;">
                                <hr style="border: solid 1px #007BFF; margin-top: unset; width: 80%;">
                                <div class="copyright float-center">
                                    &copy;
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script>, Copyright</a>.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/plugins/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="/plugins/popper/umd/popper.min.js" type="text/javascript"></script>
    <script src="/plugins/bootstrap-material-design/js/bootstrap-material-design.min.js" type="text/javascript"></script>
    <script src="/plugins/material-kit/js/material-kit.js?v=2.0.7" type="text/javascript"></script>
    <script src="/plugins/sweetalert2/sweetalert2.min.js"></script>

    <script>
        csrf_name = 'token';
        $('#form_reset').submit(function(e) {
            e.preventDefault();

            $('.card-body .alert').remove();

            passwordBaru = $('#password_baru').val();
            konfPassword = $('#konfirmasi_password').val();
            if (passwordBaru == '' || konfPassword == '') {
                console.log('masuk');
                $('.card-body').prepend('<div class="alert alert-danger" role="alert" style="border-radius: 7px;"> Form Belum Diisi </div>');
                return false;
            }
            if (passwordBaru != konfPassword) {
                $('.card-body').prepend('<div class="alert alert-danger" role="alert" style="border-radius: 7px;"> Konfirmasi Password Tidak Sama </div>');
                return false;
            }
            if (!/(?=.{8,}$)([A-Za-z].*\d|\d.*[A-Za-z])/.test(passwordBaru)) {
                $('.card-body').prepend('<div class="alert alert-danger" role="alert" style="border-radius: 7px;">Password Minimal 8 Karakter dengan Huruf dan Angka</div>');
                return false;
            }
            // console.log(passwordBaru.match('^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$'));
            // console.log(passwordBaru.match('^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$'));
            // console.log(passwordBaru.match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/'));
            return false;
            $.ajax({
                url: "/resetPassword/reset",
                type: "POST",
                datatype: "JSON",
                data: {
                    token: $("input[name=" + csrf_name + "]").val(),
                    password_baru: passwordBaru,
                    konfirmasi_password: konfPassword,
                },
                beforeSend: function() {},
                success: function(data) {
                    $("input[name=" + csrf_name + "]").val(data[csrf_name]);
                    console.log(data);
                    if (data.error != '') {
                        $('.card-body').prepend('<div class="alert alert-danger" role="alert" style="border-radius: 7px;">' + data.error + '</div>');
                        return false;
                    }
                    window.location.href = '/login';
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText);
                },
                async: false,
            });
        })
    </script>
</body>

</html>