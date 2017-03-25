<?php
    namespace Tabela {
        
        class Empreste extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_empreste";
            public static $primary_key = "id";

            public $id;
            public $titulo;
            public $descricao;
            public $imagemA;
            public $tituloA;
            public $previaImagem;
            public $previaTexto;
        }
        
    }
?>