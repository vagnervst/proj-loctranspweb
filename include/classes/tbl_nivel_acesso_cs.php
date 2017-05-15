<?php
    namespace Tabela {
        
        class NivelAcessoCS extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_nivelacesso_cs";
            public static $primary_key = "id";

            public $id;
            public $nome;
            public $visivel;
            
            public function inserirRelacionamento ($idNivel, $idPermissao) {
                $sql = "INSERT INTO nivelacesso_permissaocs ( idNivelAcesso, idPermissao ) ";
                $sql .= "VALUES(" . $idNivel . ", " . $idPermissao . ")";
                
                return $this->executarQuery($sql);
            }
            
            public function deletarRelacionamentos() {
                $sql = "DELETE FROM nivelacesso_permissaocs ";
                $sql .= "WHERE idNivelAcesso = " . $this->id;                
                
                return $this->executarQuery($sql);
            }
            
            public function getNivelAcesso_permissoes($idNivelAcesso) {
                $sql = "SELECT * FROM nivelacesso_permissaocs ";
                $sql .= "WHERE idNivelAcesso = " . $idNivelAcesso;                                
                
                $resultado = $this->executarQuery($sql);
                
                $listaPermissoes = [];
                
                if( $resultado ) {
                    while( $permissao = mysqli_fetch_assoc( $resultado ) ) {
                        $listaPermissoes[] = $permissao["idPermissao"];
                    }
                }
                return $listaPermissoes;
            }
        }
        
    }
?>