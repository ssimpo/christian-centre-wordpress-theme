var profile = {
	basePath: "./",
    releaseDir: "release",
	releaseName: "live",
	action: "release",
	
	layerOptimize: "shrinksafe",
	optimize: "shrinksafe",
	//layerOptimize: "closure",
	//optimize: "closure",
	cssOptimize: "comments",
	mini: false,
	insertAbsMids: false,
	
	staticHasFeatures: {
		"host-node": false,
		"host-rhino": false,
		"host-browser": undefined,
		"dom": undefined,
		"dojo-cdn": false,
		"dojo-sniff": undefined
	},
	
	packages: [
		{ name: "lib", location :"lib" },
		{ name: "simpo", location :"simpo" },
		{ name: "rprhag", location : "rprhag" }
	]
}