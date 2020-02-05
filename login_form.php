<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset = UTF-8 ">
    <!-- Meta, title, CSS, favicons, etc-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Login Form</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>admin_assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>admin_assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <style media="screen">
        body {
            background: gray;
        }

        .well {
            border-radius: 9px;
            margin-top: 10%;
            color: #616161;
        }

        .well hr {
            margin: 10px;
            border-color: #0077a3;
        }

        .header {
            font-size: 27px;
            color: #f7f7f7;
        }

        .header .fa {
            border: 10px solid #fcfcfc;
            border-radius: 50%;
            padding: 5px;
        }

        .container {
            padding-top: 7%;
        }

        .form-control {
            padding: 20px 20px;
            font-size: 15px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 12px;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="container">

        <center><img src="<?php echo base_url(); ?>assets/image/mdnj2.png" width="70px" alt="logo"></center>
        <center>
            <span class="header">MADRASAH DINIYAH NURUL JADID</span>
        </center>
        <div class="col-md-4 col-sm-12 col-md-offset-4">
            <?php
            if ($this->session->flashdata('alert')) {
                echo '<div class="alert alert-warning alert-message">';
                echo $this->session->flashdata('alert');
                echo '</div>';
            }
            ?>
            <form class="well" action="" method="post">

                <h3><i class="fa fa-user"></i> Silahkan login</h3>
                <hr />
                <br />

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" placeholder="Masukkan Nama" name="username">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Masukkan Password" name="password">
                </div>

                <div class="form-group" style="text-align:right">
                    <button type="submit" class="btn btn-primary" name="submit" value="Submit">Masuk</button>
                    <button type="reset" class="btn btn-default">Batal</button>
                </div>
            </form>
        </div>

    </div>
    <!-- <footer class="sticky-footer bg-blue"> -->
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span> &copy; Hamba Amatiran <?= date('Y'); ?></span>
        </div>
    </div>
    <!-- </footer> -->
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>admin_assets/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>admin_assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $('.alert-message').alert().delay(3000).slideUp('slow');
    </script>
</body>

</html>