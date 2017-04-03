<?php
    namespace Tabela {
        
        class fabricanteVeiculo extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_fabricanteveiculo";
            public static $primary_key = "id";

            public $id;
            public $nome;
            
            public function getFabricante($registros_por_pagina, $pagina_atual, $where = null) {
                $sql = "SELECT f.* ";
                $sql .= "FROM {$this::$nome_tabela} AS f ";
                
                if( !empty($where) ) {
                    $sql .= " WHERE " . $where;
                }

                $sql .= " ORDER BY f.nome";

                if( !empty($registros_por_pagina) && !empty($pagina_atual) ) {
                    $registros_a_ignorar = $registros_por_pagina * ( $pagina_atual - 1 );

                    $sql .= " LIMIT " . $registros_por_pagina . " ";
                    $sql .= "OFFSET " . $registros_a_ignorar;
                }     
                
                $resultado = $this->executarQuery( $sql );
                $resultado = $this->get_array_from_resultado( $resultado );

                $total_fabricante = $this->executarQuery("SELECT COUNT(*) AS total FROM {$this::$nome_tabela}");

                $info_paginacao = [];
                $info_paginacao["totalRegistros"] = (int) mysqli_fetch_array( $total_fabricante )[0];
                $info_paginacao["paginaAtual"] = (int) $pagina_atual;
                $info_paginacao["registrosPorPagina"] = (int) $registros_por_pagina;

                $resultado[] = $info_paginacao;

                return $resultado;
                
            }
            
            
            
        }
    }
?>