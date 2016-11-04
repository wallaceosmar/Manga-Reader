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
 * Description of MangaModel
 *
 * @author Wallace Osmar <wallace.osmar@r7.com>
 */
class MangaModel extends Model {
    
    
    const ORDER_ASC = 0;
    
    const ORDER_DESC = 1;
    
    private $filds = [
        'name', 'slug', 'authors', 'artists', 'other_name', 'genres'
    ];
    
    public function getAll( $return = null ) {
        $query = 'SELECT * FROM `' . $this->db->prefix . 'manga`';
        switch ( $return ) {
            case 'pagination':
                $results = new Paginator( $this->db , $query);
                $results->setDataParse('MangaEntity');
                return $results;
            default:
                if ( $stmt = $this->db->query( $query ) ) {
                    return [
                        'length' => $stmt->rowCount(),
                        'response' => $stmt->fetchAll(PDO::FETCH_CLASS, 'MangaEntity')
                    ];
                }
                
        }
        return [];
    }
    
    public function find ( $value, $columns = [ 'name', 'slug', 'authors', 'artists', 'other_name', 'genres' ] ) {
        $columns = (array) $columns;
        foreach ( $columns as $key => $arvar ) {
            switch ( $arvar ) {
                case 'artist':
                    $columns[$key] = 'artists';
                    break;
                case 'author':
                    $columns[$key] = 'authors';
                    break;
                case 'genre':
                    $columns[$key] = 'genres';
                    break;
                default :
                    if ( in_array($value, $this->filds) ) {
                        continue;
                    }
                    unset( $columns[$key] );
            }
        }
        $sql = 'SELECT * FROM `' . $this->db->prefix . 'manga` WHERE UPPER(`' . implode( "`) LIKE UPPER('%{$value}%') OR (`", (array) $columns ) . "`) LIKE UPPER('%{$value}%')";
        $pagination = new Paginator( $this->db, $sql );
        return $pagination->setDataParse('MangaEntity');
    }
    
    public function getColum ( $colum, $order = 'ASC' ) {
        $sql = 'SELECT * FROM `' . $this->db->prefix . 'manga`';
        $sql .= 'ORDER BY `' . $colum . '` ';
        switch ( $order ) {
            case 'desc':
            case 'DESC':
            case 1:
                $sql .= 'DESC ';
                break;
            default:
                $sql .= 'ASC';
        }
        $pagination = new Paginator( $this->db, $sql );
        return $pagination->setDataParse('MangaEntity');
    }
    
    /**
     * 
     * @param string|int $arg
     * @return array
     * @throws ModelException
     */
    public function select ( $arg ) {
        if ( ! is_string ( $arg ) && ! is_integer( $arg ) ) {
            throw new ModelException( __('O parametro deve ser uma string ou um numero inteiro.'), 0);
        }
        
        $sql = 'SELECT * FROM `' . $this->db->prefix . 'manga`';
        if ( is_numeric( $arg ) ) {
            $sql .= 'WHERE `id_manga` = ?';
        } else {
            $sql .= 'WHERE `slug` = ?';
        }
        if ( $stmt = $this->db->query($sql,[ $arg ]) ) {
            return $stmt->fetchObject('MangaEntity');
        }
        return null;
    }
    
    /**
     * 
     * @param MangaEntity $manga
     */
    public function insert( MangaEntity $manga ) {
        
    }
    
    public function update ( MangaEntity $manga ) {
        
    }
    
    public function delete ( $id ) {
        
    }
    
}
