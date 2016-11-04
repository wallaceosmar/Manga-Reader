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
 * Description of StorageCache
 *
 * @author Avell G1511 MAX
 * @package Core\Class
 */
class StorageCache {
    
    private $cachingPath = DATA_CAHCE_PATH;
    
    private $host = '127.0.0.1';
    
    private $port = 6379;
    
    private $auth = 'mangareader';
    
    private $object;
    
    public function __construct() {
        if ( class_exists( 'Redis' , false) ) {
            $this->object = new Redis();
            $this->object->connect( $this->host , $this->port);
            $this->object->auth( $this->auth );
        }
    }
    
    /**
     * 
     * @param type $name
     * @param type $variable
     * @param type $expireTime
     */
    public function set ( $name, $variable, $expireTime = 100 ) {
        if ( is_a( $this->object, 'Redis', false ) ) {
            $this->object->set( $name, mabySerialize( $variable ) );
            $redis->expire( $name, $expireTime);
        }
    }
    
    /**
     * 
     * @param type $name
     * @return type
     */
    public function get( $name ) {
        if ( is_a( $this->object, 'Redis', false ) ) {
            return maybe_unserialize( $this->object->get( $name ) );
        }
        return null;
    }
    
}
