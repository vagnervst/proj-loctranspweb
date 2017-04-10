<?php
    namespace Tabela {
        
        class TipoCartaoCredito extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_tipo_cartao_credito";
            public static $primary_key = "id";

            public $id;
            public $titulo;
            public $qtdDigitosSeguranca;
        }
        
    }
?>