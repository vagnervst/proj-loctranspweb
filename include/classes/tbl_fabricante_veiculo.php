<?php
    namespace Tabela {
        
        class FabricanteVeiculo extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_fabricanteveiculo";
            public static $primary_key = "id";

            public $id;
            public $nome;
            
            public function getFabricante($registros_por_pagina, $pagina_atual, $where = null) {
                $sql = "SELECT f.* ";
                $sql .= "FROM {$this::$nome_tabela} AS f ";
                
                if( !empty($where) ) {
                    $sql .= " WHERE " . $where;
                }

                $sql .= " ORDER BY f.nome";

                if( !empty($registros_por_pagina) && !empty($pagina_atual) ) {
                    $registros_a_ignorar = $registros_por_pagina * ( $pagina_atual - 1 );

                    $sql .= " LIMIT " . $registros_por_pagina . " ";
                    $sql .= "OFFSET " . $registros_a_ignorar;
                }     
                
                $lista_fabricantes = $this->executarQuery( $sql );
                $lista_fabricantes = $this->get_array_from_resultado( $lista_fabricantes );

                foreach( $lista_fabricantes as $fabricante ) {
                    $sql = "SELECT t.* ";
                    $sql .= "FROM tbl_tipoveiculo AS t ";
                    $sql .= "INNER JOIN fabricanteveiculo_tipoveiculo AS ft ";
                    $sql .= "ON ft.idTipo = t.id ";
                    $sql .= "INNER JOIN tbl_fabricanteveiculo AS f ";
                    $sql .= "ON f.id = ft.idFabricante ";
                    $sql .= "WHERE f.id = {$fabricante->id}";                                        
                    
                    $lista_tipos_veiculo = [];
                    
                    $busca_tipos_veiculo = $this->executarQuery( $sql );
                    while( $tipo_veiculo = mysqli_fetch_assoc($busca_tipos_veiculo) ) {
                        $objTipoVeiculo = new TipoVeiculo();
                        $objTipoVeiculo->id = $tipo_veiculo["id"];
                        $objTipoVeiculo->titulo = $tipo_veiculo["titulo"];
                        
                        $lista_tipos_veiculo[] = $objTipoVeiculo;
                    }
                                        
                    $fabricante->listaTiposVeiculo = $lista_tipos_veiculo;
                }
                
                $total_fabricante = $this->executarQuery("SELECT COUNT(*) AS total FROM {$this::$nome_tabela}");
                
                if( !empty($registros_por_pagina) && !empty($pagina_atual) ) {
                    $info_paginacao = [];
                    $info_paginacao["totalRegistros"] = (int) mysqli_fetch_array( $total_fabricante )[0];
                    $info_paginacao["paginaAtual"] = (int) $pagina_atual;
                    $info_paginacao["registrosPorPagina"] = (int) $registros_por_pagina;

                    $lista_fabricantes[] = $info_paginacao;
                }
                
                return $lista_fabricantes;                
            }
            
            public function eliminar_relacionamentos_a_tipo_veiculo() {
                $sql = "DELETE FROM fabricanteveiculo_tipoveiculo "; 
                $sql .= "WHERE idFabricante = {$this->id}";
                
                $resultado = $this->executarQuery( $sql );
                return $resultado;
            }
            
            public function relacionar_a_tipo_veiculo($idTipoVeiculo) {
                $sql = "INSERT INTO fabricanteveiculo_tipoveiculo(idFabricante, idTipo) ";
                $sql .= "VALUES({$this->id}, {$idTipoVeiculo})";
                
                $resultado = $this->executarQuery( $sql );
                return $resultado;
            }
            
        }
    }
?>