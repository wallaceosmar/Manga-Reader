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
    }
    
    public function manga_get() {
        if (file_exists( $filename = ABSPATH . 'public' . DS . 'uploads' . DS . 'cover' . DS . '66ea01353c616e2b43f3d23badc26c75.jpg' ) ) {
            $image = new m2brimagem( $filename );
        } else {
            $image = new m2brimagem( ABSPATH . 'public' . DS . 'img' . DS . '404.png' );
        }
        
        $image->grava();
    }
    
    public function cover_get( $slugname ) {
        $manga = $this->model->Mangas->select( $slugname );
        if ( is_a($manga, 'MangaEntity') && file_exists( $filename = sprintf( $manga->cover, UPLOAD_MANGA, UPLOAD_COVER ) ) ) {
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
