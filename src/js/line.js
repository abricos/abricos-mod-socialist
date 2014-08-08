/*
@package Abricos
@license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

var Component = new Brick.Component();
Component.requires = {
	mod:[
        {name: 'widget', files: ['lib.js']}
	]
};
Component.entryPoint = function(NS){
	
	var L = YAHOO.lang;
	var buildTemplate = this.buildTemplate;
	
	var LineWidget = function(container, cfg){
		cfg = L.merge({
			'url': '',
			'title': ''
		}, cfg || {});
		LineWidget.superclass.constructor.call(this, container, {
			'buildTemplate': buildTemplate, 'tnames': 'line' 
		}, cfg);
	};
	YAHOO.extend(LineWidget, Brick.mod.widget.Widget, {
		buildTData: function(cfg){
			return {
				'url': cfg['url'],
				'titleuri': cfg['title']
			};
		}
	});
	NS.LineWidget = LineWidget;
};