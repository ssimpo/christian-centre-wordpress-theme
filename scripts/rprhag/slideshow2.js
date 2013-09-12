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
	"dojo/i18n!./nls/slideshow",
	"dojo/text!./views/slideshow.html",
	"simpo/typeTest",
	"dojo/dom-style",
	"dojo/_base/array",
	"dojo/dom-construct",
	"dojo/_base/fx",
	"dojo/fx",
	"dojo/_base/lang",
	"dojo/on",
	"dojo/Deferred"
], function(
	declare, _widget, _templated, _wTemplate, i18n, strings, template,
	typeTest, domStyle, array, domConstr, fx, coreFx, lang, on, Deferred
) {
	"use strict";
	
	var construct = declare([_widget, _templated, _wTemplate], {
		// i18n: object
		//		The internationalisation text-strings for current browser language.
		"i18n": strings,
		
		// templateString: string
		//		The loaded template string containing the HTML formatted template for this widget.
		"templateString": template,
		
		"src": null,
		
		"width": 0,
		"height": 0,
		"slices": 10,
		
		"_slideWidths": null,
		"_slices": null,
		
		"_in": true,
		"_currentSlide": 0,
		"_timeout": null,
		
		_setSrcAttr: function(value){
			if(typeTest.isArray(value)){
				array.forEach(value, function(src, n){
					//value[n] = this._convertToFullPath(value[n])
				}, this);
				this.src = value;
			}
		},
		
		_setWidthAttr: function(value){
			if(!typeTest.isBlank(value)){
				this.width = value;
				domStyle.set(this.domNode, "width", value+"px");
			}
		},
		
		_setHeightAttr: function(value){
			if(!typeTest.isBlank(value)){
				this.height = value;
				domStyle.set(this.domNode, "height", value+"px");
			}
		},
		
		_setSlicesAttr: function(value){
			if(!typeTest.isBlank(value)){
				this.slices = value;
				this._setSliceWidths(value);
				this._createSlices();
			}
		},
		
		_setSliceWidths: function(sliceCount){
			var sliceWidth = parseInt((this.get("width")/sliceCount), 10);
			var leftOver = (this.get("width")%sliceCount);
			var sliceWidths = new Array();
			
			for(var i = 0; i < sliceCount; i++){
				sliceWidths[i] = sliceWidth;
			}
			sliceWidths[0] += (parseInt((leftOver/2), 10) + (leftOver%2));
			sliceWidths[sliceWidths.length -1] += parseInt((leftOver/2), 10);
			
			this._slideWidths = sliceWidths;
		},
		
		_createSlices: function(){
			var position = 0;
			this._slices = new Array();
			
			array.forEach(this._slideWidths, function(width){
				var div = domConstr.create("div", {
					"class": "dojoLhSlideshowSlice",
					"style":{
						"position": "absolute",
						"zIndex": 1,
						"left": position + "px",
						"width": "0px",
						"height": this.height + "px"
					}
				});
				domConstr.place(div, this.domNode);
				this._slices.push(div);
				position += width;
			}, this);
		},
		
		_addImageToSlice: function(src){
			var position = 0;
			
			array.forEach(this._slices, function(slice, n){
				domStyle.set(slice,{
					"backgroundImage": "url('"+src+"')",
					"backgroundPosition": position+"px 0px",
					"backgroundSize": this.get("width").toString()+"px "
						+this.get("height").toString()+"px"
				});
				
				position -= this._slideWidths[n];
			}, this);
		},
		
		_addImageToBackground: function(src){
			domStyle.set(this.domNode, {
				"backgroundImage":"url('"+src+"')",
				"backgroundSize": this.get("width").toString()+"px "
					+this.get("height").toString()+"px"
			});
		},
		
		slideIn: function(){
			var def = new Deferred();
			var animations = new Array();
			
			array.forEach(this._slices, function(slice, n){
				animations[n] = fx.animateProperty({
					"node": slice,
					"properties": {
						"width": {
							"start":0,
							"end": this._slideWidths[n],
							"units":"px",
							
						},
						"opacity": {
							"start": 0,
							"end": 1
						}
					},
					"duration": 3000
				});
			}, this);
			
			var animation = coreFx.combine(animations);
			animation.onEnd = function(){
				def.resolve();
			}
			animation.play();
			
			return def;
		},
		
		slideOut: function(){
			var def = new Deferred();
			var animations = new Array();
			
			array.forEach(this._slices, function(slice, n){
				animations[n] = fx.animateProperty({
					"node": slice,
					"properties": {
						"width": {
							"start":this._slideWidths[n],
							"end": 0,
							"units":"px",
							
						},
						"opacity": {
							"start": 1,
							"end": 0
						}
					},
					"duration": 3000
				});
			}, this);
			
			var animation = coreFx.combine(animations);
			animation.onEnd = function(){
				def.resolve();
			}
			animation.play();
			
			return def;
		},
		
		_callSlide: function(){
			if(this._timeout !== null){
				clearTimeout(this._timeout);
			}
			
			setTimeout(
				lang.hitch(this, this.slide),
				3000
			);
		},
		
		slide: function(){
			if(this._in){
				var src = this._nextSrc();
				this._addImageToSlice(src);
				this.slideIn().then(lang.hitch(this, function(){
					this._callSlide();
				}));
				this._in = false;
			}else{
				var src = this._nextSrc();
				this._addImageToBackground(src);
				this.slideOut().then(lang.hitch(this, function(){
					this._callSlide();
				}));
				this._in = true;
			}
		},
		
		_nextSrc: function(){
			this._currentSlide++;
			if(this._currentSlide > (this.src.length - 1)){
				this._currentSlide = 0;
			}
			
			return this.src[this._currentSlide];
		},
		
		postCreate: function(){
			var src = this._nextSrc();
			this._addImageToBackground(src);
			this._callSlide();
		},
		
		_convertToFullPath: function(path){
			return location.protocol + '//' + location.hostname + location.pathname.split('/').slice(0,-1).join('/')+"/" + path;
		},
	});
	
	return construct;
});