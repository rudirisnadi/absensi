<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>PANEL LOGIN</title>
        <link rel="shortcut icon" href="<?= base_url(); ?>/assets/images/logo.png" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Responsive bootstrap 4 admin template" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="<?= base_url(); ?>/assets/images/favicon.ico" type="image/x-icon" />
        <link href="<?= base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="<?= base_url(); ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />
    </head>
    <style type="text/css">
        input[type=password] {
            width: 85%;
            box-sizing: border-box;
            margin-top: 7px;
            border: none;
            border-bottom: 2px solid #DE862E;
            background-color: #FFF;
        }
        input[type=text] {
            width: 85%;
            box-sizing: border-box;
            margin-top: 7px;
            border: none;
            border-bottom: 2px solid #DE862E;
            background-color: #FFF;
        }
        input {
            color: #DE862E;
            /*font-weight: bold;*/
            font-size: 14px;
        }
        body {
            background-color: #DE862E;
            height: 100%; 
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .alert {
            padding: 20px;
            background-color: #DE862E;
            color: white;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }
        .closebtn:hover {
            color: white;
        }
        #texterr {
            color: white;
        }
    </style>
    <body>
        <div class="account-pages xdiv">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="row col-md-9 justify-content-center" style="margin-top: 15%;">
                        <div class="col-md-5" style="background-color: #fff; border-top-left-radius: 20px; border-bottom-left-radius: 20px; -webkit-box-shadow: 0px 0px 4px 2px rgba(50,68,64,0.6); box-shadow: 0px 0px 4px 2px rgba(50,68,64,0.6);">
                            <div class="col-md-12 text-left" style="padding-top: 13%;">
                                <h1 style="color: #DE862E;">SISTEM INFORMASI ABSENSI KARYAWAN</h1>
                            </div>
                        </div>
                        <div class="col-md-7" style="background-color: #FFF; border-top-right-radius: 20px; border-bottom-right-radius: 20px; -webkit-box-shadow: 0px 0px 4px 2px rgba(50,68,64,0.6); box-shadow: 0px 0px 4px 2px rgba(50,68,64,0.6);">
                            <form action="<?= base_url(); ?>index.php/login/aksi_login" method="post" class="p-2">
                                <div class="col-md-12" style="margin-top: 20%;">
                                    <text style="color: #DE862E; font-weight: bold;">USERNAME</text>
                                    <input type="text" name="username" autocomplete="off">
                                </div>
                                <br>
                                <div class="col-md-12" style="margin-bottom: 30px;">
                                    <text style="color: #DE862E; font-weight: bold;">PASSWORD</text>
                                    <input type="password" name="password" autocomplete="off">
                                </div>
                                <?php 
                                    if($this->session->flashdata('statusx') != '' || $this->session->flashdata('statusx') != null){
                                ?>
                                <div class="form-row">
                                    <div class="alert">
                                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                                        <text id="texterr"><?= $this->session->flashdata('statusx') ?></text>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                                <div class="col-md-12" style="margin-bottom: 20px; margin-top: 10px;">
                                    <input type="submit" value="Login" class="btn" style="background-color: #fff; color: #DE862E; -webkit-box-shadow: 0px 0px 4px 2px rgba(50,68,64,0.6); box-shadow: 0px 0px 4px 2px rgba(50,68,64,0.6);">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="<?= base_url(); ?>/assets/js/vendor.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/app.min.js"></script>

    <script type="text/javascript">
        $("img").mousedown(function(){
            return false;
        });
    </script>

</html>