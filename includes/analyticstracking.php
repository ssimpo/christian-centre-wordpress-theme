<script type="text/javascript">
  var googleAnalyticsBlockUsers = new Array('Admin','stephen');
  var googleAnalyticsBlockUser = false;

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  
  ga('create', 'UA-44458039-1', 'thechristiancentre.org.uk');
  ga(function(tracker) {
	for(var i = 0; i < googleAnalyticsBlockUsers.length; i++){
	  if(user.username === googleAnalyticsBlockUsers[i]){
		googleAnalyticsBlockUser = true;
		if(typeof console == "object"){
		  console.info("NOT TRACKING USER: ", user.username);
		}
	  }
	}
	
	if(!googleAnalyticsBlockUser){
	  var utm_campaign = tracker.get('campaignName');
	  var utm_source = tracker.get('campaignSource');
	  var utm_medium = tracker.get('campaignMedium');
	  var utm_term = tracker.get('campaignKeyword');
	 
	  function setCampaign(value){
		if((utm_campaign !== null)&&(utm_campaign !== undefined)&&(utm_campaign !== "")&&(utm_campaign !== false)){
		  utm_campaign = value;
		}
	  }
	  
	  function setSource(value){
		if((utm_source !== null)&&(utm_source !== undefined)&&(utm_source !== "")&&(utm_source !== false)){
		  utm_source = value;
		}
	  }
	 
	  function setMedium(value){
		if((utm_medium !== null)&&(utm_medium !== undefined)&&(utm_medium !== "")&&(utm_medium !== false)){
		  utm_medium = value;
		}
	  }
	  
	  function setTerm(value){
		if((utm_term !== null)&&(utm_term !== undefined)&&(utm_term !== "")&&(utm_term !== false)){
		  utm_term = value;
		}
	  }
	  
	  function parseUri (str) {
		// parseUri 1.2.2
		// (c) Steven Levithan <stevenlevithan.com>
		// MIT License
		
		var o   = parseUri.options,
			m   = o.parser[o.strictMode ? "strict" : "loose"].exec(str),
			uri = {},
			i   = 14;
		
		while (i--) uri[o.key[i]] = m[i] || "";
		uri[o.q.name] = {};
		uri[o.key[12]].replace(o.q.parser, function ($0, $1, $2) {
		  if ($1) uri[o.q.name][$1] = $2;
		});
		return uri;
	  };
	  
	  parseUri.options = {
		strictMode: false,
		key: ["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"],
		q: {
		  name:   "queryKey",
		  parser: /(?:^|&)([^&=]*)=?([^&]*)/g
		},
		parser: {
		  strict: /^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,
		  loose:  /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/
		}
	  };
	  
	  try{
		var host = parseUri(document.referrer).host;
		var query = parseUri(document.referrer).query;
		var values = parseUri(document.referrer).queryKey;
	  
		if((host.search(/google/) != -1) && (query.search(/q\=/) != -1)){
		  setCampaign("organic search");
		  setSource("google");
		  setMedium("search engine");
		}
		if((host.search(/bing/) != -1) && (query.search(/q\=/) != -1)){
		  setCampaign("organic search");
		  setSource("bing");
		  setMedium("search engine");
		}
		if((host.search(/yahoo/) != -1) && (query.search(/p\=/) != -1)){
		  setCampaign("organic search");
		  setSource("yahoo");
		  setMedium("search engine");
		  queryKey.q = queryKey.p;
		}
		if(host.search(/facebook/) != -1){
		  setCampaign("organic social media");
		  setSource("facebook");
		  setMedium("social media");
		}
		if(host.search(/twitter/) != -1){
		  setCampaign("organic social media");
		  setSource("twitter");
		  setMedium("social media");
		}
		if(host.search(/t\.co/) != -1){
		  setCampaign("organic social media");
		  setSource("twitter");
		  setMedium("social media");
		}
	  
		if(utm_medium === "search engine"){
		  if((queryKey.q.search(/\bchurch(?:es|s|)\b/) != -1)&&(queryKey.p.search(/\bmiddlesbrough\b/) != -1)){
			setTerm("middlesbrough churches");
		  }
		  if((queryKey.q.search(/\bchurch(?:es|s|)\b/) != -1)&&(queryKey.p.search(/\bteesside\b/) != -1)){
			setTerm("teesside churches");
		  }
		  if((queryKey.q.search(/\bchurch(?:es|s|)\b/) != -1)&&(queryKey.p.search(/\btees(?:\-| |)valley\b/) != -1)){
			setTerm("tee-valley churches");
		  }
		  if(queryKey.q.search(/\bapostolic\b/) != -1){
			setTerm("apostolic");
		  }
		  if((queryKey.q.search(/\bpaul\b/) != -1)&&(queryKey.p.search(/\bhowells\b/) != -1)){
			setTerm("paul howells");
		  }
		}
	  }catch(e){
	  }
		
	  if(utm_campaign !== ""){
		ga('set', 'campaignName', utm_campaign);
	  }
	  if(utm_source !== ""){
		ga('set', 'campaignSource', utm_source);
	  }
	  if(utm_medium !== ""){
		ga('set', 'campaignMedium', utm_medium);
	  }
	  if(utm_term !== ""){
		ga('set', 'campaignKeyword', utm_term);
	  }
	  
	  ga('send', 'pageview');
	}
  });
</script>