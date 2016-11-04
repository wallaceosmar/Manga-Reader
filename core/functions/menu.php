<?php if ( ! defined( 'ABSPATH' ) ) { exit; }

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
 * @package Core\Functions\Navigation
 */

global $_navbar_;

require_once ( CORE_CLASS_PATH . 'class.Menu.php' );

/**
 * 
 * @global Menu $_navbar_
 * @param string $title
 * @param array $options
 * @return MenuElement
 */
function add_navbar ($title, $options) {
    global $_navbar_;
    
    return $_navbar_->add($title, $options);
}

/**
 * 
 * @global Menu $_navbar_
 * @return array
 */
function get_navbar () {
    global $_navbar_;
    
    return $_navbar_->getElement();
}

/**
 * 
 * @global Menu $_navbar_
 * @return boolean
 */
function navbar_has_element () {
    global $_navbar_;
    
    if ( $_navbar_->lenght() > 0 ) {
        return TRUE;
    }
    
    return FALSE;
}

/**
 * 
 * @global array $_menu_
 * @param string $instance
 * @param string $title
 * @param array $options
 * @return MenuElement
 */
function add_menu ($instance, $title, $options) {
    global $_menu_;
    
    $instance = (string) $instance;
    
    if ( isset ( $_menu_[$instance] ) ) {
        return $_menu_[$instance]->add($title, $options);
    } else {
        $menu = new Menu();
        $_menu_[$instance] = $menu;
        return $menu->add($title, $options);
    }
    return NULL;
}

/**
 * 
 * @global array $_menu_
 * @param string $instance
 * @return boolean
 */
function menu_has_element ( $instance ) {
    global $_menu_;
    
    $instance = (string) $instance;
    
    if ( isset ( $_menu_[$instance] ) ) {
        if ( $_menu_[$instance]->lenght() > 0 ) {
            return TRUE;
        }
    }
    return FALSE;
}

/**
 * 
 * @global array $_menu_
 * @param string $instance
 * @return array
 */
function get_menu( $instance ) {
    global $_menu_;
    
    return isset ( $_menu_[ (string) $instance] ) ? $_menu_[ (string) $instance]->getElement() : array();
}