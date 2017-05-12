<?php
    namespace Tabela {
        
        class Cityshare extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_cityshare";
            public static $primary_key = "id";

            public $id;
            public $saldo;
        }
    }
?>