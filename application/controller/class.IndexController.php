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
 * Description of IndexController
 *
 * @author Wallace Osmar <wallace.osmar@r7.com>
 */
class IndexController extends Controller {
        
    public function index_get() {
        
        $this->variables['maxInsertManga'] = (int) ( is_numeric( get_option('app_show_max_inset_manga') ) ? get_option('app_show_max_inset_manga') : 10);
        $this->variables['maxUpdateManga'] = (int) ( is_numeric( get_option('app_show_max_update_manga') ) ? get_option('app_show_max_update_manga') : 100 );
        $this->variables['maxPopularManga'] = (int) ( is_numeric( get_option('app_show_max_popular_manga') ) ? get_option('app_show_max_popular_manga') : 10 );
        
        $this->variables = array_merge(array(
            'insertManga' => $this->model->Mangas->lastInsertManga(0, $this->variables['maxInsertManga']),
            'updateManga' => $this->model->Mangas->lastUpdateManga(0, $this->variables['maxUpdateManga']),
            'popularManga' => $this->model->Mangas->mostPopularManga(0, $this->variables['maxPopularManga'])
        ), $this->variables);
        
        try {
            Load::view('_share::header', $this->variables);
            Load::view('index::index', $this->variables);
            Load::view('_share::footer', $this->variables);
        } catch (Exception $ex) {
            $this->_404();
        }
    }
    
    public function login_get() {
        
        try {
            Load::view('_share::header', $this->variables);
            Load::view('index::login', $this->variables);
            Load::view('_share::footer', $this->variables);
        } catch (Exception $ex) {
            $this->_404();
        }
    }
    
    public function register_get() {
        try {
            Load::view('_share::header', $this->variables);
            Load::view('index::register', $this->variables);
            Load::view('_share::footer', $this->variables);
        } catch (Exception $ex) {
            $this->_404();
        }
    }
    
    public function search_get() {
        $this->variables['searchManga'] = array();
        if ( ! empty( $search = $this->request->get('q') ) ) {
            $this->variables['searchManga'] = $this->model->Mangas->search( $search, array('name', 'other_name') );            
        }
        try {
            Load::view( '_share::header', $this->variables);
            Load::view( 'index::search', $this->variables);
            Load::view( '_share::footer', $this->variables);
        } catch (Exception $ex) {
            $this->_404();
        }
    }
    
}
