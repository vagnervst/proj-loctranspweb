<?php
    namespace Tabela {
        
        class PlanoConta extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_planoconta";
            public static $primary_key = "id";

            public $id;
            public $nome;
            public $preco;
            public $duracaoMeses;
            public $limitePublicacao;
            public $descPlano;
            public $diasAnalisePublicacao;
        
            public function getPlanos($registros_por_pagina = null, $pagina_atual = null, $where = null) {
                $sql = "SELECT p.* ";
                $sql .= "FROM {$this::$nome_tabela} AS p ";

                if( !empty($where) ) {
                    $sql .= " WHERE " . $where;
                }
                
                $sql .= " ORDER BY p.nome";

                if( !empty($registros_por_pagina) && !empty($pagina_atual) ) {
                    $registros_a_ignorar = $registros_por_pagina * ( $pagina_atual - 1 );

                    $sql .= " LIMIT " . $registros_por_pagina . " ";
                    $sql .= "OFFSET " . $registros_a_ignorar;
                }                                
                
                $resultado = $this->executarQuery( $sql );
                $resultado = $this->get_array_from_resultado( $resultado );

                $total_veiculos = $this->executarQuery("SELECT COUNT(*) AS total FROM {$this::$nome_tabela}");
                
                if( !empty($registros_por_pagina) && !empty($pagina_atual) ) {
                    $info_paginacao = [];
                    $info_paginacao["totalRegistros"] = (int) mysqli_fetch_array( $total_veiculos )[0];
                    $info_paginacao["paginaAtual"] = (int) $pagina_atual;
                    $info_paginacao["registrosPorPagina"] = (int) $registros_por_pagina;

                    $resultado[] = $info_paginacao;
                }
                
                return $resultado;
            }
        }
    }
?>