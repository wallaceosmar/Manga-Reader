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
 * 
 * @author Wallace Osmar <wallace.osmar@r7.com>
 * @staticvar boolean $loaded
 * @return null
 */
function load_default_constants() {
    
    static $loaded = false;
    if ( $loaded ) {
        return NULL;
    }
    $loaded = true;
    
    require_once ( ABSPATH . 'core' . DS . 'includes' . DS . 'default-constants.php' );
    require_once ( CORE_INCLUDES_PATH . 'version.php' );
    
    return null;
}

/**
 * 
 * @global array $_load
 * @param string $goupname
 * @param boolean $instantload
 * @return boolean
 */
function register_load_group_functions ( $goupnames ) {
    global $_load;
    
    if ( ! is_array( $_load[ '_function' ] ) ) {
        $_load[ '_function' ] = array();
    }
    
    foreach ( (array) $goupnames as $goupname ) {
        
        if ( ! in_array( $goupname, $_load[ '_function' ] ) ) {
            $goupname = strtolower($goupname);
            if ( file_exists( $filename = sprintf( '%s%s.php', CORE_FUNCTION_PATH, $goupname ) ) ) {
                require_once ( $filename );
                array_push($_load[ '_function' ], $goupname);
            }
        }
        
        continue;
    }
}

function load_translation () {
    static $loaded = false;
    if ( $loaded ) {
        return NULL;
    }
    $loaded = true;
    
    register_load_group_functions('i18n');
}