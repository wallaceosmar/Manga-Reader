<?php if ( ! defined( 'ABSPATH' ) ) { exit; }

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
 * @package Core\Functions\Routing
 */

/**
 * 
 * @global Routing $_routing
 * @param String $route
 * @param string|callable $target
 * @param string $name
 */
function routing_get( $route, $target, $name = null ) {
    global $_routing;
    
    $_routing->map('GET', $route, $target, $name );
}

/**
 * 
 * @global Routing $_routing
 * @param string $route
 * @param string|callable $target
 * @param string $name
 */
function routing_post($route, $target, $name = null) {
    global $_routing;
    
    $_routing->map('POST', $route, $target, $name);
}

/**
 * 
 * @global Routing $_routing
 * @param string $method
 * @param string $route
 * @param string|callable $target
 * @param string $name
 */
function routing_map($method, $route, $target, $name = null) {
    global $_routing;
    
    $_routing->map($method, $route, $target, $name);
}

/**
 * 
 * @global Routing $_routing
 * @param string $routeName
 * @param array $params
 */
function routing_generate($routeName, $params = array()) {
    global $_routing;
    
    if ( func_num_args() > 2 ) {
        $params = func_get_args();
    }
    
    return $_routing->generate($routeName, $params);
}

/**
 * 
 * @global Routing $_routing
 * @param string $basePath
 */
function routing_setBasePath($basePath) {
    global $_routing;
    
    $_routing->setbasePath($basePath);
}