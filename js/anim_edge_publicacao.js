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
                rect: ['5px', '5px','268px','188px','auto', 'auto'],
                fill: ["rgba(192,192,192,0.00)"],
                stroke: [1,"rgba(64,71,81,1.00)","solid"]
            },
            {
                id: 'logo_city_share_v2',
                type: 'image',
                rect: ['100px', '35px','80px','129px','auto', 'auto'],
                opacity: 0.1,
                fill: ["rgba(0,0,0,0)",im+"logo%20city%20share%20v2.png",'0px','0px']
            },
            {
                id: 'car',
                type: 'image',
                rect: ['-140px', '67px','126px','126px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"car.png",'0px','0px']
            },
            {
                id: 'cursor',
                type: 'image',
                rect: ['-80px', '126px','52px','52px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"cursor.png",'0px','0px']
            },
            {
                id: 'icon',
                type: 'image',
                rect: ['300px', '93px','33px','33px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"icon.png",'0px','0px']
            },
            {
                id: 'photo-camera',
                type: 'image',
                rect: ['14px', '-36px','33px','33px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"photo-camera.png",'0px','0px']
            },
            {
                id: 'Text',
                type: 'text',
                rect: ['58px', '-65px','175px','58px','auto', 'auto'],
                text: "Publique seu veículo com as fotos e devidas informações",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 16, "rgba(255,255,255,1.00)", "normal", "none", ""]
            },
            {
                id: 'Group',
                type: 'group',
                rect: ['-4px', '17px','136','58','auto', 'auto'],
                transform: [[],[],[],['0.8','0.8']],
                c: [
                {
                    id: 'Rectangle2',
                    type: 'rect',
                    rect: ['0px', '0px','136px','58px','auto', 'auto'],
                    borderRadius: ["1px 1px", "1px 1px", "1px 1px", "1px 1px"],
                    fill: ["rgba(220,220,220,1.00)"],
                    stroke: [1,"rgb(64, 71, 81)","none"]
                },
                {
                    id: 'Rectangle2Copy',
                    type: 'rect',
                    rect: ['4px', '4px','50px','50px','auto', 'auto'],
                    borderRadius: ["2px 2px", "2px 2px", "2px 2px", "2px 2px"],
                    fill: ["rgba(197,197,197,1.00)"],
                    stroke: [1,"rgb(64, 71, 81)","none"]
                },
                {
                    id: 'Rectangle2Copy2',
                    type: 'rect',
                    rect: ['59px', '4px','71px','5px','auto', 'auto'],
                    fill: ["rgba(197,197,197,1.00)"],
                    stroke: [1,"rgb(64, 71, 81)","none"]
                },
                {
                    id: 'Rectangle2Copy3',
                    type: 'rect',
                    rect: ['59px', '11px','40px','5px','auto', 'auto'],
                    fill: ["rgba(197,197,197,1.00)"],
                    stroke: [1,"rgb(64, 71, 81)","none"]
                },
                {
                    id: 'Rectangle2Copy4',
                    type: 'rect',
                    rect: ['59px', '18px','60px','5px','auto', 'auto'],
                    fill: ["rgba(197,197,197,1.00)"],
                    stroke: [1,"rgb(64, 71, 81)","none"]
                }]
            },
            {
                id: 'GroupCopy',
                type: 'group',
                rect: ['-4px', '71px','136','58','auto', 'auto'],
                transform: [[],[],[],['0.8','0.8']],
                c: [
                {
                    id: 'Rectangle2Copy9',
                    type: 'rect',
                    rect: ['0px', '0px','136px','58px','auto', 'auto'],
                    borderRadius: ["1px 1px", "1px 1px", "1px 1px", "1px 1px"],
                    fill: ["rgba(220,220,220,1.00)"],
                    stroke: [1,"rgb(64, 71, 81)","none"]
                },
                {
                    id: 'Rectangle2Copy8',
                    type: 'rect',
                    rect: ['4px', '4px','50px','50px','auto', 'auto'],
                    borderRadius: ["2px 2px", "2px 2px", "2px 2px", "2px 2px"],
                    fill: ["rgba(197,197,197,1.00)"],
                    stroke: [1,"rgb(64, 71, 81)","none"]
                },
                {
                    id: 'Rectangle2Copy7',
                    type: 'rect',
                    rect: ['59px', '4px','71px','5px','auto', 'auto'],
                    fill: ["rgba(197,197,197,1.00)"],
                    stroke: [1,"rgb(64, 71, 81)","none"]
                },
                {
                    id: 'Rectangle2Copy6',
                    type: 'rect',
                    rect: ['59px', '11px','40px','5px','auto', 'auto'],
                    fill: ["rgba(197,197,197,1.00)"],
                    stroke: [1,"rgb(64, 71, 81)","none"]
                },
                {
                    id: 'Rectangle2Copy5',
                    type: 'rect',
                    rect: ['59px', '18px','60px','5px','auto', 'auto'],
                    fill: ["rgba(197,197,197,1.00)"],
                    stroke: [1,"rgb(64, 71, 81)","none"]
                }]
            },
            {
                id: 'GroupCopy2',
                type: 'group',
                rect: ['-132px', '125px','136','58','auto', 'auto'],
                transform: [[],[],[],['0.8','0.8']],
                c: [
                {
                    id: 'Rectangle2Copy14',
                    type: 'rect',
                    rect: ['0px', '0px','136px','58px','auto', 'auto'],
                    borderRadius: ["1px 1px", "1px 1px", "1px 1px", "1px 1px"],
                    fill: ["rgba(220,220,220,1.00)"],
                    stroke: [1,"rgb(64, 71, 81)","none"]
                },
                {
                    id: 'Rectangle2Copy13',
                    type: 'rect',
                    rect: ['4px', '4px','50px','50px','auto', 'auto'],
                    borderRadius: ["2px 2px", "2px 2px", "2px 2px", "2px 2px"],
                    fill: ["rgba(197,197,197,1)"],
                    stroke: [1,"rgb(64, 71, 81)","none"]
                },
                {
                    id: 'Rectangle2Copy12',
                    type: 'rect',
                    rect: ['59px', '4px','71px','5px','auto', 'auto'],
                    fill: ["rgba(197,197,197,1.00)"],
                    stroke: [1,"rgb(64, 71, 81)","none"]
                },
                {
                    id: 'Rectangle2Copy11',
                    type: 'rect',
                    rect: ['59px', '11px','40px','5px','auto', 'auto'],
                    fill: ["rgba(197,197,197,1.00)"],
                    stroke: [1,"rgb(64, 71, 81)","none"]
                },
                {
                    id: 'Rectangle2Copy10',
                    type: 'rect',
                    rect: ['59px', '18px','60px','5px','auto', 'auto'],
                    fill: ["rgba(197,197,197,1.00)"],
                    stroke: [1,"rgb(64, 71, 81)","none"]
                }]
            },
            {
                id: 'cursor2',
                type: 'image',
                rect: ['300px', '28px','35px','35px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"cursor.png",'0px','0px']
            },
            {
                id: 'Text2',
                type: 'text',
                rect: ['289px', '26px','126px','40px','auto', 'auto'],
                text: "Aceite uma das solicitações",
                align: "left",
                font: ['Arial, Helvetica, sans-serif', 16, "rgba(255,255,255,1)", "400", "none", "normal"]
            },
            {
                id: 'verify-circular-black-button-symbol',
                type: 'image',
                rect: ['47px', '132px','0px','0px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"verify-circular-black-button-symbol.png",'0px','0px']
            },
            {
                id: 'girl',
                type: 'image',
                rect: ['15px', '68px','126px','126px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"girl.png",'0px','0px']
            },
            {
                id: 'speech-bubble',
                type: 'image',
                rect: ['85px', '66px','40px','40px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"speech-bubble.png",'0px','0px']
            },
            {
                id: 'Text3',
                type: 'text',
                rect: ['301px', '11px','139px','75px','auto', 'auto'],
                text: "Contacte o solicitante do veículo para definir o local de retirada",
                align: "right",
                font: ['Arial, Helvetica, sans-serif', 16, "rgba(255,255,255,1)", "400", "none", "normal"]
            },
            {
                id: 'agreement',
                type: 'image',
                rect: ['175px', '128px','50px','50px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"agreement.png",'0px','0px']
            },
            {
                id: 'calendar',
                type: 'image',
                rect: ['118px', '-53px','32px','32px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"calendar.png",'0px','0px']
            },
            {
                id: 'brand-new-car-with-dollar-price-tag',
                type: 'image',
                rect: ['10px', '88px','120px','120px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"brand-new-car-with-dollar-price-tag.png",'0px','0px']
            },
            {
                id: 'Text4',
                type: 'text',
                rect: ['-188px', '26','170px','40px','auto', 'auto'],
                text: "Entregue o veículo no local e data combinados",
                align: "right",
                font: ['Arial, Helvetica, sans-serif', 16, "rgba(255,255,255,1)", "400", "none", "normal"]
            },
            {
                id: 'right-arrow',
                type: 'image',
                rect: ['121px', '75px','50px','50px','auto', 'auto'],
                cursor: ['pointer'],
                opacity: 0,
                fill: ["rgba(0,0,0,0)",im+"right-arrow.png",'0px','0px']
            }],
            symbolInstances: [

            ]
        },
    states: {
        "Base State": {
            "${_Rectangle2}": [
                ["color", "background-color", 'rgba(220,220,220,1.00)'],
                ["style", "border-top-left-radius", [1,1], {valueTemplate:'@@0@@px @@1@@px'} ],
                ["style", "border-bottom-right-radius", [1,1], {valueTemplate:'@@0@@px @@1@@px'} ],
                ["style", "border-style", 'none'],
                ["style", "left", '0px'],
                ["style", "width", '136px'],
                ["style", "top", '0px'],
                ["style", "border-bottom-left-radius", [1,1], {valueTemplate:'@@0@@px @@1@@px'} ],
                ["style", "height", '58px'],
                ["style", "border-top-right-radius", [1,1], {valueTemplate:'@@0@@px @@1@@px'} ]
            ],
            "${_verify-circular-black-button-symbol}": [
                ["style", "top", '132px'],
                ["style", "height", '35px'],
                ["style", "opacity", '0'],
                ["style", "left", '47px'],
                ["style", "width", '35px']
            ],
            "${_girl}": [
                ["style", "top", '68px'],
                ["style", "height", '126px'],
                ["style", "left", '-134px'],
                ["style", "width", '126px']
            ],
            "${_Text2}": [
                ["style", "height", '40px'],
                ["style", "top", '26px'],
                ["style", "left", '289px'],
                ["style", "width", '126px']
            ],
            "${_Rectangle2Copy5}": [
                ["color", "background-color", 'rgba(197,197,197,1.00)'],
                ["style", "top", '18px'],
                ["style", "height", '5px'],
                ["style", "border-style", 'none'],
                ["style", "left", '59px'],
                ["style", "width", '60px']
            ],
            "${_car}": [
                ["style", "top", '67px'],
                ["style", "height", '126px'],
                ["style", "left", '-140px'],
                ["style", "width", '126px']
            ],
            "${_GroupCopy2}": [
                ["style", "top", '125px'],
                ["transform", "scaleX", '0.8'],
                ["style", "left", '-132px'],
                ["transform", "scaleY", '0.8']
            ],
            "${_Text4}": [
                ["style", "height", '40px'],
                ["style", "left", '-188px'],
                ["style", "width", '170px']
            ],
            "${_logo_city_share_v2}": [
                ["style", "top", '35px'],
                ["style", "height", '129px'],
                ["style", "opacity", '0.1'],
                ["style", "left", '100px'],
                ["style", "width", '80px']
            ],
            "${_photo-camera}": [
                ["style", "top", '-36px'],
                ["style", "height", '33px'],
                ["style", "left", '14px'],
                ["style", "width", '33px']
            ],
            "${_Rectangle2Copy8}": [
                ["color", "background-color", 'rgba(197,197,197,1.00)'],
                ["style", "border-top-left-radius", [2,2], {valueTemplate:'@@0@@px @@1@@px'} ],
                ["style", "border-bottom-right-radius", [2,2], {valueTemplate:'@@0@@px @@1@@px'} ],
                ["style", "border-style", 'none'],
                ["style", "left", '4px'],
                ["style", "width", '50px'],
                ["style", "top", '4px'],
                ["style", "border-bottom-left-radius", [2,2], {valueTemplate:'@@0@@px @@1@@px'} ],
                ["style", "height", '50px'],
                ["style", "border-top-right-radius", [2,2], {valueTemplate:'@@0@@px @@1@@px'} ]
            ],
            "${_Group}": [
                ["style", "top", '17px'],
                ["transform", "scaleY", '0.8'],
                ["transform", "scaleX", '0.8'],
                ["style", "opacity", '1'],
                ["style", "left", '-127px']
            ],
            "${_Rectangle2Copy6}": [
                ["color", "background-color", 'rgba(197,197,197,1.00)'],
                ["style", "top", '11px'],
                ["style", "height", '5px'],
                ["style", "border-style", 'none'],
                ["style", "left", '59px'],
                ["style", "width", '40px']
            ],
            "${_Rectangle2Copy12}": [
                ["color", "background-color", 'rgba(197,197,197,1)'],
                ["style", "top", '4px'],
                ["style", "height", '5px'],
                ["style", "border-style", 'none'],
                ["style", "left", '59px'],
                ["style", "width", '71px']
            ],
            "${_cursor}": [
                ["style", "top", '126px'],
                ["style", "height", '52px'],
                ["style", "left", '-80px'],
                ["style", "width", '52px']
            ],
            "${_Rectangle2Copy4}": [
                ["color", "background-color", 'rgba(197,197,197,1.00)'],
                ["style", "top", '18px'],
                ["style", "height", '5px'],
                ["style", "border-style", 'none'],
                ["style", "left", '59px'],
                ["style", "width", '60px']
            ],
            "${_Text3}": [
                ["style", "top", '11px'],
                ["style", "text-align", 'right'],
                ["style", "height", '75px'],
                ["style", "left", '301px'],
                ["style", "width", '151px']
            ],
            "${_Rectangle2Copy3}": [
                ["color", "background-color", 'rgba(197,197,197,1.00)'],
                ["style", "top", '11px'],
                ["style", "height", '5px'],
                ["style", "border-style", 'none'],
                ["style", "left", '59px'],
                ["style", "width", '40px']
            ],
            "${_agreement}": [
                ["style", "top", '209px'],
                ["style", "height", '50px'],
                ["style", "left", '175px'],
                ["style", "width", '50px']
            ],
            "${_Rectangle2Copy2}": [
                ["color", "background-color", 'rgba(197,197,197,1.00)'],
                ["style", "top", '4px'],
                ["style", "height", '5px'],
                ["style", "border-style", 'none'],
                ["style", "left", '59px'],
                ["style", "width", '71px']
            ],
            "${_GroupCopy}": [
                ["style", "top", '71px'],
                ["transform", "scaleY", '0.8'],
                ["transform", "scaleX", '0.8'],
                ["style", "opacity", '1'],
                ["style", "left", '-132px']
            ],
            "${_Rectangle}": [
                ["style", "top", '5px'],
                ["style", "border-style", 'solid'],
                ["style", "border-width", '1px'],
                ["color", "background-color", 'rgba(192,192,192,0.00)'],
                ["style", "height", '188px'],
                ["color", "border-color", 'rgba(64,71,81,1.00)'],
                ["style", "left", '5px'],
                ["style", "width", '268px']
            ],
            "${_Rectangle2Copy10}": [
                ["color", "background-color", 'rgba(197,197,197,1)'],
                ["style", "top", '18px'],
                ["style", "height", '5px'],
                ["style", "border-style", 'none'],
                ["style", "left", '59px'],
                ["style", "width", '60px']
            ],
            "${_right-arrow}": [
                ["style", "top", '75px'],
                ["style", "cursor", 'pointer'],
                ["style", "height", '50px'],
                ["style", "opacity", '0.000000'],
                ["style", "left", '121px'],
                ["style", "width", '50px']
            ],
            "${_brand-new-car-with-dollar-price-tag}": [
                ["style", "top", '88px'],
                ["transform", "rotateZ", '0deg'],
                ["style", "height", '120px'],
                ["style", "-webkit-transform-origin", [100,100], {valueTemplate:'@@0@@% @@1@@%'} ],
                ["style", "-moz-transform-origin", [100,100],{valueTemplate:'@@0@@% @@1@@%'}],
                ["style", "-ms-transform-origin", [100,100],{valueTemplate:'@@0@@% @@1@@%'}],
                ["style", "msTransformOrigin", [100,100],{valueTemplate:'@@0@@% @@1@@%'}],
                ["style", "-o-transform-origin", [100,100],{valueTemplate:'@@0@@% @@1@@%'}],
                ["style", "left", '-128px'],
                ["style", "width", '120px']
            ],
            "${_calendar}": [
                ["style", "height", '32px'],
                ["style", "top", '-53px'],
                ["style", "left", '118px'],
                ["style", "width", '32px']
            ],
            "${_speech-bubble}": [
                ["style", "top", '66px'],
                ["style", "height", '40px'],
                ["style", "left", '-52px'],
                ["style", "width", '40px']
            ],
            "${_Rectangle2Copy}": [
                ["color", "background-color", 'rgba(197,197,197,1.00)'],
                ["style", "border-top-left-radius", [2,2], {valueTemplate:'@@0@@px @@1@@px'} ],
                ["style", "border-bottom-right-radius", [2,2], {valueTemplate:'@@0@@px @@1@@px'} ],
                ["style", "border-style", 'none'],
                ["style", "left", '4px'],
                ["style", "width", '50px'],
                ["style", "top", '4px'],
                ["style", "border-bottom-left-radius", [2,2], {valueTemplate:'@@0@@px @@1@@px'} ],
                ["style", "height", '50px'],
                ["style", "border-top-right-radius", [2,2], {valueTemplate:'@@0@@px @@1@@px'} ]
            ],
            "${_Rectangle2Copy14}": [
                ["color", "background-color", 'rgba(220,220,220,1)'],
                ["style", "border-top-left-radius", [1,1], {valueTemplate:'@@0@@px @@1@@px'} ],
                ["style", "border-bottom-right-radius", [1,1], {valueTemplate:'@@0@@px @@1@@px'} ],
                ["style", "border-style", 'none'],
                ["style", "left", '0px'],
                ["style", "width", '136px'],
                ["style", "top", '0px'],
                ["style", "border-bottom-left-radius", [1,1], {valueTemplate:'@@0@@px @@1@@px'} ],
                ["style", "height", '58px'],
                ["style", "border-top-right-radius", [1,1], {valueTemplate:'@@0@@px @@1@@px'} ]
            ],
            "${_cursor2}": [
                ["style", "top", '26px'],
                ["style", "height", '35px'],
                ["style", "left", '291px'],
                ["style", "width", '35px']
            ],
            "${_Rectangle2Copy7}": [
                ["color", "background-color", 'rgba(197,197,197,1.00)'],
                ["style", "top", '4px'],
                ["style", "height", '5px'],
                ["style", "border-style", 'none'],
                ["style", "left", '59px'],
                ["style", "width", '71px']
            ],
            "${_Text}": [
                ["style", "top", '-65px'],
                ["style", "text-align", 'left'],
                ["style", "height", '58px'],
                ["color", "color", 'rgba(255,255,255,1.00)'],
                ["style", "font-size", '16px'],
                ["style", "left", '58px'],
                ["style", "width", '175px']
            ],
            "${_Rectangle2Copy13}": [
                ["color", "background-color", 'rgba(197,197,197,1)'],
                ["style", "border-top-left-radius", [2,2], {valueTemplate:'@@0@@px @@1@@px'} ],
                ["style", "border-bottom-right-radius", [2,2], {valueTemplate:'@@0@@px @@1@@px'} ],
                ["style", "border-style", 'none'],
                ["style", "left", '4px'],
                ["style", "width", '50px'],
                ["style", "top", '4px'],
                ["style", "border-bottom-left-radius", [2,2], {valueTemplate:'@@0@@px @@1@@px'} ],
                ["style", "height", '50px'],
                ["style", "border-top-right-radius", [2,2], {valueTemplate:'@@0@@px @@1@@px'} ]
            ],
            "${_Stage}": [
                ["color", "background-color", 'rgba(20,22,25,1.00)'],
                ["style", "width", '280px'],
                ["style", "height", '200px'],
                ["style", "overflow", 'hidden']
            ],
            "${_Rectangle2Copy11}": [
                ["color", "background-color", 'rgba(197,197,197,1)'],
                ["style", "top", '11px'],
                ["style", "height", '5px'],
                ["style", "border-style", 'none'],
                ["style", "left", '59px'],
                ["style", "width", '40px']
            ],
            "${_icon}": [
                ["style", "top", '93px'],
                ["style", "height", '33px'],
                ["style", "left", '300px'],
                ["style", "width", '33px']
            ],
            "${_Rectangle2Copy9}": [
                ["color", "background-color", 'rgba(220,220,220,1.00)'],
                ["style", "border-top-left-radius", [1,1], {valueTemplate:'@@0@@px @@1@@px'} ],
                ["style", "border-bottom-right-radius", [1,1], {valueTemplate:'@@0@@px @@1@@px'} ],
                ["style", "border-style", 'none'],
                ["style", "left", '0px'],
                ["style", "width", '136px'],
                ["style", "top", '0px'],
                ["style", "border-bottom-left-radius", [1,1], {valueTemplate:'@@0@@px @@1@@px'} ],
                ["style", "height", '58px'],
                ["style", "border-top-right-radius", [1,1], {valueTemplate:'@@0@@px @@1@@px'} ]
            ]
        }
    },
    timelines: {
        "Default Timeline": {
            fromState: "Base State",
            toState: "",
            duration: 20250,
            autoPlay: true,
            labels: {
                "start": 0,
                "animStart": 500,
                "playButton": 20250
            },
            timeline: [
                { id: "eid97", tween: [ "style", "${_Text3}", "width", '151px', { fromValue: '151px'}], position: 12250, duration: 0 },
                { id: "eid4", tween: [ "style", "${_cursor}", "left", '60px', { fromValue: '-80px'}], position: 1340, duration: 500 },
                { id: "eid18", tween: [ "style", "${_cursor}", "left", '309px', { fromValue: '60px'}], position: 5000, duration: 500 },
                { id: "eid89", tween: [ "style", "${_Text3}", "left", '116px', { fromValue: '301px'}], position: 10750, duration: 750 },
                { id: "eid105", tween: [ "style", "${_Text3}", "left", '284px', { fromValue: '116px'}], position: 15735, duration: 515 },
                { id: "eid103", tween: [ "style", "${_girl}", "top", '208px', { fromValue: '68px'}], position: 15500, duration: 500 },
                { id: "eid49", tween: [ "style", "${_cursor2}", "width", '30px', { fromValue: '35px'}], position: 7500, duration: 250 },
                { id: "eid52", tween: [ "style", "${_cursor2}", "width", '35px', { fromValue: '30px'}], position: 7750, duration: 250 },
                { id: "eid68", tween: [ "color", "${_Rectangle2Copy12}", "background-color", 'rgba(225,225,225,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(197,197,197,1)'}], position: 7750, duration: 500 },
                { id: "eid72", tween: [ "style", "${_verify-circular-black-button-symbol}", "top", '80px', { fromValue: '132px'}], position: 7750, duration: 500 },
                { id: "eid56", tween: [ "style", "${_Group}", "opacity", '0', { fromValue: '1'}], position: 7750, duration: 500 },
                { id: "eid91", tween: [ "style", "${_speech-bubble}", "left", '85px', { fromValue: '-52px'}], position: 11230, duration: 520 },
                { id: "eid101", tween: [ "style", "${_speech-bubble}", "left", '-51px', { fromValue: '85px'}], position: 15250, duration: 485 },
                { id: "eid2", tween: [ "style", "${_car}", "left", '8px', { fromValue: '-140px'}], position: 1000, duration: 500 },
                { id: "eid20", tween: [ "style", "${_car}", "left", '-143px', { fromValue: '8px'}], position: 5000, duration: 500 },
                { id: "eid128", tween: [ "style", "${_right-arrow}", "opacity", '1', { fromValue: '0.000000'}], position: 19500, duration: 750 },
                { id: "eid50", tween: [ "style", "${_cursor2}", "height", '30px', { fromValue: '35px'}], position: 7500, duration: 250 },
                { id: "eid51", tween: [ "style", "${_cursor2}", "height", '35px', { fromValue: '30px'}], position: 7750, duration: 250 },
                { id: "eid120", tween: [ "style", "${_Text4}", "left", '95px', { fromValue: '-188px'}], position: 16500, duration: 750 },
                { id: "eid126", tween: [ "style", "${_Text4}", "left", '-185px', { fromValue: '95px'}], position: 19015, duration: 485 },
                { id: "eid44", tween: [ "style", "${_GroupCopy2}", "left", '-4px', { fromValue: '-132px'}], position: 6250, duration: 750 },
                { id: "eid83", tween: [ "style", "${_GroupCopy2}", "left", '-134px', { fromValue: '-4px'}], position: 10500, duration: 505 },
                { id: "eid93", tween: [ "style", "${_girl}", "left", '15px', { fromValue: '-134px'}], position: 11500, duration: 500 },
                { id: "eid8", tween: [ "style", "${_icon}", "left", '107px', { fromValue: '300px'}], position: 1445, duration: 500 },
                { id: "eid16", tween: [ "style", "${_icon}", "left", '-46px', { fromValue: '107px'}], position: 4750, duration: 500 },
                { id: "eid118", tween: [ "style", "${_calendar}", "top", '90px', { fromValue: '-53px'}], position: 16500, duration: 500 },
                { id: "eid124", tween: [ "style", "${_calendar}", "top", '223px', { fromValue: '90px'}], position: 18740, duration: 510 },
                { id: "eid113", tween: [ "transform", "${_brand-new-car-with-dollar-price-tag}", "rotateZ", '15deg', { fromValue: '0deg'}], position: 16250, duration: 250 },
                { id: "eid114", tween: [ "transform", "${_brand-new-car-with-dollar-price-tag}", "rotateZ", '0deg', { fromValue: '15deg'}], position: 16500, duration: 250 },
                { id: "eid10", tween: [ "style", "${_Text}", "top", '15px', { fromValue: '-65px'}], position: 1750, duration: 250 },
                { id: "eid12", tween: [ "style", "${_Text}", "top", '208px', { fromValue: '15px'}], position: 4500, duration: 500 },
                { id: "eid46", tween: [ "style", "${_Text2}", "left", '130px', { fromValue: '289px'}], position: 6250, duration: 750 },
                { id: "eid110", tween: [ "style", "${_brand-new-car-with-dollar-price-tag}", "-webkit-transform-origin", [100,100], { valueTemplate: '@@0@@% @@1@@%', fromValue: [100,100]}], position: 16250, duration: 0 },
                { id: "eid185", tween: [ "style", "${_brand-new-car-with-dollar-price-tag}", "-moz-transform-origin", [100,100], { valueTemplate: '@@0@@% @@1@@%', fromValue: [100,100]}], position: 16250, duration: 0 },
                { id: "eid186", tween: [ "style", "${_brand-new-car-with-dollar-price-tag}", "-ms-transform-origin", [100,100], { valueTemplate: '@@0@@% @@1@@%', fromValue: [100,100]}], position: 16250, duration: 0 },
                { id: "eid187", tween: [ "style", "${_brand-new-car-with-dollar-price-tag}", "msTransformOrigin", [100,100], { valueTemplate: '@@0@@% @@1@@%', fromValue: [100,100]}], position: 16250, duration: 0 },
                { id: "eid188", tween: [ "style", "${_brand-new-car-with-dollar-price-tag}", "-o-transform-origin", [100,100], { valueTemplate: '@@0@@% @@1@@%', fromValue: [100,100]}], position: 16250, duration: 0 },
                { id: "eid40", tween: [ "style", "${_Group}", "left", '-4px', { fromValue: '-127px'}], position: 5000, duration: 750 },
                { id: "eid95", tween: [ "style", "${_agreement}", "top", '128px', { fromValue: '209px'}], position: 11750, duration: 500 },
                { id: "eid99", tween: [ "style", "${_agreement}", "top", '205px', { fromValue: '128px'}], position: 15000, duration: 500 },
                { id: "eid107", tween: [ "style", "${_brand-new-car-with-dollar-price-tag}", "left", '10px', { fromValue: '-128px'}], position: 15500, duration: 750 },
                { id: "eid122", tween: [ "style", "${_brand-new-car-with-dollar-price-tag}", "left", '-141px', { fromValue: '10px'}], position: 18500, duration: 515 },
                { id: "eid87", tween: [ "style", "${_Text2}", "top", '-53px', { fromValue: '26px'}], position: 10500, duration: 730 },
                { id: "eid42", tween: [ "style", "${_GroupCopy}", "left", '-4px', { fromValue: '-132px'}], position: 5750, duration: 750 },
                { id: "eid62", tween: [ "color", "${_Rectangle2Copy13}", "background-color", 'rgba(235,235,235,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(197,197,197,1)'}], position: 7750, duration: 500 },
                { id: "eid55", tween: [ "style", "${_GroupCopy}", "opacity", '0', { fromValue: '1'}], position: 7750, duration: 500 },
                { id: "eid79", tween: [ "style", "${_verify-circular-black-button-symbol}", "opacity", '1', { fromValue: '0'}], position: 7750, duration: 500 },
                { id: "eid81", tween: [ "style", "${_verify-circular-black-button-symbol}", "opacity", '0', { fromValue: '1'}], position: 10250, duration: 500 },
                { id: "eid32", tween: [ "style", "${_cursor2}", "left", '81px', { fromValue: '291px'}], position: 5500, duration: 500 },
                { id: "eid37", tween: [ "style", "${_cursor2}", "top", '150px', { fromValue: '26px'}], position: 6250, duration: 1250 },
                { id: "eid85", tween: [ "style", "${_cursor2}", "top", '212px', { fromValue: '150px'}], position: 10000, duration: 500 },
                { id: "eid60", tween: [ "color", "${_Rectangle2Copy14}", "background-color", 'rgba(100,147,188,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(220,220,220,1)'}], position: 7750, duration: 500 },
                { id: "eid66", tween: [ "color", "${_Rectangle2Copy11}", "background-color", 'rgba(225,225,225,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(197,197,197,1)'}], position: 7750, duration: 500 },
                { id: "eid6", tween: [ "style", "${_photo-camera}", "top", '67px', { fromValue: '-36px'}], position: 1250, duration: 500 },
                { id: "eid14", tween: [ "style", "${_photo-camera}", "top", '-36px', { fromValue: '67px'}], position: 4750, duration: 500 },
                { id: "eid67", tween: [ "color", "${_Rectangle2Copy10}", "background-color", 'rgba(225,225,225,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(197,197,197,1)'}], position: 7750, duration: 500 }            ]
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
})(jQuery, AdobeEdge, "EDGE-135255358");
