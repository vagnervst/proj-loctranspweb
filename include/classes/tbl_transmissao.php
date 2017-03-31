<?php
    namespace Tabela {
        
        class TransmissaoVeiculo extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_transmissaoveiculo";
            public static $primary_key = "id";

            public $id;
            public $titulo;            
        }
        
    }
?>