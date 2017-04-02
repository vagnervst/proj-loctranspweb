$(document).ready(function() {
             
    function inicializar_lista_veiculos() {
        var pagina_veiculos = $("#pag-adm-veiculos")[0];
        
        if( pagina_veiculos !== undefined ) {            
            
            var formulario_veiculos = new AjaxForm();            

            formulario_veiculos.colunas_tabela_propriedades_json = [
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
                { nomeCampo : 'txtCod', propriedade: 'id' },
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
    
    //------------------------------------------------------- FUNCOES ADM VEICULOS        
    
    function inicializar_lista_tipos() {
        var pagina_tipo = $("#pag-tipo-veiculo")[0];
        
        if( pagina_tipo !== undefined ) {                                                    
            
            var formulario_tipos_veiculo = new AjaxForm();            

            formulario_tipos_veiculo.colunas_tabela_propriedades_json = [
                {nome: "Titulo", propriedadeJson: "titulo"}                
            ];                                               

            var box_listagem_tipos = $(pagina_tipo).find(".box-listagem-tipo")[0];
            console.log(box_listagem_tipos);
            
            formulario_tipos_veiculo.urlApi = "apis/crud_tipo_veiculo.php";                
            formulario_tipos_veiculo.containerTabela = box_listagem_tipos;
            formulario_tipos_veiculo.formulario = $("#form-modificacao")[0];            

            formulario_tipos_veiculo.relacao_campo_propriedade = [
                { nomeCampo : 'txtTipoVeiculo', propriedade : 'titulo' }
            ];            

            formulario_tipos_veiculo.inicializar();                                              
        }
    }
    
    //------------------------------------------------------- FUNCOES ADM TIPO DE VEICULOS
    
    inicializar_lista_veiculos();    
    inicializar_lista_tipos();
});