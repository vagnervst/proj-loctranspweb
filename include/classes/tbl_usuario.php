<?php
    namespace Tabela {
        
        class Usuario extends \DB\DatabaseUtils {
            public static $nome_tabela = "tbl_usuario";
            public static $primary_key = "id";

            public $id;
            public $nome;
            public $sobrenome;
            public $razaoSocial;
            public $sexo;
            public $cpf;
            public $cnpj;
            public $telefone;
            public $celular;
            public $email;
            public $rg;
            public $saldo;
            public $senha;
            public $autenticacaoDupla;
            public $fotoPerfil;
            public $idEstado;
            public $idCidade;
            public $idTipoConta;
            public $idPlanoConta;
            public $idLicencaDesktop;
        }
        
    }
?>