<?php 
    require_once("include/initialize.php");
    require_once("include/classes/tbl_usuario.php");
    require_once("include/classes/tbl_cartao_credito.php");
    require_once("include/classes/tbl_conta_bancaria.php");
    require_once("include/classes/tbl_tipo_cartao_credito.php");
    require_once("include/classes/tbl_banco.php");
    require_once("include/classes/tbl_estado.php");
    require_once("include/classes/tbl_cidade.php");
    require_once("include/classes/tbl_cnh.php");
    require_once("include/classes/sessao.php");
        
    $sessao = new Sessao();
    $idUsuario = (int) $sessao->get("idUsuario");
    
    if( empty($idUsuario) ) {
        redirecionar_para("index.php");
        exit;
    }

    $usuario = new \Tabela\Usuario();
    $usuario = $usuario->buscar("id = {$idUsuario}")[0];
    
    $cartaoCredito = new \Tabela\CartaoCredito();
    $cartaoCredito = $cartaoCredito->buscar("idUsuario = {$idUsuario}");
    $cartaoCredito = ( isset($cartaoCredito[0]) )? $cartaoCredito[0] : new \Tabela\CartaoCredito();

    $contaBancaria = new \Tabela\ContaBancaria();
    $contaBancaria = $contaBancaria->buscar("idUsuario = {$idUsuario}");
    $contaBancaria = ( isset($contaBancaria[0]) )? $contaBancaria[0] : new \Tabela\ContaBancaria();        

    $formSubmit = ( isset($_POST["formSubmit"]) )? $_POST["formSubmit"] : null;
    $formSubmitFinanceiro = ( isset($_POST["formSubmitFinanceiro"]) )? $_POST["formSubmitFinanceiro"] : null;

    $pasta_usuario = "img/uploads/usuarios";
    if( !empty($formSubmit) ) {

        $nome = ( isset($_POST["txtNome"]) )? $_POST["txtNome"] : null;
        $sobrenome = ( isset($_POST["txtSobrenome"]) )? $_POST["txtSobrenome"] : null;
        $sexo = ( isset($_POST["rdSexo"]) )? $_POST["rdSexo"] : null;
        $cpf = ( isset($_POST["txtCpf"]) )? $_POST["txtCpf"] : null;
        $rg = ( isset($_POST["txtRg"]) )? $_POST["txtRg"] : null;
        $fotoPerfil = ( isset($_FILES["fotoPerfil"]) )? $_FILES["fotoPerfil"] : null;
        $email = ( isset($_POST["txtEmail"]) )? $_POST["txtEmail"] : null;
        $dataNascimento = ( isset($_POST["txtDataNascimento"]) )? $_POST["txtDataNascimento"] : null;
        $id_estado = ( isset($_POST["slEstado"]) )? (int) $_POST["slEstado"] : null;
        $id_cidade = ( isset($_POST["slCidade"]) )? (int) $_POST["slCidade"] : null;
        $telefone = ( isset($_POST["txtTelefone"]) )? $_POST["txtTelefone"] : null;
        $celular = ( isset($_POST["txtCelular"]) )? $_POST["txtCelular"] : null;
        $email = ( isset($_POST["txtEmail"]) )? $_POST["txtEmail"] : null;                                                                
        $numeroCnh = ( isset($_POST["txtNumeroCnh"]) )? $_POST["txtNumeroCnh"] : null;
        $senha = ( isset($_POST["txtSenha"]) )? $_POST["txtSenha"] : null;
        $confirmarSenha = ( isset($_POST["txtConfirmarSenha"]) )? $_POST["txtConfirmarSenha"] : null;
                
        $usuario->nome = $nome;
        $usuario->sobrenome = $sobrenome;
        $usuario->sexo = $sexo;
        $usuario->rg = $rg;
        $usuario->cpf = $cpf;
        $usuario->dataNascimento = $dataNascimento;
        $usuario->telefone = $telefone;
        $usuario->celular = $celular;
        $usuario->email = $email;        
        $usuario->senha = $senha;                
                
        $nome_arquivo = "usr_" . $usuario->id . "." . pathinfo($fotoPerfil["name"])["extension"];        
        if( File::replace($fotoPerfil, $nome_arquivo, $usuario->fotoPerfil, $pasta_usuario . "/") ) {
            $usuario->fotoPerfil = $nome_arquivo;    
        }
                
        $usuario->idCidade = $id_cidade;
        $usuario->atualizar();
        
        redirecionar_para("configuracoes.php?id={$idUsuario}");
    }

    if( !empty($formSubmitFinanceiro) ) {
        $id_tipoCartao = ( isset($_POST["slTipoCartao"]) )? (int) $_POST["slTipoCartao"] : null;
        $numeroCartao = ( isset($_POST["txtNumeroCartao"]) )? $_POST["txtNumeroCartao"] : null;        
        $validadeCartao = ( isset($_POST["txtValidadeCartao"]) )? $_POST["txtValidadeCartao"] : null;
        $id_banco = ( isset($_POST["slBanco"]) )? (int) $_POST["slBanco"] : null;
        $numeroAgencia = ( isset($_POST["txtNumeroAgencia"]) )? $_POST["txtNumeroAgencia"] : null;
        $numeroConta = ( isset($_POST["txtNumeroConta"]) )? $_POST["txtNumeroConta"] : null;
        $digitoVerificador = ( isset($_POST["txtDigitoVerificador"]) )? $_POST["txtDigitoVerificador"] : null;
        
        $cartaoCreditoUsuario = new \Tabela\CartaoCredito();        
        $cartaoCreditoUsuario = $cartaoCreditoUsuario->buscar("idUsuario = {$idUsuario}");
        
        if( isset( $cartaoCreditoUsuario[0] ) ) {
            $cartaoCreditoUsuario = $cartaoCreditoUsuario[0];
            $cartaoCreditoUsuario->numero = $numeroCartao;
            
            $validadeCartao = str_replace("/", "-", $validadeCartao);            
            $validadeCartao = strtotime( $validadeCartao );
                    
            $data_validade = get_data_mysql( $validadeCartao );            
            
            $cartaoCreditoUsuario->vencimento = $data_validade;
            $cartaoCreditoUsuario->idTipo = $id_tipoCartao;
            $cartaoCreditoUsuario->atualizar();                                    
        }
        
        $contaBancariaUsuario = new \Tabela\ContaBancaria();        
        $contaBancariaUsuario = $contaBancariaUsuario->buscar("idUsuario = {$idUsuario}");
        
        if( isset( $contaBancariaUsuario[0] ) ) {
            $contaBancariaUsuario = $contaBancariaUsuario[0];
            $contaBancariaUsuario->numeroAgencia = $numeroAgencia;
            $contaBancariaUsuario->conta = $numeroConta;
            $contaBancariaUsuario->digito = $digitoVerificador;
            $contaBancariaUsuario->idBanco = $id_banco;
            $contaBancariaUsuario->atualizar();
        }
        
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Configurações | City Share</title>
        <meta name="viewport" content="width=device-width" />
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/icones/logoCityShareIcon.png">        
    </head>
    <body>
        <div id="container">
            <?php require_once("layout/header.php"); ?>            
            <div class="main" id="pag-config-perfil">
                <div class="box-conteudo">
                    <div id="box-botoes">
                        <span id="botao-pessoais" class="js-botao-pessoais botao ativo">
                            <p class="label">Pessoais</p>
                            <div class="icone"></div>
                        </span>
                        <span id="botao-contato" class="js-botao-contato botao">
                            <p class="label">Contato</p>
                            <div class="icone"></div>
                        </span>
                        <span id="botao-financeiro" class="js-botao-financeiro botao">
                            <p class="label">Financeiro</p>
                            <div class="icone"></div>
                        </span>
                        <span id="botao-conducao" class="js-botao-conducao botao">
                            <p class="label">Condução</p>
                            <div class="icone"></div>
                        </span>
                        <span id="botao-autenticacao" class="js-botao-autenticacao botao">
                            <p class="label">Autenticação</p>
                            <div class="icone"></div>
                        </span>
                    </div>
                    <div id="box-form">
                        <div id="form-info-pessoais" class="form-conta">
                            <form method="POST" enctype="multipart/form-data" action="configuracoes.php?id=<?php echo $idUsuario; ?>">
                                <div class="box-label-input">
                                    <label class="label"><span class="label">Foto*:</span>
                                        <input class="input-foto" id="input-foto" name="fotoPerfil" type="file" />
                                    </label>
                                    <div class="botao-foto" id="botao-foto" style="background-image: url(<?php echo File::read( $usuario->fotoPerfil, $pasta_usuario); ?>); "></div>
                                </div>
                                <div class="box-label-input">
                                    <label><span class="label">Nome:</span>
                                        <input type="text" name="txtNome" class="preset-input-text input" value="<?php echo $usuario->nome; ?>" />
                                    </label>
                                </div>
                                <div class="box-label-input">
                                    <label><span class="label">Sobrenome:</span>
                                        <input type="text" name="txtSobrenome" class="preset-input-text input" value="<?php echo $usuario->sobrenome; ?>"/>
                                    </label>
                                </div>
                                <div class="box-label-input">
                                    <label><span class="label">Email:</span>
                                        <input type="text" name="txtEmail" class="preset-input-text input" value="<?php echo $usuario->email; ?>" />
                                    </label>
                                </div>
                                <div class="box-label-input">
                                    <label><span class="label">RG:</span>
                                        <input type="text" name="txtRg" class="preset-input-text input" value="<?php echo $usuario->rg; ?>" />
                                    </label>
                                </div>
                                <div class="box-label-input">
                                    <p>Sexo</p>
                                    <label><span>Feminino:</span>
                                        <input type="radio" name="rdSexo" value="f" class="preset-input-text" <?php echo ( $usuario->sexo == "f" )? "checked" : ""; ?> />
                                    </label>
                                    <label><span>Masculino:</span>
                                        <input type="radio" name="rdSexo" value="m" class="preset-input-text" <?php echo ( $usuario->sexo == "m" )? "checked" : ""; ?> />
                                    </label>
                                </div>
                                <div class="box-label-input">
                                    <label><span class="label">CPF:</span>
                                        <input type="text" name="txtCpf" class="preset-input-text input" value="<?php echo $usuario->cpf; ?>" />
                                    </label>
                                </div>
                                <div class="box-label-input">
                                    <label><span class="label">Data de Nascimento:</span>
                                        <input type="text" name="txtDataNascimento" class="preset-input-text input" value="<?php echo $usuario->dataNascimento; ?>" />
                                    </label>
                                </div>
                                <div class="box-label-input">
                                    <label><span class="label">Estado:</span>
                                        <select name="slEstado" class="preset-input-select input">
                                            <option selected disabled>Selecione...</option>
                                            <?php
                                            $listaEstado = new \Tabela\Estado();
                                            $listaEstado = $listaEstado->buscar();
                                            $cidadeUsuario = new \Tabela\Cidade();
                                            $cidadeUsuario = $cidadeUsuario->buscar("id = {$usuario->idCidade}")[0];
                                            
                                            $idEstadoUsuario = $cidadeUsuario->idEstado;
                                            foreach( $listaEstado as $estado ) {
                                            ?>
                                            <option value="<?php echo $estado->id; ?>" <?php echo ( $estado->id == $idEstadoUsuario )? "selected" : ""; ?>><?php echo $estado->nome; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </label>
                                </div>
                                <div class="box-label-input">
                                    <label><span class="label">Cidade:</span>
                                        <select name="slCidade" class="preset-input-select input">
                                            <option selected disabled>Selecione...</option>  
                                            <?php
                                            $listaCidade = new \Tabela\Cidade();
                                            $listaCidade = $listaCidade->buscar();
                                            foreach( $listaCidade as $cidade ) {
                                            ?>
                                            <option value="<?php echo $cidade->id; ?>"  <?php echo ( $cidade->id == $usuario->idCidade )? "selected" : ""; ?>><?php echo $cidade->nome; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </label>
                                </div>
                                <input class="preset-input-submit botao-submit" type="submit" name="formSubmit" value="Salvar" />
                            </form>
                        </div>
                        <div id="form-info-contato" class="form-conta">
                            <form method="POST" action="configuracoes.php?id=<?php echo $idUsuario; ?>">
                                <div class="box-label-input">
                                    <label><span class="label">Telefone:</span>
                                        <input type="text" name="txtTelefone" class="preset-input-text input" value="<?php echo $usuario->telefone; ?>" />
                                    </label>
                                </div>
                                <div class="box-label-input">
                                    <label><span class="label">Celular:</span>
                                        <input type="text" name="txtCelular" class="preset-input-text input" value="<?php echo $usuario->celular; ?>" />
                                    </label>
                                </div>
                                <div class="box-label-input">
                                    <label><span class="label">Email:</span>
                                        <input type="text" name="txtEmail" class="preset-input-text input" value="<?php echo $usuario->email; ?>" />
                                    </label>
                                </div>
                                <input class="preset-input-submit botao-submit" type="submit" name="formSubmit" value="Salvar" />
                            </form>
                        </div>
                        <div id="form-info-financeiro" class="form-conta">
                            <form method="POST" action="configuracoes.php?id=<?php echo $idUsuario; ?>">
                                <h2 class="titulo-sessao">Cartão de Crédito</h2>
                                <div class="box-label-input">
                                    <label><span class="label">Tipo de Cartão:</span>
                                        <select name="slTipoCartao" class="preset-input-select input">
                                            <option selected disabled>Selecione</option>
                                            <?php
                                                $listaTipoCartao = new \Tabela\TipoCartaoCredito();
                                                $listaTipoCartao = $listaTipoCartao->buscar();
                                                
                                                foreach( $listaTipoCartao as $tipoCartao ) {
                                            ?>
                                            <option value="<?php echo $tipoCartao->id; ?>" <?php echo ( $cartaoCredito->idTipo == $tipoCartao->id )? "selected" : ""; ?>>
                                                <?php echo $tipoCartao->titulo; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                </div>
                                <div class="box-label-input">
                                    <label><span class="label">Número do Cartão:</span>
                                        <input type="text" name="txtNumeroCartao" class="preset-input-text input" value="<?php echo $cartaoCredito->numero; ?>" />
                                    </label>
                                </div>
                                <div class="box-label-input">
                                    <label><span class="label">Validade</span>
                                        <?php
                                            $data_formatada = explode("-", $cartaoCredito->vencimento);
                                            $data_formatada = $data_formatada[2] . "/" . $data_formatada[0];                                                                                    
                                        ?>
                                        <input type="text" name="txtValidadeCartao" class="preset-input-text input" value="<?php echo $data_formatada; ?>" />
                                    </label>
                                </div>
                                <h2 class="titulo-sessao">Conta Bancária</h2>
                                <div class="box-label-input">
                                    <label><span class="label">Banco:</span>
                                        <select name="slBanco" class="preset-input-select input">
                                            <option selected disabled>Selecione</option>
                                            <?php
                                                $listaBanco = new \Tabela\Banco();
                                                $listaBanco = $listaBanco->buscar();
                                                
                                                foreach( $listaBanco as $banco ) {
                                            ?>
                                            <option value="<?php echo $banco->id; ?>" <?php echo ( $contaBancaria->idBanco == $banco->id )? "selected" : ""; ?>>
                                                <?php echo $banco->nome; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                </div>
                                <div class="box-label-input">
                                    <label><span class="label">Número da Agência:</span>
                                        <input type="text" name="txtNumeroAgencia" class="preset-input-text input" value="<?php echo $contaBancaria->numeroAgencia; ?>" />
                                    </label>
                                </div>
                                <div class="box-label-input">
                                    <label><span class="label">Número da Conta:</span>
                                        <input type="text" name="txtNumeroConta" class="preset-input-text input" value="<?php echo $contaBancaria->conta; ?>" />
                                    </label>
                                </div>
                                <div class="box-label-input">
                                    <label><span class="label">Dígito Verificador:</span>
                                        <input type="text" name="txtDigitoVerificador" class="preset-input-text input" value="<?php echo $contaBancaria->digito; ?>" />
                                    </label>
                                </div>
                                <input class="preset-input-submit botao-submit" type="submit" name="formSubmitFinanceiro" value="Salvar" />
                            </form>
                        </div>
                        <div id="form-info-conducao" class="form-conta">                            
                            <div class="box-label-input">
                                <form method="post" action="apis/crud_cnh.php?modo=insert">
                                    <label><span class="label">CNH:</span>
                                        <input type="text" name="txtNumeroRegistro" class="preset-input-text input" value="<?php echo $contaBancaria->digito; ?>" required />                                        
                                    </label>
                                    <input class="preset-input-submit btn-adicionar" type="submit" value="" />
                                </form>
                            </div>
                            <div id="container-cnh">
                                <?php
                                $buscaCnh = new \Tabela\Cnh();
                                $listaCnhUsuario = $buscaCnh->buscar("idUsuario = {$usuario->id}");
                                foreach( $listaCnhUsuario as $cnh ) {
                                ?>
                                <div class="box-cnh">
                                    <form action="apis/crud_cnh.php?idCnh=<?php echo $cnh->id; ?>&modo=update" method="post">
                                        <input type="text" class="preset-input-text input-numero-cnh" name="txtNumeroRegistro" placeholder="Digite o número da cnh" value="<?php echo $cnh->numeroRegistro; ?>" />
                                        <div class="box-acoes">
                                            <input type="submit" class="preset-input-submit editar" value="" />
                                            <a href="apis/crud_cnh.php?idCnh=<?php echo $cnh->id; ?>&modo=delete" class="preset-botao remover"></a>
                                        </div>
                                    </form>
                                </div>
                                <?php 
                                }
                                ?>
                            </div>                            
                        </div>
                        <div id="form-info-autenticacao" class="form-conta">
                            <form method="POST" action="configuracoes.php?id=<?php echo $idUsuario; ?>">
                                <div class="box-label-input">
                                    <label><span class="label">Senha:</span>
                                        <input type="password" name="txtSenha" class="preset-input-text input" />
                                    </label>
                                </div>
                                <div class="box-label-input">
                                    <label><span class="label">Confirmar Senha:</span>
                                        <input type="password" name="txtConfirmarSenha" class="preset-input-text input" />
                                    </label>
                                </div>
                                <input class="preset-input-submit botao-submit" type="submit" name="formSubmit" value="Salvar" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CONTEUDO PRINCIPAL -->
        </div>
        <?php require_once("layout/footer.php"); ?>
        <script src="js/libs/jquery-3.1.1.min.js"></script>        
        <script src="js/script.js"></script>
    </body>
</html>