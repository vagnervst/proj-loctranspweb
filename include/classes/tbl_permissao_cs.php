<?php
    namespace Tabela {
        
         class PermissaoCS extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_permissao_cs";
            public static $primary_key = "id";
            
            public $id;
            public $nome;                    
        }
    }
?>