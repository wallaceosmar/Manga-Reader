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
 * Description of Url
 *
 * @author Wallace Osmar <wallace.osmar@r7.com>
 */
class Url {
    
    /**
     * 
     * @param string $path
     * @return string
     */
    public static function base_url( $path = '/' , $https = false ) {

        if ( isset($_SERVER['HTTP_HOST']) ) {
            $http = ( Url::is_ssl() || $https )? 'https' : 'http';
            $dir =  str_replace( basename( $_SERVER['SCRIPT_NAME'] ) , '', $_SERVER['SCRIPT_NAME'] );
            $base_url = sprintf( "%s://%s%s" , $http, $_SERVER['HTTP_HOST'], dirname( $dir ) . '/' );
        } else {
            $base_url = 'http://localhost/';
        }
        return rtrim( $base_url, '\\/' ) . '/' . ltrim( $path , '/');
    }
    
    public static function getBaseUrl() {
        
        $currentPath = $_SERVER['PHP_SELF'];
        // Supress the path_info for a more accurate base url.
        if ( isset ( $_SERVER['PATH_INFO'] ) ) {
            $currentPath = str_replace( $_SERVER['PATH_INFO'], '', $currentPath);
        }
        $http = ( Url::is_ssl() )? 'https' : 'http';
        $pathInfo = pathinfo($currentPath);
    
        return sprintf('%s://%s%s', $http, $_SERVER['HTTP_HOST'], rtrim( $pathInfo['dirname'], '\\' ) . '/' );
    }
    
    /**
     * 
     * @return string
     */
    public static function guess_url () {
        if ( defined ( 'MVC_SITE_URL' ) && '' != MVC_SITE_URL ) {
            $url = MVC_SITE;
        } else {
            $abspath_fix = str_replace( '\\', '/', ABSPATH );
            $script_filename_dir = dirname( dirname( $_SERVER['SCRIPT_FILENAME'] ) );
            
            if ( $script_filename_dir . '/' == $abspath_fix ) {
                // Strip off any file/query params in the path
                $path = preg_replace( '#/[^/]*$#i', '', $_SERVER['PHP_SELF'] );
            } else {
                if ( false !== strpos( $_SERVER['SCRIPT_FILENAME'], $abspath_fix ) ) {
                    // Request is hitting a file inside ABSPATH
                    $directory = str_replace( ABSPATH, '', $script_filename_dir );
                    // Strip off the sub directory, and any file/query params
                    $path = preg_replace( '#/' . preg_quote( $directory, '#' ) . '/[^/]*$#i', '' , $_SERVER['REQUEST_URI'] );
                } elseif ( false !== strpos( $abspath_fix, $script_filename_dir ) ) {
                    // Request is hitting a file above ABSPATH
                    $subdirectory = substr( $abspath_fix, strpos( $abspath_fix, $script_filename_dir ) + strlen( $script_filename_dir ) );
                    // Strip off any file/query params from the path, appending the sub directory to the install
                    $path = preg_replace( '#/[^/]*$#i', '' , $_SERVER['REQUEST_URI'] ) . $subdirectory;
                } else {
                    $path = $_SERVER['REQUEST_URI'];
                }
            }
            $schema = Routing::is_ssl() ? 'https://' : 'http://';
            $url = $schema . $_SERVER['HTTP_HOST'] . $path;
            
        }
        return rtrim($url, '/');
    }
    
    /**
     * Verifica se a request é uma requisição https.
     * 
     * @return boolean
     */
    public static function is_ssl() {
        if ( isset($_SERVER['HTTPS']) ) {
            if ( 'on' == strtolower($_SERVER['HTTPS']) )
                return true;
            if ( '1' == $_SERVER['HTTPS'] )
                return true;
        } elseif ( isset($_SERVER['SERVER_PORT']) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
            return true;
        }
        return false;
    }
    
    /**
     * 
     * @return string
     */
    public static function get_base_uri() {
        $script_name = dirname( dirname( $_SERVER['SCRIPT_NAME'] ) );
        $request_uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        
        if ( '/' == $script_name ) {
            $uri = $request_uri;
        } elseif ( strpos($_SERVER['REQUEST_URI'], $script_name) !== false ) {
            $uri = str_replace( $script_name , '', $request_uri);
        } elseif ( strpos( $_SERVER['REQUEST_URI'], strtolower( $script_name )) !== false ) {
            $uri = str_replace( strtolower( $script_name ) , '', $request_uri);
        } else {
            $uri = $request_uri;
        }
        
        return '/' . ltrim( $uri , '/' );
    }
    
}
