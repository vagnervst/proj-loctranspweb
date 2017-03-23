<?php
    namespace Tabela {
        
        class Assunto extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_assunto";
            public static $primary_key = "id";

            public $id;
            public $titulo;
        }
        
    }
?>