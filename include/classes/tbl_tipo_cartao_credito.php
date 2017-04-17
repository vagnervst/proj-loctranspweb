<?php
    namespace Tabela {
        
        class TipoCartaoCredito extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_tipo_cartao_credito";
            public static $primary_key = "id";

            public $id;
            public $titulo;
            public $qtdDigitosSeguranca;
            public $visivel;
            
            public function getTipoCartao($registros_por_pagina, $pagina_atual, $where = null) {
                $sql = "SELECT *";
                $sql .= "FROM {$this::$nome_tabela}";
                
                if( !empty($where) ) {
                    $sql .= " WHERE " . $where;
                }

                $sql .= " ORDER BY titulo";
                
                if( !empty($registros_por_pagina) && !empty($pagina_atual) ) {
                    $registros_a_ignorar = $registros_por_pagina * ( $pagina_atual - 1 );

                    $sql .= " LIMIT " . $registros_por_pagina . " ";
                    $sql .= "OFFSET " . $registros_a_ignorar;
                }
                $resultado = $this->executarQuery( $sql );
                $resultado = $this->get_array_from_resultado( $resultado );
                
                $total_cartoes = $this->executarQuery("SELECT COUNT(*) AS total FROM {$this::$nome_tabela}");
                
                $info_paginacao = [];
                $info_paginacao["totalRegistros"] = (int) mysqli_fetch_array( $total_cartoes )[0];
                $info_paginacao["paginaAtual"] = (int) $pagina_atual;
                $info_paginacao["registrosPorPagina"] = (int) $registros_por_pagina;
                
                $resultado[] = $info_paginacao;
                
                return $resultado;
            }
            public function hideTipoCartao() {
                $sql = "UPDATE tbl_tipo_cartao_credito ";
                $sql .= "SET visivel = 0 ";
                $sql .= "WHERE id = " . $this->id;
                
                return $this->executarQuery( $sql );
            }
        } 
    }
?>