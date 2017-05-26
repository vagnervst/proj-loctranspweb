<?php
    namespace Tabela {
        
        class ContaBancaria extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_conta_bancaria";
            public static $primary_key = "id";

            public $id;
            public $numeroAgencia;
            public $conta;
            public $digito;
            public $idUsuario;
            public $idTipoConta;
            public $idBanco;
            
            public function getContaBancaria($where = null) {
                
                $sql = "SELECT cb.* ";
                $sql .= "FROM tbl_conta_bancaria AS cb";
                
                if( !empty( $where ) ) {
                    $sql .= " WHERE " . $where;
                }
                
                $resultado = $this->executarQuery( $sql );
                $resultado  = $this->get_array_from_resultado( $resultado );

                return $resultado;
            }
        }
        
    }
?>