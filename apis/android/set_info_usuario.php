<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_usuario.php");
    require_once("../../include/classes/tbl_cartao_credito.php");
    require_once("../../include/classes/tbl_conta_bancaria.php");
    require_once("../../include/classes/tbl_cnh.php");
        
    $idUsuario = ( isset($_POST["idUsuario"]) )? $_POST["idUsuario"] : null;
    $fotoPerfil = ( isset($_POST["fotoPerfil"]) )? $_POST["fotoPerfil"] : null;
    $nome = ( isset( $_POST["nome"] ) )? $_POST["nome"] : null;
    $sobrenome = ( isset( $_POST["sobrenome"] ) )? $_POST["sobrenome"] : null;
    $dataNascimento = ( isset( $_POST["dataNascimento"] ) )? get_data_mysql( (int) $_POST["dataNascimento"] ) : null;
    $sexo = ( isset( $_POST["sexo"] ) )? $_POST["sexo"] : null;
    $rg = ( isset( $_POST["rg"] ) )? $_POST["rg"] : null;
    $cpf = ( isset( $_POST["cpf"] ) )? $_POST["cpf"] : null;    
    $idCidade = ( isset( $_POST["idCidade"] ) )? $_POST["idCidade"] : null;
    $telefone = ( isset( $_POST["telefone"] ) )? $_POST["telefone"] : null;
    $celular = ( isset( $_POST["celular"] ) )? $_POST["celular"] : null;
    $emailContato = ( isset( $_POST["emailContato"] ) )? $_POST["emailContato"] : null;
    $idTipoCartao = ( isset( $_POST["idTipoCartao"] ) )?  $_POST["idTipoCartao"] : null;
    $numeroCartao = ( isset( $_POST["numeroCartao"] ) )? $_POST["numeroCartao"] : null;
    $validadeCartao = ( isset( $_POST["validadeCartao"] ) )? $_POST["validadeCartao"] : null;
    $idBanco = ( isset( $_POST["idBanco"] ) )? $_POST["idBanco"] : null;
    $numeroAgencia = ( isset( $_POST["numeroAgencia"] ) )? $_POST["numeroAgencia"] : null;
    $numeroContaBancaria = ( isset( $_POST["numeroContaBancaria"] ) )? $_POST["numeroContaBancaria"] : null;
    $digitoContaBancaria = ( isset( $_POST["digitoContaBancaria"] ) )? $_POST["digitoContaBancaria"] : null;
    $emailAutenticacao = ( isset( $_POST["emailAutenticacao"] ) )? $_POST["emailAutenticacao"] : null;
    $senha = ( isset( $_POST["senha"] ) )? $_POST["senha"] : null;
    $confirmarSenha = ( isset( $_POST["confirmarSenha"] ) )? $_POST["confirmarSenha"] : null;
    $novaSenha = ( isset( $_POST["novaSenha"] ) )? $_POST["novaSenha"] : null;    
    
    $infoUsuario = new \Tabela\Usuario();
    $infoUsuario = $infoUsuario->buscar("id = {$idUsuario}")[0];    

    $usuario = new \Tabela\Usuario();    
    $usuario->id = $idUsuario;

    if( $fotoPerfil != null ) {
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $fotoPerfil));
        
        $nome_arquivo = "usr_" . $idUsuario . ".jpeg";
        $pasta = "../../img/uploads/usuarios";
        
        File::remove($infoUsuario->fotoPerfil, $pasta);
        file_put_contents($pasta . "/" . $nome_arquivo, $data);        
        
        $usuario->fotoPerfil = $nome_arquivo;
    }

    $usuario->nome = $nome;
    $usuario->sobrenome = $sobrenome;
    $usuario->sexo = $sexo;
    $usuario->cpf = $cpf;
    $usuario->dataNascimento = $dataNascimento;
    $usuario->telefone = $telefone;
    $usuario->celular = $celular;
    $usuario->emailContato = $emailContato;
    $usuario->rg = $rg;
    $usuario->email = $emailAutenticacao;
    $usuario->senha = $novaSenha;
    //$usuario->fotoPerfil = $;
    $usuario->idCidade = $idCidade;
        
    $resultado = $usuario->atualizar();

    echo json_encode($resultado);
?>