<?php
if (!defined('ABSPATH')) {
    exit;
}
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

if (!function_exists('WC_Uninstall')) {
    function WC_Uninstall()
    {
        global $wpdb;

        $wpdb->query("drop table {$wpdb->prefix}image");
        $wpdb->query("drop table {$wpdb->prefix}carrousel");
    }
    WC_Uninstall();
}
