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
            
            function getPublicacao($where = null) {
                
                $sql = "SELECT p.id, p.titulo, p.descricao, p.valorDiaria, p.valorCombustivel, p.valorQuilometragem, ";
                $sql .= "p.quilometragemAtual, p.limiteQuilometragem, p.imagemPrincipal, p.imagemA, p.imagemB, p.imagemC, p.imagemD, p.idStatusPublicacao, sp.titulo AS tituloStatus, ";
                $sql .= "u.id AS idLocador, u.nome AS nomeLocador, u.sobrenome AS sobrenomeLocador, ";
                $sql .= "v.id AS idVeiculo, v.nome AS modeloVeiculo, ";
                $sql .= "f.id AS idFuncionario ";
                $sql .= "FROM tbl_publicacao AS p ";
                $sql .= "INNER JOIN tbl_veiculo AS v ";
                $sql .= "ON v.id = p.idVeiculo ";
                $sql .= "INNER JOIN tbl_statuspublicacao AS sp ";
                $sql .= "ON sp.id = p.idStatusPublicacao ";
                $sql .= "LEFT JOIN tbl_usuario AS u ";
                $sql .= "ON u.id = p.idUsuario ";
                $sql .= "LEFT JOIN tbl_funcionario AS f ";
                $sql .= "ON f.id = p.idFuncionario ";
                $sql .= "LEFT JOIN tbl_agencia AS a ";
                $sql .= "ON a.id = p.idAgencia";
                
                if( !empty($where) ) {
                        $sql .= " WHERE " . $where;
                }
                
                $resultado = $this->executarQuery( $sql );
                                
                $resultado = $this->get_array_from_resultado( $resultado );                                                
                
                return $resultado;
            }
            public function getDetalhesPublicacao($where = null) {
                $sql = "SELECT p.id, p.titulo, p.descricao, p.imagemPrincipal, p.imagemA, p.imagemB, p.imagemC, p.imagemD, ";
                $sql .= "u.id AS idLocador, u.nome AS nomeLocador, u.sobrenome AS sobrenomeLocador, ";
                $sql .= "c.nome AS cidade, e.nome AS estado, ";
                $sql .= "v.id AS idVeiculo, v.nome AS modeloVeiculo, v.codigo, v.tipoMotor, v.ano, v.qtdPortas, v.idCategoriaVeiculo, ";
                $sql .= "cv.nome AS categoria, v.idFabricante, fb.nome as fabricante, v.idTipoCombustivel, cb.nome AS combustivel, ";
                $sql .= "v.idTipoVeiculo, tp.titulo AS tipoVeiculo, v.idTransmissao, tr.titulo AS transmissao, ";
                $sql .= "f.id AS idFuncionario ";
                $sql .= "FROM tbl_publicacao AS p ";
                $sql .= "INNER JOIN tbl_veiculo AS v ";
                $sql .= "ON v.id = p.idVeiculo ";
                $sql .= "INNER JOIN tbl_statuspublicacao AS sp ";
                $sql .= "ON sp.id = p.idStatusPublicacao ";
                $sql .= "LEFT JOIN tbl_funcionario AS f ";
                $sql .= "ON f.id = p.idFuncionario ";
                $sql .= "LEFT JOIN tbl_agencia AS a ";
                $sql .= "ON a.id = p.idAgencia ";
                $sql .= "INNER JOIN tbl_categoriaveiculo AS cv ";
                $sql .= "ON cv.id = v.idCategoriaVeiculo ";
                $sql .= "INNER JOIN tbl_fabricanteveiculo AS fb ";
                $sql .= "ON fb.id = v.idFabricante ";
                $sql .= "INNER JOIN tbl_tipocombustivel AS cb ";
                $sql .= "ON cb.id = v.idTipoCombustivel ";
                $sql .= "INNER JOIN tbl_tipoveiculo AS tp ";
                $sql .= "ON tp.id = v.idTipoVeiculo INNER JOIN ";
                $sql .= "tbl_transmissaoveiculo AS tr ";
                $sql .= "ON tr.id = v.idTransmissao ";
                $sql .= "LEFT JOIN tbl_usuario AS u ";
                $sql .= "ON u.id = p.idUsuario ";
                $sql .= "INNER JOIN tbl_cidade AS c ";
                $sql .= "ON u.idCidade = c.id ";
                $sql .= "INNER JOIN tbl_estado AS e ";
                $sql .= "ON c.idEstado = e.id ";
                
                if( !empty($where) ) {
                        $sql .= " WHERE " . $where;
                }
                
                $resultado = $this->executarQuery( $sql );
                                
                $resultado = $this->get_array_from_resultado( $resultado );                                                
                
                return $resultado;
            }
        }
    }
?>