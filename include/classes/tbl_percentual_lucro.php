<?php
    namespace Tabela {
        
        class PercentualLucro extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_percentual_lucro";
            public static $primary_key = "id";

            public $id;
            public $percentual;
            public $valorMinimo;
            public $idCategoria;
            public $idTipoVeiculo;
            
            public function getPercentuais($registros_por_pagina, $pagina_atual, $where = null) {
                $sql = "SELECT pl.id, pl.percentual, pl.valorMinimo, c.id AS idCategoria, c.nome AS categoriaVeiculo, tv.id AS idTipoVeiculo, tv.titulo AS tipoVeiculo ";
                $sql .= "FROM tbl_percentual_lucro AS pl ";
                $sql .= "INNER JOIN tbl_categoriaveiculo AS c ";
                $sql .= "ON c.id = pl.idCategoria ";
                $sql .= "INNER JOIN tbl_tipoveiculo AS tv ";
                $sql .= "ON tv.id = pl.idTipoVeiculo";
                
                if( !empty($where) ) {
                    $sql .= " WHERE " . $where;
                }

                $sql .= " ORDER BY c.nome";

                if( !empty($registros_por_pagina) && !empty($pagina_atual) ) {
                    $registros_a_ignorar = $registros_por_pagina * ( $pagina_atual - 1 );

                    $sql .= " LIMIT " . $registros_por_pagina . " ";
                    $sql .= "OFFSET " . $registros_a_ignorar;
                }                                
                
                $resultado = $this->executarQuery( $sql );
                $resultado = $this->get_array_from_resultado( $resultado );
                
                $total_veiculos = $this->executarQuery("SELECT COUNT(*) AS total FROM {$this::$nome_tabela}");

                $info_paginacao = [];
                $info_paginacao["totalRegistros"] = (int) mysqli_fetch_array( $total_veiculos )[0];
                $info_paginacao["paginaAtual"] = (int) $pagina_atual;
                $info_paginacao["registrosPorPagina"] = (int) $registros_por_pagina;

                $resultado[] = $info_paginacao;                                
                
                return $resultado;
            }
        }
    }
?>