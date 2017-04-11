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
            public $idVeiculo;
            
            function getPublicacao($registros_por_pagina = null, $pagina_atual = null, $where = null) {
                
                $sql = "SELECT p.id, p.titulo, p.valorDiaria, p.valorCombustivel, p.valorQuilometragem, ";
                $sql .= "p.imagemPrincipal, ";
                $sql .= "p.idStatusPublicacao, ";
                $sql .= "v.nome AS modelo ";
                $sql .= "FROM tbl_publicacao AS p ";
                $sql .= "INNER JOIN tbl_veiculo AS v ";
                $sql .= "ON p.idVeiculo = v.id";

                if( !empty($where) ) {
                        $sql .= " WHERE " . $where;
                }                

                if( !empty($registros_por_pagina) && !empty($pagina_atual) ) {
                    $registros_a_ignorar = $registros_por_pagina * ( $pagina_atual - 1 );

                    $sql .= " LIMIT " . $registros_por_pagina . " ";
                    $sql .= "OFFSET " . $registros_a_ignorar;
                }                                
                
                $resultado = $this->executarQuery( $sql );
                                
                $resultado = $this->get_array_from_resultado( $resultado );                
                
                /*$total_publicacoes = $this->executarQuery("SELECT COUNT(*) AS total FROM {$this::$nome_tabela}");
                
                $info_paginacao = [];
                $info_paginacao["totalRegistros"] = (int) mysqli_fetch_array( $total_publicacoes )[0];
                $info_paginacao["paginaAtual"] = (int) $pagina_atual;
                $info_paginacao["registrosPorPagina"] = (int) $registros_por_pagina;
                
                $resultado[] = $info_paginacao;*/
                
                return $resultado;
            }
        }
    }
?>