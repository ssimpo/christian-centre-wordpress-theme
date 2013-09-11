<?php
function RPRHAG_script_config(){
    wp_register_script(
        'RPRHAGConfig',
        get_template_directory_uri().'/scripts/jsConfig.php',
        array()
    );
   
    wp_enqueue_script('RPRHAGConfig');
}

function RPRHAG_script_loader(){
    wp_register_script(
        'dojo',
        '//ajax.googleapis.com/ajax/libs/dojo/1.9.1/dojo/dojo.js',
        array('RPRHAGConfig'),
        '1.9.1'
    );     
    wp_register_script(
        'RPRHAGJsRun',
        get_template_directory_uri().'/scripts/jsRun.js',
        array('RPRHAGConfig','dojo')
    );  
        
    wp_enqueue_script('dojo');
    wp_enqueue_script('RPRHAGJsRun'); 
}

function LHM_stylesheet_loaderDojo(){
    wp_register_style(
        'claro',
        '//ajax.googleapis.com/ajax/libs/dojo/1.9.1/dijit/themes/claro/claro.css',
        array(),
        '1.9.1'
    );
    
    wp_enqueue_style('claro');
}

function RPRHAG_stylesheet_loader(){
    wp_register_style(
        'RPRHAGstyle',
        get_template_directory_uri().'/styles/styles.css'
    );
    
    wp_enqueue_style('RPRHAGstyle');
}

add_action('wp_head', 'RPRHAG_stylesheet_loaderDojo', 1);
add_action('wp_head', 'RPRHAG_stylesheet_loader', 5);  
add_action('wp_head', 'RPRHAG_script_config', 2);
add_action('wp_head', 'RPRHAG_script_loader', 5);  
?>