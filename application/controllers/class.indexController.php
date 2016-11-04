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
            $max_insert = get_option('app_show_max_inset_manga');
            $max_popular = get_option('app_show_max_popular_manga');
            $max_update = get_option('app_show_max_update_manga');
            //
            if ( !( $insertManga = caching_get('list-insert-manga') ) ) {
                $insertManga = $this->model->Manga->getColum('id_manga', MangaModel::ORDER_DESC)->getData( $max_insert,1);
                caching_set( 'list-insert-manga', $insertManga->data, 500);
            }
            
            if ( !( $popularManga = caching_get('list-popular-manga') ) ) {
                $popularManga = $this->model->Manga->getColum('views', MangaModel::ORDER_DESC)->getData( $max_popular,1);
                caching_set( 'list-popular-manga', $popularManga->data, 500);
            }
            
            if ( !( $updateManga = caching_get('list-update-manga') ) ) {
                $updateManga = $this->model->Manga->getColum('last_update', MangaModel::ORDER_DESC)->getData( $max_update,1);
                caching_set( 'list-update-manga', $updateManga->data, 500);
            }
            
            $this->template->assign('insertManga', $insertManga->data);
            $this->template->assign('popularManga', $popularManga->data);
            $this->template->assign('updateManga', $updateManga->data);
            $this->template->assign('maxInsertManga', $max_insert );
            $this->template->assign('maxUpdateManga', $max_update );
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
