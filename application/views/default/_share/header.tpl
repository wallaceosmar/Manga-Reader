<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{if (isset($title))}{$title}{else}Manga Reader{/if}</title>
        <!-- Bootstrap -->
        <link href="{'/css/custom-bootstrap.min.css'|content_base_url}" type="text/css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{'/css/font-awesome.min.css'|content_base_url}" type="text/css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link href="{'/css/style.min.css'|content_base_url}" type="text/css" rel="stylesheet">
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
                <a class="navbar-brand" href="{'/'|base_url}">{'Manga Reader (Alpha)'|__}</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                {if navbar_has_element() }
                <ul class="nav navbar-nav">
                {foreach get_navbar() as $menuItem }
                    <li{if $menuItem->hasChilldren()} class='dropdown'{/if}>
                        <a href="{$menuItem->url}"{if $menuItem->hasChilldren()} class="dropdown-toggle" data-toggle="dropdown"{/if}>{$menuItem->title}{if $menuItem->hasChilldren()} <b class="caret"></b>{/if}</a>
                        {if $menuItem->hasChilldren()}
                        <ul class="dropdown-menu">
                            {foreach $menuItem->getChilldren() as $subItem }
                            <li><a href="{$subItem->url}">{$subItem->title}</a></li>
                            {/foreach}
                        </ul>
                        {/if}
                    </li>
                {/foreach}
                </ul>
                {/if}
                <div class="col-sm-3 col-md-3 pull-right">
                    <form class="navbar-form" role="search" action="{'search'|base_url}" method="get" target="_top">
                        <div class="input-group">
                            <input type="text" class="form-control" autocomplete="off" placeholder="{'Search'}" name="q">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                {if menu_has_element('navbar-right')}
                <ul class="nav navbar-nav navbar-right">
                    {foreach get_menu('navbar-right') as $menuItem }
                    <li{if $menuItem->hasChilldren()} class="dropdown"{/if}>
                        <a href="{$menuItem->url}" {if $menuItem->hasChilldren()} class="dropdown-toggle" data-toggle="dropdown"{/if}>{$menuItem->title}{if $menuItem->hasChilldren()} <b class="caret"></b>{/if}</a>
                        {if $menuItem->hasChilldren()}
                        <ul class="dropdown-menu">
                            {foreach $menuItem->getChilldren() as $subItem }
                            <li><a href="{$subItem->url}">{$subItem->title}</a></li>
                            {/foreach}
                        </ul>
                        {/if}
                    </li>
                    {/foreach}
                </ul>
                {/if}
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        
        <!-- Begin Banner -->
        <div class="container-fluid" style="margin: 0 0 20px 0;">
            <div class="row" id="banner-image">
                <img src="{'/img/banner/%s.png'|content_base_url|sprintf:rand(1,6)}" style="max-height: 100%; max-width: 100%; width: 100%; height: auto;">
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