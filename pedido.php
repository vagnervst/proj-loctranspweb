<?php 
    require_once("include/initialize.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Home | City Share</title>
        <meta name="viewport" content="width=device-width" />
        <meta charset="utf-8" />        
        <link rel="stylesheet" href="css/style.css">        
    </head>
    <body>
        <div id="container">
            <?php require_once("layout/header.php"); ?>            
            <div class="main" id="pag-pedido">
                <div id="box-botoes-exibicao">
                    <span id="botao-detalhes" class="preset-botao botao">Detalhes</span>
                    <span id="botao-acoes" class="preset-botao botao">Ações</span>
                    <span id="botao-historico" class="preset-botao botao">Histórico</span>
                </div>
                <div id="box-info">
                    <div id="container-modals">
                        <div class="box-modal-pedido modal js-modal9" id="modal-pagamento-confirmado">
                            <div class="icone"></div>
                            <span class="botao-fechar"></span>
                            <div class="box-info">
                                <h1 class="titulo">Pagamento de Pendência Confirmado!</h1>
                                <p class="conteudo">R$XX,XX foram depositados na conta de ~nome do locador~</p>
                                <div class="box-avaliacao">
                                    <p class="label">Avalie o Locador</p>
                                    <div class="box-botoes-avaliacao">
                                        <span class="botao-avaliacao"></span>
                                        <span class="botao-avaliacao"></span>
                                        <span class="botao-avaliacao"></span>
                                        <span class="botao-avaliacao"></span>
                                        <span class="botao-avaliacao"></span>
                                    </div>
                                </div>
                                <div class="box-acoes">                                    
                                    <span class="preset-botao botao btn-avancar">Confirmar</span>
                                </div>
                            </div>
                        </div>
                        <div class="box-modal-pedido modal js-modal7" id="modal-pagamento-dinheiro">
                            <div class="icone"></div>
                            <span class="botao-fechar"></span>
                            <div class="box-info">
                                <h1 class="titulo">Pagamento em Dinheiro</h1>
                                <p class="conteudo">R$XX,XX devem ser pagos à ~nome do locador~</p>                                                                
                                <div class="box-acoes">
                                    <span class="preset-botao botao btn-avancar">Cancelar</span>
                                    <span class="preset-botao botao btn-avancar js-modal9">Confirmar</span>
                                </div>
                            </div>
                        </div>
                        <div class="box-modal-pedido modal js-modal8" id="modal-pagamento-cartao">
                            <div class="icone"></div>
                            <span class="botao-fechar"></span>
                            <div class="box-info">
                                <h1 class="titulo">Pagamento em Cartão de Crédito</h1>
                                <p class="conteudo">Código de Segurança do Cartão:</p>
                                <input class="preset-input-text js-mask" type="text" placeholder="Digite o CSC de 3 ou 4 dígitos" data-mask="DDDD"/>
                                <p class="conteudo">A diferença de R$XX,XX será paga à ~nome do locador~</p>
                                <div class="box-acoes">
                                    <span class="preset-botao botao btn-avancar">Cancelar</span>
                                    <span class="preset-botao botao btn-avancar js-modal9">Confirmar</span>
                                </div>
                            </div>
                        </div>
                        <div class="box-modal-pedido modal js-modal6" id="modal-pagamento-pendencias">
                            <div class="icone"></div>
                            <span class="botao-fechar"></span>
                            <div class="box-info">
                                <h1 class="titulo">Pagamento de Pendências</h1>
                                <div class="box-label-info">
                                    <p class="label">Atraso:</p>
                                    <p class="info">X dias = R$XX,XX</p>
                                </div>
                                <div class="box-label-info">
                                    <p class="label">Combustível restante para preenchimento:</p>
                                    <p class="info">X litros = R$XX,XX</p>
                                </div>
                                <div class="box-label-info">
                                    <p class="label">Distância Excedida:</p>
                                    <p class="info">X quilômetros = R$XX,XX</p>
                                </div>
                                <div class="box-label-info">
                                    <p class="label">Total:</p>
                                    <p class="info">R$XX,XX</p>
                                </div>
                                <div class="box-acoes">
                                    <h1 class="titulo">Forma de Pagamento</h1>
                                    <span class="preset-botao botao btn-avancar js-modal7">Dinheiro</span>
                                    <span class="preset-botao botao btn-avancar js-modal8">Cartão de Crédito</span>
                                </div>
                            </div>
                        </div>
                        <div class="box-modal-pedido modal js-modal3" id="modal-confirmacao-pendencias">
                            <div class="icone"></div>
                            <span class="botao-fechar"></span>
                            <div class="box-info">
                                <h1 class="titulo">Confirmar Pendências</h1>
                                <div class="box-label-info">
                                    <p class="label">Atraso:</p>
                                    <p class="info">X dias = R$XX,XX</p>
                                </div>
                                <div class="box-label-info">
                                    <p class="label">Combustível restante para preenchimento:</p>
                                    <p class="info">X litros = R$XX,XX</p>
                                </div>
                                <div class="box-label-info">
                                    <p class="label">Distância Excedida:</p>
                                    <p class="info">X quilômetros = R$XX,XX</p>
                                </div>
                                <div class="box-acoes">
                                    <span class="preset-botao botao btn-avancar">Discordo</span>
                                    <span class="preset-botao botao btn-avancar js-modal6">Concordo</span>
                                </div>
                            </div>
                        </div>
                        <div class="box-modal-pedido modal" id="modal-solicitacao-devolucao-enviada">
                            <div class="icone"></div>
                            <span class="botao-fechar"></span>
                            <div class="box-info">
                                <h1 class="titulo">Solicitação de Devolução Enviada!</h1>
                                <p class="conteudo">Após confirmação de devolução, o locador definirá as pendências a serem pagas mediante sua confirmação</p>
                                <div class="box-acoes">
                                    <span class="preset-botao botao btn-avancar">Confirmar</span>
                                </div>
                            </div>
                        </div>
                        <div class="box-modal-pedido modal" id="modal-solicitacao-devolucao">
                            <div class="icone"></div>
                            <span class="botao-fechar"></span>
                            <div class="box-info">
                                <h1 class="titulo">Solicitar Devolução</h1>
                                <div class="box-label-info">
                                    <p class="label">Data de Entrega Marcada:</p>
                                    <p class="info">XX/XX/XX XX:XX</p>
                                </div>
                                <div class="box-label-info">
                                    <p class="label">Data de Entrega:</p>
                                    <p class="info">XX/XX/XX XX:XX</p>
                                </div>
                                <div class="box-label-info">
                                    <p class="label">Dias atrasados:</p>
                                    <p class="info">XX</p>
                                </div>
                                <div class="box-acoes">
                                    <span class="preset-botao botao btn-avancar">Confirmar</span>
                                </div>
                            </div>
                        </div>
                        <div class="box-modal-pedido modal js-modal5" id="modal-solicitacao-retirada-enviada">
                            <div class="icone"></div>
                            <span class="botao-fechar"></span>
                            <div class="box-info">
                                <h1 class="titulo">Solicitação de Retirada Enviada!</h1>
                                <p class="conteudo">Após confirmação de retirada pelo locador, R$XX,XX serão depositados na conta de ~nome do locador~</p>
                                <div class="box-acoes">
                                    <span class="preset-botao botao btn-avancar">Confirmar</span>
                                </div>
                            </div>
                        </div>
                        <div class="box-modal-pedido modal js-modal2" id="modal-solicitacao-retirada">
                            <div class="icone"></div>
                            <span class="botao-fechar"></span>
                            <div class="box-info">
                                <h1 class="titulo">Solicitação de Retirada</h1>
                                <p class="conteudo">Digite o código de segurança do cartão cadastrado em sua conta</p>
                                <input class="preset-input-text js-mask" type="text" name="txtCodigoSeguranca" placeholder="Digite o código de 3 ou 4 digitos" data-mask="DDDD" />
                                <p class="conteudo">Após confirmação de retirada, o sistema depositará o valor total na conta de ~nome do locador~</p>
                                <div class="box-acoes">
                                    <span class="preset-botao botao btn-avancar js-modal5">Confirmar</span>
                                </div>
                            </div>
                        </div>
                        <div class="box-modal-pedido modal js-modal1" id="modal-confirmacao-local">
                            <div class="icone"></div>
                            <span class="botao-fechar"></span>
                            <div class="box-info">
                                <h1 class="titulo">Confirmar Local de Retirada</h1>
                                <h2 class="subtitulo">Atenção!</h2>
                                <p class="conteudo">Ao prosseguir, você confirma que o local de retirada foi negociado com o locador após ter contactado o mesmo. A confirmação deve ser feita pelas duas partes, só assim, a retirada do veículo poderá ser feita.</p>
                                <p class="conteudo">Se você, até o momento, não entrou em contato com o locador, NÃO prossiga com a confirmação de definição de local de retirada do veículo.</p>
                                <div class="box-acoes">
                                    <span class="preset-botao botao btn-avancar">Confirmar</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="container-info-pedido">
                        <div id="box-veiculo-locador">
                            <img id="foto-veiculo" />
                            <div id="info-locador">
                                <p id="modelo-veiculo">Modelo do Veículo</p>
                                <p id="nome-locador">Nome do Locador</p>
                                <div class="box-avaliacoes">                                    
                                    <div class="container-icone-avaliacoes">
                                        <div class="icone-avaliacao"></div>
                                        <div class="icone-avaliacao"></div>
                                        <div class="icone-avaliacao"></div>
                                        <div class="icone-avaliacao"></div>
                                        <div class="icone-avaliacao"></div>
                                    </div>
                                </div>
                                <div class="box-contato-locador" id="contato-desktop">
                                    <div class="box-contato">
                                       <p class="info-contato">11 9999-9999</p>                                    
                                        <div class="icone-contato telefone"></div>
                                    </div>
                                    <div class="box-contato">
                                       <p class="info-contato">11 9 9999-9999</p>                                    
                                        <div class="icone-contato celular"></div>
                                    </div>
                                    <div class="box-contato">                                    
                                        <p class="info-contato">xxxx@xxxx.com</p>
                                        <div class="icone-contato email"></div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="info-box" id="info-valores">
                            <h1 class="titulo-box">Valores</h1>
                            <div class="box-label-info">
                                <p class="label">Valor da diária:</p>
                                <p class="info">R$9,99</p>
                            </div>
                            <div class="box-label-info">
                                <p class="label">Valor do Combustível (R$/L):</p>
                                <p class="info">R$9,99</p>
                            </div>
                            <div class="box-label-info">
                                <p class="label">Valor por distância excedida:</p>
                                <p class="info">R$9,99</p>
                            </div>
                        </div>
                        <div class="info-box" id="box-info-diarias">
                            <div class="box-label-info">
                                <p class="label">Data de retirada:</p>
                                <p class="info">XX/XX/XX XX:XX</p>
                            </div>
                            <div class="box-label-info">
                                <p class="label">Data de entrega:</p>
                                <p class="info">XX/XX/XX XX:XX</p>
                            </div>
                            <div class="box-label-info">
                                <p class="label">Valor total de diárias:</p>
                                <p class="info">R$9,99</p>
                            </div>
                            <div class="box-contato-locador" id="contato-mobile">
                                <div class="box-contato">
                                   <p class="info-contato">11 9999-9999</p>                                    
                                    <div class="icone-contato telefone"></div>
                                </div>
                                <div class="box-contato">
                                   <p class="info-contato">11 9 9999-9999</p>                                    
                                    <div class="icone-contato celular"></div>
                                </div>
                                <div class="box-contato">                                    
                                    <p class="info-contato">xxxx@xxxx.com</p>
                                    <div class="icone-contato email"></div>
                                </div>
                            </div>
                        </div>
                        <div class="info-box" id="box-info-pendencias">
                            <p class="titulo-box">Pendências</p>
                            <div class="box-label-info">
                                <p class="label">Combustível:</p>
                                <p class="info">R$9,99</p>
                            </div>
                            <div class="box-label-info">
                                <p class="label">Quilometragem Excedida:</p>
                                <p class="info">R$9,99</p>
                            </div>
                            <div class="box-label-info">
                                <p class="label">Atraso de entrega:</p>
                                <p class="info">R$9,99</p>
                            </div>
                        </div>
                        <div class="info-box" id="box-info-cnh">                            
                            <div class="box-label-info">
                                <p class="label">CNH:</p>
                                <p class="info">XXXX</p>
                            </div>
                        </div>
                        <div class="info-box" id="box-info-status">                            
                            <div class="box-label-info">
                                <p class="label">Status:</p>
                                <p class="info">XXXX</p>
                            </div>
                        </div>
                    </div>
                    <div id="container-acoes-pedido">
                        <span class="preset-botao botao js-modal1" id="botao-local-retirada">Confirmar Local de Retirada</span>
                        <span class="preset-botao botao js-modal2" id="botao-solicitar-retirada">Solicitar Retirada</span>
                        <span class="preset-botao botao js-modal3" id="botao-visualizar-pendencias">Visualizar Pendências</span>
                        <span class="preset-botao botao js-modal4" id="botao-cancelar-locacao">Cancelar Locação</span>
                    </div>
                    <div id="container-historico-pedido">
                        <div class="box-status">
                            <p class="info">XX/XX/XX XX:XX - Status</p>
                        </div>
                        <div class="box-status">
                            <p class="info">XX/XX/XX XX:XX - Status</p>
                        </div>
                        <div class="box-status">
                            <p class="info">XX/XX/XX XX:XX - Status</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CONTEUDO PRINCIPAL -->
        </div>
        <?php require_once("layout/footer.php"); ?>
        <script src="js/libs/jquery-3.1.1.min.js"></script>
        <script src="js/classes/JSMask.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>