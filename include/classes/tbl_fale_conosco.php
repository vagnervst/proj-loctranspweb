<?php
    namespace Tabela {
        
        class FaleConosco extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_faleconosco";
            public static $primary_key = "id";

            public $id;
            public $tituloA;
            public $tituloB;
            public $descricaoA;
            public $email;
            public $telefone;
            public $horarioAtendimento;
            public $endereco;
        }
        
    }
?>