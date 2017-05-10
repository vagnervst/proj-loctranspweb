<?php
    namespace Tabela {
        
        class Avaliacao extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_avaliacao";
            public static $primary_key = "id";
            
            public $id;
            public $nota;
            public $mensagem;
            public $data;
            public $idUsuarioAvaliador;
            public $idUsuarioAvaliado;
            
            public function getAvaliacao($registros_por_pagina = null, $pagina_atual = null, $where = null) {
            
                $sql = "SELECT a.id, a.nota, a.mensagem, a.data AS dataAvaliacao, ";
                $sql .= "avaliado.nome AS nomeAvaliado, avaliado.sobrenome AS sobrenomeAvaliado, ";
                $sql .= "avaliador.nome AS nomeAvaliador, avaliador.sobrenome AS sobrenomeAvaliador ";
                $sql .= "FROM tbl_avaliacao AS a ";
                $sql .= "INNER JOIN tbl_usuario AS avaliado ";
                $sql .= "ON avaliado.id = a.idUsuarioAvaliado ";
                $sql .= "INNER JOIN tbl_usuario AS avaliador ";
                $sql .= "ON avaliador.id = a.idUsuarioAvaliador ";

                if( !empty($where) ) {
                    $sql .= " WHERE " . $where;
                }

                if( !empty($registros_por_pagina) && !empty($pagina_atual) ) {
                        $registros_a_ignorar = $registros_por_pagina * ( $pagina_atual - 1 );

                        $sql .= " LIMIT " . $registros_por_pagina . " ";
                        $sql .= "OFFSET " . $registros_a_ignorar;
                }

                $resultado = $this->executarQuery( $sql );
                $resultado  = $this->get_array_from_resultado( $resultado );

                return $resultado;
            }
        }
    }
?>