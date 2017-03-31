<?php
    namespace Tabela {
        
        class TipoCombustivel extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_tipocombustivel";
            public static $primary_key = "id";

            public $id;
            public $nome;
        }
        
    }
?>