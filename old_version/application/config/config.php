<?php

register_load_group_functions(array(
    'menu','option','user'
));

define('USED_DB', TRUE);
define('DB_HOST', 'localhost');
define('DB_USER', 'MangaReader');
define('DB_NAME', 'manga-reader');
define('DB_PWDB', 'mangareader');

define('UPLOAD_MANGA', ABSPATH . 'public' . DS . 'uploads' . DS . 'manga');
define('UPLOAD_COVER', ABSPATH . 'public' . DS . 'uploads' . DS . 'cover');

// Routing the image files.
Routing::get('/image/compressed/<slugname>/cover.jpg', array('controller' => 'Image', 'action' => 'cover'));
Routing::get('/image/compressed/<slugname>/<chapter>/<pagenumber>.jpg', array('controller' => 'Image', 'action' => 'manga'));
Routing::get('/image/<number>/banner.png', array('controller' => 'Image', 'action' => 'banner'));
// If you want to develop a mobile application.
Routing::get('/api/<controller>/<slug>/<chapter>(/)?',array('plataform' => 'api','action' => 'chapter'));
Routing::get('/api/<controller>/<slug>(/)?',array('plataform' => 'api','action' => 'manga'));
Routing::get('/api/<controller>(/)?',array('plataform' => 'api'));
Routing::get('/api(/)?',array('plataform' => 'api', 'controller' => 'manga' ));
// Administração.
Routing::add(array('get','post'), '/admin/', array('plataform' => 'admin', 'controller' => 'Dashbord' ));
Routing::map('/admin/(.*)?', function(){
    if ( ! is_logged() ) {
        //header('Location: ' . base_url('/login'));
    }
});
// The pages
Routing::get('/manga/<slugname>/<chapter>(/(<pagenumber>(/)?)?)?', array( 'controller' => 'manga', 'action' => 'read'));
Routing::get('/manga/<slugname>(/)?', array('controller' => 'manga', 'action' => 'index'));
Routing::get('/<controller>/<action>/<filter>/<name>(/<pagination>)?');
Routing::get('/<controller>/(<action>(/<pagination>(/)?)?)?');
Routing::get('/(<action>)?',array('controller' => 'index'));

// Menu de Usuario
if ( ! is_logged() ) {
    add_menu('navbar-right', sprintf( '<i class="fa fa-sign-in"></i>  %s' , __('Login')), base_url('/login'));
    add_menu('navbar-right', sprintf( '<i class="fa fa-user"></i>  %s', __('Registrar-se')), base_url('/register'));
} else {
    $user = add_menu('navbar-right', sprintf( '<i class="fa fa-user"></i> ' . __('Bem vindo %s') , ''), base_url('/register'));
    $user->add( __('Perfil'), base_url('/user/profile'));
    if ( user_can('dashbord') ) {
        $user->add( __('Dashbord'), base_url('/admin/'));
    }
    $user->add( __('Adicionar Manga'), base_url('/manga/add-manga'));
    $user->add( __('Adicionar Capitulo'), base_url('/manga/add-chapter'));
    $user->add( __('Sair'), base_url('/auth/logout'));
}

// 
add_navbar( __('Home'), base_url( '/' ));
// Criando menu Read Manga
$readManga = add_navbar( __('Ler Manga'), base_url('#'));
$readManga->add( __('Lista de manga'), base_url('/pages/manga-list'));
$readManga->add( __('Mangas populares'), base_url('/pages/manga-popular'));
$readManga->add( __('Recentemente Atualizado'), base_url('/pages/recent-updates'));