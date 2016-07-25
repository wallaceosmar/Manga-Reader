<?php

/*
 * Copyright (C) 2016 Wallace Osmar https://github.com/wallaceosmar
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

/**
 * Description of session
 *
 * @author Wallace Osmar <wallace.osmar@r7.com>
 */
class Session {
    
    public function __construct() {
        if ( ! isset( $_SESSION ) ) {
            session_start();
        }
        foreach ( $_COOKIE as $key => $value ) {
            if ( ! isset ( $_SESSION[$key] ) ) {
                json_decode($value);
                if (json_last_error() == JSON_ERROR_NONE ) {
                    $_SESSION[$key] = json_decode($value);
                } else {
                    $_SESSION[$key] = $value;
                }
            }
        }
    }
    
    /**
     * 
     * @param type $key
     * @return boolean
     */
    static function check( $key ) {
        if ( is_array( $key ) ) {
            $set = true;
            foreach ( $key as $k ) {
                if ( ! session::check($k) ) {
                    $set = false;
                }
            }
        } else {
            return isset( $_SESSION[session::generateSessionKey($key)] );
        }
    }
    
    static function get ( $key ) {
        $key = session::generateSessionKey($key);
        return isset ( $_SESSION[$key] ) ? $_SESSION[$key] : false ;
    }
    
    static function set ( $key , $value , $ttl = 0 ) {
        $_SESSION[session::generateSessionKey($key)] = $value;
        if ( $ttl !== 0 ) {
            if (is_object( $value ) || is_array($value) ) {
                $value = json_encode($value);
            }
            setcookie(session::generateSessionKey($key), $value, ( time() + $ttl), "/" , $_SESSION["HTTP_HOST"]);
        }
    }
    
    static function kill( $key ) {
        $iKey = session::generateSessionKey($key);
        if ( isset ( $_SESSION[$iKey] ) ) {
            unset($_SESSION[$iKey]);
        }
        if ( isset ( $_COOKIE[$key] ) ) {
            setcookie($iKey,"",(time() - 5000), "/", $_SERVER['HTTP_HOST']);
        }
    }
    
    static function endSession() {
        foreach ( $_SESSION as $key => $value ) {
            unset( $_SESSION[$key] );
        }
        foreach ( $_COOKIE as $key => $value ) {
            setcookie($key, '', ( time() + $ttl), "/" , $_SESSION["HTTP_HOST"]);
        }
        session_destroy();
    }
    
    static function generateSessionKey( $key ) {
        
        return md5($key.CORE_VERSION);
    }
    
}
