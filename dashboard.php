<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard</title>
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>admin_assets/js/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>admin_assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>admin_assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Data Tables -->
    <link href="<?php echo base_url(); ?>admin_assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>admin_assets/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>admin_assets/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>admin_assets/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>admin_assets/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Include Bootstrap Datepicker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/datepicker-bs.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/datepicker-bs3.min.css" />
    <!-- sweetalert -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/sweetalert2.min.css" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css"> -->
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>admin_assets/css/custom.min.css" rel="stylesheet">
    <!-- nprogres -->
    <link href="<?php echo base_url(); ?>admin_assets/css/nprogress.css" rel="stylesheet">

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script> -->
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <?php echo $nav; ?>
            <!-- page content -->
            <div class="right_col" role="main">
                <?php echo $content; ?>

            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    <a> <i class="fa fa-copyright"></i> Hamba Amatiran</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>


    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>admin_assets/js/bootstrap.min.js"></script>
    <!-- Data Tables -->
    <script src="<?php echo base_url(); ?>admin_assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/dist/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/build/vfs_fonts.js"></script>
    <!-- Include DatePicker -->
    <script src="<?php echo base_url(); ?>admin_assets/js/datepicker-bs.min.js"></script>
    <!-- sweet alert2 -->
    <script src="<?php echo base_url(); ?>admin_assets/js/sweetalert/sweetalert2.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>admin_assets/js/custom.min.js"></script>
    <!-- morris.js -->
    <script src="<?php echo base_url(); ?>admin_assets/js/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/morris.js/morris.min.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url(); ?>admin_assets/js/dist/Chart.min.js"></script>
    <!-- npprogres -->
    <script src="<?php echo base_url(); ?>admin_assets/js/npprogres/nprogress.js"></script>

    <script>
        $(document).ready(function() {
            $('$datatable').DataTable();
        });
    </script>
</body>

</html>