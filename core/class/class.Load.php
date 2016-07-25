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
 * Description of Load
 *
 * @author Wallace Osmar <wallace.osmar@r7.com>
 */
class Load {
    
    private static $replace = array(
        '/' => '',
        '..' => '',
        '::' => DS,
        '{plataform}' => PLATAFORM
    );
    
    private static function _parse( $str ) {
        self::$replace['{template}'] = defined( 'TEMPLATE_VIEW_PAGE' ) ?  TEMPLATE_VIEW_PAGE:  '';
        $str = preg_replace('/\\.[^.\\s]{3,4}$/', '', $str);
        $str = str_replace( array_keys( self::$replace ), self::$replace, $str );
        return $str;
    }
    
    /**
     * <code>
     *  {plataform} = nome da plataform
     *  {template} = nome do template
     * </code>
     * 
     * @param type $_path
     * @param type $_variables
     * @throws Exception
     */
    public static function view( $_path, $_variables = array() ) {
        if ( file_exists ( $filename = CURR_VIEW_PATH . self::_parse( $_path ) . '.php' ) ) {
            extract( $_variables );
            require_once ( $filename );
        } else {
            throw new LoadException( sprintf( 'The file <code>%s</code> was not found' , $filename ) , 404 );
        }
    }
    
}
