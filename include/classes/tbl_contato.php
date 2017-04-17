<?php
    namespace Tabela {
        
        class Contato extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_contato";
            public static $primary_key = "id";

            public $id;
            public $nome;
            public $email;
            public $mensagem;
            public $idAssunto;
            public $resposta;
        
            public function getInfoContato( $where ) {
                $query = "SELECT c.id, c.nome, c.email, c.mensagem, c.resposta, c.respondido, a.titulo AS assunto ";
                $query .= "FROM tbl_contato AS c ";
                $query .= "INNER JOIN tbl_assunto AS a ";
                $query .= "ON a.id = c.idAssunto";
                
                if( !empty($where) ) {
                    $query .= " WHERE " . $where;   
                }                                
                
                $resultado = $this->executarQuery( $query );
                return $this->get_array_from_resultado( $resultado );
            }
        
        }        
        
    }
?>