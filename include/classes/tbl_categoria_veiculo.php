<?php
    namespace Tabela {
        
        class CategoriaVeiculo extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_categoriaveiculo";
            public static $primary_key = "id";

            public $id;
            public $nome;
            public $percentualLucro;
            public $valorMinimoVeiculo;
            public $idTipoVeiculo;
        }
        
    }
?>