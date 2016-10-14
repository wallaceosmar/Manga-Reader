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
 * Load the Core Class Application
 */
spl_autoload_register(function ( $class ){
    if ( file_exists( $filename = CORE_CLASS_PATH . __NAMESPACE__ . "class.{$class}.php" ) ):
    elseif ( ! file_exists( $filename = CORE_CLASS_PATH . $class . DS . __NAMESPACE__ . $class . '.class.php' ) ):
        return false;
    endif;
    
    require_once ( $filename );
    return TRUE;
});

/**
 * Load
 */
spl_autoload_register( function ( $class ){
    if ( ! file_exists( $filename = CORE_TRAIT_PATH . __NAMESPACE__ . "trait.{$class}.php" ) ):
        return false;
    endif;
    
    require_once ( $filename );
    return TRUE;
});

/**
 * Load the Controller Class Application
 */
spl_autoload_register( function ( $class ){
    
    if( ! file_exists( $filename = APP_CONTROLLER_PATH . ( defined( 'PLATAFORM_NAME' ) ? PLATAFORM_NAME . DS : '' ) . __NAMESPACE__ . "class.{$class}.php" ) ):
        return false;
    endif;
    
    require_once ( $filename );
    return TRUE;
});

/**
 * Load the Models Class Application
 */
spl_autoload_register( function ( $class ){
    
    if ( ! file_exists( $filename = APP_MODELS_PATH . __NAMESPACE__ . "class.{$class}.php" ) ) {
        return false;
    }
    
    require_once ( $filename );
    return TRUE;
});

/**
 * Load the Entity Class Application
 */
spl_autoload_register( function ( $class ){
    
    if ( ! file_exists( $filename = APP_ENTITY_PATH . __NAMESPACE__ . "class.{$class}.php" ) ):
        return false;
    endif;
    
    require_once ( $filename );
    return TRUE;
});