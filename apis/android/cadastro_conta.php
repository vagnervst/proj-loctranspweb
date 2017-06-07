<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_usuario.php");
    require_once("../../include/classes/tbl_cartao_credito.php");
    require_once("../../include/classes/tbl_conta_bancaria.php");

    $nome = ( isset($_POST["nome"]) )? $_POST["nome"] : null;
    $sobrenome = ( isset($_POST["sobrenome"]) )? $_POST["sobrenome"] : null;
    $sexo = ( isset($_POST["sexo"]) )? $_POST["sexo"] : null;
    $cpf = ( isset($_POST["cpf"]) )? $_POST["cpf"] : null;
    $dataNascimento = ( isset($_POST["dataNascimento"]) )? (int) $_POST["dataNascimento"] : null;
    $telefone = ( isset($_POST["telefone"]) )? $_POST["telefone"] : null;
    $celular = ( isset($_POST["celular"]) )? $_POST["celular"] : null;
    $emailContato = ( isset($_POST["emailContato"]) )? $_POST["emailContato"] : null;
    $rg = ( isset($_POST["rg"]) )? $_POST["rg"] : null;    
    $email = ( isset($_POST["emailAutenticacao"]) )? $_POST["emailAutenticacao"] : null;
    $senha = ( isset($_POST["senha"]) )? $_POST["senha"] : null;    
    $fotoPerfil = ( isset($_POST["fotoPerfil"]) )? $_POST["fotoPerfil"] : null;
    $idCidade = ( isset($_POST["idCidade"]) )? $_POST["idCidade"] : null;        
    $numeroCartao = ( isset($_POST["numeroCartao"]) )? $_POST["numeroCartao"] : null;
    $vencimentoCartao = ( isset($_POST["validadeCartao"]) )? (int) $_POST["validadeCartao"] : null;
    $idTipoCartao = ( isset($_POST["idTipoCartao"]) )? (int) $_POST["idTipoCartao"] : null;
    $idBanco = ( isset($_POST["idBanco"]) )? $_POST["idBanco"] : null;
    $numeroAgencia = ( isset($_POST["numeroAgencia"]) )? $_POST["numeroAgencia"] : null;
    $numeroConta = ( isset($_POST["numeroConta"]) )? $_POST["numeroConta"] : null;
    $digitoVerificador = ( isset($_POST["digitoVerificador"]) )? $_POST["digitoVerificador"] : null;
    
    $usuario = new \Tabela\Usuario();
    $usuario->nome = $nome;
    $usuario->sobrenome = $sobrenome;
    $usuario->sexo = $sexo;
    $usuario->cpf = $cpf;
    $usuario->dataNascimento = get_data_mysql($dataNascimento);
    $usuario->telefone = $telefone;
    $usuario->celular = $celular;
    $usuario->emailContato = $emailContato;
    $usuario->rg = $rg;
    $usuario->saldo = 0;
    $usuario->email = $email;
    $usuario->senha = $senha;        
    $usuario->idCidade = $idCidade;
    $usuario->idTipoConta = 1;
    $usuario->idPlanoConta = 1;    

    $idUsuario = $usuario->inserir();

    if( $idUsuario != 0 ) {
        
        $pasta = "../../img/uploads/usuarios";
        $nome_arquivo = "usr_" . $idUsuario . ".jpeg";
        
        if( upload_base64_image( $fotoPerfil, $nome_arquivo, $pasta ) ) {
            $usuario->fotoPerfil = $nome_arquivo;
            $usuario->atualizar();
        }
        
        if( !empty($numeroCartao) ) {
                        
            $cartaoCredito = new \Tabela\CartaoCredito();
            $cartaoCredito->numero = $numeroCartao;
            $cartaoCredito->vencimento = get_data_mysql($vencimentoCartao);
            $cartaoCredito->idUsuario = $idUsuario;
            $cartaoCredito->idTipo = $idTipoCartao;
            echo json_encode($cartaoCredito);
            
            $cartaoCredito->inserir();
            
        } elseif( !empty($numeroAgencia) ) {
                
            $contaBancaria = new \Tabela\ContaBancaria();
            $contaBancaria->numeroAgencia = $numeroAgencia;
            $contaBancaria->conta = $numeroConta;
            $contaBancaria->digito = $digitoVerificador;
            $contaBancaria->idUsuario = $idUsuario;
            $contaBancaria->idTipoConta = 1;
            $contaBancaria->idBanco = $idBanco;
            echo json_encode($contaBancaria);
            
            $contaBancaria->inserir();
        }
    }

?>