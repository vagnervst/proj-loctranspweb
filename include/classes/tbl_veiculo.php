<?php
    namespace Tabela {
        
        class Veiculo extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_veiculo";
            public static $primary_key = "id";

            public $id;
            public $codigo;
            public $nome;
            public $tipoMotor;
            public $precoMedio;
            public $ano;
            public $tanque;
            public $qtdPortas;
            public $idCategoriaVeiculo;
            public $idFabricante;
            public $idTipoCombustivel;
            public $idTipoVeiculo;
            public $idTransmissao;
            
            public function getVeiculos($registros_por_pagina = null, $pagina_atual = null, $where = null, $group = null) {
                //Retorna a relação de veiculos, fabricantes, combustivel, categoria, tipo e transmissao
                
                $sql = "SELECT v.id, v.codigo, v.nome, v.tipoMotor, v.ano, v.qtdPortas, v.idCategoriaVeiculo, v.tanque, ";
                $sql .= "c.nome AS categoria, v.idFabricante, f.nome AS fabricante, v.idTipoCombustivel, cb.nome AS combustivel, ";
                $sql .= "v.idTipoVeiculo, t.titulo AS tipo, v.idTransmissao, tr.titulo AS transmissao ";
                $sql .= "FROM {$this::$nome_tabela} AS v ";
                $sql .= "INNER JOIN tbl_categoriaveiculo AS c ";
                $sql .= "ON c.id = v.idCategoriaVeiculo ";
                $sql .= "INNER JOIN tbl_fabricanteveiculo AS f ";
                $sql .= "ON f.id = v.idFabricante ";
                $sql .= "INNER JOIN tbl_tipocombustivel AS cb ";
                $sql .= "ON cb.id = v.idTipoCombustivel ";
                $sql .= "INNER JOIN tbl_tipoveiculo AS t ";
                $sql .= "ON t.id = v.idTipoVeiculo ";
                $sql .= "INNER JOIN tbl_transmissaoveiculo AS tr ";
                $sql .= "ON tr.id = v.idTransmissao";
            
                if( !empty($where) ) {
                    $sql .= " WHERE " . $where;
                }
                
                if( !empty($group) ) {
                    $sql .= " GROUP BY " . $group;
                }
                
                $sql .= " ORDER BY v.nome";
                
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
            
            public function getAcessorios($where = null) {
                
                $sql = "SELECT a.id, a.nome, v.idTipoVeiculo ";
                $sql .= "FROM tbl_acessorioveiculo AS a ";
                $sql .= "INNER JOIN tbl_veiculo AS v ";
                $sql .= "INNER JOIN acessorioveiculo_tipoveiculo AS act ";
                $sql .= "ON a.id = act.idAcessorio AND v.idTipoVeiculo = act.idTipoVeiculo";
                
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