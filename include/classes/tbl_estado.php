<?php
    namespace Tabela {
        
        class Estado extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_estado";
            public static $primary_key = "id";

            public $id;
            public $nome;
            public $idPais;
        }
        
    }
?>