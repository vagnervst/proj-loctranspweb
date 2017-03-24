<?php
    require_once("include/initialize.php");
    $formularioFisico = ( isset($_POST["submitFisico"]) )? $_POST["submitFisico"] : null;
    $formularioJuridico = ( isset($_POST["submitJuridico"]) )? $_POST["submitJuridico"] : null;

    if( !empty($formularioFisico) || !empty($formularioJuridico) ) {        
        
        $fotoPerfil = null;
        if( !empty($formularioFisico) ) {
            $fotoPerfil = ( isset($_POST["fotoPerfilFisico"]) )? $_POST["fotoPerfilFisico"] : null;
        } elseif( !empty($formularioJuridico) ) {
            $fotoPerfil = ( isset($_POST["fotoPerfilJuridico"]) )? $_POST["fotoPerfilJuridico"] : null;
        }
        
        $nome = ( isset($_POST["txtNome"]) )? $_POST["txtNome"] : null;
        $sobrenome = ( isset($_POST["txtSobrenome"]) )? $_POST["txtSobrenome"] : null;
        $dataNascimento = ( isset($_POST["txtDataNascimento"]) )? $_POST["txtDataNascimento"] : null;
        $sexo = ( isset($_POST["rdoSexo"]) )? $_POST["rdoSexo"] : null;
        $sexo = ( isset($_POST["rdoSexo"]) )? $_POST["rdoSexo"] : null;
        $cpf = ( isset($_POST["txtCpf"]) )? $_POST["txtCpf"] : null;
        $rg = ( isset($_POST["txtRg"]) )? $_POST["txtRg"] : null;
        $telefone = ( isset($_POST["txtTelefone"]) )? $_POST["txtTelefone"] : null;
        $celular = ( isset($_POST["txtCelular"]) )? $_POST["txtCelular"] : null;
        $email = ( isset($_POST["txtEmail"]) )? $_POST["txtEmail"] : null;
        $titularCartao = ( isset($_POST["txtTitularCartao"]) )? $_POST["txtTitularCartao"] : null;
        $numeroCartao = ( isset($_POST["txtNumeroCartao"]) )? $_POST["txtNumeroCartao"] : null;
        $validadeCartaoMes = ( isset($_POST["txtValidadeCartaoMes"]) )? $_POST["txtValidadeCartaoMes"] : null;
        $validadeCartaoAno = ( isset($_POST["txtValidadeCartaoAno"]) )? $_POST["txtValidadeCartaoAno"] : null;
        $contaAgencia = ( isset($_POST["txtContaAgencia"]) )? $_POST["txtContaAgencia"] : null;
        $contaNumero = ( isset($_POST["txtContaNumero"]) )? $_POST["txtContaNumero"] : null;
        $cnh = ( isset($_POST["txtCnh"]) )? $_POST["txtCnh"] : null;
        $senha = ( isset($_POST["txtSenha"]) )? $_POST["txtSenha"] : null;
        $confSenha = ( isset($_POST["txtConfSenha"]) )? $_POST["txtConfSenha"] : null;
        $idEstado = ( isset($_POST["slEstado"]) )? $_POST["slEstado"] : null;
        $idCidade = ( isset($_POST["slCidade"]) )? $_POST["slCidade"] : null;
        $razaoSocial = ( isset( $_POST["txtRazaoSocial"] ) )? $_POST["txtRazaoSocial"] : null;
        $nomeFantasia = ( isset( $_POST["txtNomeFantasia"] ) )? $_POST["txtNomeFantasia"] : null;
        $cnpj = ( isset( $_POST["txtCnpj"] ) )? $_POST["txtCnpj"] : null;
        
        $idPlanoBasico = 1;
        $idTipoContaFisico = 1;
        
        echo $fotoPerfil . "<br/>";
        echo $nome . "<br/>";
        echo $sobrenome . "<br/>";
        echo $dataNascimento . "<br/>";
        echo $sexo . "<br/>";
        echo $sexo . "<br/>";
        echo $cpf . "<br/>";
        echo $rg . "<br/>";
        echo $telefone . "<br/>";
        echo $celular . "<br/>";
        echo $email . "<br/>";
        echo $titularCartao . "<br/>";
        echo $numeroCartao . "<br/>";
        echo $validadeCartaoMes . "<br/>";
        echo $validadeCartaoAno . "<br/>";
        echo $contaAgencia . "<br/>";
        echo $contaNumero . "<br/>";
        echo $cnh . "<br/>";
        echo $senha . "<br/>";
        echo $confSenha . "<br/>";
        echo $idEstado . "<br/>";
        echo $idCidade . "<br/>";                
        echo $razaoSocial . "<br/>";
        echo $nomeFantasia . "<br/>";
        echo $cnpj . "<br/>";
        
        /*$objUsuario = new Usuario();
        $objUsuario->nome = $nome;
        $objUsuario->sobrenome = $sobrenome;
        $objUsuario->nomeFantasia = $nomeFantasia;
        $objUsuario->sexo = $sexo;
        $objUsuario->cpf = $cpf;
        $objUsuario->cnpj = $cnpj;
        $objUsuario->telefone = $telefone;
        $objUsuario->celular = $celular;
        $objUsuario->email = $email;
        $objUsuario->rg = $rg;
        $objUsuario->razaoSocial = $razaoSocial;
        $objUsuario->saldo = 0;
        $objUsuario->senha = $senha;
        $objUsuario->autenticacaoDupla = 1;
        $objUsuario->fotoPerfil = $fotoPerfil;
        $objUsuario->idEstado = $idEstado;
        $objUsuario->idCidade = $idCidade;
        $objUsuario->idTipoConta = $idTipoContaFisico;
        $objUsuario->idPlanoConta = $idPlanoBasico;
        $objUsuario->idLicencaDesktop = 1;*/
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cadastro | City Share</title>
        <meta name="viewport" content="width=device-width"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/icones/logoCityShareIcon.png">
    </head>
    <body>
        <div id="container">
            <?php require_once("layout/header.php"); ?>
            <div class="js-popup-painel painel-mobile" id="box-mobile-menu">
                <ul id="mobile-menu">
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">ALUGUE</a></li>
                    <li><a href="#">EMPRESTE</a></li>
                    <li><a href="#">CONTATO</a></li>                    
                </ul>
            </div>
            <!-- MENU DE PAGINAS - MOBILE -->
            <div class="main" id="pag-cadastro">
                <div class="imagem-divisao-conteudo"></div>
                <div id="box-tipo-conta">
                    <div class="box-conteudo">
                        <div id="container-botoes-conta">
                            <span class="preset-botao botao-conta" id="botao-conta-fisica">Físico</span>
                            <span class="preset-botao botao-conta" id="botao-conta-juridica">Jurídico</span>
                        </div>                
                    </div>
                    <div class="indicador-modo"></div>
                </div>
                <div class="box-conteudo">
                    <div class="js-cadastro-ativo" id="container-cadastro-fisico">
                        <form method="post" action="cadastro.php">
                            <section class="js-etapa1 box-cadastro" id="box-info-pessoais">
                                <h1 class="titulo-cadastro">Informações Pessoais</h1>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Foto*:</span>
                                        <input class="input-foto" id="input-foto-fisico" name="fotoPerfilFisico" type="file"  />
                                    </label>
                                    <div class="botao-foto" id="botao-foto-fisico"></div>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Nome*:</span>
                                        <input class="preset-input-text text-input" name="txtNome" type="text" placeholder="Digite seu nome..."  />
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Sobrenome*:</span>
                                        <input class="preset-input-text text-input" name="txtSobrenome" type="text" placeholder="Digite seu sobrenome..."  />
                                    </label>
                                </div>
                                <div class="horizontal-input-container">
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">Data de Nascimento*:</span>
                                            <input class="preset-input-text text-input" name="txtDataNascimento" type="text" placeholder="Ex: DD/MM/AAAA"  />
                                        </label>
                                    </div>
                                    <div class="label-input">
                                        <p class="label">Sexo:</p>
                                        <input class="radio-input" type="radio" name="rdoSexo" value="f"  />
                                        <label class="label radio-label">Feminino</label>
                                        <input class="radio-input" type="radio" name="rdoSexo" value="m"  />
                                        <label class="label radio-label">Masculino</label>
                                    </div>
                                </div>
                                <div class="horizontal-input-container box-localizacao">
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">Cidade*:</span>
                                            <select class="preset-input-select input" name="slCidade">
                                                <option selected disabled>Selecione uma cidade</option>
                                                <?php for($i = 0; $i < 30; ++$i) { ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">Estado*:</span>
                                            <select class="preset-input-select input" name="slEstado">
                                                <option selected disabled>Selecione uma cidade</option>
                                                <?php for($i = 0; $i < 30; ++$i) { ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="horizontal-input-container">
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">CPF*:</span>
                                            <input class="preset-input-text text-input" type="text" name="txtCpf" placeholder="Ex: XXX.XXX.XXX-XX" />
                                        </label>
                                    </div>
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">RG*:</span>
                                            <input class="preset-input-text text-input" type="text" name="txtRg" placeholder="Ex: XX.XXX.XXX-X" />
                                        </label>
                                    </div>
                                </div>
                                <span class="js-botao-transf js-etapa2 preset-botao button-link">Confirmar</span>
                            </section>
                            <section class="js-etapa2 box-cadastro" id="box-info-contato">
                                <h1 class="titulo-cadastro">Informações de Contato</h1>               
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Telefone*:</span>
                                        <input class="preset-input-text text-input" type="text" name="txtTelefone"  />
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Celular*:</span>
                                        <input class="preset-input-text text-input" type="text" name="txtCelular"  />
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Email*:</span>
                                        <input class="preset-input-text text-input" type="text" name="txtEmail"  />
                                    </label>
                                </div>
                                <div class="horizontal-input-container">
                                    <p class="js-botao-transf js-etapa3 preset-botao button-link">Vou alugar</p>
                                    <p class="js-botao-transf js-etapa4 preset-botao button-link">Vou emprestar</p>
                                </div>
                            </section>
                            <section class="js-etapa3 box-cadastro" id="box-cartao-credito">
                                <h1 class="titulo-cadastro">Cartão de Crédito</h1>               
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Nome do Titular do Cartão*:</span>
                                        <input class="preset-input-text text-input" type="text" name="txtTitularCartao"  />
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Número do Cartão*:</span>
                                        <input class="preset-input-text text-input" type="text" name="txtNumeroCartao"  />
                                    </label>
                                </div>
                                <div class="horizontal-input-container">
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">Validade (mm/aa)*:</span>
                                            <input class="preset-input-text text-input" type="text" name="txtValidadeCartaoMes" placeholder="Mês"  />
                                        </label>
                                    </div>
                                    <div class="label-input">
                                        <input class="preset-input-text text-input" type="text" name="txtValidadeCartaoAno" placeholder="Ano"  />
                                    </div>
                                </div>
                                <p class="js-botao-transf js-etapa5 preset-botao button-link">Confirmar</p>
                            </section>
                            <section class="js-etapa4 box-cadastro" id="box-conta-bancaria">
                                <h1 class="titulo-cadastro">Conta Bancária</h1>               
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Número da Agência*:</span>
                                        <input class="preset-input-text text-input" type="text" name="txtContaAgencia" />
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Número da Conta*:</span>
                                        <input class="preset-input-text text-input" type="text" name="txtContaNumero" />
                                    </label>
                                </div>
                                    <p class="js-botao-transf js-etapa6 preset-botao button-link">Confirmar</p>
                            </section>
                            <section class="js-etapa5 box-cadastro" id="box-conducao">
                                <h1 class="titulo-cadastro">Dados de Condução</h1>               
                                <div class="label-input">
                                    <label class="label"><span class="input-label">CNH*:</span>
                                        <input class="preset-input-text text-input" type="text" name="txtCnh" />
                                    </label>
                                </div>
                                    <p class="js-botao-transf js-etapa6 preset-botao button-link">Confirmar</p>
                            </section>
                            <section class="js-etapa6 box-cadastro" id="box-autenticacao">
                                <h1 class="titulo-cadastro">Autenticação</h1>               
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Senha*:</span>
                                        <input class="preset-input-text text-input" type="password" name="txtSenha" />
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Confirmar Senha*:</span>
                                        <input class="preset-input-text text-input" type="password" name="txtConfSenha" />
                                    </label>
                                </div>
                                <input class="preset-input-submit button-link botao-cadastrar" type="submit" name="submitFisico" value="Criar Conta"/>
                            </section>
                        </form>
                    </div>
                    <div id="container-cadastro-juridico">
                        <form method="post" action="cadastro.php">
                            <section class="js-etapa1 box-cadastro" id="box-info-pessoais">
                                <h1 class="titulo-cadastro">Informações Pessoais</h1>               
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Foto*:</span>
                                        <input class="input-foto" id="input-foto-juridico" type="file" name="fotoJuridico" />
                                    </label>
                                    <div class="botao-foto" id="botao-foto-juridico"></div>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Nome*:</span>
                                        <input class="preset-input-text text-input" type="text" name="txtNome" />
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Sobrenome*:</span>
                                        <input class="preset-input-text text-input" type="text" name="txtSobrenome" />
                                    </label>
                                </div>
                                <div class="horizontal-input-container">
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">Data de Nascimento*:</span>
                                            <input class="preset-input-text text-input" type="text" name="txtDataNascimento" />
                                        </label>
                                    </div>
                                    <div class="label-input">
                                        <p class="label">Sexo:</p>
                                        <input class="radio-input" type="radio" name="rdoSexo" value="f" />
                                        <label class="label radio-label">Feminino</label>
                                        <input class="radio-input" type="radio" name="rdoSexo" value="m" />
                                        <label class="label radio-label">Masculino</label>
                                    </div>
                                </div>                                
                                <p class="js-botao-transf js-etapa2 preset-botao button-link">Confirmar</p>
                            </section>
                            <section class="js-etapa2 box-cadastro" id="box-info-empresa">
                                <h1 class="titulo-cadastro">Dados da Empresa</h1>               
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Razão Social*:</span>
                                        <input class="preset-input-text text-input" type="text" name="txtRazaoSocial" />
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Nome Fantasia*:</span>
                                        <input class="preset-input-text text-input" type="text" name="txtNomeFantasia" />
                                    </label>
                                </div>
                                <div class="horizontal-input-container">
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">CNPJ*:</span>
                                            <input class="preset-input-text text-input" type="text" name="txtCnpj" />
                                        </label>
                                    </div>                                    
                                </div>                                
                                <p class="js-botao-transf js-etapa3 preset-botao button-link">Confirmar</p>
                            </section>
                            <section class="js-etapa3 box-cadastro" id="box-conta-bancaria">
                                <h1 class="titulo-cadastro">Conta Bancária</h1>               
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Número da Agência*:</span>
                                        <input class="preset-input-text text-input" type="text" name="txtContaAgencia" />
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Número da Conta*:</span>
                                        <input class="preset-input-text text-input" type="text" name="txtContaNumero" />
                                    </label>
                                </div>
                                    <p class="js-botao-transf js-etapa4 preset-botao button-link">Confirmar</p>
                            </section>
                            <section class="js-etapa4 box-cadastro" id="box-autenticacao">
                                <h1 class="titulo-cadastro">Autenticação</h1>               
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Senha*:</span>
                                        <input class="preset-input-text text-input" type="password" name="txtSenha" />
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Confirmar Senha*:</span>
                                        <input class="preset-input-text text-input" type="password" name="txtConfSenha" />
                                    </label>
                                </div>
                                <input class="preset-input-submit button-link botao-cadastrar" type="submit" name="submitJuridico" value="Criar Conta"/>
                            </section>
                        </form>
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