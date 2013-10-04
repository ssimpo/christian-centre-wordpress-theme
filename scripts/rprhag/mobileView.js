// summary:
//
// description:
//
// author:
//		Stephen Simpson <me@simpo.org>, <http://simpo.org>
define([
	"dojo/_base/declare",
	"dijit/_WidgetBase",
	"dijit/_TemplatedMixin",
	"dijit/_WidgetsInTemplateMixin",
	"dojo/i18n",
	"dojo/i18n!./nls/mobileView",
	"dojo/text!./views/mobileView.html",
	"dojo/window",
	"dojo/_base/window",
	"dojo/dom-style",
	"dojo/on",
	"dojo/_base/lang",
	"dojox/gesture/swipe",
	"dojo/dom-geometry",
	"dojo/fx",
	"dojo/Deferred",
	"dojo/dom-class",
	"dojo/query",
	"dojo/dom-construct",
	"dijit/form/Button",
	"dojo/_base/array"
], function(
	declare, _widget, _templated, _wTemplate, i18n, strings, template,
	win, dojoWin, domStyle, on, lang, swipeEvent, domGeom, coreFx, Deferred,
	domClass, $, domConstr, Button, array
) {
	"use strict";
	
	var construct = declare([_widget, _templated, _wTemplate], {
		// i18n: object
		//		The internationalisation text-strings for current browser language.
		"i18n": strings,
		
		// templateString: string
		//		The loaded template string containing the HTML formatted template for this widget.
		"templateString": template,
		
		"margin":0,
		
		"height":null,
		"width": null,
		
		"_menuShowing":false,
		"menuWidth": 200,
		"_slideDeferred":null,
		
		"_header": null,
		"_menuButton": null,
		"_aside": null,
		
		/*constructor: function(){
			domConstr.destroy($("body>.main>div>footer")[0]);
			domConstr.destroy($("body>.main>div>header")[0]);
			domConstr.destroy($("body>.main>aside")[0]);
		},*/
		
		postCreate: function(){
			this._setHeightWidth();
			this._setStyles();
			
			this._header = domConstr.create("header",{
				"class":"mobileViewHeader",
				"style": {
					"width": this.width + "px"
				}
			}, dojoWin.body());
			
			this._menuButton = new Button({
				"label": "Menu",
				"class": "primary"
			});
			domConstr.place(this._menuButton.domNode, this._header);
			
			this._aside = domConstr.create("aside",{
				"class":"mobileViewSlideMenu",
				"style": {
					"width": this.menuWidth + "px",
					"left": (this.menuWidth*-1) + "px"
				}
			}, dojoWin.body());
			
			array.forEach($("nav.metromenu a.metro"), function(metroButton){
				domConstr.place(metroButton, this._aside);
				domStyle.set(metroButton, "visibility", "visible");
			}, this);
			
			on(this._menuButton, "click", lang.hitch(this, this.menuSlide));
			
			this._setSwipeCapture();
		},
		
		_setHeightWidth: function(){
			var winSize = win.getBox();
			
			this.width = winSize.w;
			this.height = winSize.h;
		},
		
		_setStyles: function(){
			domStyle.set(this.domNode, {
				"width": (this.width - (this.margin*2))+ "px"
			});
		},
		
		_setSwipeCapture: function() {
			on(this.domNode, swipeEvent,
			    lang.hitch(this, function(evt){
					this.swipe(evt.dy);
				})
			);
		},
		
		menuSlide: function(){
			if(this._slideDeferred === null){
				this._slideDeferred = new Deferred();
				
				if(!this._menuShowing){
					domClass.add(this.domNode, "leftEdge");
					domClass.add(this._header, "leftEdge");
				}
				
				var cy = domStyle.get(this.domNode, "top").toString().replace("px","");
				coreFx.combine([
					coreFx.slideTo({
						"node": this.domNode,
						"onEnd": lang.hitch(this, this._slideEnd, this._slideDeferred),
						"duration": 400,
						"unit": "px",
						"left": (this._menuShowing)?0:this.menuWidth,
						"top": cy
					}),
					coreFx.slideTo({
						"node": this._header,
						"duration": 400,
						"unit": "px",
						"left": (this._menuShowing)?0:this.menuWidth,
						"top": 0
					}),
					coreFx.slideTo({
						"node": this._aside,
						"duration": 400,
						"unit": "px",
						"left": (this._menuShowing)?(this.menuWidth*-1):0,
						"top": 0
					})
				]).play();
			
				this._slideDeferred.then(function(){
					
				})
			}
		},
		
		_slideEnd: function(def){
			this._menuShowing = !this._menuShowing;
			if(!this._menuShowing){
				domClass.remove(this.domNode, "leftEdge");
				domClass.remove(this._header, "leftEdge");
			}
			def.resolve();
			this._slideDeferred = null;
		},
		
		swipe: function(amount){
			var cy = domStyle.get(this.domNode, "top").toString().replace("px","");
			var maxY = domGeom.getContentBox(this.domNode);
			
			cy++; cy--;
			cy += amount;
			cy = ((cy > 50)?50:cy);
			cy = ((cy < ((maxY.h*-1)+this.height-this.margin))?maxY.y:cy);
			
			domStyle.set(this.domNode,"top",cy + "px");
		}
	});
	
	return construct;
});