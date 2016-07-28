<?php

/*
 * The MIT License
 *
 * Copyright 2016 Wallace Osmar https://github.com/wallaceosmar
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
 * Description of MangasModel
 *
 * @author Wallace Osmar <wallace.osmar@r7.com>
 */
class MangasModel extends Model {
    
    /**
     *
     * @var int 
     */
    public $length;
    
    public function __construct() {
        parent::__construct();
        $stmt = $this->database->query("SELECT count(*) as `ct` FROM `{$this->database->manga}`");
        $this->length = $stmt->fetch()['ct'];
    }
    
    public function get_all() {
        if ( $contador = $this->database->query( "SELECT count(*) as `CONT` FROM `{$this->database->manga}` ORDER BY `id_manga` DESC" ) ) {
            $this->lenght = $contador->fetch()['CONT'];
            unset($contador);
            $stmt = $this->database->query("SELECT * FROM `{$this->database->manga}`;");
            if ( $stmt->rowCount() > 0 ) {
                $mangaEntity = array();
                while( $row = $stmt->fetchObject('MangaEntity') ) {
                    $mangaEntity[] = $row;
                }
                return $mangaEntity;
            }
            return FALSE;
        }
        return NULL;
    }
    
    public function get_last_insert_manga( $inicial, $final ) {
        if ( $contador = $this->database->query( "SELECT count(*) as `CONT` FROM `{$this->database->manga}` ORDER BY `id_manga` DESC" ) ) {
            $this->length = $contador->fetch()['CONT'];
            unset( $contador );
            $stmt = $this->database->prepare("SELECT * FROM `{$this->database->manga}` ORDER BY `id_manga` DESC LIMIT ?,?");
            $stmt->bindParam(1, $inicial, Connection::PARAM_INT);
            $stmt->bindParam(2, $final, Connection::PARAM_INT);
            if ( $stmt->execute() ) {
                $mangaEntity = array();
                while( $row = $stmt->fetchObject('MangaEntity') ) {
                    $mangaEntity[] = $row;
                }
                return $mangaEntity;
            }
            return FALSE;
        }
        return NULL;
    }
    
    public function get_list_manga ( $inicial = 0, $final = 20 , $field = NULL, $search = '' ) {
        while( TRUE ) {
            
            $sql = "SELECT * FROM `{$this->database->manga}`";
            if ( ! is_null( $field ) ) {
                switch ( $field ) {
                    case 'genre':
                        $sql .= " WHERE `genres` LIKE :search";
                        break;
                    case 'author':
                        $sql .= " WHERE `authors` LIKE :search";
                        break;
                    case 'artist':
                        $sql .= " WHERE `artists` LIKE :search";
                        break;
                    case 'release':
                        $sql .= " WHERE `released` LIKE :search";
                        break;
                    case 'status':
                        $sql .= " WHERE `m_status` LIKE :search";
                        break;
                    default :
                        $sql .= "";
                }
            }
            
            if ( ! is_a( $contador = $this->database->prepare( str_replace( '*', 'count(*) as `count`', $sql ) ), 'PDOStatement' ) ) {
                break;
            }
            
            if ( ! is_null ( $field ) ) {
                $search = "%{$search}%";
                $contador->bindParam(':search', $search);
            }
            
            $this->length = $contador->fetch()['count'];
            unset( $contador );
            
            $sql .= " LIMIT :ini, :fim";
            
            if ( ! is_a( $stmt = $this->database->prepare($sql) , 'PDOStatement') ) {
                return array();
            }
            
            if ( ! is_null ( $field ) && ! ( false == strpos( $sql, ':search' ) ) ) {
                $stmt->bindParam(':search', $search);
            }
            
            $stmt->bindParam(':ini', $inicial, Connection::PARAM_INT);
            $stmt->bindParam(':fim', $final, Connection::PARAM_INT);
            
            if ( $stmt->execute() ) {
                $mangaEntity = array();
                while ( $row = $stmt->fetchObject('MangaEntity') ) {
                    $mangaEntity[] = $row;
                }
                return $mangaEntity;
            }
            
            break;
        }
        return FALSE;
    }
    
    public function lastInsertManga( $ini, $fim ) {
        if ( $contador = $this->database->query( "SELECT count(*) as `CONT` FROM `{$this->database->manga}` ORDER BY `id_manga` DESC" ) ) {
            $this->lenght = $contador->fetch()['CONT'];
            unset($contador);
            $stmt = $this->database->prepare("SELECT * FROM `{$this->database->manga}` ORDER BY `id_manga` DESC LIMIT ?,?");
            $stmt->bindParam(1, $ini, Connection::PARAM_INT);
            $stmt->bindParam(2, $fim, Connection::PARAM_INT);
            if ( $stmt->execute() ) {
                $mangaEntity = array();
                $ct = 0;
                while( $row = $stmt->fetchObject('MangaEntity') ) {
                    $mangaEntity[$ct++] = $row;
                }
                if ( $ct > 0 ) {
                    return $mangaEntity;
                }
            }
            return FALSE;
        }
        return NULL;
    }
    
    public function lastUpdateManga( $ini, $fim ) {
        if ( $contador = $this->database->query( "SELECT count(*) as `CONT` FROM `{$this->database->manga}` ORDER BY `last_update` DESC" ) ) {
            $this->lenght = $contador->fetch()['CONT'];
            unset($contador);
            $stmt = $this->database->prepare("SELECT * FROM `{$this->database->manga}` ORDER BY `last_update` DESC LIMIT ?,?");
            $stmt->bindParam(1, $ini, Connection::PARAM_INT);
            $stmt->bindParam(2, $fim, Connection::PARAM_INT);
            if ( $stmt->execute() ) {
                $mangaEntity = array();
                $ct = 0;
                while( $row = $stmt->fetchObject('MangaEntity') ) {
                    $mangaEntity[$ct++] = $row;
                }
                if ( $ct > 0 ) {
                    return $mangaEntity;
                }
            }
            return FALSE;
        }
        return NULL;
    }
    
    public function mostPopularManga( $ini, $fim ) {
        if ( $contador = $this->database->query( "SELECT count(*) as `CONT` FROM `{$this->database->manga}` ORDER BY `views` DESC" ) ) {
            $this->lenght = $contador->fetch()['CONT'];
            unset($contador);
            $stmt = $this->database->prepare("SELECT * FROM `{$this->database->manga}` ORDER BY `views` DESC LIMIT ?,?");
            $stmt->bindParam(1, $ini, Connection::PARAM_INT);
            $stmt->bindParam(2, $fim, Connection::PARAM_INT);
            if ( $stmt->execute() ) {
                $mangaEntity = array();
                $ct = 0;
                while( $row = $stmt->fetchObject('MangaEntity') ) {
                    $mangaEntity[$ct++] = $row;
                }
                if ( $ct > 0 ) {
                    return $mangaEntity;
                }
            }
            return FALSE;
        }
        return NULL;
    }
    
    public function select( $slugName ) {
        $stmt = $this->database->prepare("SELECT * FROM `{$this->database->manga}` WHERE `slug` = ?;");
        $stmt->bindValue(1, $slugName, Connection::PARAM_STR );
        if ( $stmt->execute() && $stmt->rowCount() == 1 ) {
            return $stmt->fetchObject('MangaEntity');
        }
        return NULL;
    }
    
    public function listManga ( $order = 'ASC', $ini = 0, $fim = 20 ) {
        $sql = "SELECT * FROM `{$this->database->manga}` ORDER BY `name` {$order}";
        if ( is_integer( $ini ) ) {
            $sql .= " LIMIT ?,?";
        }
        $stmt = $this->database->prepare( $sql );
        if ( is_numeric( $ini ) ) {
            $stmt->bindParam(1, $ini, Connection::PARAM_INT);
            $stmt->bindParam(2, $fim, Connection::PARAM_INT);
        }
        if ( $stmt->execute() ) {
            $mangaEntity = array();
            while( $row = $stmt->fetchObject('MangaEntity') ) {
                $mangaEntity[] = $row;
            }
            return $mangaEntity;
        }
        return NULL;
    }
    
    public function search( $search, $camposearch = 'name' , $ini = null, $fim = null ) {
        
        while ( TRUE ) {
            
            $sql = "SELECT * FROM `{$this->database->manga}` WHERE ";
            foreach ( (array) $camposearch as $k => $campo ) {
                if ( $k > 0 ) {
                    $sql .= " OR ";
                }
                $sql .= "UPPER(`{$campo}`) LIKE :{$campo}";
            }
            
            if ( ! is_a ( $contador = $this->database->prepare( str_replace( '*', 'count(*) as `count`', $sql ) ), 'PDOStatement' ) ) {
                break;
            }
            
            if ( ! is_null( $ini ) && ! is_null ( $fim )) {
                $sql .= " LIMIT :ini, :fim";
            }
            
            // For case incencitive
            $search = "%" . strtoupper( $search ) . "%";
            $stmt = $this->database->prepare( $sql );
            
            foreach ( (array) $camposearch as $campo ) {
                $contador->bindParam( ":{$campo}", $search );
                $stmt->bindParam( ":{$campo}", $search );
            }
            
            $contador->execute();
            
            $this->length = $contador->rowCount();
            unset( $contador );
            
            if ( ! is_null( $ini )  && ! is_null ( $fim )) {
                $stmt->bindParam( ':ini', $ini, Connection::PARAM_INT );
                $stmt->bindParam( ':fim', $fim, Connection::PARAM_INT );
            }
            
            if ( $stmt->execute() ) {
                $mangaEntity = array();
                while ( $row = $stmt->fetchObject( 'MangaEntity' ) ) {
                    $mangaEntity[] = $row;
                }
                return $mangaEntity;
            }
            
            break;
        }
        
        return NULL;
    }
    
}
