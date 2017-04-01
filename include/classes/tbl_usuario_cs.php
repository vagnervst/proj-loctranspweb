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
            
            public function getUsuarios() {
                $sql = "SELECT u.id, u.nome, u.sobrenome, u.usuario, u.senha, n.id AS idNivelAcesso, n.nome AS nivelAcesso ";
                $sql .= "FROM tbl_usuario_cs AS u ";
                $sql .= "INNER JOIN tbl_nivelacesso_cs AS n ";
                $sql .= "ON u.idNivelAcesso = n.id";
                
                return $this->executarQuery($sql);
            }
            
            public static function login($usuario, $senha) {
                $usuarioObj = new \Tabela\UsuarioCS();
                $buscaUsuario = $usuarioObj->buscar("usuario = '" . $usuario . "'");
                
                if( !empty($buscaUsuario[0]) ) {

                    $usuarioObj = $buscaUsuario[0];
                    $hash = $usuarioObj->senha;

                    $is_senha_correta = \Autenticacao::verificar( $senha, $hash );
                    
                    if( $is_senha_correta ) return $usuarioObj;
                    return null;
                }
            }
        }
        
    }
?>