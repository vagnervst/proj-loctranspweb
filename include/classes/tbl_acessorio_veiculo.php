<?php
    namespace Tabela {
        
        class AcessorioVeiculo extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_acessorioveiculo";
            public static $primary_key = "id";
            
            public $id;
            public $nome;
            
            public function getAcessorios($registros_por_pagina = null, $pagina_atual = null, $where = null) {
                $sql = "SELECT id, nome ";
                $sql .= "FROM {$this::$nome_tabela} ";
                
                if( !empty($where) ) {
                    $sql .= " WHERE " . $where;
                }
                
                if( !empty($registros_por_pagina) && !empty($pagina_atual) ) {
                    $registros_a_ignorar = $registros_por_pagina * ( $pagina_atual - 1 );
                    
                    $sql .= " LIMIT " . $registros_por_pagina . " ";
                    $sql .= "OFFSET " . $registros_a_ignorar;
                }                                
                
                $lista_acessorios = $this->executarQuery( $sql );
                $lista_acessorios = $this->get_array_from_resultado( $lista_acessorios );
                
                foreach( $lista_acessorios as $acessorio ) {
                    $sqlTiposVeiculo = "SELECT t.id, t.titulo ";
                    $sqlTiposVeiculo .= "FROM tbl_tipoveiculo AS t ";
                    $sqlTiposVeiculo .= "INNER JOIN acessorioveiculo_tipoveiculo AS a ";
                    $sqlTiposVeiculo .= "ON a.idAcessorio = " . $acessorio->id . " AND a.idTipoVeiculo = t.id";
                    
                    $lista_tipos_veiculo = $this->executarQuery( $sqlTiposVeiculo );                    
                    
                    $lista = [];
                    while( $tipo_veiculo = mysqli_fetch_assoc( $lista_tipos_veiculo ) ) {     
                        $objTipoVeiculo = new TipoVeiculo();
                        $objTipoVeiculo->id = $tipo_veiculo["id"];
                        $objTipoVeiculo->titulo = $tipo_veiculo["titulo"];
                        
                        $lista[] = $objTipoVeiculo;                        
                    }
                    
                    $acessorio->listaTiposVeiculo = $lista;
                }                                
                
                $total_acessorios = $this->executarQuery("SELECT COUNT(*) AS total FROM {$this::$nome_tabela}");
                
                $info_paginacao = [];
                $info_paginacao["totalRegistros"] = (int) mysqli_fetch_array( $total_acessorios )[0];
                $info_paginacao["paginaAtual"] = (int) $pagina_atual;
                $info_paginacao["registrosPorPagina"] = (int) $registros_por_pagina;
                
                $resultado = $lista_acessorios;
                $resultado[] = $info_paginacao;
                
                return $resultado;
            }                 
            
            public function eliminar_relacionamentos_a_veiculo() {
                $nome_tabela_relacionamento = "acessorioveiculo_tipoveiculo";
                
                $sql = "DELETE FROM " . $nome_tabela_relacionamento . " ";
                $sql .= "WHERE idAcessorio = " . $this->id;
                
                return $this->executarQuery( $sql );
            }
            
            public function relacionar_a_tipo_veiculo($idTipoVeiculo) {
                $nome_tabela_relacionamento = "acessorioveiculo_tipoveiculo";
                
                $sql = "INSERT INTO " . $nome_tabela_relacionamento . " (idAcessorio, idTipoVeiculo) ";
                $sql .= "VALUES(" . $this->id . ", " . $idTipoVeiculo . ")";
                
                return $this->executarQuery( $sql );
            }
        }
    }
?>