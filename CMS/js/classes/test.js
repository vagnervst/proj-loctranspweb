function AjaxForm() {
    this.jsonRegistros;
    this.infoPaginas;
    this.formulario;
    this.urlApi;
    this.modoCRUD;
    
    //metodos
    this.inicializar;
    
    this.exibirTabela;
    this.prepararTabela;
    
    this.prepararBotoesPaginacao;
    
    this.prepararFormulario = function() {
        var botao_remocao = $(this.formulario).find(".js-botao-remocao")[0];
        
        $(this.formulario).submit(function(e) {
            e.preventDefault();
            
            var dados_formulario = new FormData(this);
            dados_formulario.append( this.modoCRUD );
            
            if( this.modoCRUD === "update" ) {
                var id_registro_selecionado = $(this.formulario).data( "id" );
                dados_formulario.append( "id", id_registro_selecionado );
            }
            
            var ajax = new Ajax();
            ajax.transferir_dados_para_api( this.urlApi, "POST", dados_formulario, function(dados_api) {
                $(this.formulario).trigger("reset");
                
                if( this.modoCRUD === "update" ) {
                    $(this.formulario).removeData( "id" );
                    
                    this.modoCRUD = "insert";
                } 
            });
            
        });
        
        if( botao_remocao !== undefined ) {
            $(botao_remocao).click(function() {
                var id_registro = $(this.formulario).data( "id" );
                
                var dados_para_api = new FormData();
                dados_para_api.append( "id", id_registro );
                
                this.modoCRUD = "delete";
                dados_para_api.append( "modo", this.modoCRUD );
                
                var ajax = new Ajax();
                ajax.transferir_dados_para_api( this.urlApi, "POST", dados_para_api, function(dados_api) {
                    $(this.formulario).trigger("reset");
                });
            });
        }
    }
    
}