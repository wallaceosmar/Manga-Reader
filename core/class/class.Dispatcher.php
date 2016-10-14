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
 * Description of Dispatcher
 *
 * @author Wallace Osmar <wallace.osmar@r7.com>
 */
class Dispatcher {
    
    /**
     *
     * @var Routing 
     */
    public $routing;
    
    /**
     *
     * @var array 
     */
    private $matches;
    
    /**
     *
     * @var string 
     */
    private $separator = '@';
    
    /**
     *
     * @var string 
     */
    private $plataformSeparator = ':';
    
    /**
     *
     * @var type 
     */
    private $template = null;
    
    /*
     * 
     */
    private $notAllowedTemplate = array(
        'admin'
    );
    
    /**
     * 
     * @param Routing $routing
     */
    public function __construct( Routing &$routing ) {
        $this->routing = $routing;
    }
    
    public function run() {
        
        if ( ! ( $this->matches = $this->routing->match( Url::get_base_uri() ) ) ) {
            throw new Exception( __( 'Não foi encontrado um mapeamento de url.' ), '4501' );
        }
        
        if ( is_string( $this->matches['target'] ) ) {
            $this->_parse_target();
        }
        
        $this->callback();
    }
    
    private function callback() {
        $params_new = array();
        $params_old = $this->matches['params'];
        // Verifica se é uma função
        if ( is_callable( $this->matches['target'] ) ) {
            $reflection = new ReflectionFunction( $this->matches['target'] );
            $callable = $this->matches['target'];
        } else {
            define( 'PLATAFORM_NAME', $this->matches['target']['plataform'] );
            $_method = strtolower($this->matches['request']);
            if ( class_exists( "{$this->matches['target']['controller']}Controller" ) ) {
                $controllerName = $this->matches['target']['controller'];
            } else {
                $controllerName = '';
            }
            // Set the name of controller
            $controllerName = "{$controllerName}Controller";
            // Set the name of action
            $methodName = $this->matches['target']['action'];
            try {
                // Construir a classe controller
                $dispatch = new $controllerName();
                // Verifica se a funcão com o metodo any existe
                if ( method_exists ( $controllerName, $methodName . '_any' ) ) {
                    $methodName .= '_any';
                } elseif ( method_exists ( $controllerName, $methodName . '_' . $_method ) ) {
                    $methodName .= '_' . $_method;
                } else {
                    $methodName = '_404';
                }
                // we need to reference the parameters to a correct order in order to match the arguments order 
                
                $reflectionController = new ReflectionClass($controllerName);
                // 
                $reflection = $reflectionController->getMethod($methodName);
                
                $callable = array( $dispatch, $methodName );
            } catch (Exception $ex) {
                throw $ex;
            }
            
        }
        
        $reflectionParameters = $reflection->getParameters();
        for( $i = 0; $i < count( $reflectionParameters ); $i++ ) {
            $key = $reflectionParameters[$i]->getName();
            if( array_key_exists( $key, $params_old ) ){
                $params_new[$i] = $params_old[$key];
                unset( $params_old[$key] );
            } else {
                $params_new[$i] = null;
            }
        }
        // after reorder, merge the leftovers
        $params_new = array_merge($params_new, $params_old);
        
        $this->template = get_instance('template');
        $path = ( defined ( 'TEMPLATE_NAME_FOLDER' ) ? TEMPLATE_NAME_FOLDER : 'default' ) . DS;
        if ( ! empty( $this->matches['target']['plataform'] ) ) {
            if ( in_array( $this->matches['target']['plataform'], $this->notAllowedTemplate) ) {
                $path = '';
            }
            $path = '_' . $this->matches['target']['plataform'] . DS . $path;
        }
        $this->template->setTemplateDir( APP_VIEWS_PATH . $path );
        // call the action method
        call_user_func_array(
            $callable,
            $params_new
        );
        
        return TRUE;
    }
    
    private function _parse_target() {
        
        if ( ! preg_match( '/^((?P<plataform>[a-zA-Z\\*_-]+)\\' . $this->plataformSeparator . ')?(?P<controller>[a-zA-Z\\*_-]+)\\' . $this->separator . '(?P<action>[a-zA-Z-\\*_]+)$/', $this->matches['target'], $matches ) ) {
            throw new Exception( 'não é valido o target' );
        }
        
        if ( empty( $plataform = $matches['plataform'] ) ) {
            $plataform = null;
        }
        
        if ( '*' === ( $controller = $matches['controller'] ) ) {
            $controller = $this->matches['params']['controller'];
            unset( $this->matches['params']['controller'] );
        }
        
        if ( '*' === ( $methodName = $matches['action'] ) ) {
            $methodName = $this->matches['params']['action'];
            unset( $this->matches['params']['action'] );
        }
        
        $this->matches['target'] = array_merge(array(
            'plataform' => $plataform,
            'controller' => $controller,
            'action' => $methodName,
        ));
    }
    
}
