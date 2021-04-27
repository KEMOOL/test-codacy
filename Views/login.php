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
    <link rel="apple-touch-icon" sizes="76x76" href="/img/favicon.png">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Login Page | BKK
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

        .login-card .form {
            min-height: 250px;
        }

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
    <div class="page-header header-filter" style="background-image: url(''); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 ml-auto mr-auto">
                    <div class="row">
                        <div class="col-md-12" style="text-align: center; bottom: 20px;">
                            <img class="img" src="/img/logo.png" style="height: 150px;">
                        </div>
                    </div>

                    <div class="card login-card">
                        <form class="form" method="post" action="/login/cek">
                            <?= csrf_field() ?>
                            <div class="card-header text-center" style="background:#007BFF;">
                                <h4 class="card-title text-white">Log-in</h4>
                            </div>
                            <div class="card-body">
                                <?php if (session()->getFlashdata('pesan')) { ?>
                                    <div class="alert alert-danger" role="alert" style="border-radius: 7px;">
                                        <?= session()->getFlashdata('pesan'); ?>
                                    </div>
                                <?php }
                                if (session()->getFlashdata('success')) { ?>
                                    <div class="alert alert-success" role="alert" style="border-radius: 7px;">
                                        <?= session()->getFlashdata('success'); ?>
                                    </div>
                                <?php
                                } ?>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Masukkan Alamat  Email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" placeholder="Masukkan Password" name="password">
                                </div>
                                <a href="/reset-password" class="" style="color:#007BFF;">Lupa Password?</a>
                                <div class="footer text-right">
                                    <button type="submit" class="btn btn-wd" style="background-color: #007BFF; text-transform:none; ">
                                        <b><i class="material-icons">login</i> Login</b>
                                    </button>
                                </div>
                            </div>
                        </form>
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
</body>

</html>