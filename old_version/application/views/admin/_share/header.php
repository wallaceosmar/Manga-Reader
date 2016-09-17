<?php

/* 
 * The MIT License
 *
 * Copyright 2016 Wallace Osmar https://github.com/wallaceosmar.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo sprintf( '%s %s', $title, CONTROLLER ) ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo base_content_url('AdminLTE/bootstrap/css/bootstrap.min.css');?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_content_url('font-awesome/css/font-awesome.min.css')?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_content_url('AdminLTE/css/AdminLTE.min.css');?>">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
                page. However, you can choose any other skin. Make sure you
                apply the skin class to the body tag so the changes take effect.
        -->
        <link rel="stylesheet" href="<?php echo base_content_url('AdminLTE/css/skins/skin-blue.min.css')?>">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        
        <!-- Wrapper -->
        <div class="wrapper">
        
            <!-- Main Header -->
            <header class="main-header">
                
                <!-- Logo -->
                <a href="<?php echo base_url_admin('/')?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>M</b>R</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Manga</b>Reader</span>
                </a>
                <!-- /.logo -->
                
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="<?php echo user_info('icon');?>" class="user-image" alt="User Image">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs"><?php echo user_info('username');?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <img src="<?php echo user_info('icon');?>" class="img-circle" alt="User Image">
                                        <p>
                                            <?php echo user_info('username');?>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-body">
                                      <div class="row">
                                        <div class="col-xs-4 text-center">
                                          <a href="#">Followers</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                          <a href="#">Sales</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                          <a href="#">Friends</a>
                                        </div>
                                      </div>
                                      <!-- /.row -->
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                      <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                      </div>
                                      <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                      </div>
                                    </li>
                                </ul>
                            </li>
                            
                        </ul>
                    </div>
                    
                </nav>
                <!-- /.navbar -->
                
            </header>
            <!-- /.main-header -->

            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar"></aside>
            <!-- /.main-sidebar -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper"></div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <footer class="main-footer"></footer>
            <!-- /.main-Footer -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark"></aside>
            <!-- /.control-sidebar -->

            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        
        </div>
        <!-- /.wrapper -->
        <!-- jQuery 2.2.3 -->
        <script src="<?php echo base_content_url('jQuery/jquery-2.2.3.min.js');?>"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo base_content_url('AdminLTE/bootstrap/js/bootstrap.min.js')?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_content_url('AdminLTE/js/app.min.js');?>"></script>
    </body>
</html>