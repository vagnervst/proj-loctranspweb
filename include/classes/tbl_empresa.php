<?php
    namespace Tabela {
        
        class Empresa extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_empresa";
            public static $primary_key = "id";

            public $id;
            public $nomeHost;
            public $razaoSocial;
            public $nomeFantasia;
            public $cnpj;
            public $logomarca;
            public $idUsuarioJuridico;
        }
        
    }
?>