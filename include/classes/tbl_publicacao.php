<?php
    namespace Tabela {
        class Publicacao extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_publicacao";
            public static $primary_key = "id";
            
            public $id;
            public $titulo;
            public $descricao;
            public $valorDiaria;
            public $valorCombustivel;
            public $valorQuilometragem;
            public $quilometragemAtual;
            public $limiteQuilometragem;
            public $dataPublicacao;
            public $imagemPrincipal;
            public $imagemA;
            public $imagemB;
            public $imagemC;
            public $imagemD;
            public $idStatusPublicacao;
            public $idAgencia;
            public $idUsuario;
            public $idFuncionario;
            
            function getPublicacao($registro_por_pagina = null, $pagina_atual = null, $where = null) {
                
                $sql = "SELECT p."
            /*SELECT p.titulo, p.descricao, p.valorDiaria, p.valorCombustivel, p.valorQuilometragem,
            p.quilometragemAtual, p.limiteQuilometragem, p.dataPublicacao, p.imagemPrincipal, p.imagemA
            p.imagemB, p.imagemC, p.imagemD, p.idStatusPublicacao, p.idAgencia, p.idUsuario, p.idFuncionario,
            v.nome AS modelo
            FROM tbl_publicacao AS p
            INNER JOIN tbl_veiculo AS v
            ON;*/
            }
        }
    }
?>