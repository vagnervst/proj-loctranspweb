<?php
    namespace DB {
        class Database {                
            private $servidor = "10.107.140.37";
            private $usuario = "root";
            private $senha = "bcd127";
            private $banco = "dbcityshare";
            public $conexao;

            function __construct() {
                $this->conectar();
            }

            function __destruct() {
                $this->desconectar();
            }

            private function conectar() {                
                $this->conexao = mysqli_connect($this->servidor, $this->usuario, $this->senha, $this->banco);
                mysqli_set_charset($this->conexao, "utf-8");
            }

            public function desconectar() {                
                return mysqli_close($this->conexao);
            }

            public function query($sql) {
                return mysqli_query($this->conexao, $sql);
            }
        }
     }
?>