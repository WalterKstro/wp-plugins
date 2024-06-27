<?php
/*
 * Plugin Name:       Contact Form
 * Plugin URI:        https://walterkstro.me/
 * Description:       Plugin para manejar un formulario de contacto
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Walter Castro
 * Author URI:        https://walterkstro.me/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       wcf
 * Domain Path:       /languages
 */

if (!defined('ABSPATH')) {
    exit;
}
require_once('clases/Setup.php');
require_once('templates/Templates.php');
require_once('clases/Database.php');

/** ACTIVAR EL PLUGIN */
if (!function_exists('wcf_activation')) {
    function wcf_activation()
    {
        Setup_wfc::activate();
    }
    register_activation_hook(__FILE__, 'wcf_activation');
}

/** DESACTIVAR EL PLUGIN */
if (!function_exists('wcf_desactivation')) {
    function wcf_desactivation()
    {
        Setup_wfc::desactivate();
    }
    register_deactivation_hook(__FILE__, 'wcf_desactivation');
}

/** AGREGAR EL MENU AL PANEL DE ADMINISTRACION DE WORDPRESS */
if (!function_exists('wcf_add_menu')) {
    function wcf_add_menu()
    {
        add_menu_page(
            "WCF",
            "WCF",
            "manage_options",
            plugin_dir_path(__FILE__) . 'admin/index.php',
            null,
            "dashicons-screenoptions"
        );
    }
    add_action('admin_menu', 'wcf_add_menu');
}


/* REGISTRO DE SHORTCODE */
if( !function_exists('wcf_register_shortcode') ) {
    function wcf_register_shortcode(){
        add_shortcode('wfc_form', 'execute_shortcode');
    }
    add_action('init', 'wcf_register_shortcode');
}
/* EJECUCION DE LA LOGICA DEL SHOTCODE */
if( !function_exists('execute_shortcode') ) {
    function execute_shortcode($args, $content){
        require_once(dirname(__FILE__)."/templates/alerts/validation.php");
        return WFC_Templates::getTemplateForm($args["id"]);
    }
}

/** CARGAR LOS ASSETS DEL PLUGIN */
add_action('admin_enqueue_scripts', Setup_wfc::load_files());


/**
 * wp_ajax_nopriv: Hook para usuarios no logueados
 */
add_action('wp_ajax_nopriv_make_request_ajax',function(){
    global $wpdb;
    $request = new WFC_Database($wpdb);
    $answers = $request->getAnswers($_POST['idForm']);
    
    echo WFC_Templates::getTemplateMessages($answers);
    wp_die();
});

/**
 * wp_ajax_: Hook para usuarios logueados
 */
add_action('wp_ajax_make_request_ajax',function(){
    global $wpdb;
    $request = new WFC_Database($wpdb);
    $answers = $request->getAnswers($_POST['idForm']);
    
    echo WFC_Templates::getTemplateMessages($answers);
    wp_die();
});
