<?php
    namespace Tabela {
        
        class Deposito extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_deposito";
            public static $primary_key = "id";

            public $id;
            public $valor;
            public $quando;
            public $idUsuario;
        }
        
    }
?>