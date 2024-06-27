<?php
if ( ! defined( 'ABSPATH' ) ) {exit;}
if(!defined('WP_UNINSTALL_PLUGIN') ) { exit;}

if( !function_exists('wcf_uninstall')){
    function wcf_uninstall(){
        global $wpdb;

        $wpdb->query("drop table {$wpdb->prefix}_answers");
        $wpdb->query("drop table {$wpdb->prefix}_contact");
    }
    wcf_uninstall();
}