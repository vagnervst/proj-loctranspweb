<?php
    namespace Tabela {
        
        class FabricanteVeiculo extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_fabricanteveiculo";
            public static $primary_key = "id";

            public $id;
            public $nome;
        }
    }
?>