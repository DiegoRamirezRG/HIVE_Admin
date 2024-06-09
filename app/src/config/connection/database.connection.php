<?php

    class connection {
        private $_connection;

        public function __construct(){
            $this->_connection = new mysqli(
                $_ENV['DB_HOST'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASS'],
                $_ENV['DB_NAME']
            );
    
            if ($this->_connection->connect_error) {
                trigger_error("Error al conectar con la Base de datos: " . $this->_connection->connect_error, E_USER_ERROR);
            }else {
                return $this->_connection;
            }
        }
    }

?>