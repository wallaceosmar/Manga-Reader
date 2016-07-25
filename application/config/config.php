<?php

register_load_group_functions(array(
    'menu'
),TRUE);

if ( ! defined('TEMPLATE_VIEW_PAGE') ) {
    define('TEMPLATE_VIEW_PAGE', 'theme-default');
}

// Routing the image files.
Routing::get('/image/compressed/<slugname>/cover.jpg', array('controller' => 'Image', 'action' => 'cover'));
Routing::get('/image/compressed/<slugname>/<chapter>/<pagenumber>.jpg', array('controller' => 'Image', 'action' => 'image'));
Routing::get('/image/<number>/banner.png', array('controller' => 'Image', 'action' => 'banner'));
// If you want to develop a mobile application.
Routing::get('/api/<controller>/<slug>/<chapter>(/)?',array('plataform' => 'api','action' => 'chapter'));
Routing::get('/api/<controller>/<slug>(/)?',array('plataform' => 'api','action' => 'manga'));
Routing::get('/api/<controller>(/)?',array('plataform' => 'api'));
Routing::get('/api(/)?',array('plataform' => 'api', 'controller' => 'manga' ));
// Administração.
Routing::add(array('get','post'), '/admin/<controller>(/)?', array('plataforma' => 'admin'));
// The page
Routing::get('/manga/<slug>/<chapter>(/(<pagenumber>(/)?)?)?', array( 'plataform' => 'theme-default', 'controller' => 'manga', 'action' => 'read'));
Routing::get('/manga/<slug>(/)?', array('controller' => 'manga', 'action' => 'manga'));
Routing::get('/<controller>/<action>/<filter>/<name>(/<pagination>)?');
Routing::get('/<controller>/(<action>(/<pagination>(/)?)?)?');
Routing::get('/(<action>)?',array('controller' => 'index'));

add_menu('navbar-right', sprintf( '<i class="fa fa-sign-in"></i>  %s' , __('Login')), base_url('/login'));
add_menu('navbar-right', sprintf( '<i class="fa fa-user"></i>  %s', __('Registrar-se')), base_url('/register'));

// 
add_navbar( __('Home'), base_url( '/' ));
// Criando menu Read Manga
$readManga = add_navbar( __('Ler Manga'), base_url('#'));
$readManga->add( __('Lista de manga'), base_url('/pages/manga-list'));
$readManga->add( __('Mangas populares'), base_url('/pages/manga-popular'));
$readManga->add( __('Recentemente Atualizado'), base_url('/pages/recent-updates'));