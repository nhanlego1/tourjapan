<?php

class WCMp_Paypal_Adaptive_Gateway {

    public $plugin_url;
    public $plugin_path;
    public $version;
    public $token;
    public $text_domain;
    public $admin;
    private $file;

    public function __construct($file) {

        $this->file = $file;
        $this->plugin_url = trailingslashit(plugins_url('', $plugin = $file));
        $this->plugin_path = trailingslashit(dirname($file));
        $this->token = WCMp_PAYPAL_ADAPTIVE_GATEWAY_PLUGIN_TOKEN;
        $this->text_domain = WCMp_PAYPAL_ADAPTIVE_GATEWAY_TEXT_DOMAIN;
        $this->version = WCMp_PAYPAL_ADAPTIVE_GATEWAY_PLUGIN_VERSION;
        add_action('init', array(&$this, 'init'));
        add_action('plugins_loaded', array($this, 'init_adaptive_wcmp'));
    }

    /**
     * initilize plugin on WP init
     */
    function init() {

        // Init Text Domain
        $this->load_plugin_textdomain();
        if (is_admin()) {
            $this->load_class('admin');
            $this->admin = new WCMp_Paypal_Adaptive_Gateway_Admin();
        }
        if (isset($_GET['ipn']) && isset($_GET['self_custom'])) {
            $this->paypal_adaptive_ipn_response($_POST);
        }
    }
    /**
     * Process payment and update order status and commission status
     * @global class $WCMp_Paypal_Adaptive_Gateway
     * @param array $posted
     */
    function paypal_adaptive_ipn_response($posted) {
        global $WCMp_Paypal_Adaptive_Gateway;

        if (isset($_POST['action_type']) && $_POST['action_type'] == 'PAY' && isset($_POST['status']) && $_POST['status'] == 'COMPLETED') {
            $order_id = (int) $_GET['self_custom'];
            if ($order_id) {
                $order = new WC_Order($order_id);
                $order->add_order_note(__('IPN payment completed', $WCMp_Paypal_Adaptive_Gateway->text_domain));
                $order->update_status('processing');
                /**
                 * Update Commission Status
                 */
                $arr_vendor = WCMp_get_vendors_due_from_order($order_id);
                $vendor_to_pay = array();
                foreach ($arr_vendor as $key => $value) {
                    $user_id = $this->get_user_id_from_term_id($key);
                    if(!empty(get_user_meta($user_id, '_vendor_paypal_email', true))){
                        $vendor_to_pay[$key] = array($user_id => get_user_meta($user_id, '_vendor_paypal_email', true));
                    }
                }
                foreach ($vendor_to_pay as $term_id => $payeer) {
                    $args = array(
                        'post_type' => 'dc_commission',
                        'meta_query' => array(
                            array(
                                'key' => '_commission_vendor',
                                'value' => $term_id,
                            ),
                            array(
                                'key' => '_commission_order_id',
                                'value' => $order_id
                            ),
                            array(
                                'key' => '_paid_status',
                                'value' => 'Unpaid'
                            )
                        )
                    );
                    $postslist = get_posts($args);
                    if(!empty($postslist) && is_array($postslist)){
                        $commission_id = $postslist[0]->ID;
                        update_post_meta($commission_id, '_paid_status', 'paid');
                    }  
                }
            }
        }
        do_log_paypal_adaptive_payment(serialize($posted));
    }

    /**
     * Intilize Paypal Adaptive Gateway
     *
     */
    function init_adaptive_wcmp() {
        $this->load_class('adaptive');
        add_filter('woocommerce_payment_gateways', array($this, 'woocommerce_add_paypal_adaptive_wcmp'));
    }

    function woocommerce_add_paypal_adaptive_wcmp($methods) {
        $methods[] = 'WCMp_Adaptive_Payment_Adaptive';
        return $methods;
    }

    /**
     * Load Localisation files.
     *
     * Note: the first-loaded translation file overrides any following ones if the same translation is present
     *
     * @access public
     * @return void
     */
    public function load_plugin_textdomain() {
        $locale = apply_filters('plugin_locale', get_locale(), $this->token);

        load_textdomain($this->text_domain, WP_LANG_DIR . "/wcmp-Paypal-Adaptive-Gateway/wcmp-Paypal-Adaptive-Gateway-$locale.mo");
        load_textdomain($this->text_domain, $this->plugin_path . "/languages/wcmp-Paypal-Adaptive-Gateway-$locale.mo");
    }

    public function load_class($class_name = '') {
        if ('' != $class_name && '' != $this->token) {
            require_once ('class-' . esc_attr($this->token) . '-' . esc_attr($class_name) . '.php');
        } // End If Statement
    }

    /**
     * Install upon activation.
     *
     * @access public
     * @return void
     */
    function activate_WCMp_Paypal_Adaptive_Gateway() {
        global $WCMp_Paypal_Adaptive_Gateway;

        update_option('WCMp_Paypal_Adaptive_Gateway_installed', 1);
    }

    /**
     * UnInstall upon deactivation.
     *
     * @access public
     * @return void
     */
    function deactivate_WCMp_Paypal_Adaptive_Gateway() {
        global $WCMp_Paypal_Adaptive_Gateway;
        delete_option('WCMp_Paypal_Adaptive_Gateway_installed');
    }

    /** Cache Helpers ******************************************************** */

    /**
     * Sets a constant preventing some caching plugins from caching a page. Used on dynamic pages
     *
     * @access public
     * @return void
     */
    function nocache() {
        if (!defined('DONOTCACHEPAGE'))
            define("DONOTCACHEPAGE", "true");
        // WP Super Cache constant
    }

}
