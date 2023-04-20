<?php
// If uninstall is not called from WordPress, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}

// Drop a custom db table
global $wpdb;
$table_TPTapa   = $wpdb->prefix . 'TPTapa';
$wpdb->query( "DROP TABLE IF EXISTS {$table_TPTapa}" );

$wpdb->delete($wpdb->posts, array('post_title' => 'widget tapas de diarios','post_type'=>'page'));
