<?php
    namespace Tabela {
        
        class Veiculo extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_veiculo";
            public static $primary_key = "id";

            public $id;
            public $nome;
            public $tipoMotor;
            public $precoMedio;
            public $ano;
            public $qtdPortas;
            public $idCategoriaVeiculo;
            public $idFabricante;
            public $idTipoCombustivel;
            public $idTipoVeiculo;
            public $idTransmissao;
            
            public function getVeiculos($registros_por_pagina = null, $salto = null) {
                //Retorna a relação de veiculos, fabricantes, combustivel, categoria, tipo e transmissao
                
                $sql = "SELECT v.id, v.nome, v.tipoMotor, v.precoMedio, v.ano, v.qtdPortas, c.nome AS categoria, f.nome AS fabricante, cb.nome AS combustivel, t.titulo AS tipo, tr.titulo AS transmissao ";
                $sql .= "FROM {$this::$nome_tabela} AS v ";
                $sql .= "INNER JOIN tbl_categoriaveiculo AS c ";
                $sql .= "ON c.id = v.idCategoriaVeiculo ";
                $sql .= "INNER JOIN tbl_fabricanteveiculo AS f ";
                $sql .= "ON f.id = f.id ";
                $sql .= "INNER JOIN tbl_tipocombustivel AS cb ";
                $sql .= "ON cb.id = v.idTipoCombustivel ";
                $sql .= "INNER JOIN tbl_tipoveiculo AS t ";
                $sql .= "ON t.id = v.idTipoVeiculo ";
                $sql .= "INNER JOIN tbl_transmissaoveiculo AS tr ";
                $sql .= "ON tr.id = v.idTransmissao";                                                                
                
                if( !empty($registros_por_pagina) && !empty($salto) ) {
                    $sql .= " LIMIT " . $registros_por_pagina . " ";
                    $sql .= "OFFSET " . $salto;
                }
                
                $resultado = $this->executarQuery( $sql );
                $resultado = $this->get_array_from_resultado( $resultado );
                return $resultado;
            }
        }
        
    }
?>