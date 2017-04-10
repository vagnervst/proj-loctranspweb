<?php
    namespace Tabela {
        
        class Usuario extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_usuario";
            public static $primary_key = "id";

            public $id;
            public $nome;
            public $sobrenome;
            public $sexo;
            public $cpf;
            public $dataNascimento;
            public $telefone;
            public $celular;
            public $email;
            public $rg;
            public $saldo;
            public $senha;
            public $autenticacaoDupla;
            public $fotoPerfil;            
            public $idCidade;
            public $idTipoConta;
            public $idPlanoConta;
            public $idLicencaDesktop;
        }
        
    }
?>