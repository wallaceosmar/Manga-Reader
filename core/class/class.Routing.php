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
 * Description of Routing
 *
 * @author Wallace Osmar https://github.com/wallaceosmar
 */
class Routing {
    
    /**
     *
     * @var array 
     */
    protected static $routing = array();
    
    /**
     *
     * @var array 
     */
    protected static $mapping = array();
    
    /**
     *
     * @var array 
     */
    protected static $_router_encouter = array(
        'plataform' => NULL,
        'controller' => NULL,
        'action' => 'index'
    );
    
    /**
     *
     * @var array 
     */
    protected static $params = array(
        'lang' => '[a-z]{2}', // regex url parametr <lang>
        'controller' => '[\w-_]+',
        'action' => '[\w-_]+',
        'page' => '[a-z0-9_\-]{5,25}',
        'pagination' => '[0-9]{1,2}', 
        'year' => '[0-9]{4}',
        'month' => '[0-9]{2}',
        'day' => '[0-9]{1,2}',
        'id' => '[0-9]+'
    );
    
    /**
     * 
     * 
     * @param string|array $methods
     * @param string $url
     * @param array $cond
     */
    public static function add( $methods, $url, $cond = array() ) {
        foreach ( (array) $methods as $method ) {
            self::$routing[ $method ][ $url ] = array_merge(
                array(
                    'plataform' => NULL,
                    'controller' => NULL,
                    'action' => 'index'
                ),
                $cond
            );
        }
    }
    
    public static function get( $url, $cond = array() ) {
        self::add( 'GET', $url, $cond);
    }
    
    public static function post ( ) {
        self::add('POST', $url, $cond);
    }
    
    /**
     * 
     * @param type $uri
     * @return boolean
     */
    public static function find ( $uri ) {
        if ( ! empty( $uri ) && isset ( self::$routing[ $_SERVER['REQUEST_METHOD'] ] ) ) {
            // Mapeia a a uri e verifica se
            foreach ( self::$mapping as $urlMapping => $mappingFunction ) {
                $urlMapping = preg_replace_callback(
                    "/\<(?<key>[0-9a-z_]+)\>/",
                    'self::__call_replace',
                    str_replace( ")", ")?" , $urlMapping )
                );
                if ( preg_match ( "#^{$urlMapping}$#" , $uri ) ) {
                    call_user_func( $mappingFunction );
                    break;
                }
                continue;
            }
            // Inicia o mapeamento dos controllers e dos metodos
            foreach ( self::$routing[ $_SERVER['REQUEST_METHOD'] ] as $url => $value ) {
                $url = preg_replace_callback(
                    "/\<(?<key>[0-9a-z_]+)\>/",
                    'self::__call_replace',
                    str_replace( ")", ")?" , $url )
                );
                if ( preg_match ( "#^{$url}$#" , $uri , $matches ) ) {
                    self::$_router_encouter = array_merge( $value, $matches, array('_uri' => $uri, '_uri_regex' => $url));
                    return TRUE;
                }
            }
        }
        return FALSE;
    }
    
    public static function dispath( $uri ) {
        // Procura se a uri passada foi mapeada.
        if ( '' == $uri ) {
            throw new Exception('O Parametro não pode ser vazio');
        }
        self::find($uri);
        
        foreach( self::$_router_encouter as $key => $value ) {
            if ( is_integer( $key ) ) {
                continue;
            }
            switch( $key ) {
                case 'controller':
                    $controllerName = str_replace( '-', '_', $value);
                    break;
                case 'action':
                    $methodName = str_replace( '-', '_', $value);
                    break;
                case 'plataform':
                    $plataform = self::$_router_encouter['plataform'];
                    break;
                default :
                    if ( isset ( $_REQUEST[ $key ] ) ) {
                        $_REQUEST["_{$key}_"] = $value;
                    } else {
                        $_REQUEST[ $key ] = $value;
                    }
                    
            }
        }
        
        define( 'PLATAFORM', $plataform );
        define( 'CURR_CONTROLLER_PATH', APP_CONTROLLER_PATH . ( is_null ( $plataform ) ? "" : "{$plataform}" . DS ) );
        define( 'CURR_VIEW_PATH', APP_VIEWS_PATH . ( is_null ( $plataform ) ? "" : "{$plataform}" . DS ) );
        
        $controllerName = "{$controllerName}Controller";
        
        try {
            // Construir a classe controller
            $dispatch = new $controllerName();
            // 
            $methodName = $methodName . '_' . strtolower($_SERVER['REQUEST_METHOD']);
            // Se o metodo não existir
            if ( ! method_exists( $controllerName, $methodName ) ) {
                $methodName = '_404';
            }
            // we need to reference the parameters to a correct order in order to match the arguments order 
            // of the calling function
            $reflectionController = new ReflectionClass($controllerName);
            // 
            $reflectionFunction = $reflectionController->getMethod($methodName);
            // 
            $reflectionParameters = $reflectionFunction->getParameters();
            // 
            $params_new = array();
            $params_old = $_REQUEST;
            // re-map the parameters
            for( $i = 0; $i < count( $reflectionParameters ); $i++ ) {
                $key = $reflectionParameters[$i]->getName();
                if( array_key_exists( $key, $params_old ) ){
                    $params_new[$i] = $params_old[$key];
                    unset( $params_old[$key] );
                }
            }
            // after reorder, merge the leftovers
            $params_new = array_merge($params_new, $params_old);
            // call the action method
            call_user_func_array(
                array( $dispatch, $methodName),
                $params_new
            );
        } catch ( ReflectionException $ex ){
            Error::show($ex->getCode(), $ex->getMessage(),array('title'=>'Error on ReflectionClass!'));
        } catch (Exception $ex) {
            Error::show($ex->getCode(), $ex->getMessage());
        }
        exit;
    }
    
    public static function has_routing() {
        if ( isset ( self::$routing ) && count( self::$routing ) > 0 ) {
            return TRUE;
        }
        return FALSE;
    }
    
    /**
     * 
     * @param type $matches
     * @return type
     */
    private static function __call_replace ( $matches ) {
        if( isset( self::$params[ $matches['key'] ] ) ) { 
            return "(?<" . $matches['key'] . ">". self::$params[ $matches['key'] ] . ")"; 
        }
        return "(?<" . $matches['key'] . ">" . "([^/]+)" . ")";
    }
    
}