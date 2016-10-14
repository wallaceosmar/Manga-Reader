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
 * Description of indexController
 *
 * @author Wallace Osmar <wallace.osmar@r7.com>
 */
class indexController extends Controller {
    
    /**
     * 
     */
    public function index_get() {
        
        // This is cached
        if ( ! $this->template->isCached('index/index.tpl') ) {
            
            //
            if ( !( $insertManga = caching_get('list-insert-manga') ) ) {
                $insertManga = $this->model->Manga->list_limit(0,40);
                caching_set( 'list-insert-manga', $insertManga, 500);
            }
            
            if ( !( $popularManga = caching_get('list-insert-manga') ) ) {
                $popularManga = $this->model->Manga->list_limit(0,10);
                caching_set( 'list-insert-manga', $popularManga, 500);
            }
            
            if ( !( $updateManga = caching_get('list-insert-manga') ) ) {
                $updateManga = $this->model->Manga->list_limit(0,40);
                caching_set( 'list-insert-manga', $updateManga, 500);
            }
            
            $this->template->assign('insertManga', $insertManga);
            $this->template->assign('popularManga', $popularManga);
            $this->template->assign('updateManga', $updateManga);
            $this->template->assign('maxInsertManga', 40 );
            $this->template->assign('maxUpdateManga', 100 );
            
        }
        
        $this->template->display('index/index.tpl');
    }
    
    public function search_get () {
        // 
        if ( ! $this->template->isCached('index/search.tpl') ) {
            $this->template->assign('searchManga', array());
            $this->template->assign('mangaGenreList', array());
        }
        
        $this->template->display('index/search.tpl');
    }
    
    /**
     * 
     */
    public function login_get () {
        $this->template->display('index/login.tpl');
    }
    
    /**
     * 
     */
    public function register_get () {
        $this->template->display('index/register.tpl');
    }
    
    /**
     * 
     */
    public function contact_any() {
        if ( ! $this->template->isCached('index/contact.tpl') ) {
            $this->template->assign('mailto', 'contato@' . $_SERVER['HTTP_HOST'] );
        }
        $this->template->display('index/contact.tpl');
    }
    
}
