<?php
    namespace Tabela {
        
        class Pedido extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_pedido";
            public static $primary_key = "id";

            public $id;
            public $dataRetirada;
            public $dataEntrega;
            public $idPublicacao;
            public $idUsuarioLocador;
            public $idUsuarioLocatario;
            public $idStatusPedido;
            public $idTipoPedido;
            public $idFormaPagamento;
            public $idFuncionario;
            public $idCnh;
            public $idVeiculo;
            
            function getPedido($where = null) {
                
                $sql = "SELECT p.id AS idPedido, p.dataRetirada, p.dataEntrega, p.idUsuarioLocatario AS idLocatario, ";
                $sql .= "u.nome AS nomeLocador, u.sobrenome AS sobrenomeLocador, sp.titulo AS statusPedido ";
                $sql .= "FROM tbl_pedido AS p ";
                $sql .= "INNER JOIN tbl_usuario AS u ";
                $sql .= "ON u.id = p.idUsuarioLocador ";
                $sql .= "INNER JOIN tbl_statuspedido AS sp ";
                $sql .= "ON sp.id = p.idStatusPedido";
                
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
                
                return $resultado;
            }
        }

    }
?>