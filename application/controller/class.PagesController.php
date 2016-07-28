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
 * Description of Pages
 *
 * @author Wallace Osmar <wallace.osmar@r7.com>
 */
class PagesController extends Controller {
    
    use Request;
    
    public function __construct() {
        parent::__construct();
        
        
        $this->model->Mangas = new MangasModel();
    }
    
    public function manga_list_get( $pagination = 1 , $name = '', $filter = '' ) {
        if ( is_null( $pagination ) ) {
            $pagination = 0;
        }
        
        $pagination = (int) ( $pagination <= 1 ) ? 0: $pagination - 1;
        
        //Quantidade maxima de mangas.
        $length = $this->model->Mangas->length;
        
        //Statisticas;
        $statistic = (object) array(
            'mangas' => $length,
            'chapters' => 0,
            'views' => 0,
        );
        
        $maxRecordsforPage = 20;
        
        // Paginação
        $paginator = new stdClass();
        $paginator->enable = true;
        $paginator->url = @sprintf('/pages/manga-list/%s%s',
            ! is_null ( $filter ) ? "{$filter}/" : '',
            ! is_null ( $name ) ? "{$name}/%d" : '%d'
        );
        $paginator->firstPage = 1;
        $paginator->currentPage = $pagination;
        $paginator->lastPage = ( ( $length/$maxRecordsforPage ) > (round($length/$maxRecordsforPage)) ) ? round( $length /$maxRecordsforPage)+1 : round( $length /$maxRecordsforPage) ;
        if ( $paginator->lastPage == 0 ) {
            $paginator->lastPage = 1;
        }
        $paginator->beginFor = ( ( $paginator->currentPage - 4 ) > 1  ) ? ( $paginator->currentPage - 4 ) : 1;
        $paginator->endFor = ( ( $paginator->currentPage + 5 ) < $paginator->lastPage ) ? $paginator->currentPage + 5 : $paginator->lastPage;
        $paginator->next = ( $paginator->currentPage  < ( $paginator->lastPage - 1 ) ) ? $paginator->currentPage + 2 : $paginator->lastPage;
        $paginator->preview = ( $paginator->currentPage > 1 ) ? $paginator->currentPage : 1;
        // End of Pagination
        
        if ( ! is_null( $filter ) ) {
            $manga = $this->model->Mangas->get_list_manga( $pagination * 20, 20, $filter, urldecode( $name ) );
        } else {
            $manga = $this->model->Mangas->get_list_manga( 0, 20);
        }
        
        $this->variables['pagination'] = $paginator;
        $this->variables['statistc'] = $statistic;
        $this->variables['listManga'] = $manga;
        try {
            Load::view('_share::header', $this->variables);
            Load::view( 'pages::manga-list', $this->variables);
            Load::view('_share::footer', $this->variables);
        } catch (Exception $ex) {
            $this->_404();
        }
    }
    
    public function manga_popular_get() {
        try {
            Load::view("_share::header", $this->variables);
            Load::view("_share::footer", $this->variables);
        } catch (Exception $ex) {
            $this->_404();
        }
    }
    
    public function recent_updates_get() {
        try {
            Load::view("_share::header", $this->variables);
            Load::view("_share::footer", $this->variables);
        } catch (Exception $ex) {
            $this->_404();
        }
    }
    
}
