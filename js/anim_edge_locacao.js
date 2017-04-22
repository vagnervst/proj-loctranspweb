/**
 * Adobe Edge: symbol definitions
 */
(function($, Edge, compId){
//images folder
var im='img/animacao_edge/';

var fonts = {};
var opts = {
    'gAudioPreloadPreference': 'auto',

    'gVideoPreloadPreference': 'auto'
};
var resources = [
];
var symbols = {
"stage": {
    version: "4.0.0",
    minimumCompatibleVersion: "4.0.0",
    build: "4.0.0.359",
    baseState: "Base State",
    scaleToFit: "none",
    centerStage: "none",
    initialState: "Base State",
    gpuAccelerate: false,
    resizeInstances: false,
    content: {
            dom: [
            {
                id: 'Rectangle',
                type: 'rect',
                rect: ['10px', '10px','260px','179px','auto', 'auto'],
                fill: ["rgba(192,192,192,0.00)"],
                stroke: [1,"rgba(49,54,61,1.00)","solid"]
            },
            {
                id: 'logo_city_share_v22',
                type: 'image',
                rect: ['111px', '51px','60px','100px','auto', 'auto'],
                opacity: 0.15,
                fill: ["rgba(0,0,0,0)",im+"logo%20city%20share%20v2.png",'0px','0px']
            },
            {
                id: 'texto_1',
                type: 'text',
                rect: ['291px', '73px','135px','54px','auto', 'auto'],
                text: "Crie sua conta com cartão de crédito",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 16, "rgba(240,240,240,1.00)", "normal", "none", ""]
            },
            {
                id: 'credit-card',
                type: 'image',
                rect: ['291px', '50px','100px','100px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"credit-card%20%281%29.png",'0px','0px']
            },
            {
                id: 'automobile',
                type: 'image',
                rect: ['291px', '45px','122px','122px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"automobile.png",'0px','0px']
            },
            {
                id: 'pointer',
                type: 'image',
                rect: ['317px', '90px','61px','61px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"pointer.png",'0px','0px']
            },
            {
                id: 'Text2',
                type: 'text',
                rect: ['378px', '71px','auto','auto','auto', 'auto'],
                text: "Selecione um veículo",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 16, "rgba(240,240,240,1)", "400", "none", "normal"]
            },
            {
                id: 'Text3',
                type: 'text',
                rect: ['15px', '15px','auto','auto','auto', 'auto'],
                opacity: 1,
                text: "Como Alugar?",
                align: "left",
                font: ['Arial Black, Gadget, sans-serif', 15, "rgba(255,255,255,1.00)", "400", "none", "normal"]
            },
            {
                id: 'boy',
                type: 'image',
                rect: ['290px', '37px','100px','100px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"boy.png",'0px','0px']
            },
            {
                id: 'verify-circular-black-button-symbol',
                type: 'image',
                rect: ['351px', '101px','39px','39px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"verify-circular-black-button-symbol.png",'0px','0px']
            },
            {
                id: 'agreement',
                type: 'image',
                rect: ['305px', '125px','62px','61px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"agreement.png",'0px','0px']
            },
            {
                id: 'Text4',
                type: 'text',
                rect: ['386px', '48px','156px','42px','auto', 'auto'],
                text: "Aguarde a aprovação do locador",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 16, "rgba(240,240,240,1)", "400", "none", "normal"]
            },
            {
                id: 'map',
                type: 'image',
                rect: ['60px', '203px','77px','77px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"map.png",'0px','0px']
            },
            {
                id: 'speech-bubble',
                type: 'image',
                rect: ['23px', '206px','62px','62px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"speech-bubble.png",'0px','0px'],
                filter: [0, 0, 1, 1, 0, 0, 0, 0, "rgba(0,0,0,0.00)", 4, -1, 8]
            },
            {
                id: 'rent-a-car',
                type: 'image',
                rect: ['116px', '209px','62px','62px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"rent-a-car.png",'0px','0px']
            },
            {
                id: 'Text5',
                type: 'text',
                rect: ['91px', '217px','173px','39px','auto', 'auto'],
                text: "Contacte o locador para definir o local de retirada",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 16, "rgba(240,240,240,1)", "400", "none", "normal"]
            },
            {
                id: 'chauffer',
                type: 'image',
                rect: ['95px', '55px','92px','92px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"chauffer.png",'0px','0px']
            },
            {
                id: 'Text6',
                type: 'text',
                rect: ['85px', '150px','173px','34px','auto', 'auto'],
                text: "Retire o veículo na data e hora marcada!",
                align: "center",
                font: ['Arial, Helvetica, sans-serif', 16, "rgba(240,240,240,1)", "400", "none", "normal"]
            },
            {
                id: 'right-arrow',
                type: 'image',
                rect: ['110px', '70px','61px','61px','auto', 'auto'],
                cursor: ['pointer'],
                opacity: 0,
                fill: ["rgba(0,0,0,0)",im+"right-arrow.png",'0px','0px']
            }],
            symbolInstances: [

            ]
        },
    states: {
        "Base State": {
            "${_boy}": [
                ["style", "top", '40px'],
                ["style", "height", '100px'],
                ["style", "left", '290px'],
                ["style", "width", '100px']
            ],
            "${_verify-circular-black-button-symbol}": [
                ["style", "top", '101px'],
                ["style", "height", '39px'],
                ["style", "left", '351px'],
                ["style", "width", '39px']
            ],
            "${_Text3}": [
                ["style", "top", '15px'],
                ["style", "font-family", 'Arial Black, Gadget, sans-serif'],
                ["style", "opacity", '1'],
                ["color", "color", 'rgba(255,255,255,1.00)'],
                ["style", "font-weight", '400'],
                ["style", "left", '15px'],
                ["style", "font-size", '15px']
            ],
            "${_rent-a-car}": [
                ["style", "top", '209px'],
                ["style", "height", '62px'],
                ["style", "left", '116px'],
                ["style", "width", '62px']
            ],
            "${_Text2}": [
                ["style", "left", '378px'],
                ["style", "top", '71px']
            ],
            "${_agreement}": [
                ["style", "top", '128px'],
                ["style", "height", '61px'],
                ["style", "left", '305px'],
                ["style", "width", '62px']
            ],
            "${_logo_city_share_v22}": [
                ["style", "top", '51px'],
                ["style", "height", '100px'],
                ["style", "opacity", '0.15'],
                ["style", "left", '111px'],
                ["style", "width", '60px']
            ],
            "${_Rectangle}": [
                ["style", "top", '10px'],
                ["style", "border-style", 'solid'],
                ["color", "background-color", 'rgba(192,192,192,0.00)'],
                ["color", "border-color", 'rgba(49,54,61,1.00)'],
                ["style", "border-width", '1px']
            ],
            "${_speech-bubble}": [
                ["style", "top", '206px'],
                ["subproperty", "filter.drop-shadow.blur", '8px'],
                ["subproperty", "filter.drop-shadow.color", 'rgba(0,0,0,0.00)'],
                ["subproperty", "filter.drop-shadow.offsetV", '-1px'],
                ["style", "height", '62px'],
                ["subproperty", "filter.drop-shadow.offsetH", '4px'],
                ["style", "left", '23px'],
                ["style", "width", '62px']
            ],
            "${_Text4}": [
                ["style", "top", '48px'],
                ["style", "height", '42px'],
                ["style", "left", '386px'],
                ["style", "width", '156px']
            ],
            "${_right-arrow}": [
                ["style", "top", '70px'],
                ["style", "cursor", 'pointer'],
                ["style", "height", '61px'],
                ["style", "opacity", '0.000000'],
                ["style", "left", '110px'],
                ["style", "width", '61px']
            ],
            "${_chauffer}": [
                ["style", "top", '55px'],
                ["transform", "rotateZ", '0deg'],
                ["style", "height", '92px'],
                ["style", "left", '303px'],
                ["style", "width", '92px']
            ],
            "${_Text6}": [
                ["style", "top", '150px'],
                ["style", "text-align", 'center'],
                ["transform", "rotateZ", '0deg'],
                ["style", "height", '34px'],
                ["style", "left", '-200px'],
                ["style", "width", '173px']
            ],
            "${_map}": [
                ["style", "top", '203px'],
                ["style", "height", '77px'],
                ["style", "left", '60px'],
                ["style", "width", '77px']
            ],
            "${_automobile}": [
                ["style", "top", '45px'],
                ["style", "height", '122px'],
                ["style", "left", '291px'],
                ["style", "width", '122px']
            ],
            "${_texto_1}": [
                ["style", "top", '80px'],
                ["style", "text-align", 'left'],
                ["style", "font-size", '16px'],
                ["color", "color", 'rgba(240,240,240,1.00)'],
                ["style", "height", '39px'],
                ["style", "left", '291px'],
                ["style", "width", '135px']
            ],
            "${_Stage}": [
                ["color", "background-color", 'rgba(20,22,25,1.00)'],
                ["style", "width", '280px'],
                ["style", "height", '200px'],
                ["style", "overflow", 'hidden']
            ],
            "${_pointer}": [
                ["style", "top", '90px'],
                ["style", "height", '61px'],
                ["style", "left", '317px'],
                ["style", "width", '61px']
            ],
            "${_Text5}": [
                ["style", "top", '217px'],
                ["style", "height", '39px'],
                ["style", "left", '91px'],
                ["style", "width", '173px']
            ],
            "${_credit-card}": [
                ["style", "top", '50px'],
                ["style", "height", '100px'],
                ["style", "left", '291px'],
                ["style", "width", '100px']
            ]
        }
    },
    timelines: {
        "Default Timeline": {
            fromState: "Base State",
            toState: "",
            duration: 19152,
            autoPlay: true,
            labels: {
                "inicio": 50,
                "playButton": 19000
            },
            timeline: [
                { id: "eid26", tween: [ "style", "${_boy}", "left", '15px', { fromValue: '290px'}], position: 6895, duration: 1105, easing: "easeInOutQuint" },
                { id: "eid42", tween: [ "style", "${_boy}", "left", '-135px', { fromValue: '15px'}], position: 10750, duration: 750, easing: "easeInOutQuint" },
                { id: "eid64", tween: [ "style", "${_Text5}", "left", '323px', { fromValue: '91px'}], position: 14566, duration: 684, easing: "easeInOutQuint" },
                { id: "eid44", tween: [ "style", "${_speech-bubble}", "top", '108px', { fromValue: '206px'}], position: 11005, duration: 745, easing: "easeInOutQuint" },
                { id: "eid58", tween: [ "style", "${_speech-bubble}", "top", '221px', { fromValue: '108px'}], position: 14250, duration: 750, easing: "easeInOutQuint" },
                { id: "eid2", tween: [ "style", "${_credit-card}", "left", '20px', { fromValue: '291px'}], position: 0, duration: 1000, easing: "easeInOutQuad" },
                { id: "eid9", tween: [ "style", "${_credit-card}", "left", '-120px', { fromValue: '20px'}], position: 3240, duration: 510, easing: "easeOutQuad" },
                { id: "eid52", tween: [ "style", "${_Text5}", "top", '137px', { fromValue: '217px'}], position: 11750, duration: 750, easing: "easeInOutQuint" },
                { id: "eid13", tween: [ "style", "${_automobile}", "left", '20px', { fromValue: '291px'}], position: 3240, duration: 760, easing: "easeInOutQuad" },
                { id: "eid21", tween: [ "style", "${_automobile}", "left", '-137px', { fromValue: '20px'}], position: 6500, duration: 750, easing: "easeInOutQuad" },
                { id: "eid32", tween: [ "style", "${_verify-circular-black-button-symbol}", "left", '80px', { fromValue: '351px'}], position: 7435, duration: 1065, easing: "easeInOutQuint" },
                { id: "eid36", tween: [ "style", "${_verify-circular-black-button-symbol}", "left", '-91px', { fromValue: '80px'}], position: 10000, duration: 750, easing: "easeInOutQuint" },
                { id: "eid17", tween: [ "style", "${_Text2}", "left", '114px', { fromValue: '378px'}], position: 3750, duration: 750, easing: "easeOutQuad" },
                { id: "eid23", tween: [ "style", "${_Text2}", "left", '-161px', { fromValue: '114px'}], position: 6255, duration: 745, easing: "easeInOutQuint" },
                { id: "eid72", tween: [ "transform", "${_chauffer}", "rotateZ", '-360deg', { fromValue: '0deg'}], position: 15000, duration: 2250, easing: "easeOutBounce" },
                { id: "eid73", tween: [ "transform", "${_chauffer}", "rotateZ", '-360deg', { fromValue: '-360deg'}], position: 17250, duration: 0, easing: "easeOutBounce" },
                { id: "eid83", tween: [ "transform", "${_chauffer}", "rotateZ", '-720deg', { fromValue: '-360deg'}], position: 18000, duration: 500, easing: "easeOutBounce" },
                { id: "eid67", tween: [ "style", "${_chauffer}", "left", '95px', { fromValue: '303px'}], position: 15000, duration: 2250, easing: "easeOutBounce" },
                { id: "eid81", tween: [ "style", "${_chauffer}", "left", '-108px', { fromValue: '95px'}], position: 18000, duration: 500, easing: "easeOutQuad" },
                { id: "eid77", tween: [ "style", "${_right-arrow}", "opacity", '1', { fromValue: '0.000000'}], position: 18500, duration: 652, easing: "easeOutQuad" },
                { id: "eid28", tween: [ "style", "${_agreement}", "left", '26px', { fromValue: '305px'}], position: 7145, duration: 1105, easing: "easeInOutQuint" },
                { id: "eid40", tween: [ "style", "${_agreement}", "left", '-105px', { fromValue: '26px'}], position: 10250, duration: 755, easing: "easeInOutQuint" },
                { id: "eid15", tween: [ "style", "${_pointer}", "left", '40px', { fromValue: '317px'}], position: 3500, duration: 735, easing: "easeOutQuad" },
                { id: "eid19", tween: [ "style", "${_pointer}", "left", '-110px', { fromValue: '40px'}], position: 6000, duration: 750, easing: "easeOutQuad" },
                { id: "eid34", tween: [ "style", "${_Text4}", "left", '108px', { fromValue: '386px'}], position: 7750, duration: 1000, easing: "easeInOutQuint" },
                { id: "eid38", tween: [ "style", "${_Text4}", "left", '-170px', { fromValue: '108px'}], position: 10500, duration: 750, easing: "easeInOutQuint" },
                { id: "eid48", tween: [ "style", "${_rent-a-car}", "top", '38px', { fromValue: '209px'}], position: 11500, duration: 749, easing: "easeInOutQuint" },
                { id: "eid60", tween: [ "style", "${_rent-a-car}", "top", '-77px', { fromValue: '38px'}], position: 14379, duration: 500, easing: "easeInOutQuint" },
                { id: "eid46", tween: [ "style", "${_map}", "top", '53px', { fromValue: '203px'}], position: 11250, duration: 750, easing: "easeInOutQuint" },
                { id: "eid56", tween: [ "style", "${_map}", "left", '312px', { fromValue: '60px'}], position: 14000, duration: 750, easing: "easeInOutQuint" },
                { id: "eid68", tween: [ "style", "${_Text6}", "left", '60px', { fromValue: '-200px'}], position: 15000, duration: 1500, easing: "easeInOutQuint" },
                { id: "eid85", tween: [ "style", "${_Text6}", "left", '314px', { fromValue: '60px'}], position: 18000, duration: 500, easing: "easeOutQuad" },
                { id: "eid4", tween: [ "style", "${_texto_1}", "left", '125px', { fromValue: '291px'}], position: 750, duration: 750, easing: "easeOutQuad" },
                { id: "eid11", tween: [ "style", "${_texto_1}", "left", '-156px', { fromValue: '125px'}], position: 3000, duration: 500, easing: "easeOutQuad" }            ]
        }
    }
}
};


Edge.registerCompositionDefn(compId, symbols, fonts, resources, opts);

/**
 * Adobe Edge DOM Ready Event Handler
 */
$(window).ready(function() {
     Edge.launchComposition(compId);
});
})(jQuery, AdobeEdge, "EDGE-62639122");
