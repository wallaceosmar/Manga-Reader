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
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo isset( $title ) ? $title : 'Manga Reader (Alpha)';?></title>
        <!-- Bootstrap -->
        <link href="<?php echo base_content_url('/bootstrap/css/bootstrap.min.css');?>" type="text/css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo base_content_url('/font-awesome/css/font-awesome.min.css');?>" type="text/css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link href="<?php echo base_content_url('css/style.css');?>" type="text/css" rel="stylesheet">
        <?php template_header();?>
    </head>
    <body>
        
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url('/');?>"><?php echo isset( $title ) ? $title : 'Manga Reader (Alpha)';?></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php if( navbar_has_element() ):?>
                <ul class="nav navbar-nav">
                    <?php foreach( get_navbar() as $menuItem ):?>
                    <li<?php echo ( $menuItem->hasChilldren() )? ' class="dropdown"' : '';?>>
                        <a href="<?php echo $menuItem->url;?>" <?php echo ( $menuItem->hasChilldren() )? ' class="dropdown-toggle" data-toggle="dropdown"' : '';?>><?php echo $menuItem->title;?><?php if( $menuItem->hasChilldren() ):?> <b class="caret"></b><?php endif;?></a>
                        <?php if( $menuItem->hasChilldren() ):?>
                        <ul class="dropdown-menu">
                            <?php foreach( $menuItem->getChilldren() as $subItem ):?>
                            <li><a href="<?php echo $subItem->url;?>"><?php echo $subItem->title;?></a></li>
                            <?php endforeach;?>
                        </ul>
                        <?php endif;?>
                    </li>
                    <?php endforeach;?>
                </ul>
                <?php endif;?>
                <div class="col-sm-3 col-md-3 pull-right">
                    <form class="navbar-form" role="search" action="<?php echo base_url('search');?>" method="get" target="_top">
                        <div class="input-group">
                            <input type="text" class="form-control" autocomplete="off" placeholder="Search" name="q">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php if( menu_has_element('navbar-right') ):?>
                <ul class="nav navbar-nav navbar-right">
                    <?php foreach( get_menu('navbar-right') as $menuItem ):?>
                    <li<?php echo ( $menuItem->hasChilldren() )? ' class="dropdown"' : '';?>>
                        <a href="<?php echo $menuItem->url;?>" <?php echo ( $menuItem->hasChilldren() )? ' class="dropdown-toggle" data-toggle="dropdown"' : '';?>><?php echo $menuItem->title;?><?php if( $menuItem->hasChilldren() ):?> <b class="caret"></b><?php endif;?></a>
                        <?php if( $menuItem->hasChilldren() ):?>
                        <ul class="dropdown-menu">
                            <?php foreach( $menuItem->getChilldren() as $subItem ):?>
                            <li><a href="<?php echo $subItem->url;?>"><?php echo $subItem->title;?></a></li>
                            <?php endforeach;?>
                        </ul>
                        <?php endif;?>
                    </li>
                    <?php endforeach;?>
                </ul>
                <?php endif;?>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        
        <!-- Begin Banner -->
        <div class="container-fluid" style="margin: 0 0 20px 0;">
            <div class="row" id="banner-image">
                <img src="<?php echo base_url( sprintf( '/image/%s/banner.png?w=1900' , rand( 1, 6) ) );?>" style="max-height: 100%; max-width: 100%; width: 100%; height: auto;">
            </div>
        </div>
        <!-- End Banner -->
        
        <!-- Begin Container -->
        <div class="container">
            
            <!-- Begin Error -->
            <div class="row">
                <div class="col-lg-12 col-md-12" id="message-display"></div>
            </div>
            <!-- End Error -->
            
            <!-- BEGIN PAGE CONTENT -->