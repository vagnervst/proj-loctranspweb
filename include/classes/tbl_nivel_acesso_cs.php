<?php
    namespace Tabela {
        
        class NivelAcessoCS extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_nivelacesso_cs";
            public static $primary_key = "id";

            public $id;
            public $nome;            
        }
        
    }
?>