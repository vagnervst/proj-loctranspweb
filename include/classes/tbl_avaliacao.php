<?php
    namespace Tabela {
        
        class Avaliacao extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_avaliacao";
            public static $primary_key = "id";
            
            public $id;
            public $nota;
            public $mensagem;
            public $data;
            public $idUsuarioAvaliador;
            public $idUsuarioAvaliado;
        }
        
    }
?>