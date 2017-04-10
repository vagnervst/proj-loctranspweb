<?php
    namespace Tabela {
        
        class Cidade extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_cidade";
            public static $primary_key = "id";

            public $id;
            public $nome;
            public $idEstado;
        }
        
    }
?>