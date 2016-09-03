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
 * Description of ImageController
 *
 * @author Wallace Osmar <wallace.osmar@r7.com>
 */
class ImageController extends Controller {
    
    use Request;
    
    public function __construct() {
        parent::__construct();
        
        $this->model->Mangas = new MangasModel();
        $this->model->Chapter = new ChapterModel();
    }
    
    public function manga_get( $slugname, $chapter, $pagenumber ) {
        if ( file_exists( $filename = '' ) ) {
            $image = new m2brimagem( $filename );
        } else {
            $image = new m2brimagem( ABSPATH . 'public' . DS . 'img' . DS . '404.png' );
        }
        
        $tamanho = $this->request_get();
        
        if ( isset ( $tamanho['w'] ) && is_numeric( $tamanho['w'] ) ) {
            if ( isset ( $tamanho['h'] ) && is_numeric( $tamanho['h'] ) ) {
                $image->redimensiona( $tamanho['w'], $tamanho['h'] );
            } else {
                $image->redimensiona( $tamanho['w'] );
            }
        }
        
        $image->grava();
    }
    
    public function cover_get( $slugname ) {
        $manga = $this->model->Mangas->select( $slugname );
        while( TRUE ) {
            
            $image = new m2brimagem( ABSPATH . 'public' . DS . 'img' . DS . '404.png' );
            
            if ( ! is_a($manga, 'MangaEntity') ) {
                break;
            }
            
            $md5 = md5( $manga->id );
            $filename = UPLOAD_COVER . DS . "{$md5}.jpg";
            
            if( ! file_exists( $filename ) ){
                if ( false !== strpos( $manga->cover, 'http://' ) ) {
                    if ( empty( $content = file_get_contents( $manga->cover ) ) ) {
                        break;
                    }
                    file_put_contents( $filename , $content );
                } elseif ( ! file_exists( $filename = sprintf( $manga->cover, UPLOAD_MANGA, UPLOAD_COVER, md5($manga->id) ) ) ) {
                    break;
                }
            }
            
            $image = new m2brimagem( $filename );
            
            break;
        }
        
        $tamanho = $this->request_get();
        
        if ( isset ( $tamanho['w'] ) && is_numeric( $tamanho['w'] ) ) {
            if ( isset ( $tamanho['h'] ) && is_numeric( $tamanho['h'] ) ) {
                $image->redimensiona( $tamanho['w'], $tamanho['h'] );
            } else {
                $image->redimensiona( $tamanho['w'] );
            }
        }
        
        $image->grava();
    }
    
    public function banner_get( $number = 1) {
        if ( file_exists( $filename = ABSPATH . 'public' . DS . 'img' . DS . 'banner' . DS . "{$number}.png" ) ) {
            $image = new m2brimagem( $filename );
        } else {
            $image = new m2brimagem( ABSPATH . 'public' . DS . 'img' . DS . '404.png' );
        }
        
        $tamanho = $this->request_get();
        
        if ( isset ( $tamanho['w'] ) && is_numeric( $tamanho['w'] ) ) {
            if ( isset ( $tamanho['h'] ) && is_numeric( $tamanho['h'] ) ) {
                $image->redimensiona( $tamanho['w'], $tamanho['h'] );
            } else {
                $image->redimensiona( $tamanho['w'] );
            }
        }
        
        $image->grava();
    }
    
}
