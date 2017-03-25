<?php
    namespace Tabela {
        
        class SobreEmpresa extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_sobreempresa";
            public static $primary_key = "id";

            public $id;
            public $titulo;
            public $introducao;
            public $imagemA;
            public $tituloA;
            public $descricaoA;
            public $imagemB;
            public $tituloB;
            public $descricaoB;
            public $previaImagem;
            public $previaTexto;
        }
        
    }
?>