define([
    "dojo/_base/declare",
	"dijit/_WidgetBase",
	"dijit/_TemplatedMixin",
	"dojo/parser",
	"dijit/registry",
	"dojo/i18n",
	"dojo/i18n!./nls/expandingMap",
	"dojo/text!./views/expandingMap.html",
	"dojo/text!./views/expandingMap/floatingDiv.html",
	"simpo/widget/expandingDiv",
	"simpo/maps/google/canvas",
	"dojo/dom-construct",
	"dojo/_base/lang",
	"dojo/dom-style",
	"dojo/on",
	"dojo/query",
	"dojo/_base/fx",
	"dojo/fx",
	"dojo/_base/array",
	"dojo/dom-attr"
], function(
    declare, _widget, _templated, parser, registry, i18n, strings,
	template, floatingDiv, expandingDiv, mapCanvas, domConstr, lang, domStyle,
	on, $, fx, fxx, array, domAttr
){
    "use strict";
    
    var construct = declare([_widget, _templated, expandingDiv], {
		// i18n: object
		//		The internationalisation text-strings for current browser language.
		"i18n": strings,
		
		// templateString: string
		//		The loaded template string containing the HTML formatted template for this widget.
		"templateString": template,
		
		"canvas": null,
		
		"_resizingCount": 0,
		"_resizingFactor": 5,
		"_centre": null,
		"_submitDirections": null,
		"_formDirections": null,
		"scroll": true,
		"useAvail": true,
		"availMargin": 50,
		"floatingDiv": null,
		"hiddenDiv": null,
		"clearNode": null,
		"expandToContent":false,
		"_directionsDisplay":null,
		"_directionsService":null,
		"_marker":null,
		"_dialog": null,
		
		postCreate: function(){
			this._init();
			this._initExpandingDiv();
			this._initSize();
			this._initExpandingMap();
		},
		
		_initSize: function(){
			this.set("minHeight", 300);
			this.set("maxHeight", 600);
			this.set("minWidth", 300);
			this.set("maxWidth", 748);
		},
		
		_initExpandingMap: function(){
			this._createMap();
		},
		
		_createFloatingPane: function(){
			this.hiddenNode = domConstr.create("div", {
				"class": "hiddenDiv"
			}, this.domNode);
			this.storageNode = domConstr.create("div", {}, this.hiddenNode);
			this.floatingDiv = domConstr.create("div", {
				"class": "contentSml",
				"style": {
					"width": "300px",
					"position": "absolute",
					"padding": "5px",
					"zIndex": 99
				},
				"innerHTML": floatingDiv
			}, this.hiddenNode);
			this._parseFloatingPlane();
			this._findClearNode();
		},
		
		_parseFloatingPlane: function(node){
			parser.parse(this.floatingDiv).then(lang.hitch(this, function(){
				this._setDirectionsSubmitAttachPoint();
			}));
		},
		
		_setDirectionsSubmitAttachPoint: function(){
			this._submitDirections = registry.byId("googleMapsDirectionSubmit");
			this._formDirections = registry.byId("googleMapsDirectionForm");
			this._dialog = registry.byId("googleMapsDirectionDialog");
			
			this._directionsService = new google.maps.DirectionsService();
			this._directionsDisplay = new google.maps.DirectionsRenderer();
			this._directionsDisplay.setMap(this.canvas.map);
			this._directionsDisplay.setPanel($('#googleMapsDirectionDialogContent')[0]);
			
			on(this._submitDirections, "click", lang.hitch(this,this._getDirections));
		},
		
		_getDirections: function(){
			var value = this._formDirections.get("value");
			var request = {
				origin:value.mapFromPostcode,
				destination:value.mapToPostcode,
				travelMode: google.maps.DirectionsTravelMode.DRIVING
			};
			
			this._directionsService.route(
				request, lang.hitch(this, function(response, status) {
					if (status == google.maps.DirectionsStatus.OK) {
						this._directionsDisplay.setDirections(response);
						this._dialog.show();
						this._dialog.resize();
					}
				}
			));
		},
		
		_initHoverCaptures: function(){
			on(this.domNode, "beforeexpanded", lang.hitch(this, this._storeMapCentre1));
			on(this.domNode, "beforecontracted", lang.hitch(this, this._storeMapCentre2));
			on(this.domNode, "expanded", lang.hitch(this, this.mapExpanded));
			on(this.domNode, "contracted", lang.hitch(this, this.mapContracted));
			on(this.domNode, "resizing", lang.hitch(this, this.mapResizing));
		},
		
		mapExpanded: function(){
			this._resizingCount = 0;
			this._redrawMap();
			this._recentreMap();
			domConstr.place(this.floatingDiv, this.canvas.domNode, "first");
			domStyle.set(this.floatingDiv,"right","40px");
			domStyle.set(this.floatingDiv,"top","40px");
		},
		
		mapContracted: function(){
			this._resizingCount = 0;
			this._redrawMap();
			this._recentreMap();
			domConstr.place(this.floatingDiv, this.hiddenNode);
			this._restoreParentContent();
		},
		
		mapResizing: function(evt){
			if((this._resizingCount % this._resizingFactor) == 0){
				this._redrawMap();
			}
			this._resizingCount++;
		},
		
		_storeMapCentre1: function(){
			if(!this.expanded){
				this._centre = this.canvas.map.getCenter();
				this._moveParentContent();
			}
		},
		
		_storeMapCentre2: function(){
			if(this.expanded){
				this._centre = this.canvas.map.getCenter();
			}
		},
		
		_recentreMap: function(){
			if(this._centre !== null){
				this.canvas.map.setCenter(this._centre);
			}
		},
		
		_redrawMap: function(){
			google.maps.event.trigger(this.canvas.map, "resize");
		},
		
		_createMap: function(){
			this.canvas = new mapCanvas({
				"callback": lang.hitch(this, function(canvas){
					domStyle.set(this.canvas.domNode, "height", "100%");
					domStyle.set(this.canvas.domNode, "width", "100%");
					this._redrawMap();
					this._initHoverCaptures();
					this._createFloatingPane();
					canvas.plot("TS2 1AD", lang.hitch(this, function(marker){
						this._marker = marker;
					}));
					canvas.centre("TS2 1AD");
				})
			});
			domConstr.place(this.canvas.domNode, this.domNode);
		},
		
		_findClearNode: function(){
			$("*", this.domNode.parentNode).forEach(function(node){
				if((node.parentNode == this.domNode.parentNode) && (node != this.domNode)){
					if(domAttr.get(node, "class") == "clear"){
						this.clearNode = node;
					}
				}
			}, this);
		},
		
		_moveParentContent: function(){
			$("*", this.domNode.parentNode).forEach(function(node){
				if((node.parentNode == this.domNode.parentNode) && (node != this.domNode) && (node != this.clearNode)){
					domConstr.place(node, this.storageNode);
				}
			}, this);
		},
		
		_restoreParentContent: function(){
			$("*", this.storageNode).forEach(function(node){
				if(node.parentNode == this.storageNode){
					domConstr.place(node, this.domNode.parentNode);
				}
			}, this);
			domConstr.place(this.clearNode, this.domNode.parentNode);
		}
    });
    
    return construct;
});