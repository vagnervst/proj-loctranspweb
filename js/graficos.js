$(document).ready(function() {
    
    function inicializar_grafico_perfil_locador() {
    
        var pag_perfil_usuario = $("#pag-perfil-usuario");
        var canvas = $("#canvas-grafico")[0];
        
        if( pag_perfil_usuario !== undefined && canvas !== undefined ) {
                                                                
            var ajax = new Ajax();
            ajax.transferir_dados_para_api("apis/relatorios/saldo_mensal_usuario.php", "POST", null, function(json) {
                var dados_financeiros = JSON.parse(json);                
                
                var data = { labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
                            datasets: [
                                {
                                    label: "Saldo",
                                    fill: false,
                                    lineTension: 0.1,
                                    backgroundColor: "rgba(75,192,192,0.4)",
                                    borderColor: "rgba(75,192,192,1)",
                                    borderCapStyle: 'butt',
                                    borderDash: [],
                                    borderDashOffset: 0.0,
                                    borderJoinStyle: 'miter',
                                    pointBorderColor: "rgba(75,192,192,1)",
                                    pointBackgroundColor: "#fff",
                                    pointBorderWidth: 1,
                                    pointHoverRadius: 5,
                                    pointHoverBackgroundColor: "rgba(75,192,192,1)",
                                    pointHoverBorderColor: "rgba(220,220,220,1)",
                                    pointHoverBorderWidth: 2,
                                    pointRadius: 1,
                                    pointHitRadius: 10,
                                    data: dados_financeiros,
                                    spanGaps: false,
                                }
                            ]
                        };
                
                var chart = new Chart(canvas, {
                    type: 'line',
                    data: data
                });

            });
        }
    }
    
    inicializar_grafico_perfil_locador();
});