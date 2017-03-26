<?php
    namespace Tabela {
        
        class Home extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_home";
            public static $primary_key = "id";

            public $id;
            public $titulo;
            public $imagemA;
        }
        
    }
?>