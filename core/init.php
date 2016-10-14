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
 * 
 */
global $_core, $_app;
//
require_once ( dirname ( __FILE__ ) . DS . 'functions' . DS . 'load.php' );
// Primary Load
load_defaults_constants();
// A file how load the class need to use
require_once ( CORE_PATH . 'bootstrap.php' );
// Carrega as traduçoes
load_tranlation_early();
// Carrega as variaveis defaults.
load_defaults('variables');
// 
load_defaults('functions');

if ( ! file_exists ( APP_CONFIG_PATH . 'config.php' ) ) {
    throw new Exception( '', '4000' );
}

require_once ( APP_CONFIG_PATH . 'config.php' );

// Carrega o mapeamento de url
if ( file_exists( APP_CONFIG_PATH . 'routing.php' ) ) {
    require_once ( APP_CONFIG_PATH . 'routing.php' );
}

// Start
$_dispatch->run();