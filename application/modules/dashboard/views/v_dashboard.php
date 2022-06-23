<!DOCTYPE html>
<html lang="en">

    
<head>
        <meta charset="utf-8" />
        <title>Admin Panel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Responsive bootstrap 4 admin template" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="icon" href="<?= base_url(); ?>assets/images/favicon.ico">
        <!-- App css -->
        <link href="<?= base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="<?= base_url(); ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

        <!-- <link href="<?= base_url(); ?>/assets/css/bootstrap-treeview.css" rel="stylesheet" type="text/css" id="app-stylesheet" /> -->
        <!-- <link href="<?= base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css" id="app-stylesheet" /> -->

        
        <link href="<?= base_url(); ?>/assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>/assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>/assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>/assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />

        <link href="<?= base_url(); ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

        <link href="<?= base_url(); ?>/assets/libs/select2/select2.css" rel="stylesheet" type="text/css" />

        <link href="<?= base_url(); ?>/assets/libs/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />

        <link href="<?= base_url(); ?>/assets/html5-editor/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>/assets/datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />

    </head>

    <style type="text/css">
        #table thead th, #table thead td {
            font-size: 13px;
            height: 30px;
        }

        #table tbody th, #table tbody td {
            padding: 3px 5px;
            font-size: 11px;
        }

        #loadery {
            width: 100%;
            height: 1000px;
            background-color:rgba(126,190,190,0.50);
            z-index: 30000;
            display: none;
            position: absolute;
        }
        #loaderx {
            position: absolute;
            left: 50%;
            top: 50%;
            z-index: 1;
            width: 150px;
            height: 150px;
            margin: -75px 0 0 -75px;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @-webkit-keyframes animatebottom {
            from { bottom:-100px; opacity:0 } 
            to { bottom:0px; opacity:1 }
        }

        @keyframes animatebottom { 
            from{ bottom:-100px; opacity:0 } 
            to{ bottom:0; opacity:1 }
        }

        output {
            display: block;
            margin-top: 4em;
            font-family: Roboto, sans-serif;
            font-size: .8em;
        }

        .imgx_pasx {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 150px;
        }
        .imgx_pasx:hover {
            box-shadow: 0 0 2px 1px orange;
        }

    </style>

    <body data-layout="horizontal" style="background-color: white;">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Navigation Bar-->
            <header id="topnav">
                <!-- Topbar Start -->
                <div class="navbar-custom" style="background-color: #DE862E;">
                    <div class="container-fluid">
                        <ul class="list-unstyled topnav-menu float-right mb-0">

                            <li class="dropdown notification-list">
                                <!-- Mobile menu toggle-->
                                <a class="navbar-toggle nav-link">
                                    <div class="lines">
                                        <span style="background-color: #fff2dc;"></span>
                                        <span style="background-color: #fff2dc;"></span>
                                        <span style="background-color: #fff2dc;"></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>

                            <li class="notification-list">
                                <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                                    <span class="pro-user-name d-none d-xl-inline-block ml-2" style="color: #fff2dc;">
                                        <?= $this->session->userdata('nama_user') ?>
                                    </span>
                                </a>
                            </li>

                            <li class="notification-list">
                                <a href="<?= base_url(); ?>login/logout" class="nav-link" title="Logout">
                                    <i class="mdi mdi-logout-variant" style="color: #fff2dc; font-size: 30px;"></i>
                                </a>
                            </li>

                        </ul>

                        <!-- LOGO -->
                        <div class="logo-box" style="display: none;">
                            <a href="<?= base_url(); ?>dashboard" class="logo text-center">
                                <span class="logo-lg">
                                    <img src="<?= base_url(); ?>/assets/images/favicon.png" alt="" height="40">
                                </span>
                                <span class="logo-sm">
                                    <img src="<?= base_url(); ?>/assets/images/favicon.png" alt="" height="22">
                                </span>
                            </a>
                        </div>

                        <div id="navigation">
                            <!-- Navigation Menu-->
                            <ul class="navigation-menu" style="background-color: #F7B907;">

                                <li class="has-submenu">
                                    <a href="<?= base_url(); ?>dashboard" style="color: #fff2dc;">
                                        <i class="ti-home"></i>Dashboard
                                    </a>
                                </li>

                                <?php
                                  foreach ($data_menu->result() as $value) {
                                ?>

                                    <li class="has-submenu">
                                        <a href="#" style="color: #fff2dc;"> <i class="<?= $value->icon_mdul ?>"></i><?= $value->nama_mdul ?></a>
                                        <ul class="submenu" style="background-color: #DE862E;">
                                          <?php
                                            $dchild = $this->m_dashboard->get_menu_child( $value->idxx_mdul, $this->session->userdata('idxx_role') );
                                            foreach ($dchild->result() as $row) {
                                          ?>
                                                <li><a onclick="get_url_1('<?= $row->urlx_menu ?>')" href="#" style="color: #fff2dc;"><i class="fa fa-caret-right"></i> &nbsp;<?= $row->nama_menu ?></a></li>
                                          <?php
                                            }
                                          ?>
                                        </ul>
                                    </li>

                                <?php
                                  }
                                ?>

                            </ul>
                            <!-- End navigation menu -->

                            <div class="clearfix"></div>
                        </div>
                        <!-- end #navigation -->

                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- end Topbar -->
            </header>
            <!-- End Navigation Bar-->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <div id="loadery">
                <div id="loaderx"></div>
            </div>
            <div class="content-page" style="height: 100%; overflow: auto;">
                <div class="content">

                    <!-- Start container-fluid -->
                    <div class="container-fluid" id="content-load" style="max-width: 95%;">
                      <?= $this->load->view( $content ); ?>
                    </div>
                    <!-- end container-fluid -->

                    

                    <!-- Footer Start -->
                    <!-- <footer class="footer">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    2017 - 2020 &copy; Simple theme by <a href="#">Coderthemes</a>
                                </div>
                            </div>
                        </div>
                    </footer> -->
                    <!-- end Footer -->

                </div>
                <!-- end content -->

            </div>
            <!-- END content-page -->

        </div>
        <!-- END wrapper -->

        
        <!-- Right Sidebar -->
        <div class="right-bar">
            <div class="rightbar-title" style="background-color: grey;">
                <a href="javascript:void(0);" class="right-bar-toggle float-right">
                    <i class="mdi mdi-close"></i>
                </a>
                <h5 class="font-16 m-0 text-white">Theme Customizer</h5>
            </div>
            <div class="slimscroll-menu">
        
                <div class="p-4">
                    <div class="alert alert-warning" role="alert">
                        <strong>Customize </strong> the overall color scheme, layout, etc.
                    </div>
                    <div class="mb-2">
                        <img src="<?= base_url(); ?>/assets/images/favicon.png" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked />
                        <label class="custom-control-label" for="light-mode-switch">Light Mode</label>
                    </div>
            
                    <div class="mb-2">
                        <img src="<?= base_url(); ?>/assets/images/favicon.png" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsStyle="<?= base_url(); ?>/assets/css/bootstrap-dark.min.css" 
                            data-appStyle="<?= base_url(); ?>/assets/css/app-dark.min.css" />
                        <label class="custom-control-label" for="dark-mode-switch">Dark Mode</label>
                    </div>
            
                    <div class="mb-2">
                        <img src="<?= base_url(); ?>/assets/images/favicon.png" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-5">
                        <input type="checkbox" class="custom-control-input theme-choice" id="rtl-mode-switch" data-appStyle="<?= base_url(); ?>/assets/css/app-rtl.min.css" />
                        <label class="custom-control-label" for="rtl-mode-switch">RTL Mode</label>
                    </div>

                    <a href="https://1.envato.market/EK71X" class="btn btn-danger btn-block mt-3" target="_blank"><i class="mdi mdi-download mr-1"></i> Download Now</a>
                </div>
            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <a href="javascript:void(0);" class="right-bar-toggle demos-show-btn" style="background-color: grey; display: none;">
            <i class="mdi mdi-settings-outline mdi-spin"></i> &nbsp;Ganti Mode
        </a>

        <!-- Vendor js -->
        <script src="<?= base_url(); ?>/assets/js/vendor.min.js"></script>

        <!-- <script src="<?= base_url(); ?>/assets/js/bootstrap-treeview.js"></script> -->

        <!-- <script src="<?= base_url(); ?>/assets/libs/morris-js/morris.min.js"></script> -->
        <script src="<?= base_url(); ?>/assets/libs/raphael/raphael.min.js"></script>

        <!-- <script src="<?= base_url(); ?>/assets/js/pages/dashboard.init.js"></script> -->

        <!-- App js -->
        <script src="<?= base_url(); ?>/assets/js/app.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/jquery.cookie/jquery.cookie.js"> </script>

        <!-- Required datatable js -->
        <script src="<?= base_url(); ?>/assets/libs/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url(); ?>/assets/libs/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Buttons examples -->
        <script src="<?= base_url(); ?>/assets/libs/datatables/dataTables.buttons.min.js"></script>
        <script src="<?= base_url(); ?>/assets/libs/datatables/buttons.bootstrap4.min.js"></script>
        <script src="<?= base_url(); ?>/assets/libs/datatables/dataTables.keyTable.min.js"></script>
        <script src="<?= base_url(); ?>/assets/libs/datatables/dataTables.select.min.js"></script>
        
        <script src="<?= base_url(); ?>/assets/libs/jszip/jszip.min.js"></script>
        <script src="<?= base_url(); ?>/assets/libs/pdfmake/pdfmake.min.js"></script>
        <script src="<?= base_url(); ?>/assets/libs/pdfmake/vfs_fonts.js"></script>
        <script src="<?= base_url(); ?>/assets/libs/datatables/buttons.html5.min.js"></script>
        <script src="<?= base_url(); ?>/assets/libs/datatables/buttons.print.min.js"></script>

        <!-- Responsive examples -->
        <script src="<?= base_url(); ?>/assets/libs/datatables/dataTables.responsive.min.js"></script>
        <script src="<?= base_url(); ?>/assets/libs/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Datatables init -->
        <script src="<?= base_url(); ?>/assets/js/pages/datatables.init.js"></script>

        <script src="<?= base_url(); ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/pages/sweet-alerts.init.js"></script>
        
        <script src="<?= base_url(); ?>/assets/libs/select2/select2.js"></script>

        <script src="<?= base_url(); ?>/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

        <script src="<?= base_url(); ?>/assets/js/chart.js"></script>
        
        <script src="<?= base_url(); ?>/assets/html5-editor/bootstrap-wysihtml5.js"></script>
        <script src="<?= base_url(); ?>/assets/html5-editor/wysihtml5-0.3.0.js"></script>
        <script src="<?= base_url(); ?>/assets/datetimepicker/js/moment.js"></script>
        <script src="<?= base_url(); ?>/assets/datetimepicker/js/bootstrap-datetimepicker.js"></script>

    </body>


</html>
<script type="text/javascript">

    $("img").mousedown(function(){
        return false;
    });

    function get_url_1( dataurl ){
        $.ajax({
            type: 'GET',
            url: '<?= base_url() ?>dashboard/cek_session',
            success: function(result) {
                if( result != 'login' ){
                    Swal.fire(
                        'SESION HABIS!',
                        'silahkan login kembali.',
                        'warning'
                    );
                    setInterval(function(){
                        location.reload();
                    }, 2000);
                }else{
                    get_url_2( dataurl );
                }
            }
        });
    }
  
    function get_url_2( dataurl ) {
        if( dataurl != null && dataurl != '' ){
            $.cookie('url', dataurl);
            $.ajax({
                type: 'GET',
                url: '<?= base_url() ?>' + dataurl,
                success: function(data) {
                    $('#content-load').html(data);
                    $('#navigation').slideToggle(300);
                }
            });
        }
    }

    function formatNumber(num) { // rupiah with comas
        if (num >= 0) {
            if(num.toString().indexOf('.') !== -1) {
                var coma = roundToTwo(num).toString().split('.');
                var new_coma = numtocurr(coma[0]);
                var new_coma2= '';
                if (coma[1] !== undefined && coma[1].length === 1) {
                    new_coma2= coma[1]+'0';
                }
                else if (coma[1] === undefined) {
                    new_coma2= '00';
                }
                else {
                    new_coma2= coma[1];
                }
                if (new_coma2 === '00') {
                    return new_coma;
                }else{
                    var new_num  = new_coma+','+new_coma2;
                    return new_num;    
                }
                
            } else {
                return numtocurr(num);
            }
        } 
        if (num < 0) {
            if(Math.abs(num).toString().indexOf('.') !== -1) {
                var coma = roundToTwo(num).toString().split('.');
                var new_coma = numtocurr(coma[0]);
                var new_coma2= '';
                
                if (((coma[1] !== undefined)?coma[1]:'0').length === 1) {
                    new_coma2= ((coma[1] !== undefined)?coma[1]:'0')+'0';
                } else {
                    new_coma2= coma[1];
                }
                var new_num  = new_coma+','+new_coma2;
                return '-'+new_num;
            } else {
                return '-'+numtocurr(num);
            }
        }
    }

    function roundToTwo(num) {    
        return +(Math.round(num + "e+2")  + "e-2");
    }

    function numtocurr(a){
        if (a !== null) {
            a=a.toString();       
            var b = a.replace(/[^\d\,]/g,'');
            var dump = b.split(',');
            var c = '';
            var lengthchar = dump[0].length;
            var j = 0;
            for (var i = lengthchar; i > 0; i--) {
                    j = j + 1;
                    if (((j % 3) == 1) && (j != 1)) {
                            c = dump[0].substr(i-1,1) + '.' + c;
                    } else {
                            c = dump[0].substr(i-1,1) + c;
                    }
            }
            
            if(dump.length>1){
                    if(dump[1].length>0){
                            c += ','+dump[1];
                    }else{
                            c += ',';
                    }
            }
            return c;
        } else {
            return '0';
        }
    }

</script>