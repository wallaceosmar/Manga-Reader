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
 * Description of Request
 *
 * @author Wallace Osmar https://github.com/wallaceosmar
 * @version 0.2
 */
trait Request {
    
    /**
     * Retorna todas as Requisiçoes.
     * 
     * @since 0.1
     * @version 0.2
     * 
     * @return array
     */
    public function request() {
        $data['post'] = $this->post();
        $data['get'] = $this->get();
        return $data;
    }
    
    /**
     * Verifica se o methodo requisitado é o passado pelo parametro.
     * 
     * @version 0.1
     * @since 0.2
     * 
     * @param string $var
     * @return boolean
     */
    public function requestIs( $var ) {
        
        if ( strtolower( $_SERVER['REQUEST_METHOD'] ) == $var ) {
            return TRUE;
        }
        
        return FALSE;
    }
    
    /**
     * Retorna um ou mais valores passados pelo metodo POST.
     * 
     * @since 0.1
     * @version 0.2
     * 
     * @param string $name
     * @return mixed
     */
    public function post( $name = NULL ) {
        if ( isset ( $_POST[ $name ] ) ) {
            return filter_input( INPUT_POST, $name );
        }
        return filter_input_array( INPUT_POST );
    }
    
    /**
     * Retorna um ou mais valores passados pelo metodo GET.
     * 
     * @since 0.1
     * @version 0.2
     * 
     * @param string $name
     * @return mixed
     */
    public function get( $name = NULL ) {
        if ( isset ( $_GET[ $name ] ) ) {
            return filter_input( INPUT_GET, $name );
        }
        return filter_input_array( INPUT_GET );
    }
    
}