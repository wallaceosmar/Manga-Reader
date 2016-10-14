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

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Variavel onde sera armazenado um array contendo as instancias das classes.
 * 
 * @global array $GLOBALS['_instance']
 * @name $_instance 
 */
$GLOBALS['_instance'] = array();

require_once ( ABSPATH . 'core' . DS . 'function' . DS . 'load.php' );

// Carrega as constantes usadas pelo core da aplicação
load_default_constants();

// Registra a função de autoload.
require_once ( CORE_PATH . 'bootstrap.php' );


// Carrega o modulo de tradução
load_translation();

// Carrega as funcóes e variaveis por default.
require_once ( CORE_INCLUDES_PATH . 'default-variables.php' );
require_once ( CORE_INCLUDES_PATH . 'default-functions.php' );

if ( ! file_exists( $configfilename = APP_CONFIG_PATH . 'config.php' ) ) {
    Error::show( 404, sprintf( __( 'O arquivo <code>%s</code> não foi encontrado!' ) , 'config.php' ) );
}
require_once ( $configfilename );

// Arquivo routing onde pode ser adicionadas novos mapeamentos de rotas na url.
if ( file_exists( $routingfilename = APP_CONFIG_PATH . 'routing.php' ) ) {
    require_once ( $routingfilename );
}

// Verifica se ha alguma rota
if ( ! Routing::has_routing() ) {
    Error::show( 404, sprintf( __('Nehuma <code>%s</code> foi encontrada!'), 'Routing' ) );
}

Routing::dispath( Url::get_base_uri() );