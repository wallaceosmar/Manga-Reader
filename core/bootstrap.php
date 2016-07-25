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

spl_autoload_register(function ( $class_name ) {
    
    $filepath = false;
    
    if ( file_exists( $filepath = CORE_CLASS_PATH . "class.{$class_name}.php" ) ):
    elseif ( file_exists ( $filepath = CORE_CLASS_PATH . "trait.{$class_name}.php" ) ):
    elseif ( file_exists ( $filepath = CORE_ABSTRACT_PATH . "class.{$class_name}.php" ) ):
    elseif ( file_exists ( $filepath = CORE_INTERFACE_PATH . "class.{$class_name}.php" ) ):
    elseif ( file_exists ( $filepath = CORE_LIBRARY_PATH . "class.{$class_name}.php" ) ):
    elseif ( file_exists ( $filepath = APP_CONTROLLER_PATH . "class.{$class_name}.php" ) ):
    elseif ( file_exists ( $filepath = APP_MODELS_PATH . "class.{$class_name}.php" ) ):
    elseif ( file_exists ( $filepath = APP_ABSTRACT_PATH . "class.{$class_name}.php" ) ):
    else:
        $filepath = false;
    endif;
    
    if ( $filepath ) {
        require_once ( $filepath );
    }
    
});