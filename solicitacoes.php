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
        <link rel="icon" href="img/icones/logoCityShareIcon.png">
    </head>
    <body>
        <div id="container">
            <?php require_once("layout/header.php"); ?>            
            <div class="main" id="pag-solicitacoes">
                <div id="container-modo-visualizacao">
                    <div id="box-botoes">
                        <span class="preset-botao botao" id="btnPedidos">Pedidos</span>
                        <span class="preset-botao botao" id="btnSolicitacoes">Solicitações</span>
                    </div>
                </div>
                <div class="box-conteudo">
                    <div id="box-filtragem">
                        <select class="preset-input-select" id="select-status" name="slStatus">
                            <option selected disabled>Filtrar</option>
                        </select>
                    </div>
                    <div id="box-listagem"></div>
                    <span id="botao-exibir-mais" class="js-load-pedidos"></span>
                </div>
            </div>
            <!-- CONTEUDO PRINCIPAL -->
        </div>
        <?php require_once("layout/footer.php"); ?>
        <script src="js/libs/jquery-3.1.1.min.js"></script>
        <script src="js/classes/Ajax.js"></script>
        <script>
                var box_listagem = $("#box-listagem")[0];
                                
                var dados = new FormData();
                
                var idUsuario = window.location.search;
                idUsuario = idUsuario.substr( idUsuario.indexOf("user=") + 5, idUsuario.length );
                dados.append("idUsuario", idUsuario);                
                
                var imagem_carregamento = document.createElement("img");
                imagem_carregamento.src = "img/loading_cityshare_black.gif";
                imagem_carregamento.style.display = "block";
                imagem_carregamento.style.margin = "0 auto";
                box_listagem.appendChild( imagem_carregamento );
                
                var ajax = new Ajax();            
                ajax.transferir_dados_para_api("apis/listagem_pedidos.php", "POST", dados, function(resultado) {
                    box_listagem.innerHTML = resultado;
                                        
                    var botao_carregar_mais_pedidos = $("#botao-exibir-mais")[0];
                    
                    if( resultado.length === 0 ) {
                        botao_carregar_mais_pedidos.style.display = "none";
                    } else {
                        botao_carregar_mais_pedidos.style.display = "block";
                    }
                });
        </script>
        <script src="js/script.js"></script>
    </body>
</html>