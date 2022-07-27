<?php
/*
Plugin Name: Bloco Banner Slider
Description: Teste
Version: 1.0.0
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit();
}
 
/**
 * Load Custom Block Functions
 */
function bbapp_custom_work_init() {
    if ( class_exists( 'bbapp' ) ) {
        include 'banner-slider-block.php';
        BuddyBossApp\Custom\BookBlock::instance();
    }
}
add_action( 'plugins_loaded', 'bbapp_custom_work_init' );
?>