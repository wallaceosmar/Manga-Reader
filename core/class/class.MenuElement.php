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
 * Description of MenuItem
 *
 * @author Wallace Osmar <wallace.osmar@r7.com>
 */
class MenuElement {
    /**
     *
     * @var type 
     */
    public $title;
    
    /**
     *
     * @var type 
     */
    public $url;
    
    /**
     *
     * @var type 
     */
    protected $attr;
    
    /**
     *
     * @var type 
     */
    private $children;
    
    /**
     * 
     * @param type $title
     * @param type $url
     * @param type $attr
     */
    function __construct($title, $url, $attr){
        $this->title = $title;
        $this->url = $url;
        $this->attr = $attr;
        $this->children = new Menu();
    }
    
    /**
     * 
     * @param type $name
     * @return type
     */
    public function __get($name) {
        return $this->get($name);
    }
    
    /**
     * 
     * @param type $name
     * @return type
     */
    public function get ( $name ) {
        switch ( $name ) {
            case 'title':
                return $this->title;
            case 'url':
                return $this->url;
            default :
                return $this->attr[$name];
        }
    }
    
    /**
     * 
     * @param type $title
     * @param type $options
     * @return type
     */
    public function add($title, $options) {
        return $this->children->add($title, $options);
    }
    
    /**
     * 
     * @return boolean
     */
    public function hasChilldren () {
        if ( $this->children->lenght() > 0 ) {
            return TRUE;
        }
        return FALSE;
    }
    
    /**
     * 
     * @return type
     */
    public function getChilldren() {
        return $this->children->getElement();
    }
}
