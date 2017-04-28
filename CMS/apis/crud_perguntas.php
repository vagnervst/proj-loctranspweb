<?php
    require_once("../../include/initialize.php");
    require_once("../../include/classes/tbl_perguntas_frequentes.php");

    $pergunta = ( isset( $_POST["txtPergunta"] ) )? $_POST["txtPergunta"] : null;
    $resposta = ( isset( $_POST["txtResposta"] ) )? $_POST["txtResposta"] : null;
    $modo = ( isset( $_GET["modo"] ) )? $_GET["modo"] : null;

    if( !empty($pergunta) && !empty($resposta) && $modo == "insert" ) {
        $objPergunta = new \Tabela\PerguntasFrequentes();
        $objPergunta->pergunta = $pergunta;
        $objPergunta->resposta = $resposta;
        
        $objPergunta->inserir();
    } elseif( !empty($pergunta) && !empty($resposta) && $modo == "update" ) {
        $objPergunta = new \Tabela\PerguntasFrequentes();
        $id = ( isset( $_POST["id"] ) )? $_POST["id"] : null;                
        
        $objPergunta->id = $id;
        $objPergunta->pergunta = $pergunta;
        $objPergunta->resposta = $resposta;
        
        $objPergunta->atualizar();
    } elseif( $modo == "delete" ) {
        $objPergunta = new \Tabela\PerguntasFrequentes();
        $id = ( isset( $_POST["id"] ) )? $_POST["id"] : null;
        
        $objPergunta->id = $id;
        $objPergunta->deletar();
    }

?>

<?php 
    $buscaPerguntas = new \Tabela\PerguntasFrequentes();
    $listaPerguntas = $buscaPerguntas->buscar();

    foreach( $listaPerguntas as $pergunta ) { 
?>
<div class="pergunta" data-id="<?php echo $pergunta->id; ?>">
    <form class="form-pergunta" method="post">
        <div class="box-inputs">
            <div class="box-label-input">
                <label class="titulo-input"><span class="label">Pergunta</span>
                    <input type="text" class="input-pagina input" name="txtPergunta" value="<?php echo $pergunta->pergunta; ?> ">
                </label>
            </div>
            <div class="box-label-input">
                <label class="titulo-input"><span class="label">Resposta</span>
                    <input type="text" class="input-pagina input" name="txtResposta" value="<?php echo $pergunta->resposta; ?> ">
                </label>
            </div>
        </div>
        <div class="box-acoes">
            <span class="preset-botao botao-remover">Remover</span>
            <input class="preset-botao botao-submit" type="submit" value="Salvar"/>
        </div>
    </form>
</div>
<?php } ?>