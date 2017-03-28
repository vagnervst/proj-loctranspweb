<?php
    namespace Tabela {
        
        class NivelAcessoCS extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_nivelacesso_cs";
            public static $primary_key = "id";

            public $id;
            public $nome;
            
            public function inserirRelacionamento ($idNivel, $idPermissao) {
                $sql = "INSERT INTO nivelacesso_permissaocs ( idNivelAcesso, idPermissao ) ";
                $sql .= "VALUES(" .$idNivel. ", " .$idPermissao. ")";
                
                return $this->executarQuery($sql);
            }
            
            public function deletarRelacionamento ($idNivel) {
                $sql = "DELETE FROM nivelacesso_permissaocs ";
                $sql . "WHERE idNivel = " .$idNivel;
            }
        }
        
    }
?>