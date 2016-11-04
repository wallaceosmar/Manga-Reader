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

require_once ( dirname( __FILE__ ) . DS . 'entry.php' );

if ( !class_exists( 'Translation', false ) ) {
    /**
     * 
     */
    class Translation {
        
        /**
         *
         * @var array 
         */
        var $entries = array();
        
        /**
         *
         * @var array 
         */
        var $headers = array();
        
    }
    
}

if ( ! class_exists( 'Gettext_Translations', false ) ) {
    /**
     * 
     */
    class Gettext_Translations extends Translation {
        
        public function translate($singular, $context=null) {
            return $singular;
        }
        
    }
}

if ( ! class_exists( 'NO_Translations', false ) ) {
    /**
     * 
     */
    class NO_Translations {
        
        /**
         * @param string $singular
         * @param string $context
         */
        public function translate($singular, $context=null) {
            return $singular;
        }
        
        /**
         * @param string $singular
         * @param string $plural
         * @param int    $count
         * @param string $context
         */
        public function translate_plural($singular, $plural, $count, $context = null) {
            return 1 == $count? $singular : $plural;
        }
        
    }
}