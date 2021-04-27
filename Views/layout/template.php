<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="/admin/plugins/bootstrap/css/bootstrap.css"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/plugins/ionicons/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.css">
    <link rel="stylesheet" href="/plugins/datatables-rowreorder/css/rowReorder.bootstrap4.css">
    <!-- Fancybox -->
    <link rel="stylesheet" href="/plugins/fancybox/jquery.fancybox.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/adminlte.min.css">
    <link rel="stylesheet" href="/css/style.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Stardos+Stencil" />

    <style>
        .dataTables_scroll table tr th:last-child {
            padding-right: 300px !important;
        }

        #loading {
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            position: fixed;
            display: none;
            opacity: 0.8;
            background-color: #000;
            z-index: 9999;
            text-align: center;
        }

        #loading-image {
            position: absolute;
            top: calc(50% - 100px);
            left: calc(50% - 100px);
            z-index: 100;
        }

        .custom .wrapper .content-wrapper {
            margin-top: 73px;
        }

        /* .btn.btn-flat {
            border-radius: .25rem;
        } */

        .main-header {
            border-bottom: none;
        }

        .form-group .input-group .select2-container {
            flex: 1 1 0%;
        }

        .datatables thead tr th {
            text-align: center;
            vertical-align: middle;
        }

        .is-invalid~.select2-container .select2-selection {
            border-color: #dc3545;
        }

        td .fa-file {
            vertical-align: middle;
            margin-right: 5px;
        }

        #modal_dokumen h4.modal-title {
            text-transform: capitalize;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed custom">
    <div id="loading">
        <img id="loading-image" src="/admin/img/loading.gif" alt="Loading..." />
    </div>
    <div class="wrapper">

        <?= $this->include('layout/navbar'); ?>
        <?= $this->include('layout/sidebar'); ?>

        <?= $this->renderSection('content'); ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <div class="modal fade" id="modal_ganti_password" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="icon fas fa-edit"></i> Form ganti password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" action="/login/gantiPassword" method="POST" id="form_ganti_password">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="password_lama">
                                Password Lama<sup style="color: red;">*</sup>
                            </label>
                            <input type="password" class="form-control" id="password_lama" name="password_lama" placeholder="Masukkan Password Lama" required>
                            <div class="invalid-feedback"> </div>
                        </div>
                        <div class="form-group">
                            <label for="password_baru">
                                Password Baru<sup style="color: red;">*</sup>
                            </label>
                            <input type="password" class="form-control" id="password_baru" name="password_baru" placeholder="Masukkan Password Baru" required>
                            <div class="invalid-feedback"> </div>
                        </div>
                        <div class="form-group">
                            <label for="konfirmasi_password">
                                Konformasi Password Baru<sup style="color: red;">*</sup>
                            </label>
                            <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" placeholder="Masukkan Password Baru" required>
                            <div class="invalid-feedback"> </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="icon fas fa-paper-plane"></i> <b>Submit</b>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="main-footer">
        <strong>Copyright © BPR BKK Kota Semarang 2021</strong>
    </footer>

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="/plugins/chart.js/Chart.min.js"></script>
    <!-- daterangepicker -->
    <script src="/plugins/moment/moment-with-locales.min.js"></script>
    <script src="/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- Select2 -->
    <script src="/plugins/select2/js/select2.full.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Fancybox -->
    <script src="/plugins/fancybox/jquery.fancybox.min.js"></script>
    <!-- DataTables -->
    <script src="/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="/plugins/datatables-responsive/js/dataTables.responsive.js"></script>
    <script src="/plugins/datatables-rowreorder/js/dataTables.rowReorder.js"></script>
    <!-- Toastr -->
    <script src="/plugins/toastr/toastr.min.js"></script>

    <script src="/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/js/adminlte.min.js"></script>
    <script src="/js/script.js"></script>

    <script>

    </script>
</body>

</html>