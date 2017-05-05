<?php
    namespace Tabela {
        
        class Pedido extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_pedido";
            public static $primary_key = "id";

            public $id;
            public $valorDiaria;
            public $valorCombustivel;
            public $valorQuilometragem;
            public $dataRetirada;
            public $dataEntrega;
            public $dataEntregaEfetuada;
            public $localRetiradaLocador;
            public $localDevolucaoLocador;
            public $localRetiradaLocatario;
            public $localDevolucaoLocatario;
            public $solicitacaoRetiradaLocador;
            public $solicitacaoDevolucaoLocador;
            public $solicitacaoRetiradaLocatario;
            public $solicitacaoDevolucaoLocatario;
            public $combustivelRestante;
            public $quilometragemExcedida;            
            public $idPublicacao;
            public $idUsuarioLocador;
            public $idUsuarioLocatario;
            public $idStatusPedido;
            public $idTipoPedido;
            public $idFormaPagamento;
            public $idFormaPagamentoPendencias;
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
                
                $resultado = $this->executarQuery( $sql );
                                
                $resultado = $this->get_array_from_resultado( $resultado );                                                
                
                return $resultado;
            }
            
            function listarPedidos($registros_por_pagina = null, $pagina_atual = null, $where = null) {
                
                $sql = "SELECT p.id, p.valorDiaria, p.valorCombustivel, p.valorQuilometragem, p.combustivelRestante, p.quilometragemExcedida, v.nome AS veiculo, v.tanque AS tanqueVeiculo, p.dataRetirada, p.dataEntrega, p.dataEntregaEfetuada, p.localRetiradaLocador, p.localDevolucaoLocador, p.localRetiradaLocatario, p.localDevolucaoLocatario, p.solicitacaoRetiradaLocador, p.solicitacaoDevolucaoLocador, p.solicitacaoRetiradaLocatario, p.solicitacaoDevolucaoLocatario, ";
                $sql .= "datediff(p.dataEntrega, p.dataRetirada) AS diarias, datediff(p.dataEntrega, p.dataRetirada) * pu.valorDiaria AS valorTotal, s.id AS idStatusPedido, s.titulo AS statusPedido,  ";
                $sql .= "locador.id AS idUsuarioLocador, locador.nome AS nomeLocador, locador.sobrenome AS sobrenomeLocador, cidadeLocador.nome AS cidadeLocador, estadoLocador.nome AS estadoLocador,  ";
                $sql .= "locatario.id AS idUsuarioLocatario, locatario.nome AS nomeLocatario, locatario.sobrenome AS sobrenomeLocatario, cidadeLocatario.nome AS cidadeLocatario, estadoLocatario.nome AS estadoLocatario, ";
                $sql .= "cn.id AS idCnh, cn.numeroRegistro AS numeroCnh ";
                $sql .= "FROM tbl_pedido AS p ";
                $sql .= "INNER JOIN tbl_usuario AS locador ";
                $sql .= "ON locador.id = p.idUsuarioLocador ";
                $sql .= "INNER JOIN tbl_usuario AS locatario ";
                $sql .= "ON locatario.id = p.idUsuarioLocatario ";
                $sql .= "INNER JOIN tbl_veiculo AS v ";
                $sql .= "ON v.id = p.idVeiculo ";
                $sql .= "INNER JOIN tbl_statuspedido AS s ";
                $sql .= "ON s.id = p.idStatusPedido ";
                $sql .= "INNER JOIN tbl_cidade AS cidadeLocatario ";
                $sql .= "ON cidadeLocatario.id = locatario.idCidade ";
                $sql .= "INNER JOIN tbl_estado AS estadoLocatario ";
                $sql .= "ON estadoLocatario.id = cidadeLocatario.idEstado ";
                $sql .= "INNER JOIN tbl_cidade AS cidadeLocador ";
                $sql .= "ON cidadeLocador.id = locador.idCidade ";
                $sql .= "INNER JOIN tbl_estado AS estadoLocador ";
                $sql .= "ON estadoLocador.id = cidadeLocador.idEstado ";
                $sql .= "INNER JOIN tbl_publicacao AS pu ";
                $sql .= "ON pu.id = p.idPublicacao ";
                $sql .= "INNER JOIN tbl_cnh AS cn ";
                $sql .= "ON cn.id = p.idCnh";
                                                
                if( !empty($where) ) {
                    $sql .= " WHERE " . $where;
                }                                
                
                $sql .= " ORDER BY p.dataRetirada DESC";
                
                if( !empty($registros_por_pagina) && !empty($pagina_atual) ) {
                    $registros_a_ignorar = $registros_por_pagina * ( $pagina_atual - 1 );
                    
                    $sql .= " LIMIT " . $registros_por_pagina . " ";
                    $sql .= "OFFSET " . $registros_a_ignorar;
                }                                
                
                $resultado = $this->executarQuery( $sql );
                $listaPedidos = $this->get_array_from_resultado( $resultado );
                
                return $listaPedidos;
            }
        }

    }
?>