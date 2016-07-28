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
 * Description of MangaController
 *
 * @author Wallace Osmar <wallace.osmar@r7.com>
 */
class MangaController extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index_get( $slugname ) {
        $manga = $this->model->Mangas->select( $slugname );
        $this->variables['manga'] = $manga;
        try {
            if ( is_a( $manga, 'MangaEntity') ) {
                load::view('_share::header', $this->variables);
                load::view('manga::index', $this->variables);
                load::view('_share::footer', $this->variables);
            } else {
                $this->_404();
            }
        } catch (Exception $ex) {
            $this->_404();
        }
    }
    
}
