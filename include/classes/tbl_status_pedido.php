<?php
    namespace Tabela {
        
        class StatusPedido extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_statuspedido";
            public static $primary_key = "id";
            
            public $id;
            public $titulo;
        }
    }
?>