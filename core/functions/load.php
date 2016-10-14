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

/**
 * Load the default constants.
 * 
 * @since 0.1
 */
function load_defaults_constants() {
    /**
     * 
     */
    require_once ( dirname ( dirname( __FILE__ ) ) . DS . 'includes' . DS . 'default-constants.php' );
}

/**
 * Load a default group of config
 * 
 * @global array $GLOBALS
 * @param type $load_name
 * @since 0.1
 * @throws Exception
 */
function load_defaults( $load_name ) {
    global $GLOBALS;
    
    if ( 'constants' === $load_name ) {
        return;
    }
    
    if ( ! file_exists ( $filepath = CORE_INCLUDES_PATH . 'default-' . $load_name . '.php' ) ) {
        throw new Exception( 'The default file not loaded', 0);
    }
    
    require_once ( $filepath );
}

/**
 * 
 * @global array $_core
 * @param string $load_name
 * @since 0.1
 * @throws Exception
 */
function load_group_functions ( $load_name ) {
    global $_core;
    
    if ( ! isset( $_core[ '_load_function_' . $load_name ] ) && $_core[ '_load_function_' . $load_name ]->loaded ) {
        return;
    }
    
    $load = new stdClass();
    
    if ( ! file_exists( $filepath = CORE_FUNCTIONS_PATH . 'fn.' . $load_name . '.php' ) ) {
        throw new Exception( '', '');
    }
    
    $load->filepath = $filepath;
    $load->name = $load_name;
    
    require_once ( $filepath );
    $load->loaded = TRUE;
    
    $_core[ '_load_function_' . $load_name ] = $load;
}

/**
 * 
 */
function load_tranlation_early() {
    
    require_once ( CORE_FUNCTIONS_PATH . 'i18n.php' );
    
    
}