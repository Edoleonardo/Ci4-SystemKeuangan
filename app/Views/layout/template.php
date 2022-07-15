<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Batu Emas</title>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script> -->
    <script src="<?php echo base_url(); ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


</head>
<style>
    .tableasd>tbody>tr>* {
        vertical-align: middle;
        text-align: center;
    }
</style>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="layout-fixed sidebar-collapse sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?= $this->include('layout/navbar'); ?>
        <?php $this->renderSection('content'); ?>
    </div>
    <script src="<?php echo base_url(); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>/dist/js/adminlte.js"></script>
    <!-- <script src="<?php echo base_url(); ?>/plugins/chart.js/Chart.min.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>/dist/js/pages/dashboard3.js"></script> -->
    <script src="<?php echo base_url(); ?>/dist/js/demo.js"></script>
    <script src="<?php echo base_url(); ?>/plugins/jszip/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?php echo base_url(); ?>/plugins/toastr/toastr.min.js"></script>
    <script src="<?php echo base_url(); ?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
</body>

</html>