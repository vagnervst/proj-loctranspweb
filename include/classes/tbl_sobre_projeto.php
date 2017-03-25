<?php
    namespace Tabela {
        
        class SobreProjeto extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_sobreprojeto";
            public static $primary_key = "id";

            public $id;
            public $titulo;
            public $conteudo;
            public $imagemA;
            public $imagemB;
            public $descricaoA;
            public $descricaoB;
            public $previaTexto;
            public $previaImagem;
        }
    }
?>