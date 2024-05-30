<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Setup_wfc')) {
    class Setup_wfc
    {
        public static function activate()
        {
            global $wpdb;

            $table_form = "create table if not exists {$wpdb->prefix}_form(
                id int not null auto_increment,
                name varchar(200),
                email varchar(100),
                date date,
                primary key(id)
            )";

            $wpdb->query($table_form);

            $table_answers = "create table if not exists {$wpdb->prefix}_answers(
                id int not null auto_increment,
                first_name varchar(200) not null,
                phone varchar(8) not null,
                email varchar(100) not null,
                date date not null,
                message text not null,
                form_id int not null,
                primary key(id)
            )";

            $wpdb->query($table_answers);

            // agregar Foreign Key
            $wpdb->query("alter table {$wpdb->prefix}_answers add constraint fk_contact_id foreign key (contact_id) references {$wpdb->prefix}_form(id);");
        }

        public static function desactivate()
        {
            flush_rewrite_rules();
        }

        public static function load_files()
        {
            return function ($path) {
                if ($path != 'wcf/admin/index.php') return; // los assets solo deben cargarse en el plugin no en todo Wordpress

                wp_enqueue_style('bootstrap-css', plugins_url('../assets/css/bootstrap.min.css', __FILE__));
                wp_enqueue_style('sweetalert-css', plugins_url('../assets/css/sweetalert2.min.css', __FILE__));
                wp_enqueue_script('bootstrap-js', plugins_url('../assets/js/bootstrap.min.js', __FILE__),[],1,true);
                wp_enqueue_script('sweetalert-js', plugins_url('../assets/js/sweetalert2.min.js', __FILE__), array('jquery'),1,true);
                wp_enqueue_script('wc-index', plugins_url('../assets/js/index.js', __FILE__),[],time(),true);
                wp_enqueue_script('ajax-requests', plugins_url('../assets/js/ajax-requests.js', __FILE__),array('jquery'),true);

                /*localizar el script para peticiones AJAX*/
                wp_localize_script("wc-index","object_js",[
                    'ajax_url' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('kstro'),
                    'hook' => 'make_request_ajax'
                ]);
            };
        }
    }
}
