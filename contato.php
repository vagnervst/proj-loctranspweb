<?php
    require_once("include/initialize.php");
    require_once("include/classes/tbl_assunto.php");
    require_once("include/classes/tbl_perguntas_frequentes.php");
    require_once("include/classes/tbl_fale_conosco.php");
    require_once("include/classes/tbl_contato.php");

    $contatoSubmit = ( isset($_POST["contatoSubmit"]) )? $_POST["contatoSubmit"] : null;
    if( isset( $contatoSubmit ) ) {
        $nome = isset( $_POST["txtNome"] )? $_POST["txtNome"] : null;
        $email = isset( $_POST["txtEmail"] )? $_POST["txtEmail"] : null;
        $assunto = isset( $_POST["slAssunto"] )? $_POST["slAssunto"] : null;
        $mensagem = isset( $_POST["txtaMensagem"] )? $_POST["txtaMensagem"] : null;
        
        $lista_required_input = [];
        $lista_required_input[] = $nome;
        $lista_required_input[] = $email;
        $lista_required_input[] = $assunto;
        $lista_required_input[] = $mensagem;
        
        if( !FormValidator::has_empty_input( $lista_required_input ) ) {
            $contato = new \Tabela\Contato();
            
            $contato->nome = $nome;
            $contato->email = $email;
            $contato->mensagem = $mensagem;
            $contato->idAssunto = $assunto;
            $contato->resposta = " ";
            
            $contato->inserir();
        }
        
        
    }    

    $dadosFaleConosco = new \Tabela\FaleConosco();
    $buscaDados = $dadosFaleConosco->buscar("id = 1");
    if( !empty($buscaDados[0]) ) $dadosFaleConosco = $buscaDados[0];
?>
<!DOCTYPE html>
<html>
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
                    <?php
                        $listaPerguntas = new \Tabela\PerguntasFrequentes();
                        $listaPerguntas = $listaPerguntas->buscar();

                        if( count($listaPerguntas) > 0 ) {
                    ?>
                    <section class="box-conteudo-faq">                        
                        <h1 class="titulo-faq"><?php echo $dadosFaleConosco->tituloB; ?></h1>                        
                        <div id="faq-accordion">
                            <?php                                
                                foreach( $listaPerguntas as $pergunta ) {
                            ?>
                            <div class="faq">
                                <p class="faq-desc"><?php echo $pergunta->pergunta; ?></p>
                                <div class="faq-answer"><p><?php echo $pergunta->resposta; ?></p></div>
                            </div>
                            <?php } ?>
                        </div>                                                
                    </section>
                    <?php } ?>
                </div>           
                <div class="box-conteudo">
                    <section class="box-conteudo-contato">
                        <h1 class="titulo-contato"><?php echo $dadosFaleConosco->tituloA; ?></h1>
                        <p class="subtitulo"><?php echo $dadosFaleConosco->descricaoA; ?></p>
                        <div id="info-contato">
                            <p class="label">E-mail:</p>
                            <p class="info"><?php echo $dadosFaleConosco->email; ?></p>
                            <p class="label">Telefone:</p>
                            <p class="info"><?php echo $dadosFaleConosco->telefone; ?></p>                            
                            <p class="label">Atendimento:</p>
                            <p class="info"><?php echo $dadosFaleConosco->horarioAtendimento; ?></p>                            
                            <p class="label">Endereço:</p>
                            <p class="info"><?php echo $dadosFaleConosco->endereco; ?></p>
                        </div>
                        <div id="container-form-contato">
                            <form method="post" action="contato.php">
                                <section class="box-contato">
                                    <div class="label-input-contato">
                                        <label class="label-contato">Nome*:
                                            <input class="text-input preset-input-text" type="text" name="txtNome" placeholder="Digite seu nome"/>        
                                        </label>
                                    </div>
                                    <div class="label-input-contato">
                                        <label class="label-contato">E-mail*:
                                            <input class="text-input preset-input-text" type="text" name="txtEmail" placeholder="Digite seu e-mail"/>
                                        </label>
                                    </div>
                                    <div class="label-input-contato">
                                        <label class="label-contato">Assunto*:
                                            <select class="select-input preset-input-select" name="slAssunto">                     
                                                <option selected disabled>Escolha um assunto</option>       
                                                <?php 
                                                    $buscaAssunto = new \Tabela\Assunto();
                                                    $listaAssunto = $buscaAssunto->buscar();
                                                    
                                                    for($i = 0; $i < count($listaAssunto); ++$i) { 
                                                ?>
                                                <option value="<?php echo $listaAssunto[$i]->id; ?>"><?php echo $listaAssunto[$i]->titulo; ?></option>
                                                <?php } ?>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="label-input-contato">
                                        <label class="label-contato">Mensagem*:
                                            <textarea class="text-area-input preset-input-textarea" rows="5" cols="40" name="txtaMensagem" placeholder="Digite sua mensagem..."></textarea>
                                        </label>
                                    </div>
                                    <input class="button-link preset-input-submit" type="submit" name="contatoSubmit" value="Enviar"/>
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