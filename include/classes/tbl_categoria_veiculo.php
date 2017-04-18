<?php
    namespace Tabela {
        
        class CategoriaVeiculo extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_categoriaveiculo";
            public static $primary_key = "id";

            public $id;
            public $nome;
            public $percentualLucro;
            public $valorMinimoVeiculo;
            public $idTipoVeiculo;
        
            public function getCategorias($registros_por_pagina, $pagina_atual, $where = null) {
                $sql = "SELECT c.id, c.nome, c.percentualLucro, c.valorMinimoVeiculo, c.idTipoVeiculo, t.titulo AS tituloTipo ";
                $sql .= "FROM {$this::$nome_tabela} AS c ";
                $sql .= "INNER JOIN tbl_tipoveiculo AS t ";
                $sql .= "ON t.id = c.idTipoVeiculo";

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