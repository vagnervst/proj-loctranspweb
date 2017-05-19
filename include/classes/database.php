<?php
    namespace DB {
        class Database {                
            private $servidor = "10.107.144.3";
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
                
                if( !mysqli_set_charset($this->conexao, "utf8") ) {                    
                    printf("Houve um erro ao tentar definir o character set: %s", mysqli_error($this->conexao));
                    exit;
                }
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