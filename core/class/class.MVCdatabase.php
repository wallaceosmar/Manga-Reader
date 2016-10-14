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
 * Description of MVCdatabase
 *
 * @author Wallace Osmar <wallace.osmar@r7.com>
 */
class MVCdatabase {
    
    /**
     * Host da base de dados 
     * @var type 
     */
    public $host = 'localhost';
    
    /**
     * Nome do banco de dados
     * @var type 
     */
    public $db_name = 'manga-reader';
    
    /**
     * Senha do usuário da base de dados
     * @var type 
     */
    public $password = 'mangareader';
    
    /**
     * Usuário da base de dados
     * @var type 
     */
    public $user = 'MangaReader';
    
    /**
     * Charset da base de dados
     * @var type 
     */
    public $charset = 'utf8';
    
    /**
     * Nossa conexão com o BD
     * 
     * @var type 
     */
    public $pdo = null;
    
    /**
     * Configura o erro
     * 
     * @var type 
     */
    public $error = null;
    
    /**
     * Mostra todos os erros 
     * 
     * @var type 
     */
    public $debug = false;
    
    /**
     * Último ID inserido
     * 
     * @var type 
     */
    public $last_id = null;
    
    /**
     *
     * @var string 
     */
    public $prefix = 'mr_';
    
    /**
     * 
     */
    public function __construct() {
        $this->host = defined( 'DB_HOST' ) ? DB_HOST : $this->host;
        $this->db_name = defined( 'DB_NAME' ) ? DB_NAME : $this->db_name;
        $this->password = defined( 'DB_PASSWORD' ) ? DB_PASSWORD : $this->password;
        $this->user = defined( 'DB_USER' ) ? DB_USER : $this->user;
        $this->charset = defined( 'DB_CHARSET' ) ? DB_CHARSET : $this->charset;
        $this->prefix = defined( 'DB_PREFIX' ) ? DB_PREFIX : $this->prefix;
        $this->debug = defined( 'DEBUG' ) ? DEBUG : $this->debug;
        
        $this->connect();
    }
    
    final protected function connect() {
        
        $pdo_detail = "mysql:host={$this->host};";
        $pdo_detail .= "dbname={$this->db_name};";
        $pdo_detail .= "charset={$this->charset};";
        
        try {
            $this->pdo = new PDO( $pdo_detail, $this->user, $this->password);
            if ( TRUE === $this->debug ) {
                $this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
            }
            // Não precisamos mais dessas propriedades
            unset( $this->host     );
            unset( $this->db_name  );
            unset( $this->password );
            unset( $this->user     );
            unset( $this->charset  );
        } catch (PDOException $ex) {
            throw $ex;
        }
        
    }
    
    /**
     * 
     * @param string $statement
     * @param mixed $driver_options
     * @return PDOStatement
     */
    public function prepare ( $statement, array $driver_options = array() ) {
        return $this->pdo->prepare($statement, $driver_options);
    }
    
    /**
     * 
     * @param string $stmt
     * @param array $data_array
     * @return PDOStatement|boolean
     */
    public function query( $stmt, $data_array = null ) {
        // Prepara e executa
        $query = $this->pdo->prepare( $stmt );
        $check_exec = $query->execute( $data_array );
        // Verifica se a consulta aconteceu
        if ( $check_exec ) {
            // Retorna a consulta
            return $query;
        } else {
            // Configura o erro
            $error = $query->errorInfo();
            $this->error = $error[2];
            // Retorna falso
            return false;
        }
    }
    
    /**
     * insert - Insere valores
     *
     * Insere os valores e tenta retornar o último id enviado
     *
     * @since 0.1
     * @access public
     * @param string $table O nome da tabela
     * @param array ... Ilimitado número de arrays com chaves e valores
     * @return object|bool Retorna a consulta ou falso
     */
    public function insert( $table ) {
        // Configura o array de colunas
        $cols = array();
        // Configura o valor inicial do modelo
        $place_holders = '(';

        // Configura o array de valores
        $values = array();

        // O $j will assegura que colunas serão configuradas apenas uma vez
        $j = 1;

        // Obtém os argumentos enviados
        $data = func_get_args();
		
        // É preciso enviar pelo menos um array de chaves e valores
        if ( ! isset( $data[1] ) || ! is_array( $data[1] ) ) {
            return;
        }
		
        // Faz um laço nos argumentos
        for ( $i = 1; $i < count( $data ); $i++ ) {
            // Obtém as chaves como colunas e valores como valores
            foreach ( $data[$i] as $col => $val ) {
                // A primeira volta do laço configura as colunas
                if ( $i === 1 ) {
                    $cols[] = "`$col`";
                }
                
                if ( $j <> $i ) {
                    // Configura os divisores
                    $place_holders .= '), (';
                }
                // Configura os place holders do PDO
                $place_holders .= '?, ';
                
                // Configura os valores que vamos enviar
                $values[] = $val;
                
                $j = $i;
            }
            
            // Remove os caracteres extra dos place holders
            $place_holders = substr( $place_holders, 0, strlen( $place_holders ) - 2 );
        }

        // Separa as colunas por vírgula
        $cols = implode(', ', $cols);

        // Cria a declaração para enviar ao PDO
        $stmt = "INSERT INTO `$table` ( $cols ) VALUES $place_holders) ";
        
        // Insere os valores
        $insert = $this->query( $stmt, $values );
		
        // Verifica se a consulta foi realizada com sucesso
        if ( $insert ) {
            // Verifica se temos o último ID enviado
            if ( method_exists( $this->pdo, 'lastInsertId' ) && $this->pdo->lastInsertId() ) {
                // Configura o último ID
                $this->last_id = $this->pdo->lastInsertId();
            }

            // Retorna a consulta
            return $insert;
        }
        return;
    }
	
    /**
     * Update simples
     *
     * Atualiza uma linha da tabela baseada em um campo
     *
     * @since 0.1
     * @access protected
     * @param string $table Nome da tabela
     * @param string $where_field WHERE $where_field = $where_field_value
     * @param string $where_field_value WHERE $where_field = $where_field_value
     * @param array $values Um array com os novos valores
     * @return object|bool Retorna a consulta ou falso
     */
    public function update( $table, $where_field, $where_field_value, $values ) {
        // Você tem que enviar todos os parâmetros
        if ( empty($table) || empty($where_field) || empty($where_field_value)  ) {
            return;
        }

        // Começa a declaração
        $stmt = " UPDATE `$table` SET ";

        // Configura o array de valores
        $set = array();

        // Configura a declaração do WHERE campo=valor
        $where = " WHERE `$where_field` = ? ";

        // Você precisa enviar um array com valores
        if ( ! is_array( $values ) ) {
            return;
        }

        // Configura as colunas a atualizar
        foreach ( $values as $column => $value ) {
            $set[] = " `$column` = ?";
        }
        
        // Separa as colunas por vírgula
        $set = implode(', ', $set);
		
        // Concatena a declaração
        $stmt .= $set . $where;

        // Configura o valor do campo que vamos buscar
        $values[] = $where_field_value;
        // Garante apenas números nas chaves do array
        $values = array_values($values);
        // Atualiza
        $update = $this->query( $stmt, $values );
        // Verifica se a consulta está OK
        if ( $update ) {
            // Retorna a consulta
            return $update;
        }
        return;
    } // update
 
    /**
     * Delete
     *
     * Deleta uma linha da tabela
     *
     * @since 0.1
     * @access protected
     * @param string $table Nome da tabela
     * @param string $where_field WHERE $where_field = $where_field_value
     * @param string $where_field_value WHERE $where_field = $where_field_value
     * @return object|bool Retorna a consulta ou falso
     */
    public function delete( $table, $where_field, $where_field_value ) {
        // Você precisa enviar todos os parâmetros
        if ( empty($table) || empty($where_field) || empty($where_field_value)  ) {
            return;
        }

        // Inicia a declaração
        $stmt = " DELETE FROM `$table` ";
        
        // Configura a declaração WHERE campo=valor
        $where = " WHERE `$where_field` = ? ";
        // Concatena tudo
        $stmt .= $where;
        // O valor que vamos buscar para apagar
        $values = array( $where_field_value );
        // Apaga
        $delete = $this->query( $stmt, $values );
        // Verifica se a consulta está OK
        if ( $delete ) {
            // Retorna a consulta
            return $delete;
        }
        return;
    }
}
