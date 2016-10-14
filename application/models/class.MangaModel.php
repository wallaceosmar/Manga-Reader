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
    
    public function __construct( $db ) {
        $this->db = $db;
    }
    
    public function selectById( $id ) {
        $query = $this->db->prepare("SELECT * FROM `{$this->db->prefix}manga` WHERE `id_manga` = ?");
        $query->bindParam(1, $id);
        if ( $query->execute() )
            return $query->fetchObject('MangaEntity');
        return new MangaEntity();
    }
    
    public function selectBySlug ( $slugname ) {
        $query = $this->db->prepare("SELECT * FROM `{$this->db->prefix}manga` WHERE `slug` = ?");
        $query->bindParam(1, $slugname);
        if ( $query->execute() )
            return $query->fetchObject('MangaEntity');
        return new MangaEntity();
    }
    
    /**
     * 
     * @param int $ini
     * @param int $fim
     * @return array
     */
    public function list_limit( $ini = 0, $fim = 10 ) {
        $query = $this->db->query("SELECT * FROM `{$this->db->prefix}manga` LIMIT {$ini},{$fim}");
        
        if ( ! $query ) {
            return array();
        }
        
        return $query->fetchAll(PDO::FETCH_CLASS,'MangaEntity');
    }
    
    /**
     * 
     * @return array
     */
    public function list_manga() {
        $query = $this->db->query("SELECT * FROM `{$this->db->prefix}manga`");
        
        if ( ! $query ) {
            return array();
        }
        
        return $query->fetchAll(PDO::FETCH_CLASS,'MangaEntity');
    }
}
