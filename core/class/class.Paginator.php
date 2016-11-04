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
 * Description of Paginator
 *
 * @author Wallace Osmar <wallace.osmar@r7.com>
 */
class Paginator {
    
    /**
     *
     * @var MVCdatabase 
     */
    private $_conn;
    
    /**
     *
     * @var type 
     */
    private $_limit;
    
    /**
     *
     * @var int 
     */
    private $_page;
    
    /**
     *
     * @var string 
     */
    private $_query;
    
    /**
     *
     * @var int 
     */
    private $_total;
    
    /**
     *
     * @var bool 
     */
    private $_dataParse = false;
    
    /**
     * 
     * @param MVCdatabase $conn
     * @param string $query
     */
    public function __construct( $conn, $query ) {
        $this->_conn = $conn;
        $this->_query = $query;
        
        if ( $stmt = $this->_conn->query( $this->_query ) ) {
            $this->_total = $stmt->rowCount();
        } else {
            $this->_total = 0;
        }
    }
    
    /**
     * 
     * 
     * @param type $name
     * @return Paginator
     */
    public function setDataParse( $name ) {
        $this->_dataParse = $name;
        
        return $this;
    }
    
    /**
     * 
     * @param string|int $limit Aceita all|[0-9]+
     * @param int $page
     * @return type
     */
    public function getData ( $limit, $page = 1 ) {
        
        $this->_limit = $limit;
        $this->_page = ( $page <= 0 ) ? 1: $page;
        
        if ( 'all' == $this->_limit  ) {
            $query = $this->_query;
        } else {
            $query = $this->_query . " LIMIT " . ( ( $this->_page - 1 ) * $this->_limit ) . ", $this->_limit";
        }
        
        $result = new stdClass();
        $result->page = $this->_page;
        $result->enabled = false;
        $result->data = [];
        
        if ( $stmt = $this->_conn->query($query) ) {
            
            $result->enabled = ! $result->enabled;
            
            if ( $this->_dataParse ) {
                $results = $stmt->fetchAll( PDO::FETCH_CLASS , $this->_dataParse);
            } else {
                $results = $stmt->fetchAll();
            }

            $result->data = $results;
            $result->currentPage = $this->_page;
            $result->lastPage = ( ( $this->_total/$this->_limit ) > (round($this->_total/$this->_limit)) ) ? round( $this->_total /$this->_limit)+1 : round( $this->_total /$this->_limit) ;
            if ( $result->lastPage == 0 ) {
                $result->lastPage = 1;
            }
            $result->beginFor = ( ( $result->currentPage - 4 ) > 1  ) ? ( $result->currentPage - 4 ) : 1;
            $result->endFor = ( ( $result->currentPage + 5 ) < $result->lastPage ) ? $result->currentPage + 5 : $result->lastPage;
            $result->next = ( $result->currentPage  < ( $result->lastPage - 1 ) ) ? $result->currentPage + 2 : $result->lastPage;
            $result->preview = ( $result->currentPage > 1 ) ? $result->currentPage-1 : 1;
            
        } else {
            $result->data = [];
        }
 
        return $result;
    }
    
}
