<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_usuario.php");
    require_once("../../include/classes/tbl_cartao_credito.php");
    require_once("../../include/classes/tbl_conta_bancaria.php");

    $nome = ( isset($_POST["nome"]) )? $_POST["nome"] : null;
    $sobrenome = ( isset($_POST["sobrenome"]) )? $_POST["sobrenome"] : null;
    $sexo = ( isset($_POST["sexo"]) )? $_POST["sexo"] : null;
    $cpf = ( isset($_POST["cpf"]) )? $_POST["cpf"] : null;
    $dataNascimento = ( isset($_POST["dataNascimento"]) )? $_POST["dataNascimento"] : null;
    $telefone = ( isset($_POST["telefone"]) )? $_POST["telefone"] : null;
    $celular = ( isset($_POST["celular"]) )? $_POST["celular"] : null;
    $emailContato = ( isset($_POST["emailContato"]) )? $_POST["emailContato"] : null;
    $rg = ( isset($_POST["rg"]) )? $_POST["rg"] : null;
    $saldo = ( isset($_POST["saldo"]) )? $_POST["saldo"] : null;
    $email = ( isset($_POST["email"]) )? $_POST["email"] : null;
    $senha = ( isset($_POST["senha"]) )? $_POST["senha"] : null;    
    $fotoPerfil = ( isset($_POST["fotoPerfil"]) )? $_POST["fotoPerfil"] : null;
    $idCidade = ( isset($_POST["idCidade"]) )? $_POST["idCidade"] : null;        
    
    $usuario = new \Tabela\Usuario();
    $usuario->nome = $nome;
    $usuario->sobrenome = $sobrenome;
    $usuario->sexo = $sexo;
    $usuario->cpf = $cpf;
    $usuario->dataNascimento = $dataNascimento;
    $usuario->telefone = $telefone;
    $usuario->celular = $celular;
    $usuario->emailContato = $emailContato;
    $usuario->rg = $rg;
    $usuario->saldo = $saldo;
    $usuario->email = $email;
    $usuario->senha = $senha;    
    $usuario->fotoPerfil = $fotoPerfil;
    $usuario->idCidade = $idCidade;
    $usuario->idTipoConta = 1;
    $usuario->idPlanoConta = 1;
    
    $idUsuario = $usuario->inserir();

    if( !empty($numeroCartao) ) {
            
        $cartaoCredito = new \Tabela\CartaoCredito();
        $cartaoCredito->numero = $numero;
        $cartaoCredito->vencimento = $vencimento;
        $cartaoCredito->idUsuario = $idUsuario;
        $cartaoCredito->idTipo = $idTipo;
        
    } elseif( !empty($numeroAgencia) ) {
                
        $contaBancaria->numeroAgencia = $numeroAgencia;
        $contaBancaria->conta = $conta;
        $contaBancaria->digito = $digito;
        $contaBancaria->idUsuario = $idUsuario;
        $contaBancaria->idTipoConta = $idTipoConta;
        $contaBancaria->idBanco = $idBanco;
        
    }

?>