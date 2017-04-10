<?php
    namespace Tabela {
        
        class ContaBancaria extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_conta_bancaria";
            public static $primary_key = "id";

            public $id;
            public $numeroAgencia;
            public $conta;
            public $digito;
            public $idUsuario;
            public $idTipoConta;
            public $idBanco;
        }
        
    }
?>