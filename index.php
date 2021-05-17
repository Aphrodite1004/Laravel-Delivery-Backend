<?php

if(file_exists('includes/.lic')){
    
 $uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);



require_once __DIR__.'/public/index.php';

}
else{
	$config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
	$config['base_url'] .= "://".$_SERVER['HTTP_HOST'];
	$config['base_url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
	$base = $config['base_url'];
	header('Location: '.$base.'install');
}