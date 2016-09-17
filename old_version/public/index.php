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

define('DEBUG_MODE', 'development');

if ( defined( 'DEBUG_MODE' ) ) {
    switch( DEBUG_MODE ) {
        case 'development':
            error_reporting (E_ALL );
            ini_set('display_errors', 1);
            break;
        case 'production':
            error_reporting( 0 );
            ini_set('display_errors', 0);
            break;
        default:
            exit('The emviroment is not configurate.');
    }
}

define('DS', DIRECTORY_SEPARATOR);
define('ABSPATH', dirname( dirname( __FILE__ ) ) . DS);

// 
require_once ( ABSPATH . 'core' . DS . 'load.php' );