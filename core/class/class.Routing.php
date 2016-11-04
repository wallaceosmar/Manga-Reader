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
 * @author Wallace Osmar <wallace.osmar@r7.com>
 * @package Core\Class
 */
class Routing {
    
    /**
     * Array contendo todas as routes.
     * 
     * @var array
     */
    protected $routes = array();
    
    /**
     * 
     * 
     * @var string 
     */
    protected $basePath = '';
    
    /**
     * Armazena o nome das rotas adicionadas para serem usadas para o metodo generate
     * 
     * @see generate
     * @var array 
     */
    protected $namedRoutes = array();
    
    /**
     * Expressoes regulares a serem verificadas.
     * 
     * @var array 
     */
    protected $regexMatch = array(
        'f'  => '[0-9\.]++',
        'i'  => '[0-9]++',
        'a'  => '[0-9A-Za-z]++',
        's'  => '[A-Za-z]++',
        's*'  => '[A-Za-z+-]++',
        'h'  => '[0-9A-Fa-f]++',
        '*'  => '.+?',
        '**' => '.++',
        ''   => '[^/\.]++',
    );
    
    /**
     * Retorna todas as rotas adicionadas.
     * 
     * @return array
     */
    public function getRoutes() {
        return $this->routes;
    }
    
    /**
     * Seta um base path
     * 
     * @param string $basePath
     */
    public function setbasePath ( $basePath ) {
        $this->basePath = $basePath;
    }
    
    /**
     * Adiciona uma rota para ser verificada.
     * 
     * @param string $method Metodo de acesso para essa url
     * @param string $route Url a ser adicionada a lista de mapeamento.
     * @param string|callback|array $target
     * @param type $name
     * @return type
     * @throws Exception
     */
    public function map ( $method, $route, $target, $name = null ) {
        if ( is_array( $target ) ) {
            $target = array_merge(array(
                'controller' => NULL,
                'action' => 'index'
            ), $target);
        }
        $this->routes[] = array( $method, $route, $target, $name);
        if ( $name ) {
            if ( isset ( $this->namedRoutes[$name] ) ) {
                throw new Exception("Can not redeclare route '{$name}'");
            } else {
                $this->namedRoutes[$name] = $route;
            }
        }
        return;
    }
    
    /**
     * Pega um parametro e subsitui na url selecionada
     * 
     * @param string $routeName Nome da url
     * @param array $params Array contendo o nome e o valor a ser substituido
     * @return string Retorna a url montada com os novos valores
     * @throws Exception
     */
    public function generate( $routeName, $params = array() ) {
        // Check if named route exists
        if(!isset($this->namedRoutes[$routeName])) {
            throw new Exception("Route '{$routeName}' does not exist.");
        }
        // Replace named parameters
        $route = $this->namedRoutes[$routeName];
        // prepend base path to route url again
        $url = $this->basePath . $route;
        if (preg_match_all('`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|)`', $route, $matches, PREG_SET_ORDER)) {
            foreach($matches as $match) {
                list($block, $pre, $type, $param, $optional) = $match;
                if ($pre) {
                    $block = substr($block, 1);
                }
                if(isset($params[$param])) {
                    $url = str_replace($block, $params[$param], $url);
                } elseif ($optional) {
                    $url = str_replace($pre . $block, '', $url);
                }
            }
        }
        return $url;
    }
    
    /**
     * Compara a url requisitada e verifica se ela existe na lista de rotas
     * 
     * <h2>Example</h2>
     * <code>
     * $routes = new Routing();
     * 
     * $routes->match();
     * 
     * $routes->match('/example');
     * 
     * $routes->match('/example', 'GET');
     * 
     * </code>
     * 
     * @param string $requestUrl
     * @param string $requestMethod
     * @return boolean|array
     */
    public function match($requestUrl = null, $requestMethod = null) {
        $params = array();
        $match = false;
        // set Request Url if it isn't passed as parameter
        if($requestUrl === null) {
            $requestUrl = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        }
        // strip base path from request url
        $requestUrl = substr($requestUrl, strlen($this->basePath));
        
        // Strip query string (?a=b) from Request Url
        if (($strpos = strpos($requestUrl, '?')) !== false) {
            $requestUrl = substr($requestUrl, 0, $strpos);
        }
        // set Request Method if it isn't passed as a parameter
        if($requestMethod === null) {
            $requestMethod = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
        }
        foreach($this->routes as $handler) {
            list($methods, $route, $target, $name) = $handler;
            
            $method_match = (stripos($methods, $requestMethod) !== false);
            
            // Method did not match, continue to next route.
            if (!$method_match) continue;
            
            if ($route === '*') {
                // * wildcard (matches all)
                $match = true;
            } elseif (isset($route[0]) && $route[0] === '@') {
                // @ regex delimiter
                $pattern = '`' . substr($route, 1) . '`u';
                $match = preg_match($pattern, $requestUrl, $params) === 1;
            } elseif (($position = strpos($route, '[')) === false) {
                // No params in url, do string comparison
                $match = strcmp($requestUrl, $route) === 0;
            } else {
                // Compare longest non-param string with url
                if (strncmp($requestUrl, $route, $position) !== 0) {
                    continue;
                }
                $regex = $this->compileRoute($route);
                $match = preg_match($regex, $requestUrl, $params) === 1;
            }
            
            if ($match) {
                if ($params) {
                    foreach($params as $key => $value) {
                        if( is_numeric($key) ) unset($params[$key]);
                    }
                }
                return array(
                    'target' => $target,
                    'params' => $params,
                    'name' => $name,
                    'request' => $requestMethod
                );
            }
        }
        return false;
    }
    
    /**
     * 
     * @param string $route
     * @return string
     */
    private function compileRoute($route) {
        if (preg_match_all('`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|)`', $route, $matches, PREG_SET_ORDER)) {
            $matchTypes = $this->regexMatch;
            foreach($matches as $match) {
                list($block, $pre, $type, $param, $optional) = $match;
                if (isset($matchTypes[$type])) {
                    $type = $matchTypes[$type];
                }
                if ($pre === '.') {
                    $pre = '\.';
                }
                //Older versions of PCRE require the 'P' in (?P<named>)
                $pattern = '(?:'
                        . ($pre !== '' ? $pre : null)
                        . '('
                        . ($param !== '' ? "?P<$param>" : null)
                        . $type
                        . '))'
                        . ($optional !== '' ? '?' : null);
                $route = str_replace($block, $pattern, $route);
            }
        }
	return "`^$route$`u";
    }
    
}
