<?php
    namespace Tabela {
        
         class AlteracaoPedido extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_alteracao_pedido";
            public static $primary_key = "id";
            
            public $id;
            public $dataOcorrencia;
            public $idStatus;
            public $idPedido;
             
            public function getAlteracaoPedido($where = null) {
                $sql = "SELECT a.id, a.dataOcorrencia, p.id AS idStatusPedido, p.titulo AS tituloStatus, a.idPedido ";
                $sql .= "FROM tbl_alteracao_pedido AS a ";
                $sql .= "INNER JOIN tbl_statuspedido AS p ";
                $sql .= "ON p.id = a.idStatus";
                
                if( !empty($where) ) {
                    $sql .= " WHERE " . $where;
                }                                
                
                $resultado = $this->executarQuery( $sql );
                $listaAlteracao = $this->get_array_from_resultado($resultado);
                
                return $listaAlteracao;
            }
        }
    }
?>