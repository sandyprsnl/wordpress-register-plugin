<?php
/**
 * Plugin Name: Register Plugin
 * Description: The very first plugin that I have ever created.
 * Version: 1.0
 * Author: Sandeep bahrdwaj
 */
defined('ABSPATH') or die();

require_once(wp_normalize_path(ABSPATH).'wp-load.php');

define('PLUGINPATH',plugin_dir_path(__FILE__))."/";
define('PLUGINURL',plugin_dir_url(__FILE__)).'/';

if(file_exists(PLUGINPATH.'init.php')){
    require_once PLUGINPATH.'init.php';
}
if(file_exists(PLUGINPATH.'booking-ajax.php')){
    require_once PLUGINPATH.'booking-ajax.php';
}

// register_activation_hook(__FILE__, 'Register_Activation');
function Register_Activation(){
    Init::register();
}
Register_Activation();