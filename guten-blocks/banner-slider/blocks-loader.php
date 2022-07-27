<?php
/*
Plugin Name: Bloco Gutenberg Livro
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
        include 'buddyboss-app-custom-block.php';
        BuddyBossApp\Custom\BookBlock::instance();
    }
}
add_action( 'plugins_loaded', 'bbapp_custom_work_init' );
?>