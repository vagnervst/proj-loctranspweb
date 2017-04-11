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
    
    //------------------------------------------------------- FUNCAO ADM CATEGORIAS DE VEICULO
    
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
    
    inicializar_lista_veiculos();
    inicializar_lista_tipos();
    inicializar_lista_categorias();
    inicializar_lista_acessorios();
    inicializar_lista_fabricantes();
});