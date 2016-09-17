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
 * Description of ConfigOption
 *
 * @author Wallace Osmar <wallace.osmar@r7.com>
 */
class ConfigOption {
    
    private $data_config;
    
    /**
     *
     * @var Connection 
     */
    private $database;
    
    /**
     * 
     * @return boolean
     */
    private function _init() {
        if ( is_a ( $this->database, 'Connection' ) ) {
            return TRUE;
        }
        
        if ( defined( 'USED_DB' ) || USED_DB ) {
            $this->_start_connection();
            $this->_load_config();
            return TRUE;
        }
        
        return FALSE;
    }
    
    /**
     * 
     * @param type $option
     * @param type $value
     * @param type $autoload
     * @return type
     */
    public function add_option( $option, $value = '', $autoload = 'yes' ) {
        while ( TRUE ) {
            
            $this->data_config[ $option ] = (object) array(
                'option_value' => $value,
                'autoload' => $autoload
            );
            
            if ( $this->_init() ) {
                if ( is_object ( $value ) || is_array( $value ) ) {
                    $value = maybe_serialized($value);
                }
                $this->add_option($option, $value, $autoload);
                break;
            }
            
            break;
        }
        
        return NULL;
        
    }
    
    /**
     * 
     * @param type $option
     * @return type
     */
    public function get_option ( $option ) {
        $this->_init();
        return isset ( $this->data_config[ $option ]->option_value ) ? $this->data_config[ $option ]->option_value : null;
    }
    
    /**
     * 
     * @param type $option
     * @return boolean
     */
    public function delete_option( $option ) {
        if ( $this->delete_database($option) ) {
            unset( $this->data_config[ $option ] );
            return TRUE;
        }
        return FALSE;
    }
    
    /**
     * 
     * @param type $option
     * @param type $value
     * @param type $autoload
     */
    public function update_option ( $option, $value, $autoload = null ) {
        $this->data_config[ $option ]->option_value = $value;
        if ( is_null ( $autoload ) ) {
            $this->data_config[ $option ]->autoload = $autoload;
        }
        if ( $this->_init() ) {
            $this->update_database($option, maybe_unserialize( $value ) );
        }
    }
    
    /**
     * 
     */
    private function _load_config () {
        $stmt = $this->database->query("SELECT * FROM `{$this->database->option}`;");
        while( $row = $stmt->fetch() ) {
            $this->data_config[ $row['option_name'] ] = (object) array(
                'option_value' => maybe_unserialize( $row['option_value'] ),
                'autoload' => $row['autoload']
            );
        }
    }
    
    /**
     * 
     */
    private function _start_connection () {
        try {
            $this->database = new Connection('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST, DB_USER, DB_PWDB );
        } catch (Exception $ex) {
            Error::show( $ex->getCode() , $ex->getMessage() );
        }
    }
    
    /**
     * 
     * @param type $option
     * @return boolean
     */
    private function delete_database ( $option ) {
        $stmt = $this->database->prepare("DELETE FROM `{$this->database->option}` WHERE `option_name` = ?");
        $stmt->bindParam(1, $option);
        if ( $stmt->execute() ) {
            return TRUE;
        }
        return FALSE;
    }
    
    /**
     * 
     * @param type $option
     * @param type $value
     * @param type $autoload
     * @return boolean
     */
    private function add_database ( $option, $value = '', $autoload = 'yes' ) {
        $stmt = $this->database->prepare("INSERT INTO `{$this->database->option}` (`option_name`, `option_value`, `autoload`) VALUES (?, ?, ?);");
        $stmt->bindParam(1, $option);
        $stmt->bindParam(2, $value);
        $stmt->bindParam(3, $autoload);
        if ( $stmt->execute() ) {
            return TRUE;
        }
        return FALSE;
    }
    
    /**
     * 
     * @param type $option
     * @param type $value
     * @return boolean
     */
    private function update_database ( $option , $value ) {
        $stmt = $this->database->prepare("UPDATE `{$this->database->option}` SET `option_value` = ?, `autoload` = ? WHERE `option_value` = ?;");
        $stmt->bindParam(1, $value);
        $stmt->bindParam(2, $this->data_config[ $option ]->autoload);
        $stmt->bindParam(3, $option);
        if ( $stmt->execute() ) {
            return true;
        }
        return false;
    }
}
