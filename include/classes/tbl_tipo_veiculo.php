<?php
    namespace Tabela {
        
        class TipoVeiculo extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_tipoveiculo";
            public static $primary_key = "id";
            
            public $id;
            public $titulo;
            public $visivel;
            
            public function getTipos($registros_por_pagina = null, $pagina_atual = null, $where = null) {
                $sql = "SELECT id, titulo ";
                $sql .= "FROM {$this::$nome_tabela} ";
                
                if( !empty($where) ) {
                    $sql .= " WHERE " . $where;
                }
                
                if( !empty($registros_por_pagina) && !empty($pagina_atual) ) {
                    $registros_a_ignorar = $registros_por_pagina * ( $pagina_atual - 1 );
                    
                    $sql .= " LIMIT " . $registros_por_pagina . " ";
                    $sql .= "OFFSET " . $registros_a_ignorar;
                }                                
                                                
                $lista_tipos = $this->executarQuery( $sql );
                $lista_tipos = $this->get_array_from_resultado( $lista_tipos );
                                
                foreach( $lista_tipos as $tipo ) {
                    $lista_combustiveis = [];
                    $lista_transmissao = [];
                    
                    $sqlCombustiveis = "SELECT c.* ";
                    $sqlCombustiveis .= "FROM tbl_tipocombustivel AS c ";
                    $sqlCombustiveis .= "INNER JOIN tipoveiculo_tipocombustivel AS vc ";
                    $sqlCombustiveis .= "ON vc.idTipoCombustivel = c.id ";
                    $sqlCombustiveis .= "INNER JOIN tbl_tipoveiculo AS v ";
                    $sqlCombustiveis .= "ON v.id = vc.idTipoVeiculo ";
                    $sqlCombustiveis .= "WHERE v.id = {$tipo->id}";
                    
                    $busca_combustiveis = $this->executarQuery( $sqlCombustiveis );
                    while( $combustivel = mysqli_fetch_assoc( $busca_combustiveis ) ) {
                        $objCombustivel = new \Tabela\TipoCombustivel();
                        $objCombustivel->id = $combustivel["id"];
                        $objCombustivel->nome = $combustivel["nome"];
                        
                        $lista_combustiveis[] = $objCombustivel;
                    }
                    
                    $sqlTransmissoes = "SELECT t.* ";
                    $sqlTransmissoes .= "FROM tbl_transmissaoveiculo AS t ";
                    $sqlTransmissoes .= "INNER JOIN tipoveiculo_transmissaoveiculo AS vt ";
                    $sqlTransmissoes .= "ON vt.idTransmissaoVeiculo = t.id ";
                    $sqlTransmissoes .= "INNER JOIN tbl_tipoveiculo AS tv ";
                    $sqlTransmissoes .= "ON tv.id = vt.idTipoVeiculo ";
                    $sqlTransmissoes .= "WHERE tv.id = {$tipo->id}";
                    
                    $busca_transmissoes = $this->executarQuery( $sqlTransmissoes );
                    while( $transmissao = mysqli_fetch_assoc($busca_transmissoes) ) {
                        $objTransmissao = new \Tabela\TransmissaoVeiculo();
                        $objTransmissao->id = $transmissao["id"];
                        $objTransmissao->titulo = $transmissao["titulo"];
                        
                        $lista_transmissao[] = $objTransmissao;
                    }
                    
                    $tipo->listaTipoCombustivel = $lista_combustiveis;
                    $tipo->listaTransmissao = $lista_transmissao;
                }                                                            
                
                if( !empty($registros_por_pagina) && !empty($pagina_atual) ) {
                    $total_registros = $this->executarQuery("SELECT COUNT(*) AS total FROM {$this::$nome_tabela}");
                    
                    $info_paginacao = [];
                    $info_paginacao["totalRegistros"] = (int) mysqli_fetch_array( $total_registros )[0];
                    $info_paginacao["paginaAtual"] = (int) $pagina_atual;
                    $info_paginacao["registrosPorPagina"] = (int) $registros_por_pagina;

                    $lista_tipos[] = $info_paginacao;
                }
                
                return $lista_tipos;
            }
            
            public function getFabricantesRelacionados() {
                $sql = "SELECT f.* ";
                $sql .= "FROM tbl_fabricanteveiculo AS f ";
                $sql .= "INNER JOIN fabricanteveiculo_tipoveiculo AS ft ";
                $sql .= "ON ft.idFabricante = f.id ";
                $sql .= "INNER JOIN tbl_tipoveiculo AS t ";
                $sql .= "ON t.id = ft.idTipo ";
                $sql .= "WHERE t.id = {$this->id} AND f.visivel = 1";
                                
                $resultado = $this->executarQuery( $sql );
                $lista_fabricantes = [];
                
                while( $fabricante = mysqli_fetch_assoc($resultado) ) {
                    $objFabricante = new FabricanteVeiculo();
                    $objFabricante->id = (int) $fabricante["id"];
                    $objFabricante->nome = $fabricante["nome"];
                    
                    $lista_fabricantes[] = $objFabricante;
                }
                
                return $lista_fabricantes;
            }
            
            public function getCombustiveisRelacionados() {
                $sql = "SELECT c.* ";
                $sql .= "FROM tbl_tipoveiculo AS t ";
                $sql .= "INNER JOIN tipoveiculo_tipocombustivel AS vc ";
                $sql .= "ON vc.idTipoVeiculo = t.id ";
                $sql .= "INNER JOIN tbl_tipocombustivel AS c ";
                $sql .= "ON c.id = vc.idTipoCombustivel ";
                $sql .= "WHERE t.id = {$this->id}";
                
                $resultado = $this->executarQuery( $sql );
                $lista_combustivel = [];
                while( $combustivel = mysqli_fetch_assoc( $resultado ) ) {
                    $objCombustivel = new \Tabela\TipoCombustivel();
                    $objCombustivel->id = $combustivel["id"];
                    $objCombustivel->nome = $combustivel["nome"];
                    
                    $lista_combustivel[] = $objCombustivel;
                }
                
                return $lista_combustivel;
            }
            
            public function getTransmissoesRelacionadas() {
                $sql = "SELECT tr.* ";
                $sql .= "FROM tbl_tipoveiculo AS t ";
                $sql .= "INNER JOIN tipoveiculo_transmissaoveiculo AS tt ";
                $sql .= "ON tt.idTipoVeiculo = t.id ";
                $sql .= "INNER JOIN tbl_transmissaoveiculo AS tr ";
                $sql .= "ON tr.id = tt.idTransmissaoVeiculo ";
                $sql .= "WHERE t.id = {$this->id}";
                
                $resultado = $this->executarQuery( $sql );
                $lista_transmissao = [];
                while( $transmissao = mysqli_fetch_assoc( $resultado ) ) {
                    $objTransmissao = new \Tabela\TransmissaoVeiculo();
                    $objTransmissao->id = $transmissao["id"];
                    $objTransmissao->titulo = $transmissao["titulo"];
                    
                    $lista_transmissao[] = $objTransmissao;
                }
                echo $sql;
                return $lista_transmissao;
            }
            
            public function getAcessoriosRelacionados() {
                $sql = "SELECT a.* ";
                $sql .= "FROM tbl_acessorioveiculo AS a ";
                $sql .= "INNER JOIN acessorioveiculo_tipoveiculo AS av ";
                $sql .= "ON av.idAcessorio = a.id ";
                $sql .= "INNER JOIN tbl_tipoveiculo AS t ";
                $sql .= "ON t.id = av.idTipoVeiculo ";
                $sql .= "WHERE t.id = {$this->id} AND a.visivel = 1";
                
                $lista_acessorios = [];
                $resultado = $this->executarQuery( $sql );
                while( $acessorio = mysqli_fetch_assoc($resultado) ) {
                    $objAcessorio = new \Tabela\AcessorioVeiculo();
                    $objAcessorio->id = $acessorio["id"];
                    $objAcessorio->nome = $acessorio["nome"];
                    
                    $lista_acessorios[] = $objAcessorio;
                }
                
                return $lista_acessorios;
            }
            
            public function eliminar_relacionamentos_a_acessorio() {
                $nome_tabela_relacionamento = "acessorioveiculo_tipoveiculo";
                
                $sql = "DELETE FROM " . $nome_tabela_relacionamento . " ";
                $sql .= "WHERE idTipoVeiculo = " . $this->id;
                
                return $this->executarQuery( $sql );
            }
            
            public function eliminar_relacionamentos_a_combustivel() {
                $sql = "DELETE FROM tipoveiculo_tipocombustivel ";
                $sql .= "WHERE idTipoVeiculo = {$this->id}";
                
                $resultado = $this->executarQuery( $sql );
                return $resultado;
            }
            
            public function relacionar_a_combustivel($idCombustivel) {
                $sql = "INSERT INTO tipoveiculo_tipocombustivel(idTipoVeiculo, idTipoCombustivel) ";
                $sql .= "VALUES({$this->id}, {$idCombustivel})";
                
                $resultado = $this->executarQuery( $sql );
                return $resultado;
            }
            
            public function eliminar_relacionamentos_a_transmissao() {
                $sql = "DELETE FROM tipoveiculo_transmissaoveiculo ";
                $sql .= "WHERE idTipoVeiculo = {$this->id}";
                
                $resultado = $this->executarQuery( $sql );
                return $resultado;
            }
            
            public function relacionar_a_transmissao($idTransmissao) {
                $sql = "INSERT INTO tipoveiculo_transmissaoveiculo(idTipoVeiculo, idTransmissaoVeiculo) ";
                $sql .= "VALUES({$this->id}, {$idTransmissao})";                                
                
                $resultado = $this->executarQuery( $sql );
                return $resultado;
            }
            
            public function eliminar_relacionamentos_a_fabricante() {
                $sql = "DELETE FROM fabricanteveiculo_tipoveiculo ";
                $sql .= "WHERE idTipo = {$this->id}";
                
                $resultado = $this->executarQuery( $sql );
                return $resultado;
            }
        }
    }
?>