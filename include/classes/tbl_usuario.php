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
            public $email;
            public $rg;
            public $saldo;
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
            
            public function getUsuario() {
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
                $sql = "SELECT u.id, u.nome, u.sobrenome, u.sexo, u.cpf, u.rg, ";
                $sql .= "u.telefone, u.celular, u.email, ";
                $sql .= "c.nome AS cidade, e.nome AS estado, t.titulo AS tipoConta, ";
                $sql .= "p.nome AS planoConta, ld.nome AS licencaDesktop ";
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
        }
        
    }
?>