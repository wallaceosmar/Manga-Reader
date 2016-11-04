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
 * @package Core\Functions\Url
 */

require_once ( CORE_CLASS_PATH . 'class.Url.php' );

/**
 * Return the url
 * 
 * @param string $path
 * @param boolean $https
 * @return string
 */
function base_url ($path, $https = false) {
    return Url::base_url($path, (bool) $https);
}

/**
 * Return the url of the content url
 * 
 * @global array $CFG
 * @param string $path
 * @param boolean $https
 * @return string
 */
function content_base_url ( $path = '/', $https = false ) {
    global $CFG;
    
    $url_parsed = parse_url(Url::base_url( $path, $https ));
    $url_parsed['host'] = ( ( isset ( $CFG['cdn'] ) && $CFG['cdn']->enabled ) ? $CFG['cdn']->url : '' ) . $url_parsed['host'];
    
    return unparse_url( $url_parsed );
}

/**
 * 
 * @param string $path
 * @param boolean $https
 * @return string
 */
function admin_base_url ( $path = '/', $https = false ) {
    return Url::base_url( '/mvc-admin/' . ltrim( $path, '/' ) , $https);
}

/**
 * 
 * @param string $path
 * @param boolean $https
 * @return string
 */
function admin_content_url ( $path = '/', $https = false ) {
    return Url::base_url($path, (boolean) $https);
}

/**
 * 
 * @param array $parsed_url
 * @return string
 */
function unparse_url($parsed_url) { 
    $scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : ''; 
    $host     = isset($parsed_url['host']) ? $parsed_url['host'] : ''; 
    $port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : ''; 
    $user     = isset($parsed_url['user']) ? $parsed_url['user'] : ''; 
    $pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : ''; 
    $pass     = ($user || $pass) ? "$pass@" : ''; 
    $path     = isset($parsed_url['path']) ? $parsed_url['path'] : ''; 
    $query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : ''; 
    $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : ''; 
    return "$scheme$user$pass$host$port$path$query$fragment"; 
}
