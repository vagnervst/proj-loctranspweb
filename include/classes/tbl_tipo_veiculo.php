<?php
    namespace Tabela {
        
        class TipoVeiculo extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_tipoveiculo";
            public static $primary_key = "id";

            public $id;
            public $titulo;
        }
        
    }
?>