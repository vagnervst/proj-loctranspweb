<?php
    namespace DB {
        class Database {                
            private $servidor = "localhost";
            private $usuario = "root";
            private $senha = "root";
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