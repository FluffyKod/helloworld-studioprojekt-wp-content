<?php
/**
 * Admin
 *
 * @package GamiPress\MasterStudy_LMS\Admin
 * @since 1.0.0
 */
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

/**
 * Plugin automatic updates
 *
 * @since  1.0.0
 *
 * @param array $automatic_updates_plugins
 *
 * @return array
 */
function gamipress_masterstudy_lms_automatic_updates( $automatic_updates_plugins ) {

    $automatic_updates_plugins['gamipress-masterstudy-lms-integration'] = __( 'MasterStudy LMS integration', 'gamipress-masterstudy-lms-integration' );

    return $automatic_updates_plugins;
}
add_filter( 'gamipress_automatic_updates_plugins', 'gamipress_masterstudy_lms_automatic_updates' );