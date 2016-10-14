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
 * 
 * @global ConfigOption $_config_
 * @param string $option
 * @param mixed $value
 * @param string $autoload
 */
function add_option( $option, $value = '', $autoload = 'yes' ) {
    global $_config_;
    
    $_config_->add_option($option, $value, $autoload);
}

/**
 * 
 * @global ConfigOption $_config_
 * @param string $option
 */
function delete_option( $option ) {
    global $_config_;
    
    
}

/**
 * 
 * @global ConfigOption $_config_
 * @param string $option
 * @param string $default
 * @return mixed
 */
function get_option( $option ) {
    global $_config_;
    
    return $_config_->get_option($option);
}

/**
 * 
 * @global ConfigOption $_config_
 * @param string $option
 * @param mixed $value
 * @param string $autoload
 */
function update_option( $option, $value, $autoload = null ) {
    global $_config_;
    
    $_config_->update_option($option, $value, $autoload);
}