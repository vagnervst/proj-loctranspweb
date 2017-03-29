<?php
    namespace Tabela {
        
        class UsuarioCS extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_usuario_cs";
            public static $primary_key = "id";

            public $id;
            public $nome;
            public $sobrenome;
            public $usuario;
            public $senha;
            public $idNivelAcesso;
            public $fixo;
            
            public function getUsuarios() {
                $sql = "SELECT u.id, u.nome, u.sobrenome, u.usuario, u.senha, n.id AS idNivelAcesso, n.nome AS nivelAcesso ";
                $sql .= "FROM tbl_usuario_cs AS u ";
                $sql .= "INNER JOIN tbl_nivelacesso_cs AS n ";
                $sql .= "ON u.idNivelAcesso = n.id";
                
                return $this->executarQuery($sql);
            }
        }
        
    }
?>