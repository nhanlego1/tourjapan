<?php
/**
 * Plugin Name: WooCommerce PayPal Adaptive Payments For Japan
 * Plugin URI: https://wordpress.org/plugins/woo-paypal-adaptive-payments-for-japan/
 * Description: PayPal Adaptive Payments integration for WooCommerce in Japan
 * Version: 1.0.4
 * Author: ArtisanWorkshop
 * Author URI: http://wc.artws.info
 * Text Domain: woocommerce-gateway-paypal-adaptive-payments
 * Domain Path: /i18n
 *
 * @package  WC4JP_PayPal_Adaptive_Payments
 * @category Core
 * @author   ArtisanWorkshop and PayPal Japan
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'WC4JP_PayPal_Adaptive_Payments' ) ) :

/**
 * WooCommerce PayPal Adaptive Payments main class.
 */
class WC4JP_PayPal_Adaptive_Payments {

	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	const VERSION = '1.0.4';

	/**
	 * Instance of this class.
	 *
	 * @var object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin public actions.
	 */
	private function __construct() {
		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Checks with WooCommerce is installed.
		if ( class_exists( 'WC_Payment_Gateway' ) ) {
			$this->includes();

			if ( is_admin() ) {
				$this->admin_includes();
			}

			add_filter( 'woocommerce_payment_gateways', array( $this, 'add_gateway' ) );
		} else {
			add_action( 'admin_notices', array( $this, 'woocommerce_missing_notice' ) );
		}
	}

	/**
	 * Return an instance of this class.
	 *
	 * @return object A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Load the plugin text domain for translation.
	 */
	public function load_plugin_textdomain() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'wc4jp-paypal-adaptive' );

		load_textdomain( 'wc4jp-paypal-adaptive', trailingslashit( WP_LANG_DIR ) . 'wc4jp-paypal-adaptive-payments/wc4jp-paypal-adaptive-payments-' . $locale . '.mo' );
		load_plugin_textdomain( 'wc4jp-paypal-adaptive', false, dirname( plugin_basename( __FILE__ ) ) . '/i18n/' );
	}

	/**
	 * Includes.
	 */
	private function includes() {
		include_once 'includes/class-wc4jp-paypal-adaptive-payments-gateway.php';
	}

	/**
	 * Admin includes.
	 */
	private function admin_includes() {
		include_once 'includes/class-wc4jp-paypal-adaptive-payments-admin.php';
	}

	/**
	 * Add the gateway.
	 *
	 * @param  array $methods WooCommerce payment methods.
	 *
	 * @return array          PayPal Adaptive Payments gateway.
	 */
	public function add_gateway( $methods ) {
		$methods[] = 'WC4JP_PayPal_Adaptive_Payments_Gateway';

		return $methods;
	}

	/**
	 * WooCommerce fallback notice.
	 *
	 * @return string
	 */
	public function woocommerce_missing_notice() {
		echo '<div class="error"><p>' . sprintf( __( 'WooCommerce PayPal Adaptive Payments Gateway depends on the last version of %s to work!', 'wc4jp-paypal-adaptive' ), '<a href="http://wordpress.org/extend/plugins/woocommerce/">' . __( 'WooCommerce', 'wc4jp-paypal-adaptive' ) . '</a>' ) . '</p></div>';
	}
}

add_action( 'plugins_loaded', array( 'WC4JP_PayPal_Adaptive_Payments', 'get_instance' ) );

endif;
