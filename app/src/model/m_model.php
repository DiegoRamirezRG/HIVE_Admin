<?php
    include 'src/config/connection/database.connection.php';

    class m_model extends connection {
        public $link;
        public $numRows;
        public $error;

        public function __construct(){
            $this->link = connection::__construct();
        }

        public function _insert($query){
            $result = $this->link->query($query);
            $this->numRows = $this->link->affected_rows;
            return $result ? 'no' : 'yes';
        }

        public function _query($query){
            $result = $this->link->query($query);
            $this->numRows = $result->num_rows;
            if(!$result){
                $this->error = 'yes';
                echo "An error occurred in the model: " . mysqli_error($this->link) . "SQL: " . $query;
            }else{
                $this->error = 'no';
                while ( $resultado[] = $result->fetch_array() );
            }
    
            return $resultado;
        }
    }

?>