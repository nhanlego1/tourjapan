<?php

class WCMp_Paypal_Adaptive_Gateway_Admin {

    public $settings;

    public function __construct() {
        //admin script and style
        add_action('admin_enqueue_scripts', array(&$this, 'enqueue_admin_script'));

        add_action('WCMp_Paypal_Adaptive_Gateway_dualcube_admin_footer', array(&$this, 'dualcube_admin_footer_for_WCMp_Paypal_Adaptive_Gateway'));

        add_filter('wcmp_tabsection_payment', array(&$this, 'wcmp_tabsection_payment_callback'));
        add_action('settings_page_payment_paypal_adaptive_tab_init', array(&$this, 'paypal_adaptive_tab_init'), 10, 5);
    }

    function wcmp_tabsection_payment_callback($submenue_tab) {
        global $WCMp, $WCMp_Paypal_Adaptive_Gateway;
        $submenue_tab['paypal_adaptive'] = __('Paypal Adaptive', $WCMp_Paypal_Adaptive_Gateway->text_domain);
        return $submenue_tab;
    }

    function paypal_adaptive_tab_init($tab, $subsection) {
        global $WCMp, $WCMp_Paypal_Adaptive_Gateway;
        $this->load_class("settings-{$tab}-{$subsection}", $WCMp_Paypal_Adaptive_Gateway->plugin_path, $WCMp_Paypal_Adaptive_Gateway->token);
        new WCMp_Payment_Paypal_Adaptive_Settings_Gneral($tab, $subsection);
    }

    function load_class($class_name = '') {
        global $WCMp_Paypal_Adaptive_Gateway;
        if ('' != $class_name) {
            require_once ($WCMp_Paypal_Adaptive_Gateway->plugin_path . '/admin/class-' . esc_attr($WCMp_Paypal_Adaptive_Gateway->token) . '-' . esc_attr($class_name) . '.php');
        } // End If Statement
    }

    // End load_class()

    function dualcube_admin_footer_for_WCMp_Paypal_Adaptive_Gateway() {
        global $WCMp_Paypal_Adaptive_Gateway;
        ?>
        <div style="clear: both"></div>
        <div id="dc_admin_footer">
        <?php _e('Powered by', $WCMp_Paypal_Adaptive_Gateway->text_domain); ?> <a href="http://dualcube.com" target="_blank"><img src="<?php echo $WCMp_Paypal_Adaptive_Gateway->plugin_url . '/assets/images/dualcube.png'; ?>"></a><?php _e('Dualcube', $WCMp_Paypal_Adaptive_Gateway->text_domain); ?> &copy; <?php echo date('Y'); ?>
        </div>
        <?php
    }

    /**
     * Admin Scripts
     */
    public function enqueue_admin_script() {
        global $WCMp_Paypal_Adaptive_Gateway;
        $screen = get_current_screen();

        // Enqueue admin script and stylesheet from here
        if (in_array($screen->id, array('woocommerce_page_wcmp-Paypal-Adaptive-Gateway-setting-admin'))) :
            $WCMp_Paypal_Adaptive_Gateway->library->load_qtip_lib();
            $WCMp_Paypal_Adaptive_Gateway->library->load_upload_lib();
            $WCMp_Paypal_Adaptive_Gateway->library->load_colorpicker_lib();
            $WCMp_Paypal_Adaptive_Gateway->library->load_datepicker_lib();
            wp_enqueue_script('admin_js', $WCMp_Paypal_Adaptive_Gateway->plugin_url . 'assets/admin/js/admin.js', array('jquery'), $WCMp_Paypal_Adaptive_Gateway->version, true);
            wp_enqueue_style('admin_css', $WCMp_Paypal_Adaptive_Gateway->plugin_url . 'assets/admin/css/admin.css', array(), $WCMp_Paypal_Adaptive_Gateway->version);
        endif;
        if (in_array($screen->id, array('woocommerce_page_wc-settings'))) {
            wp_enqueue_script('adaptive_js', $WCMp_Paypal_Adaptive_Gateway->plugin_url . 'assets/admin/js/adaptive.js', array('jquery'), $WCMp_Paypal_Adaptive_Gateway->version, true);
        }
    }

}
