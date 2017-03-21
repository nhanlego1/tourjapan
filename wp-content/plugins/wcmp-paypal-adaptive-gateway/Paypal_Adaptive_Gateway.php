<?php
/*
* Plugin Name: WCMp Paypal Adaptive Gateway
* Plugin URI: http://wc-marketplace.com/
* Description: WCMp Paypal Adaptive Gateway is a payment gateway for woocommerce shopping plateform also compatible with WC Marketplace.
* Author: WC Marketplace, The Grey Parrots
* Version: 1.0.1
* Author URI: http://wc-marketplace.com/
* Text Domain: wcmp-paypal-adaptive-gateway
* Domain Path: /languages/
*/

if ( ! class_exists( 'WCMp_WC_Dependencies' ) ) {
    require_once trailingslashit(dirname(__FILE__)).'includes/class-WCMp-wc-dependencies.php';
}
require_once trailingslashit(dirname(__FILE__)).'includes/WCMp-Paypal-Adaptive-Gateway-core-functions.php';
require_once trailingslashit(dirname(__FILE__)).'Paypal_Adaptive_Gateway_config.php';
if(!defined('ABSPATH')) exit; // Exit if accessed directly
if(!defined('WCMp_PAYPAL_ADAPTIVE_GATEWAY_PLUGIN_TOKEN')) exit;
if(!defined('WCMp_PAYPAL_ADAPTIVE_GATEWAY_TEXT_DOMAIN')) exit;

if(!WCMp_WC_Dependencies::woocommerce_active_check()) {
  add_action( 'admin_notices', 'woocommerce_WCMp_pag_alert_notice' );
}
else {

    if(!class_exists('WCMp_Paypal_Adaptive_Gateway')) {
        require_once( trailingslashit(dirname(__FILE__)).'classes/class-WCMp-Paypal-Adaptive-Gateway.php' );
        global $WCMp_Paypal_Adaptive_Gateway;
        $WCMp_Paypal_Adaptive_Gateway = new WCMp_Paypal_Adaptive_Gateway( __FILE__ );
        $GLOBALS['WCMp_Paypal_Adaptive_Gateway'] = $WCMp_Paypal_Adaptive_Gateway;
        // Activation Hooks
        register_activation_hook( __FILE__, array('WCMp_Paypal_Adaptive_Gateway', 'activate_WCMp_Paypal_Adaptive_Gateway') );
        register_activation_hook( __FILE__, 'flush_rewrite_rules' );
        // Deactivation Hooks
        register_deactivation_hook( __FILE__, array('WCMp_Paypal_Adaptive_Gateway', 'deactivate_WCMp_Paypal_Adaptive_Gateway') );
    }
}
?>
