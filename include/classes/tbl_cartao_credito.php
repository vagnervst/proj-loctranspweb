<?php
    namespace Tabela {
        
        class CartaoCredito extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_cartao_credito";
            public static $primary_key = "id";

            public $id;
            public $numero;
            public $vencimento;            
            public $idUsuario;
            public $idTipo;
        }
        
    }
?>