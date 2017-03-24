<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Home | City Share</title>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/icones/logoCityShareIcon.png">
    </head>
    <body>
        <div id="container">
            <?php require_once("layout/header.php"); ?>
            <div class="main" id="pag-home">
                <div class="imagem-divisao-conteudo imagem-principal"></div>
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao conteudo-horizontal-ltr">
                        <h1 class="titulo-apresentacao">O que é?</h1>
                        <img class="imagem-apresentacao" src="img/image_teste.jpg" />
                        <p class="texto-apresentacao">
                            O City Share é um projeto da empresa de mesmo nome que consiste em um sistema de empréstimo de veículos implantado em municípios onde o usuário (físico ou jurídico) poderá disponibilizar sua bicicleta, moto ou carro o qual não utiliza ou tenha sobrando para aluguel.<br>
                            O sistema é voltado tanto para usuários que desejam alugar quanto disponibilizar para aluguel. Nele você poderá encontrar o carro perfeito para passeios ou até mesmo o carro dos seus sonhos, basta fazer uma pequena pesquisa!<br>
                            Tem algum carro parado ou obsoleto? Cadastre ele e fature um dinheiro extra com o aluguel!<br>
                            Bicicletas também são bem-vindas! Se você não usa sua bicicleta, coloque-a em nosso site, com certeza alguém fará bom uso dela, e você ainda ganha com isso!<br>
                            <br>
                            Cadastre-se agora e comece a usar o nosso sistema!
                        </p>
                    </section>
                </div>
                <div class="imagem-divisao-conteudo"></div>
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao">
                        <h1 class="titulo-apresentacao">Como funciona?</h1>
                        <img class="imagem-apresentacao" src="img/image_teste.jpg" />
                    </section>
                </div>
                <div class="imagem-divisao-conteudo"></div>                
                <section id="container-locadores-destaque">
                    <div id="horizontal-wrapper">
                        <?php for($i = 0; $i < 10; ++$i) { ?>
                        <section class="box-locador-destaque">
                            <a href="#"><img class="foto-locador" src="img/link_face.jpg"/></a>
                            <h1 class="nome-locador">Nome locador</h1>
                            <p class="localizacao-locador">Estado: SP</p>                        
                            <div class="box-avaliacoes">
                                <p class="avaliacoes-locador">Avaliações: 41</p>                            
                                <div class="container-icone-avaliacoes">
                                    <div class="icone-avaliacao"></div>
                                    <div class="icone-avaliacao"></div>
                                    <div class="icone-avaliacao"></div>
                                    <div class="icone-avaliacao"></div>
                                    <div class="icone-avaliacao"></div>
                                </div>
                            </div>
                        </section>
                        <?php } ?>
                    </div>
                </section>                
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao conteudo-horizontal-rtl">
                        <h1 class="titulo-apresentacao">Benefícios do Projeto</h1>
                        <img class="imagem-apresentacao" src="img/image_teste.jpg" />
                        <p class="texto-apresentacao">
                            O projeto City Share traz também benefícios para quem o utiliza, sendo alguns deles:<br>
                            <br>
                            - Remuneração pelo veículo alugado;<br>
                            <br>
                            - O Sistema dinâmico permite que o veículo seja alugado em questão de minutos;<br>
                            <br>
                            - Pague somente pelo uso e não pela propriedade do carro.<br>
                            <br>
                            <br>
                            Veja mais alguns dos benefícios aqui.
                        </p>
                    </section>
                </div>
                <div class="imagem-divisao-conteudo"></div>
                <div class="box-conteudo">
                    <section class="box-conteudo-apresentacao">
                        <h1 class="titulo-apresentacao">Sobre a Empresa</h1>
                        <p class="texto-apresentacao">
                            A empresa “City Share” é uma empresa de iniciativa privada que atua em parceria com prefeituras em todo o território nacional com o objetivo de auxiliar as prefeituras em projetos de mobilidade e urbanismo. Dentre os projetos que a empresa atuou podemos citar três, que são eles: Bicicletários,  Miniparques em vagas de rua e Espaços de convivência, gastronomia e arte. 
                        </p>
                    </section>
                </div>
            </div>
            <!-- CONTEUDO PRINCIPAL -->
        </div>
        <?php require_once("layout/footer.php"); ?>
        <script src="js/libs/jquery-3.1.1.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>