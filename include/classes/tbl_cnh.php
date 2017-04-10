<?php
    namespace Tabela {
        
        class Cnh extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_cnh";
            public static $primary_key = "id";

            public $id;
            public $numeroRegistro;
            public $idUsuario;
        }
        
    }
?>