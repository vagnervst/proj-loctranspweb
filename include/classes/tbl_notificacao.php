<?php
    namespace Tabela {
        
        class Notificacao extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_notificacao";
            public static $primary_key = "id";

            public $id;
            public $mensagem;
            public $idUsuarioRemetente;
            public $idUsuarioDestinatario;
            public $idPedido;   
            public $idTipoNotificacao;
            public $visualizada;
            
            public function getNotificacao($where = null) {
                $sql = "SELECT n.*, tn.titulo AS tipoNotificacao ";
                $sql .= "FROM tbl_notificacao AS n ";
                $sql .= "INNER JOIN tbl_tipo_notificacao AS tn ";
                $sql .= "ON tn.id = n.idTipoNotificacao";
                    
                if( $where != null ) {
                    $sql .= " WHERE " . $where;
                }                                
                
                $resultado = $this->executarQuery($sql);
                $resultado = $this->get_array_from_resultado($resultado);
                
                return $resultado;
            }
            
        }
    }
?>