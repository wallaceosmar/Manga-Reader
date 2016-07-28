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
 * Description of Model
 *
 * @author Wallace Osmar <wallace.osmar@r7.com>
 */
class Model {
    
    /**
     *
     * @var Connection 
     */
    public $database;
    
    private function __connect() {
        if( ! defined( 'DB_NAME' ) ) { throw new ErrorException( __('O nome da tabela não existe.') ); }
        if( ! defined( 'DB_HOST' ) ) { throw new ErrorException( __('O host não foi informado.') ); }
        if( ! defined( 'DB_USER' ) ) { throw new ErrorException( __('O usuario não foi informado.') ); }
        if( ! defined( 'DB_PWDB' ) ) { throw new ErrorException( __('A senha não foi informada.') ); }
        try {
            $this->database = new Connection('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST, DB_USER, DB_PWDB );
        } catch (Exception $ex) {
            Error::show( $ex->getCode() , $ex->getMessage() );
        }
    }
    
    public function __construct() {
        if ( defined('USED_DB') && USED_DB ) {
            $this->__connect();
        }
    }
    
}
