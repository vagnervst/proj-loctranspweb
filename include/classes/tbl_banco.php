<?php
    namespace Tabela {
        
        class Banco extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_banco";
            public static $primary_key = "id";

            public $id;
            public $nome;
            public $qtdDigitosVerificadores;
        }
        
    }
?>