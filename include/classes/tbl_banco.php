<?php
    namespace Tabela {
        
        class Banco extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_banco";
            public static $primary_key = "id";

            public $id;
            public $codigo;
            public $nome;
            public $qtdDigitosVerificadores;
<<<<<<< HEAD
            
            public function getFabricante($registros_por_pagina, $pagina_atual, $where = null) {
<<<<<<< HEAD
=======
=======
        
        public function getBanco($registros_por_pagina, $pagina_atual, $where = null) {
>>>>>>> ea4701fb51ed36bdfde44ac3c14704dfc858b501
>>>>>>> e4a72bb93cc95c06e995def1981fbdd48e09ff6f
                $sql = "SELECT b.* ";
                $sql .= "FROM {$this::$nome_tabela} AS b ";
                
                if( !empty($where) ) {
                    $sql .= " WHERE " . $where;
                }

                $sql .= " ORDER BY b.nome";

                if( !empty($registros_por_pagina) && !empty($pagina_atual) ) {
                    $registros_a_ignorar = $registros_por_pagina * ( $pagina_atual - 1 );

                    $sql .= " LIMIT " . $registros_por_pagina . " ";
                    $sql .= "OFFSET " . $registros_a_ignorar;
                }     
                
                $listaBanco = $this->executarQuery( $sql );
                $listaBanco = $this->get_array_from_resultado( $listaBanco );

                                            
                
                $totalBanco = $this->executarQuery("SELECT COUNT(*) AS total FROM {$this::$nome_tabela}");
                
                if( !empty($registros_por_pagina) && !empty($pagina_atual) ) {
                    $info_paginacao = [];
                    $info_paginacao["totalRegistros"] = (int) mysqli_fetch_array( $totalBanco )[0];
                    $info_paginacao["paginaAtual"] = (int) $pagina_atual;
                    $info_paginacao["registrosPorPagina"] = (int) $registros_por_pagina; 

                    $listaBanco[] = $info_paginacao;
                }
                
                return $listaBanco;
            }
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
            public function deletarReferencias($id){
                $sql = "delete from tbl_conta_bancaria where idBanco =".$id ;
                mysqli_query($sql);
            }
            
        
>>>>>>> ea4701fb51ed36bdfde44ac3c14704dfc858b501
>>>>>>> e4a72bb93cc95c06e995def1981fbdd48e09ff6f
        }
    }
?>