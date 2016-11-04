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
 * Description of pagesController
 *
 * @author Wallace Osmar <wallace.osmar@r7.com>
 */
class pagesController extends Controller {
    
    /**
     *
     * @var int 
     */
    private $max_record; 
    
    /**
     * Construtor da classe
     */
    public function __construct() {
        parent::__construct();
        
        $this->max_record = get_option('app_show_max_records_for_list');
    }
    
    /**
     * Pagina contendo uma lista de mangas.
     * 
     * @param int $pagination
     * @param string $filter
     * @param string $name
     */
    public function mangalist_any ( $pagination = 1, $filter, $name ) {
        $name = urldecode($name);
        if ( ! $this->template->isCached('pages/manga-list.tpl', $pagination . $filter . $name) ) {
            if ( ! is_null( $filter ) && ! is_null( $filter ) ) {
                $paginator = $this->model->Manga->find($name, $filter)->getData( $this->max_record, $pagination );
            } else {
                if ( !( $paginator = caching_get('list-insert-manga') ) ) {
                    $paginator = $this->model->Manga->getAll('pagination')->getData( $this->max_record, $pagination );
                    caching_set( 'list-insert-manga', $paginator, 500);
                }
            }
            $this->template->assign('manga_genre', get_option('app_manga_genre'));
            $this->template->assign('statisticas', (object) array(
                'mangas' => 0,
                'chapters' => 0,
                'views' => 0
            ));
            $this->template->assign('pagination', $paginator);
            $this->template->assign('listManga', $paginator->data);
        }
        $this->template->display('pages/manga-list.tpl', $pagination . $filter . $name);
    }
    
    /**
     * Lista de mangas populares.
     * 
     * @param int $pagination
     */
    public function mangapopular_any ( $pagination = 1 ) {
        if ( ! $this->template->isCached('pages/manga-popular.tpl', 'page-' . $pagination) ) {
            if ( !( $popularmanga = caching_get('list-most-view-manga') ) ) {
                $popularmanga = $this->model->Manga->getColum('views', MangaModel::ORDER_DESC)->getData( $this->max_record, $pagination);
                caching_set( 'list-insert-manga', $popularmanga->data, 500);
            }
            $this->template->assign('listManga', $popularmanga->data);
            $this->template->assign('pagination', $popularmanga);
        }
        $this->template->display('pages/manga-popular.tpl','page-' . $pagination);
    }
    
    /**
     * Lista de mangas recentementes atualizados.
     * 
     * @param type $pagination
     */
    public function recentupdates_any ( $pagination = 1 ) {
        if ( ! $this->template->isCached('pages/recent-updates.tpl', 'page-' . $pagination) ) {
            if ( !( $updatemanga = caching_get('list-most-view-manga-page-' . $pagination ) ) ) {
                $updatemanga = $this->model->Manga->getColum('id_manga', MangaModel::ORDER_DESC)->getData( $this->max_record, $pagination);
                caching_set( 'list-insert-manga-page-' . $pagination, $updatemanga->data, 500);
            }
            $this->template->assign('listManga', $updatemanga->data);
            $this->template->assign('pagination', $updatemanga);
        }
        $this->template->display('pages/recent-updates.tpl', 'page-' . $pagination);
    }
    
}
