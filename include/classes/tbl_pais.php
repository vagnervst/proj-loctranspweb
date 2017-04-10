<?php
    namespace Tabela {
        
        class Pais extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_pais";
            public static $primary_key = "id";
            
            public $id;
            public $nome;
        }
    }
?>