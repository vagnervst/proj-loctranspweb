<?php
    namespace Tabela {
        
        class Mes extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_mes";
            public static $primary_key = "id";
            
            public $id;
            public $mes;
            public $titulo;
        }
    }
?>