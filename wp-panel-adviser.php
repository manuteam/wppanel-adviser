<?php
/**
 * Plugin Name: Panel Adviser
 * Plugin URI: https://manu.team
 * Description: Setup admin panel
 * Version: 1.0.0
 * Author: MANU:TEAM Web Development Services
 * Author URI: https://manu.team
 * Requires PHP: 7.0
 * Tested up to: 5.4
 * Text Domain: wpadviser
*/

// Standard plugin security, keep this line in place.
defined( 'ABSPATH' ) or die();

/**
 * Includes
 */
define( 'WPADW_DIR', dirname( __FILE__ ) . '/' );
define( 'WPADW_URL', plugins_url( '', __FILE__ ) );
define( 'WPADW_DOMAIN', 'wpadviser' );

require_once( WPADW_DIR . 'includes/class-panel-adviser.php' );

function wpadw_activation()
{
    do_action('wpadw_activation');
}

function wpadw_deactivation()
{
    do_action('wpadw_deactivation');
}

register_activation_hook(__FILE__, 'wpadw_activation');
register_deactivation_hook(__FILE__, 'wpadw_deactivation');

new Panel_adviser();