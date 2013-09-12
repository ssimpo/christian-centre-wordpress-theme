// summary:
//		
// description:
//
define([
	"dojo/_base/declare",
	"dijit/_WidgetBase",
	"dijit/_TemplatedMixin",
	"dojo/dom-style",
	"dojo/dom-construct",
	"dojox/timing",
	"dojo/_base/lang",
	"dojo/_base/fx",
	"dojo/fx",
	"dojo/_base/array"
], function(declare, _widget, _templated, domStyle, domConstruct, timer, lang, fx, coreFx, array) {
    
    var construct = declare([_widget,_templated],{
		templateString:'<div class="dojoSimpoWidgetSlideshow" data-dojo-attach-point="container"></div>',
		height:0,
		width:0,
		images:[
			'wp-content/themes/RPRHAG/media/images/slideshow/KayleighAndJosephine.jpg',
			'wp-content/themes/RPRHAG/media/images/slideshow/LukeGreen.jpg',
			'wp-content/themes/RPRHAG/media/images/slideshow/Banners.jpg',
			'wp-content/themes/RPRHAG/media/images/slideshow/ChrisAndEloise.jpg',
			'wp-content/themes/RPRHAG/media/images/slideshow/Coffee.jpg',
			'wp-content/themes/RPRHAG/media/images/slideshow/Luke.jpg',
			'wp-content/themes/RPRHAG/media/images/slideshow/Stephen.jpg',
			'wp-content/themes/RPRHAG/media/images/slideshow/Mal.jpg',
			'wp-content/themes/RPRHAG/media/images/slideshow/Reception.jpg',
			'wp-content/themes/RPRHAG/media/images/slideshow/Sarah.jpg'
		],
		
		_img:{},
		_currentImage:0,
		_timer:{},
		_imageNodes:[],
		
		postCreate: function() {
			this._hiddenDiv = domConstruct.create("div",{'style':{'visibility':'hidden','width':'0px','height':'0px','overflow':'hidden'}});
			array.forEach(this.images,function(src,n){
				this._imageNodes[n] = domConstruct.create("img",{
					'src':src,
					'width':'350px',
					'height':'350px',
					'alt':'Ignite Images'
				});
			},this);
			domConstruct.place(this._imageNodes[this._currentImage],this.domNode);
			this._timer = new timer.Timer(5000);
			this._timer.onTick = lang.hitch(this,this.next);
			this._timer.start();
		},
		
		next: function() {
			domConstruct.place(this._imageNodes[this._currentImage],this._hiddenDiv);
			this._currentImage++;
			if (this._currentImage >= this.images.length) {
				this._currentImage = 0;
			}
			domConstruct.place(this._imageNodes[this._currentImage],this.container);
		}
	});
    
    return construct;
});