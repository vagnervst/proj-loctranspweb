function InputStack(input_stack_base, url, nome_valor) {
    this.input_stack_base = input_stack_base;
    this.urlApi = url;
    this.nome_campo = nome_valor;
    this.input_alvo = input_alvo;
    this.callback;
    
    this.run = function() {
        input_stack_base.run();
    };
}
