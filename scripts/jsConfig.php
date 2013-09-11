<?php

   //Let's set the header straight
   header('Content-type: text/javascript');

   //Get the WP-specifics, so that we can use constants and what not
   $home_dir = preg_replace('^wp-content/themes/[a-zA-Z0-9\-/]+^', '', getcwd());
   include($home_dir . 'wp-load.php');
?>

var themePath = "<?php echo get_template_directory_uri(); ?>";
var pluginsPath = "<?php echo plugins_url(); ?>";
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
var customModulesPath = themePath + "/scripts";
var dojoReleasePath = "/"

var dojoConfig = {
	"async": true,
	"cacheBust": new Date(),
	"parseOnLoad": false,
    "baseUrl": customModulesPath+dojoReleasePath,
    "dojoBlankHtmlUrl": "<?php echo get_template_directory_uri(); ?>/scripts/resources/blank.html",
	"packages": [
		{"name": "lib", "location": customModulesPath+dojoReleasePath+"lib"},
		{"name": "simpo", "location": customModulesPath+dojoReleasePath+"simpo"},
		{"name": "rprhag", "location": customModulesPath+dojoReleasePath+"rprhag"}
	]
};