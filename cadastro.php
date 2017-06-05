<?php
    require_once("include/initialize.php");
    require_once("include/classes/tbl_tipo_cartao_credito.php");
    require_once("include/classes/tbl_estado.php");
    require_once("include/classes/tbl_cidade.php");
    require_once("include/classes/tbl_usuario.php");
    require_once("include/classes/tbl_banco.php");
    require_once("include/classes/tbl_mes.php");
    require_once("include/classes/tbl_empresa.php");
    require_once("include/classes/tbl_cartao_credito.php");
    require_once("include/classes/tbl_conta_bancaria.php");
    require_once("include/classes/tbl_cnh.php");
    require_once("include/classes/form_validate.php");
    require_once("include/classes/autenticacao.php");
    require_once("include/classes/file.php");

    $formularioFisico = ( isset($_POST["submitFisico"]) )? $_POST["submitFisico"] : null;
    $formularioJuridico = ( isset($_POST["submitJuridico"]) )? $_POST["submitJuridico"] : null;

    if( !empty($formularioFisico) || !empty($formularioJuridico) ) {
        
        $idContaFisica = 1;
        $idContaJuridica = 2;
        
        $idTipoConta = ( isset( $formularioFisico ) )? $idContaFisica : $idContaJuridica;
        
        $fotoPerfil = null;
        if( !empty($formularioFisico) ) {
            $fotoPerfil = ( isset($_FILES["fotoPerfilFisico"]) )? $_FILES["fotoPerfilFisico"] : null;
        } elseif( !empty($formularioJuridico) ) {
            $fotoPerfil = ( isset($_FILES["fotoJuridico"]) )? $_FILES["fotoJuridico"] : null;
        }

        $nome = ( isset($_POST["txtNome"]) )? $_POST["txtNome"] : null;
        $sobrenome = ( isset($_POST["txtSobrenome"]) )? $_POST["txtSobrenome"] : null;
        $diaNascimento = ( isset($_POST["txtDiaNascimento"]) )? $_POST["txtDiaNascimento"] : null;
        $mesNascimento = ( isset($_POST["slMesNascimento"]) )? $_POST["slMesNascimento"] : null;
        $anoNascimento = ( isset($_POST["slAnoNascimento"]) )? $_POST["slAnoNascimento"] : null;
        $sexo = ( isset($_POST["rdoSexo"]) )? $_POST["rdoSexo"] : null;        
        $cpf = ( isset($_POST["txtCpf"]) )? $_POST["txtCpf"] : null;
        $rg = ( isset($_POST["txtRg"]) )? $_POST["txtRg"] : null;
        $telefone = ( isset($_POST["txtTelefone"]) )? $_POST["txtTelefone"] : null;
        $celular = ( isset($_POST["txtCelular"]) )? $_POST["txtCelular"] : null;
        $emailContato = ( isset($_POST["txtEmail"]) )? $_POST["txtEmail"] : null;
        $idTipoCartao = ( isset($_POST["slTipoCartao"]) )? $_POST["slTipoCartao"] : null;
        $numeroCartao = ( isset($_POST["txtNumeroCartao"]) )? $_POST["txtNumeroCartao"] : null;        
        $mesValidade = ( isset($_POST["slMesValidade"]) )? $_POST["slMesValidade"] : null;
        $anoValidade = ( isset($_POST["slAnoValidade"]) )? $_POST["slAnoValidade"] : null;
        $idBanco = ( isset($_POST["slBanco"]) )? $_POST["slBanco"] : null;
        $contaAgencia = ( isset($_POST["txtContaAgencia"]) )? $_POST["txtContaAgencia"] : null;
        $contaNumero = ( isset($_POST["txtContaNumero"]) )? $_POST["txtContaNumero"] : null;;
        $contaDigitoVerificador = ( isset($_POST["txtContaBancariaDV"]) )? $_POST["txtContaBancariaDV"] : null;
        $cnh = ( isset($_POST["txtCnh"]) )? $_POST["txtCnh"] : null;
        $emailAutenticacao = ( isset($_POST["txtEmailAutenticacao"]) )? $_POST["txtEmailAutenticacao"] : null;
        $senha = ( isset($_POST["txtSenha"]) )? $_POST["txtSenha"] : null;
        $confSenha = ( isset($_POST["txtConfSenha"]) )? $_POST["txtConfSenha"] : null;
        $idEstado = ( isset($_POST["slEstado"]) )? $_POST["slEstado"] : null;
        $idCidade = ( isset($_POST["slCidade"]) )? (int) $_POST["slCidade"] : null;
        $razaoSocial = ( isset( $_POST["txtRazaoSocial"] ) )? $_POST["txtRazaoSocial"] : null;
        $nomeFantasia = ( isset( $_POST["txtNomeFantasia"] ) )? $_POST["txtNomeFantasia"] : null;
        $cnpj = ( isset( $_POST["txtCnpj"] ) )? $_POST["txtCnpj"] : null;                  
        
        $idPlanoContaBasico = 1;
        $idLicencaDesktopBasico = 1;
        
        $dataNascimento = FormValidator::prepare_time_input_for_mysql( $diaNascimento . "/" . $mesNascimento . "/" . $anoNascimento );
        $dataValidadeCartao = FormValidator::prepare_time_input_for_mysql( '01' . "/" . $mesValidade . "/" . $anoValidade  );
                
        $usuario = new \Tabela\Usuario();
        $usuario->nome = $nome;
        $usuario->sobrenome = $sobrenome;
        $usuario->dataNascimento = $dataNascimento;        
        $usuario->sexo = $sexo;
        $usuario->cpf = $cpf;
        $usuario->rg = $rg;
        $usuario->telefone = $telefone;
        $usuario->celular = $celular;
        $usuario->emailContato = $emailContato;
        $usuario->email = $emailAutenticacao;
        $usuario->senha = Autenticacao::hash( $senha );
        $usuario->idCidade = $idCidade;        
        $usuario->idTipoConta = $idTipoConta;
        $usuario->idPlanoConta = $idPlanoContaBasico;
        $usuario->idLicencaDesktop = $idLicencaDesktopBasico;
        $usuario->fotoPerfil = ( $sexo == "m" )? "man.png" : "woman.png";
        
        $id_usuario_inserido = $usuario->inserir();
        
        if( $id_usuario_inserido && $idTipoConta == $idContaJuridica ) {
            
            $objEmpresa = new \Tabela\Empresa();
            $objEmpresa->logomarca = "company.png";
            $pasta_empresa = "img/uploads/empresas";            
            
            $nome_arquivo = "empresa_usr_" . $id_usuario_inserido . "." . pathinfo($fotoPerfil["name"], PATHINFO_EXTENSION);
            if( File::upload($fotoPerfil, $nome_arquivo, $pasta_empresa) ) {                
                $objEmpresa->logomarca = basename($fotoPerfil["name"]);
            }            
                        
            $objEmpresa->razaoSocial = $razaoSocial;
            $objEmpresa->nomeFantasia = $nomeFantasia;
            $objEmpresa->cnpj = $cnpj;            
            $objEmpresa->idUsuarioJuridico = $id_usuario_inserido;
                        
            $objEmpresa->inserir();
            
            $objContaBancaria = new \Tabela\ContaBancaria();
                
            $objContaBancaria->numeroAgencia = $contaAgencia;
            $objContaBancaria->conta = $contaAgencia;
            $objContaBancaria->digito = $contaDigitoVerificador;
            $objContaBancaria->idUsuario = $id_usuario_inserido;
            $objContaBancaria->idTipoConta = 1;
            $objContaBancaria->idBanco = $idBanco;

            $objContaBancaria->inserir();
            
        } elseif( $id_usuario_inserido && $idTipoConta == $idContaFisica ) {
            
            $pasta_usuario = "img/uploads/usuarios";
                            
            $nome_arquivo = "usr_" . $id_usuario_inserido . "." . pathinfo($fotoPerfil["name"], PATHINFO_EXTENSION);
            
            if( File::upload($fotoPerfil, $nome_arquivo, $pasta_usuario) ) {
                $usuario->id = $id_usuario_inserido;
                $usuario->fotoPerfil = basename($fotoPerfil["name"]);
                $usuario->atualizar();
            }            
            
            if( !empty( $idTipoCartao ) ) {
                $objCnh = new \Tabela\Cnh();
                $objCnh->numeroRegistro = $cnh;
                $objCnh->idUsuario = $id_usuario_inserido;

                $objCnh->inserir();
            }
            
            if( !empty($idTipoCartao) ) {
                $objCartaoCredito = new \Tabela\CartaoCredito();

                $objCartaoCredito->numero = $numeroCartao;
                $objCartaoCredito->vencimento = $dataValidadeCartao;                
                $objCartaoCredito->idUsuario = $id_usuario_inserido;
                $objCartaoCredito->idTipo = $idTipoCartao;

                $objCartaoCredito->inserir();
            } elseif( !empty($idBanco) ) {
                $objContaBancaria = new \Tabela\ContaBancaria();
                
                $objContaBancaria->numeroAgencia = $contaAgencia;
                $objContaBancaria->conta = $contaAgencia;
                $objContaBancaria->digito = $contaDigitoVerificador;
                $objContaBancaria->idUsuario = $id_usuario_inserido;
                $objContaBancaria->idTipoConta = 1;
                $objContaBancaria->idBanco = $idBanco;
                
                $objContaBancaria->inserir();
            }
        }                
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cadastro | City Share</title>
        <meta name="viewport" content="width=device-width"/>
        <meta charset="utf-8" />
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
                        <form method="post" action="cadastro.php" enctype="multipart/form-data">
                            <section class="js-etapa1 box-cadastro" id="box-info-pessoais">
                                <h1 class="titulo-cadastro">Informações Pessoais</h1>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Foto*:</span>
                                        <input class="input-foto" id="input-foto-fisico" name="fotoPerfilFisico" type="file" />
                                    </label>
                                    <div class="botao-foto" id="botao-foto-fisico"></div>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Nome*:</span>
                                        <input class="preset-input-text input text-input js-mask" name="txtNome" type="text" placeholder="Digite seu nome..." data-mask="CCCCCCCCCCCCCCCCCCCC" maxlength="20" />
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Sobrenome*:</span>
                                        <input class="preset-input-text input text-input" name="txtSobrenome" type="text" placeholder="Digite seu sobrenome..." maxlength="100" />
                                    </label>
                                </div>
                                <div class="horizontal-input-container box-data-nascimento">
                                    <p class="titulo">Data de Nascimento</p>
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">Dia*:</span>
                                            <input class="preset-input-text input text-input js-mask" name="txtDiaNascimento" placeholder="01" type="text" data-mask="DD" />
                                        </label>
                                    </div>
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">Mês*:</span>
                                            <select class="preset-input-select input" name="slMesNascimento">
                                                <option selected disabled>Mês</option>
                                                <?php
                                                    $lista_meses = new \Tabela\Mes();
                                                    $lista_meses = $lista_meses->buscar();
                                                    
                                                    foreach( $lista_meses as $mes ) {
                                                ?>
                                                <option value="<?php echo $mes->mes; ?>"><?php echo $mes->titulo; ?></option>
                                                <?php } ?>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">Ano*:</span>
                                            <select class="preset-input-select input" name="slAnoNascimento">
                                                <option selected disabled>Ano</option>
                                                <?php 
                                                    $anoInicial = 1900;
                                                    
                                                    while( $anoInicial <= date("Y") ) {
                                                ?>
                                                <option value="<?php echo $anoInicial; ?>"><?php echo $anoInicial++; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="horizontal-input-container box-sexo">
                                    <p class="titulo">Sexo:</p>
                                    <div class="label-input">                                        
                                        <label class="radio-label">
                                            <input class="radio-input" type="radio" name="rdoSexo" value="f"  />
                                            <span class="label">Feminino</span>
                                        </label>
                                    </div>
                                    <div class="label-input">
                                        <label class="radio-label">
                                            <input class="radio-input" type="radio" name="rdoSexo" value="m"  />
                                            <span class="label">Masculino</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="horizontal-input-container box-localizacao">
                                   <div class="label-input">
                                        <label class="label"><span class="input-label">Estado*:</span>
                                            <select class="preset-input-select input js-select-estado" name="slEstado">
                                                <option selected disabled>Selecione...</option>
                                                <?php 
                                                    $lista_estados = new \Tabela\Estado();
                                                    $lista_estados = $lista_estados->buscar();
                                                
                                                    foreach( $lista_estados as $estado ) { 
                                                ?>
                                                <option value="<?php echo $estado->id; ?>"><?php echo $estado->nome; ?></option>
                                                <?php } ?>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">Cidade*:</span>
                                            <select class="preset-input-select input js-select-cidade" name="slCidade">
                                                <option selected disabled>Selecione...</option>
                                            </select>
                                        </label>
                                    </div>                                    
                                </div>
                                <div class="horizontal-input-container">
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">CPF*:</span>
                                            <input class="preset-input-text input text-input js-mask" type="text" name="txtCpf" placeholder="Ex: 999.999.999-99" data-mask="DDD#.DDD#.DDD#-DD" />
                                        </label>
                                    </div>
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">RG*:</span>
                                            <input class="preset-input-text input text-input js-mask" type="text" name="txtRg" placeholder="Ex: 99.999.999-9" data-mask="DD#.DDD#.DDD#-D" />
                                        </label>
                                    </div>
                                </div>
                                <span class="js-botao-transf js-etapa2 preset-botao button-link">Confirmar</span>
                            </section>
                            <section class="js-etapa2 box-cadastro" id="box-info-contato">
                                <h1 class="titulo-cadastro">Informações de Contato</h1>               
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Telefone*:</span>
                                        <input class="preset-input-text input text-input js-mask" type="text" name="txtTelefone" placeholder="Ex: (11) 1234-5678" maxlength="25" />
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Celular*:</span>
                                        <input class="preset-input-text input text-input" type="text" name="txtCelular" placeholder="Ex: (11) 1234-5678" maxlength="25" />
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Email*:</span>
                                        <input class="preset-input-text input text-input" type="text" name="txtEmail" maxlength="100" />
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
                                    <label class="label"><span class="input-label">Tipo do Cartão:</span>
                                        <select class="preset-input-select input" name="slTipoCartao">
                                            <option selected disabled>Selecione o tipo do cartão</option>
                                            <?php
                                                $lista_tipo_cartao = new \Tabela\TipoCartaoCredito();
                                                $lista_tipo_cartao = $lista_tipo_cartao->buscar("visivel = 1");
                                                foreach( $lista_tipo_cartao as $tipo_cartao ) {
                                            ?>
                                            <option value="<?php echo $tipo_cartao->id; ?>"><?php echo $tipo_cartao->titulo; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </label>
                                </div>
                                <div class="horizontal-input-container">
                                    <div class="label-input" id="box-numero-cartao">
                                        <label class="label"><span class="input-label">Número do Cartão:</span>
                                            <input class="preset-input-text input text-input js-mask" type="text" name="txtNumeroCartao" placeholder="Digite o número do cartão" data-mask="DDDDDDDDDDDDDDDD" />
                                        </label>
                                    </div>                                    
                                </div>                                
                                <div class="horizontal-input-container">
                                    <h3 class="titulo">Validade</h3>                                    
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">Mês*:</span>
                                            <select class="preset-input-select input" name="slMesValidade">
                                                <option selected disabled>Mês</option>
                                                <?php
                                                    $lista_meses = new \Tabela\Mes();
                                                    $lista_meses = $lista_meses->buscar();
                                                    
                                                    foreach( $lista_meses as $mes ) {
                                                ?>
                                                <option value="<?php echo $mes->mes; ?>"><?php echo $mes->titulo; ?></option>
                                                <?php } ?>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">Ano*:</span>
                                            <select class="preset-input-select input" name="slAnoValidade">
                                                <option selected disabled>Ano</option>
                                                <?php 
                                                    $anoInicial = date("Y");
                                                    
                                                    while( $anoInicial <= date("Y")+30 ) {
                                                ?>
                                                <option value="<?php echo $anoInicial; ?>"><?php echo $anoInicial++; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </label>
                                    </div>
                                </div>                                                                    
                                <p class="js-botao-transf js-etapa5 preset-botao button-link">Confirmar</p>
                            </section>
                            <section class="js-etapa4 box-cadastro" id="box-conta-bancaria">
                                <h1 class="titulo-cadastro">Conta Bancária</h1>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Banco*:</span>
                                        <select class="preset-input-select input" name="slBanco">
                                            <option selected disabled>Selecione o banco</option>
                                            <?php
                                                $lista_bancos = new \Tabela\Banco();
                                                $lista_bancos = $lista_bancos->buscar();
                                                
                                                foreach( $lista_bancos as $banco ) {
                                            ?>
                                            <option value="<?php echo $banco->id; ?>"><?php echo $banco->nome; ?></option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Número da Agência*:</span>
                                        <input class="preset-input-text input text-input js-mask" type="text" name="txtContaAgencia" placeholder="Número da Agência" maxlength="10" data-mask="DDDDDDDDDD" />
                                    </label>
                                </div>
                                <div class="horizontal-input-container">
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">Número da Conta*:</span>
                                            <input class="preset-input-text input text-input js-mask" type="text" name="txtContaBancariaNumero" placeholder="Número da Conta" maxlength="15" data-mask="DDDDDDDDDDDDDDD" />
                                        </label>
                                    </div>
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">Dígito Verificador*:</span>
                                            <input class="preset-input-text input text-input" type="text" name="txtContaBancariaDV" placeholder="Dígito" data-mask="D" maxlength="1" />
                                        </label>
                                    </div>
                                </div>
                                <p class="js-botao-transf js-etapa6 preset-botao button-link">Confirmar</p>
                            </section>
                            <section class="js-etapa5 box-cadastro" id="box-conducao">
                                <h1 class="titulo-cadastro">Dados de Condução</h1>               
                                <div class="label-input">
                                    <label class="label"><span class="input-label">CNH*:</span>
                                        <input class="preset-input-text input text-input js-mask" type="text" name="txtCnh" placeholder="Número da CNH" maxlength="11" data-mask="DDDDDDDDDDD" />
                                    </label>
                                </div>
                                    <p class="js-botao-transf js-etapa6 preset-botao button-link">Confirmar</p>
                            </section>
                            <section class="js-etapa6 box-cadastro" id="box-autenticacao">
                                <h1 class="titulo-cadastro">Autenticação</h1>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Email*:</span>
                                        <input class="preset-input-text input text-input" type="email" name="txtEmailAutenticacao" placeholder="Digite seu email de autenticação" maxlength="100" />
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Senha*:</span>
                                        <input class="preset-input-text input text-input" type="password" name="txtSenha" placeholder="Digite sua senha" />
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Confirmar Senha*:</span>
                                        <input class="preset-input-text input text-input" type="password" name="txtConfSenha" placeholder="Confirme sua senha" />
                                    </label>
                                </div>
                                <input class="preset-input-submit button-link botao-cadastrar" type="submit" name="submitFisico" value="Criar Conta"/>
                            </section>
                        </form>
                    </div>
                    <div id="container-cadastro-juridico">
                        <form method="post" action="cadastro.php" enctype="multipart/form-data">
                            <section class="js-etapa1 box-cadastro" id="box-info-pessoais">
                                <h1 class="titulo-cadastro">Informações Pessoais</h1>                                
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Nome*:</span>
                                        <input class="preset-input-text input text-input" type="text" name="txtNome" />
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Sobrenome*:</span>
                                        <input class="preset-input-text input text-input" type="text" name="txtSobrenome" />
                                    </label>
                                </div>                                
                                <div class="horizontal-input-container box-data-nascimento">
                                    <p class="titulo">Data de Nascimento</p>
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">Dia*:</span>
                                            <input class="preset-input-text input text-input" name="txtDiaNascimento" placeholder="Ex: 01" type="text" />
                                        </label>
                                    </div>
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">Mês*:</span>
                                            <select class="preset-input-select input" name="slMesNascimento">
                                                <option selected disabled>Mês</option>
                                                <?php
                                                    $lista_meses = new \Tabela\Mes();
                                                    $lista_meses = $lista_meses->buscar();
                                                    
                                                    foreach( $lista_meses as $mes ) {
                                                ?>
                                                <option value="<?php echo $mes->mes; ?>"><?php echo $mes->titulo; ?></option>
                                                <?php } ?>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">Ano*:</span>
                                            <select class="preset-input-select input" name="slAnoNascimento">
                                                <option selected disabled>Ano</option>
                                                <?php 
                                                    $anoInicial = 1900;
                                                    
                                                    while( $anoInicial <= date("Y") ) {
                                                ?>
                                                <option value="<?php echo $anoInicial; ?>"><?php echo $anoInicial++; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="label-input">
                                    <p class="label">Sexo:</p>
                                    <input class="radio-input" type="radio" name="rdoSexo" value="f" />
                                    <label class="label radio-label">Feminino</label>
                                    <input class="radio-input" type="radio" name="rdoSexo" value="m" />
                                    <label class="label radio-label">Masculino</label>
                                </div>                                
                                <div class="horizontal-input-container box-localizacao">
                                   <div class="label-input">
                                        <label class="label"><span class="input-label">Estado*:</span>
                                            <select class="preset-input-select input" name="slEstado">
                                                <option selected disabled>Selecione uma cidade</option>
                                                <?php 
                                                    $lista_estados = new \Tabela\Estado();
                                                    $lista_estados = $lista_estados->buscar();
                                                
                                                    foreach( $lista_estados as $estado ) { 
                                                ?>
                                                <option value="<?php echo $estado->id; ?>"><?php echo $estado->nome; ?></option>
                                                <?php } ?>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">Cidade*:</span>
                                            <select class="preset-input-select input" name="slCidade">
                                                <option selected disabled>Selecione uma cidade</option>
                                                <?php 
                                                    $lista_cidades = new \Tabela\Cidade();
                                                    $lista_cidades = $lista_cidades->buscar();
                                                
                                                    foreach( $lista_cidades as $cidade ) { 
                                                ?>
                                                <option value="<?php echo $cidade->id; ?>"><?php echo $cidade->nome; ?></option>
                                                <?php } ?>
                                            </select>
                                        </label>
                                    </div>                                    
                                </div>
                                <p class="js-botao-transf js-etapa2 preset-botao button-link">Confirmar</p>
                            </section>
                            <section class="js-etapa2 box-cadastro" id="box-info-contato">
                                <h1 class="titulo-cadastro">Informações de Contato</h1>               
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Telefone*:</span>
                                        <input class="preset-input-text input text-input" type="text" name="txtTelefone" placeholder="Ex: (11) 1234-5678" />
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Celular*:</span>
                                        <input class="preset-input-text input text-input" type="text" name="txtCelular" placeholder="Ex: (11) 1234-5678" />
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Email*:</span>
                                        <input class="preset-input-text input text-input" type="text" name="txtEmail" />
                                    </label>
                                </div>
                                <div class="horizontal-input-container">
                                    <p class="js-botao-transf js-etapa3 preset-botao button-link">Confirmar</p>
                                </div>
                            </section>
                            <section class="js-etapa3 box-cadastro" id="box-info-empresa">
                                <h1 class="titulo-cadastro">Dados da Empresa</h1>  
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Foto Representativa*:</span>
                                        <input class="input-foto" id="input-foto-juridico" type="file" name="fotoJuridico" />
                                    </label>
                                    <div class="botao-foto" id="botao-foto-juridico"></div>
                                </div>                                                     
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Razão Social*:</span>
                                        <input class="preset-input-text input text-input" type="text" name="txtRazaoSocial" />
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Nome Fantasia*:</span>
                                        <input class="preset-input-text input text-input" type="text" name="txtNomeFantasia" />
                                    </label>
                                </div>                                
                                <div class="label-input">
                                    <label class="label"><span class="input-label">CNPJ*:</span>
                                        <input class="preset-input-text input text-input" type="text" name="txtCnpj" />
                                    </label>
                                </div>
                                <p class="js-botao-transf js-etapa4 preset-botao button-link">Confirmar</p>
                            </section>
                            <section class="js-etapa4 box-cadastro" id="box-conta-bancaria">
                                <h1 class="titulo-cadastro">Conta Bancária</h1>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Banco*:</span>
                                        <select class="preset-input-select input" name="slBanco">
                                            <option selected disabled>Selecione o banco</option>
                                            <?php
                                                $lista_bancos = new \Tabela\Banco();
                                                $lista_bancos = $lista_bancos->buscar();
                                                
                                                foreach( $lista_bancos as $banco ) {
                                            ?>
                                            <option value="<?php echo $banco->id; ?>"><?php echo $banco->nome; ?></option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Número da Agência*:</span>
                                        <input class="preset-input-text input text-input" type="text" name="txtContaAgencia" placeholder="Número da Agência" />
                                    </label>
                                </div>
                                <div class="horizontal-input-container">
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">Número da Conta*:</span>
                                            <input class="preset-input-text input text-input" type="text" name="txtContaBancariaNumero" placeholder="Número da Conta" />
                                        </label>
                                    </div>
                                    <div class="label-input">
                                        <label class="label"><span class="input-label">Dígito Verificador*:</span>
                                            <input class="preset-input-text input text-input" type="text" name="txtContaBancariaDV" placeholder="Dígito" />
                                        </label>
                                    </div>
                                </div>
                                <p class="js-botao-transf js-etapa5 preset-botao button-link">Confirmar</p>
                            </section>
                            <section class="js-etapa5 box-cadastro" id="box-autenticacao">
                                <h1 class="titulo-cadastro">Autenticação</h1>               
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Email*:</span>
                                        <input class="preset-input-text input text-input" type="email" name="txtEmailAutenticacao" placeholder="Digite seu email de autenticação" maxlength="100" />
                                    </label>
                                    <label class="label"><span class="input-label">Senha*:</span>
                                        <input class="preset-input-text input text-input" type="password" name="txtSenha" placeholder="Digite sua senha" />
                                    </label>
                                </div>
                                <div class="label-input">
                                    <label class="label"><span class="input-label">Confirmar Senha*:</span>
                                        <input class="preset-input-text input text-input" type="password" name="txtConfSenha" placeholder="Confirme sua senha" />
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