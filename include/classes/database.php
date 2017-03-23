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
                echo "conectando...<br/><hr/>";
                $this->conexao = mysqli_connect($this->servidor, $this->usuario, $this->senha, $this->banco);
            }

            public function desconectar() {
                echo "desconectando...<br/><hr/>";
                return mysqli_close($this->conexao);
            }

            public function query($sql) {
                return mysqli_query($this->conexao, $sql);
            }
        }
    }
?>