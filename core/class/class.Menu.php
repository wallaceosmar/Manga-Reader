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

require_once ( CORE_CLASS_PATH . 'class.MenuElement.php' );

/**
 * Description of Menu
 *
 * @author Wallace Osmar <wallace.osmar@r7.com>
 */
class Menu {
    
    /**
     *
     * @var array 
     */
    protected $menu = array();
    
    /**
     *
     * @var array 
     */
    protected $reserved = array( 'url' );
    
    /**
     *
     * @var int 
     */
    protected $lenght = 0;
    
    /**
     * 
     * @param string $title
     * @param array $options
     */
    public function add($title, $options) {
        $url = $this->getUrl($options);
        $attr = ( is_array($options) ) ? $this->extractAttr($options) : array();
        $item = new MenuElement($title,$url,$attr);
        array_push($this->menu, $item);
        $this->lenght++;
        return $item;
    }
    
    /**
     * 
     * @return type
     */
    public function lenght() {
        return $this->lenght;
    }
    
    /**
     * 
     * @return array
     */
    public function getElement() {
        return $this->menu;
    }
    
    /**
     * 
     * @param type $options
     * @return type
     */
    private function extractAttr($options) {
        return array_diff_key($options, array_flip($this->reserved));
    }
    
    /**
     * 
     * @param mixed $options
     * @return string|NULL
     */
    private function getUrl($options) {
        if( ! is_array($options) ) {
            return $options;
        } elseif ( isset($options['url']) ) {
            return $options['url'];
        }
        return null;
    }
    
}
