<?php
    namespace Tabela {
        
        class BeneficiosProjeto extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_beneficiosprojeto";
            public static $primary_key = "id";

            public $id;
            public $titulo;
            public $introducao;
            public $imagemA;
            public $imagemB;
            public $imagemC;
            public $descricaoA;
            public $descricaoB;
            public $descricaoC;
            public $previaImagem;
            public $previaTexto;
        }
        
    }
?>