<?php
    namespace Tabela {
        
        class Usuario extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_usuario";
            public static $primary_key = "id";

            public $id;
            public $nome;
            public $sobrenome;
            public $sexo;
            public $cpf;
            public $dataNascimento;
            public $telefone;
            public $celular;
            public $emailContato;
            public $rg;
            public $saldo;
            public $email;
            public $senha;
            public $autenticacaoDupla;
            public $fotoPerfil;            
            public $idCidade;
            public $idTipoConta;
            public $idPlanoConta;
            public $idLicencaDesktop;
            
            public function getListaCnh() {
                $sql = "SELECT * ";
                $sql .= "FROM tbl_cnh ";
                $sql .= "WHERE idUsuario = " . $this->id;
            
                $resultado = $this->executarQuery( $sql );
            
                $lista_cnh = [];
                while( $cnh = mysqli_fetch_assoc($resultado) ) {
                    $objCnh = new \Tabela\Cnh();
                    
                    $objCnh->id = (int) $cnh["id"];
                    $objCnh->numeroRegistro = (int) $cnh["numeroRegistro"];
                    $objCnh->idUsuario = (int) $cnh["idUsuario"];
                    
                    $lista_cnh[] = $objCnh;
                }
                
                return $lista_cnh;
            }
            
            public function getUsuario($where = null ) {
                $sql = "SELECT u.id, u.nome, u.email, t.titulo as tipoConta ";
                $sql .= "FROM tbl_usuario as u ";
                $sql .= "INNER JOIN tbl_tipoconta as t ";
                $sql .= "ON u.idTipoConta = t.id";
                
                if( !empty($where) ) {
                        $sql .= " WHERE " . $where;
                }
                
                $resultado = $this->executarQuery( $sql );
                                
                $resultado = $this->get_array_from_resultado( $resultado );                                                
                
                return $resultado;
            }
            
            public function getDetalhesUsuario($where = null) {
                $sql = "SELECT u.id, u.fotoPerfil, u.nome, u.sobrenome, u.sexo, u.cpf, u.rg, ";
                $sql .= "u.telefone, u.celular, u.email, u.saldo, ";
                $sql .= "c.nome AS cidade, e.nome AS estado, u.idTipoConta, t.titulo AS tipoConta, ";
                $sql .= "p.nome AS planoConta, ld.nome AS licencaDesktop, ";                
                $sql .= "( SELECT COUNT(id) FROM tbl_pedido WHERE idUsuarioLocador = u.id ) AS qtdEmprestimos, ";
                $sql .= "( SELECT COUNT(id) FROM tbl_pedido WHERE idUsuarioLocatario = u.id ) AS qtdLocacoes, ";
                $sql .= "( SELECT COUNT(id) FROM tbl_avaliacao WHERE idUsuarioAvaliado = u.id ) AS qtdAvaliacoes, ";
                $sql .= "(SELECT  AVG(a.nota) FROM  tbl_avaliacao a WHERE idUsuarioAvaliado = u.id ) AS mediaNotas ";
                $sql .= "FROM tbl_usuario AS u ";
                $sql .= "INNER JOIN tbl_cidade AS c ";
                $sql .= "ON u.idCidade = c.id ";
                $sql .= "INNER JOIN tbl_estado AS e ";
                $sql .= "ON c.idEstado = e.id ";
                $sql .= "INNER JOIN tbl_tipoconta AS t ";
                $sql .= "ON u.idTipoConta = t.id ";
                $sql .= "INNER JOIN tbl_planoconta AS p ";
                $sql .= "ON u.idPlanoConta = p.id ";
                $sql .= "INNER JOIN tbl_licencadesktop AS ld ";

                $sql .= "ON u.idLicencaDesktop = ld.id "; 
                
                if( !empty($where) ) {
                    $sql .= " WHERE " . $where;
                }
                                                                                                  
                $resultado = $this->executarQuery( $sql );
                                
                $resultado = $this->get_array_from_resultado( $resultado );                                                
                
                return $resultado;
            }
            
            public function getTopUsuarios($where = null) {
                $sql = "SELECT u.*, SUM(av.nota) AS somaAvaliacoes, (SELECT COUNT(id) FROM tbl_avaliacao WHERE idUsuarioAvaliado = u.id) AS qtdAvaliacoes, (SUM(av.nota)/(SELECT COUNT(id) FROM tbl_avaliacao WHERE idUsuarioAvaliado = u.id)) AS mediaAvaliacao, c.nome AS cidade, e.nome AS estado ";
                $sql .= "FROM tbl_usuario AS u ";
                $sql .= "INNER JOIN tbl_conta_bancaria AS cb ";
                $sql .= "ON cb.idUsuario = u.id ";
                $sql .= "INNER JOIN tbl_avaliacao AS av ";
                $sql .= "ON av.idUsuarioAvaliado = u.id ";
                $sql .= "INNER JOIN tbl_cidade AS c ";
                $sql .= "ON c.id = u.idCidade ";
                $sql .= "INNER JOIN tbl_estado AS e ";
                $sql .= "ON e.id = c.idEstado ";
                $sql .= "ORDER BY mediaAvaliacao DESC ";                                
                $sql .= "LIMIT 10";
                
                if( !empty($where) ) {
                    $sql .= " WHERE " . $where;
                }
                   
                $resultado = $this->executarQuery( $sql );
                                
                $resultado = $this->get_array_from_resultado( $resultado );                                                
                
                return $resultado;
            }
            
            public function getLucroTotal() {
                $sql = "SELECT SUM(datediff(p.dataEntrega, p.dataRetirada) * p.valorDiaria) AS lucroTotal ";
                $sql .= "FROM tbl_pedido AS p ";
                $sql .= "INNER JOIN tbl_statuspedido AS s ";
                $sql .= "ON s.id = p.idStatusPedido ";
                $sql .= "WHERE s.cod = 9 AND p.idUsuarioLocador = {$this->id} ";
                $sql .= "GROUP BY p.idUsuarioLocador";
                
                $resultado = $this->executarQuery($sql);
                return (double) mysqli_fetch_assoc($resultado)["lucroTotal"];
            }
            
            public function getSaqueTotal() {
                $sql = "SELECT SUM(d.valor) AS totalSaque ";
                $sql .= "FROM tbl_deposito AS d ";
                $sql .= "WHERE d.idUsuario = 23 ";
                $sql .= "GROUP BY d.idUsuario";
                
                $resultado = $this->executarQuery($sql);
                return (double) mysqli_fetch_assoc($resultado)["totalSaque"];
            }
        }
        
    }
?>