<?php
    namespace Tabela {
        
        class PerguntasFrequentes extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_perguntasfrequentes";
            public static $primary_key = "id";

            public $id;
            public $pergunta;
            public $resposta;
        }
        
    }
?>