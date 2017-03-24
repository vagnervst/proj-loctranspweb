<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Contato | City Share</title>
        <meta name="viewport" content="width=device-width"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/icones/logoCityShareIcon.png">
    </head>
    <body>
        <div id="container">
            <?php require_once("layout/header.php"); ?>
            <div class="main" id="pag-contato">
                <div class="box-conteudo">
                    <section class="box-conteudo-faq">
                        <h1 class="titulo-faq">Perguntas Frequentes</h1>
                        <div id="faq-accordion">
                            <div class="faq">
                                <p class="faq-desc">Aonde devo ir para pegar o veículo?</p>
                                <div class="faq-answer">A retirada do carro deve ser combinada com o proprietário, fica a critério de ambos escolherem um local favorável para retirada do veículo.</div>
                            </div>
                            <div class="faq">
                                <p class="faq-desc">Como é feito o pagamento?</p>
                                <div class="faq-answer">O pagamento deve ser feito em conjunto com a retirada do veículo no local combinado para evitar inconveniências à ambos os negociantes.</div>
                            </div>
                            <div class="faq">
                                <p class="faq-desc">Quem é responsável pelo combustível durante a locação?</p>
                                <div class="faq-answer">É imprescindível que o usuário que alugou o veículo o devolva com o tanque cheio assim como foi entregue, caso esse critério não seja cumprido, o valor complementar do combustível será cobrado como taxa no momento da devolução.</div>
                            </div>
                            <div class="faq">
                                <p class="faq-desc">Eu preciso avaliar o proprietário do carro após o aluguel?</p>
                                <div class="faq-answer">Após devolver o carro, ambos os usuários (Proprietário e Condutor) poderão avaliar a experiência que tiveram com a transação. Essa avaliação será disponibilizada no perfil do usuário e servirá como base para as transações futuras do usuário no site da City Share. </div>
                            </div>
                            <div class="faq">
                                <p class="faq-desc">Um familiar/amigo também pode dirigir o carro durante a locação?</p>
                                <div class="faq-answer">Sim, você pode cadastrar outras CNH caso não esteja apto a dirigir, mas tenha em mente que as CNH extras cadastradas devem estar válidas e sem qualquer restrição de uso.</div>
                            </div>
                            <div class="faq">
                                <p class="faq-desc">O que acontece se eu atrasar para devolver o carro?</p>
                                <div class="faq-answer">Existe uma pequena taxa de atraso acumulativa a qual deve ser paga caso o veículo não seja entregue no dia e local combinados. Porém damos ao usuário uma tolerância de no máximo 30 minutos depois do prazo, após isso a taxa será aplicada.</div>
                            </div>
                            <div class="faq">
                                <p class="faq-desc">Eu serei cobrado caso a minha solicitação de reserva não seja aceita pelo proprietário?</p>
                                <div class="faq-answer">Não. Já que o pagamento da diária ocorre no momento da retirada, você não será cobrado previamente pelo veículo alugado.</div>
                            </div>
                            <div class="faq">
                                <p class="faq-desc">Como entro em contato com o proprietário do veículo?</p>
                                <div class="faq-answer">Após enviar uma solicitação de aluguel para o proprietário, o mesmo deverá confirmá-la caso queira realmente alugar o veículo. Quando confirmada, ambos, proprietário e usuário receberão os dados para entrar em contato um com o outro.</div>
                            </div>
                        </div>                        
                    </section>
                </div>           
                <div class="box-conteudo">
                    <section class="box-conteudo-contato">
                        <h1 class="titulo-contato">Fale Conosco</h1>
                        <p class="subtitulo">Não sanou sua dúvida? Contate-nos!</p>
                        <div id="info-contato">
                            <p class="label">E-mail:</p>
                            <p class="info">Contato@cityshare.com.br</p>
                            <p class="label">Telefone:</p>
                            <p class="info">(11)3061-5678</p>                            
                            <p class="label">Atendimento:</p>
                            <p class="info">Das 09h às 18h</p>                            
                            <p class="label">Endereço:</p>
                            <p class="info">Rua Gustavo da Silveira, 23 - Vila Santa Catarina<br>
                            CEP 04376-002 - São Paulo/SP</p>
                        </div>
                        <div id="container-form-contato">
                            <form name="form-contato" action="#">
                            <section class="box-contato">
                                <div class="label-input-contato">
                                    <label class="label-contato">Nome*:
                                        <input class="text-input preset-input-text" type="text" placeholder="Digite seu nome"/>        
                                    </label>
                                </div>
                                <div class="label-input-contato">
                                    <label class="label-contato">E-mail*:
                                        <input class="text-input preset-input-text" type="text" placeholder="Digite seu e-mail"/>
                                    </label>
                                </div>
                                <div class="label-input-contato">
                                    <label class="label-contato">Assunto*:
                                        <select class="select-input preset-input-select">
                                            <option selected disabled>Escolha um assunto</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="label-input-contato">
                                    <label class="label-contato">Mensagem*:
                                        <textarea class="text-area-input preset-input-textarea" rows="5" cols="40" placeholder="Digite sua mensagem..."></textarea>
                                    </label>
                                </div>
                                <input class="button-link preset-input-submit" type="submit" value="Enviar"/>
                            </section>
                        </form>
                        </div>
                    </section>
                </div>
            </div>            
        </div>
        <?php require_once("layout/footer.php"); ?>
        <script src="js/libs/jquery-3.1.1.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>