<?php
/*
 * Plugin Name:       Carrousel de Imagenes
 * Plugin URI:        https://walterkstro.me/
 * Description:       Plugin para crear y administrar carrouseles de imagenes
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Walter Castro
 * Author URI:        https://walterkstro.me/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       wc
 * Domain Path:       /languages
 */

use App\Clases\WC_Setup;
use App\Controllers\CarrouselController;

require_once(dirname(__FILE__) . "/vendor/autoload.php");

if (!defined('ABSPATH')) {
    exit;
}


register_activation_hook(__FILE__, WC_Setup::WC_Activate());
register_deactivation_hook(__FILE__, WC_Setup::WC_Desactivate());

add_action('admin_menu', WC_Setup::WC_Menu());
add_action('wp_enqueue_scripts', WC_Setup::Assets_public());
add_action('admin_enqueue_scripts', WC_Setup::WC_Load_Assets());


/*
 * Custom Hook para peticiones Ajax
 * 
 */

add_action('wp_ajax_make_carrousel', function () {
    global $wpdb;
    $controller_carrousel = new CarrouselController($wpdb);

    $id_carrousel = $controller_carrousel->createCarrousel($_POST['title']);
    $images = json_decode(stripslashes($_POST['images']), true);

    $controller_carrousel->createCarrouselImages($images, $id_carrousel);
    echo json_encode(['status' => 200, 'message' => 'Carrousel creado exitosamente']);

    wp_die();
});

add_action('wp_ajax_create_images', function () {
    global $wpdb;
    $controller_carrousel = new CarrouselController($wpdb);

    $images = json_decode(stripslashes($_POST['images']), true);
    $id_carrousel = $_POST['id'];

    $controller_carrousel->createCarrouselImages($images, $id_carrousel);
    echo json_encode(['status' => 200, 'message' => 'Carrousel creado exitosamente']);

    wp_die();
});


add_action('wp_ajax_delete_image', function () {
    global $wpdb;
    $controller_carrousel = new CarrouselController($wpdb);
    $status = $controller_carrousel->deleteImage($_POST['id']);

    if($status){
        echo json_encode(['status' => 200, 'message' => 'Imagen eliminada exitosamente']);
    }else {
        echo json_encode(['status' => 500, 'message' => 'No se pudo eliminar la imagen']);
    }

    wp_die();
});

add_action('wp_ajax_delete_carrousel', function () {
    global $wpdb;
    $controller_carrousel = new CarrouselController($wpdb);
    $status_delete_images = $controller_carrousel->deleteImages($_POST['id']);
    $status_delete_carrousel = $controller_carrousel->deleteCarrousel($_POST['id']);

    if($status_delete_carrousel && $status_delete_images){
        echo json_encode(['status' => 200, 'message' => 'Carrousel eliminado exitosamente']);
    }else {
        echo json_encode(['status' => 500, 'message' => 'No se pudo eliminar el carrousel']);
    }

    wp_die();
});


/**
 * Add shortcode
 */
add_action( "init", function(){
    add_shortcode( "wc_carrousel", function($atts){
        global $wpdb;
        $id = $atts['id'];
        $controller_carrousel = new CarrouselController($wpdb);
        $images = $controller_carrousel->getCarrouselImages(sanitize_text_field( $id ));

        if($images){
            ob_start();
                require_once("src/Views/carrousel.php");
            return ob_get_clean();
        }else {
            return '<p>No hay imagenes para mostrar</p>';
        }
    });
});

/**
 * Add type="module" to script
 */
add_filter('script_loader_tag', 'loader_script_with_module', 10, 2);

function loader_script_with_module($tag, $handle){
	
	$defer_handles = ['index-js','execute-carrousel'];

	if ( in_array($handle, $defer_handles) ){
		return str_replace( ' src', ' type="module" src', $tag );	
	}
	return $tag;
}
