<?php
    define("DB_HOST","localhost");
    define("DB_USER","root");
    define("DB_PASS","");
    define("DB_NAME","library");

    class connection {
        private $conn;

        public function __construct() {
            $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (!$this->conn) {
                die("Connection failed: ". mysqli_connect_error());
            }
        }

        public function query($query) {
            $result = mysqli_query($this->conn, $query);
            return $result;
        }

        public function fetch($query) {
            $result = mysqli_fetch_assoc($query);
            return $result;
        }

        public function insert($query) {
            $result = mysqli_query($this->conn, $query);
            return $result;
        }

    }
?>