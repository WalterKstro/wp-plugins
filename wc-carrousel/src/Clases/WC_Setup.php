<?php

namespace App\Clases;

if (!defined('ABSPATH')) {
    exit;
}


if (!class_exists("WC_Setup")) {
    class WC_Setup
    {
        public static function WC_Activate()
        {
            return function () {
                global $wpdb;

                $table_carrousel = "create table if not exists {$wpdb->prefix}carrousel(
                id int not null auto_increment,
                name varchar(100),
                date date,
                primary key(id)
            )";

                $wpdb->query($table_carrousel);

                $table_image = "create table if not exists {$wpdb->prefix}image(
                id int not null auto_increment,
                carrousel_id int,
                name varchar(100),
                wordpress_media_id int,
                url varchar(100),
                primary key(id)
            )";

                $wpdb->query($table_image);
                $wpdb->query("alter table {$wpdb->prefix}image add constraint fk_carrousel_id foreign key (carrousel_id) references {$wpdb->prefix}carrousel(id);");
            };
        }

        public static function WC_Load_Assets()
        {
            return function ($path) {
                
                if ($path != 'wc-carrousel/src/admin/index.php' && $path != 'wc-carrousel/src/admin/editar.php') return; // los assets solo deben cargarse en el plugin no en todo Wordpress
                
                wp_enqueue_style('tailwind-css', plugins_url('../assets/css/style.css', __FILE__),[],time(),"all");
                wp_enqueue_script('tw-elements', plugins_url('../../node_modules/tw-elements/js/tw-elements.umd.min.js', __FILE__), array('jquery'), 1, true);
                wp_enqueue_style('sweetalert-css', plugins_url('../assets/css/sweetalert2.min.css', __FILE__));
                wp_enqueue_script('bootstrap-js', plugins_url('../assets/js/bootstrap.min.js', __FILE__), [], 1, true);
                wp_enqueue_script('sweetalert-js', plugins_url('../assets/js/sweetalert2.min.js', __FILE__), array('jquery'), 1, true);
                wp_enqueue_script('index-js', plugins_url('../assets/js/index.js',__FILE__), ['tw-elements'], time(), true);


                /* para utilizar la interfaz de medios de Wordpress */
                wp_enqueue_media();

                /*Make requests AJAX*/
                wp_localize_script("index-js", "objectJs", [
                    'url' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('kstro'),
                    'hook' => 'make_carrousel',
                ]);

                wp_localize_script("index-js", "ajaxObjectImages", [
                    'url' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('kstro'),
                    'hook' => 'create_images',
                ]);

                wp_localize_script("index-js", "objectDelete", [
                    'url' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('kstro'),
                    'hook' => ['delete_image','delete_carrousel'],
                ]);

            };
        }

        public static function Assets_public(){
            return function($path){
                wp_enqueue_style('twcss', "/wp-content/plugins/wc-carrousel/node_modules/tw-elements/css/tw-elements.min.css",[],time(),"all");
                wp_enqueue_script('execute-carrousel', plugins_url('../assets/js/executeCarrousel.js', __FILE__), [], time(), true);
            };
        }

        public static function WC_Menu()
        {
            return function () {
                add_menu_page(
                    "WC Carrousel",
                    "WC Carrousel",
                    "manage_options",
                    plugin_dir_path(__DIR__) . 'admin/index.php',
                    "",
                    "dashicons-format-gallery",
                    140,
                );

                add_submenu_page(
                    " ", // debe ser un string con espacio
                    "Imagenes del carrousel",
                    "",
                    "manage_options",
                    plugin_dir_path(__DIR__) . 'admin/editar.php',
                    "",
                    null,
                );
            };
        }
        public static function WC_Desactivate()
        {
            return function(){flush_rewrite_rules();};
        }
    }
}
