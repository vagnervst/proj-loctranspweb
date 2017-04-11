$(document).ready(function() {
             
    function inicializar_lista_veiculos() {
        var pagina_veiculos = $("#pag-adm-veiculos")[0];        
        
        if( pagina_veiculos !== undefined ) {            
            
            var formulario_veiculos = new AjaxForm();            

            formulario_veiculos.colunas_tabela_propriedades_json = [
                {nome: "Cod", propriedadeJson: "codigo"},
                {nome: "Nome", propriedadeJson: "nome"},
                {nome: "Tipo", propriedadeJson: "tipo"},
                {nome: "Categoria", propriedadeJson: "categoria"},
                {nome: "Fabricante", propriedadeJson: "fabricante"},
                {nome: "Ano", propriedadeJson: "ano"},
                {nome: "Preço", propriedadeJson: "precoMedio"},
            ];                                               

            var box_listagem_veiculos = $(pagina_veiculos).find("#box-listagem-veiculos")[0];

            formulario_veiculos.urlApi = "apis/crud_veiculos.php";                
            formulario_veiculos.containerTabela = box_listagem_veiculos;
            formulario_veiculos.formulario = $("#form-info-veiculo")[0];
            formulario_veiculos.formularioPesquisa = $("#box-filtragem-veiculos form")[0];

            formulario_veiculos.relacao_campo_propriedade = [                
                { nomeCampo : 'txtCod', propriedade : 'codigo' },
                { nomeCampo : 'txtNome', propriedade : 'nome' },
                { nomeCampo : 'txtPortas', propriedade : 'qtdPortas' },
                { nomeCampo : 'txtMotor', propriedade : 'tipoMotor' },
                { nomeCampo : 'txtAno', propriedade : 'ano' },
                { nomeCampo : 'slTransmissao', propriedade : 'idTransmissao' },
                { nomeCampo : 'txtPrecoMedio', propriedade : 'precoMedio' },
                { nomeCampo : 'slFabricante', propriedade : 'idFabricante' },
                { nomeCampo : 'slCombustivel', propriedade : 'idTipoCombustivel' },
                { nomeCampo : 'slTipo', propriedade : 'idTipoVeiculo' },
                { nomeCampo : 'slCategoria', propriedade : 'idCategoriaVeiculo' },
            ];

            formulario_veiculos.relacao_campo_propriedade_pesquisa = [
                { nomeCampo : 'txtCod', propriedade: 'codigo' },
                { nomeCampo : 'txtPrecoMinimo', propriedade: 'precoMedio' },
                { nomeCampo : 'slTipo', propriedade: 'idTipoVeiculo' },
                { nomeCampo : 'slFabricante', propriedade: 'idFabricante' },
                { nomeCampo : 'txtNome', propriedade: 'nome' },
                { nomeCampo : 'slCategoria', propriedade: 'idCategoriaVeiculo' },
                { nomeCampo : 'slCombustivel', propriedade: 'idTipoCombustivel' }
            ];

            formulario_veiculos.inicializar();
        }
    }
    
    //------------------------------------------------------- FUNCAO ADM VEICULOS        
    
    function inicializar_lista_tipos() {
        var pagina_tipo = $("#pag-tipo-veiculo")[0];
        
        if( pagina_tipo !== undefined ) {                                                    
            
            var formulario_tipos_veiculo = new AjaxForm();            

            formulario_tipos_veiculo.colunas_tabela_propriedades_json = [
                {nome: "Titulo", propriedadeJson: "titulo"}                
            ];                                               

            var box_listagem_tipos = $(pagina_tipo).find(".box-listagem-tipo")[0];            
            
            formulario_tipos_veiculo.urlApi = "apis/crud_tipo_veiculo.php";                
            formulario_tipos_veiculo.containerTabela = box_listagem_tipos;
            formulario_tipos_veiculo.formulario = $("#form-modificacao")[0];            

            formulario_tipos_veiculo.relacao_campo_propriedade = [
                { nomeCampo : 'txtTipoVeiculo', propriedade : 'titulo' },
                { nomeCampo : 'chkTipoCombustivel[]', propriedade : 'listaTipoCombustivel' },
                { nomeCampo : 'chkTransmissao[]', propriedade : 'listaTransmissao' }
            ];            

            formulario_tipos_veiculo.inicializar();                                              
        }
    }
    
    //------------------------------------------------------- FUNCAO ADM TIPOS DE VEICULO
    
    function inicializar_lista_categorias() {
        var pagina_categoria = $("#pag-categorias-veiculos")[0];
        
        if( pagina_categoria !== undefined ) {                                                                
            var formulario_categorias_veiculo = new AjaxForm();            

            formulario_categorias_veiculo.colunas_tabela_propriedades_json = [
                {nome: "Titulo", propriedadeJson: "nome"},
                {nome: "Lucro (%)", propriedadeJson: "percentualLucro"},
                {nome: "Valor Mínimo do Veículo", propriedadeJson: "valorMinimoVeiculo"},
                {nome: "Tipo de Veículo", propriedadeJson: "tituloTipo"},
            ];                                               

            var box_listagem_categorias = $(pagina_categoria).find("#box-listagem-categorias")[0];            
            
            formulario_categorias_veiculo.urlApi = "apis/crud_categoria_veiculo.php";                
            formulario_categorias_veiculo.containerTabela = box_listagem_categorias;
            formulario_categorias_veiculo.formulario = $("#form-modificacao")[0];            

            formulario_categorias_veiculo.relacao_campo_propriedade = [
                { nomeCampo : 'txtNomeCategoria', propriedade : 'nome' },
                { nomeCampo : 'txtPercentualLucro', propriedade : 'percentualLucro' },
                { nomeCampo : 'txtvalorMinimoVeiculo', propriedade : 'valorMinimoVeiculo' },
                { nomeCampo : 'sltipoVeiculo', propriedade : 'idTipoVeiculo' },
            ];            

            formulario_categorias_veiculo.inicializar();                                              
        }
    }
    
    //------------------------------------------------------- FUNCAO ADM CATEGORIAS DE VEICULO
    function inicializar_lista_fabricantes() {
        var pagina_fabricante = $("#pag-fabricante-veiculo")[0];
        
        if( pagina_fabricante !== undefined ) {                                                                
            var formulario_fabricante_veiculo = new AjaxForm();            

            formulario_fabricante_veiculo.colunas_tabela_propriedades_json = [
                {nome: "Titulo", propriedadeJson: "nome"}
            ];                                               

            var box_listagem_fabricantes = $(pagina_fabricante).find("#box-listagem-fabricantes")[0];            
            
            formulario_fabricante_veiculo.urlApi = "apis/crud_fabricante_veiculo.php";                
            formulario_fabricante_veiculo.containerTabela = box_listagem_fabricantes;
            formulario_fabricante_veiculo.formulario = $("#form-modificacao")[0];            

            formulario_fabricante_veiculo.relacao_campo_propriedade = [
                { nomeCampo : 'txt_titulo', propriedade : 'nome' },
                { nomeCampo : 'chkTipoVeiculo[]', propriedade : 'listaTiposVeiculo' }
            ];            

            formulario_fabricante_veiculo.inicializar();                                              
        }
    }
    
    //------------------------------------------------------- FUNCAO ADM fabricantes DE VEICULO
    
    function inicializar_lista_acessorios() {
        var pagina_acessorio = $("#pag-acessorio-veiculo")[0];
        
        if( pagina_acessorio !== undefined ) {                                                                
            var formulario_acessorios_veiculo = new AjaxForm();            

            formulario_acessorios_veiculo.colunas_tabela_propriedades_json = [
                {nome: "Cod", propriedadeJson: "id"},
                {nome: "Titulo", propriedadeJson: "nome"}
            ];                                               

            var box_listagem_acessorios = $(pagina_acessorio).find("#box-listagem-acessorios")[0];            
            
            formulario_acessorios_veiculo.urlApi = "apis/crud_acessorio_veiculo.php";                
            formulario_acessorios_veiculo.containerTabela = box_listagem_acessorios;
            formulario_acessorios_veiculo.formulario = $("#form-modificacao-acessorio")[0];            

            formulario_acessorios_veiculo.relacao_campo_propriedade = [
                { nomeCampo : 'txtTitulo', propriedade : 'nome' },
                { nomeCampo : 'chkTipoVeiculo[]', propriedade : 'listaTiposVeiculo' }
            ];            

            formulario_acessorios_veiculo.inicializar();
        }
    }
    
    //------------------------------------------------------- FUNCAO ADM ACESSORIOS DE VEICULO
    
    function inicializar_lista_licenca_desktop() {
        var pagina_licenca = $("#pag-licenca-desktop")[0];
        
        if( pagina_licenca !== undefined ) {
            
            var formulario_licenca_desktop = new AjaxForm();
            
            formulario_licenca_desktop.colunas_tabela_propriedades_json = [
                {nome: "Cod", propriedadeJson: "id"},
                {nome: "Titulo", propriedadeJson: "nome"},
                {nome: "Conexões Simultâneas", propriedadeJson: "conexoesSimultaneas"},
                {nome: "Preço", propriedadeJson: "preco"},
                {nome: "Duração de Meses", propriedadeJson: "duracaoMeses"}
            ];
            
            var box_listagem_licencas = $(pagina_licenca).find("#box-listagem-licencas")[0];
            
            formulario_licenca_desktop.urlApi = "apis/crud_licenca_desktop.php";
            formulario_licenca_desktop.containerTabela = box_listagem_licencas;
            formulario_licenca_desktop.formulario = $("#form-modificacao")[0];
            
            formulario_licenca_desktop.relacao_campo_propriedade = [
                { nomeCampo : 'txtNomeLicenca', propriedade : 'nome' },
                { nomeCampo : 'txtConexoesLicenca', propriedade : 'conexoesSimultaneas' },
                { nomeCampo : 'txtPrecoLicenca', propriedade : 'preco' },
                { nomeCampo : 'txtDuracaoLicenca', propriedade : 'duracaoMeses' }
            ];
            
            formulario_licenca_desktop.inicializar();
        } 
    }
    //------------------------------------------------------- FUNCAO ADM LICENCA DESKTOP       
    
    function inicializar_lista_plano_conta() {
        var pagina_plano_conta = $("#pag-plano-conta")[0];
        
        if( pagina_plano_conta !== undefined ) {
            var formulario_plano_conta = new AjaxForm();
            
            formulario_plano_conta.colunas_tabela_propriedades_json = [
                {nome: "Cod", propriedadeJson: "id"},
                {nome: "Nome", propriedadeJson: "nome"},
                {nome: "Preco", propriedadeJson: "preco"},
                {nome: "Duração Meses", propriedadeJson: "duracaoMeses"},
                {nome: "Limite Publicação", propriedadeJson: "limitePublicacao"},
                {nome: "Descrição plano", propriedadeJson: "descPlano"},
                {nome: "Dias Analise de  Publicacao", propriedadeJson: "diasAnalisePublicacao"}


            ];
            
            var box_listagem_planos = $(pagina_plano_conta).find("#box-listagem-planos")[0];
            
            formulario_plano_conta.urlApi = "apis/crud_plano_conta.php";
            formulario_plano_conta.containerTabela = box_listagem_planos ;
            formulario_plano_conta.formulario = $("#form-plano-conta")[0];
            
            formulario_plano_conta.relacao_campo_propriedade = [
                { nomeCampo : 'txtNomePlano', propriedade : 'nome' },
                { nomeCampo : 'txtPreco', propriedade : 'preco' },
                { nomeCampo : 'txtDuracaoMeses', propriedade : 'duracaoMeses' },
                { nomeCampo : 'txtLimitePublicacoes', propriedade : 'limitePublicacao' },
                { nomeCampo : 'txtDiasAnalise', propriedade : 'descPlano' },
                { nomeCampo : 'txtDuracaoMeses', propriedade : 'diasAnalisePublicacao' }
            ];
            
            formulario_plano_conta.inicializar();
        } 
    }

    //------------------------------------------------------- FUNCAO ADM PLANO CONTA
    
    function inicializar_lista_tipo_cartao() {
        var pagina_tipo_cartao = $("#pag-tipo-cartao")[0];
                
        if( pagina_tipo_cartao !== undefined ) {
            var formulario_tipo_cartao = new AjaxForm();
            
            formulario_tipo_cartao.colunas_tabela_propriedades_json = [
                {nome: "Cod", propriedadeJson: "id"},
                {nome: "Bandeira", propriedadeJson: "titulo"},
                {nome: "Qtd de Digitos Segurança", propriedadeJson: "qtdDigitosSeguranca"}
            ];
            
            var box_listagem_tipos_cartao = $(pagina_tipo_cartao).find("#box-listagem-tipos-cartao")[0];
            
            formulario_tipo_cartao.urlApi = "apis/crud_tipos_cartao.php";
            formulario_tipo_cartao.containerTabela = box_listagem_tipos_cartao ;
            formulario_tipo_cartao.formulario = $("#form-tipo-cartao")[0];
            
            formulario_tipo_cartao.relacao_campo_propriedade = [
                { nomeCampo : 'txtTipoCartao', propriedade : 'titulo' },
                { nomeCampo : 'txtDigitos', propriedade : 'qtdDigitosSeguranca' }
            ];
            
            formulario_tipo_cartao.inicializar();
        }
    }
    //------------------------------------------------------- FUNCAO ADM PLANO CONTA        
    //------------------------------------------------------- FUNCAO ADM PLANO CONTA  
    function inicializar_lista_bancos() {
        var pagina_banco = $("#pag-banco")[0];
        
        if( pagina_banco !== undefined ) {
            var formulario_banco = new AjaxForm();
            
            formulario_banco.colunas_tabela_propriedades_json = [
                {nome: "Cod", propriedadeJson: "id"},
                {nome: "Nome", propriedadeJson: "nome"},
                {nome: "Codigo", propriedadeJson: "codigo"},
                {nome: "qtd digitos", propriedadeJson: "qtdDigitosVerificadores"}

            ];
            
            var box_listagem_bancos = $(pagina_banco).find("#box-listagem-bancos")[0];
            
            formulario_banco.urlApi = "apis/crud_banco.php";
            formulario_banco.containerTabela = box_listagem_bancos ;
            formulario_banco.formulario = $("#form-modificacao")[0];
            
            formulario_banco.relacao_campo_propriedade = [
                { nomeCampo : 'txt_titulo', propriedade : 'nome' },
                { nomeCampo : 'txt_codigo', propriedade : 'codigo' },
                { nomeCampo : 'txt_qtd_digitos', propriedade : 'qtdDigitosVerificadores' }
                
            ];
            
            formulario_banco.inicializar();
        } 
    }
    //------------------------------------------------------- FUNCAO Banco 
    
    inicializar_lista_bancos() ;
    inicializar_lista_tipo_cartao();
    inicializar_lista_plano_conta();
    inicializar_lista_veiculos();
    inicializar_lista_tipos();
    inicializar_lista_categorias();
    inicializar_lista_acessorios();
    inicializar_lista_fabricantes();
    inicializar_lista_licenca_desktop();
});