var Component = new Brick.Component();
Component.requires = {
    mod: [
        {name: '{C#MODNAME}', files: ['lib.js']}
    ]
};
Component.entryPoint = function(NS){
    var Y = Brick.YUI,
        COMPONENT = this,
        SYS = Brick.mod.sys;

    NS.LineWidget = Y.Base.create('LineWidget', SYS.AppWidget, [], {
        buildTData: function(){
            return {
                itemURL: this.get('itemURL'),
                itemTitle: this.get('itemTitle')
            };
        }
    }, {
        ATTRS: {
            component: {value: COMPONENT},
            templateBlockName: {value: 'widget'},
            itemURL: {value: ''},
            itemTitle: {value: ''},
        },
    });
};