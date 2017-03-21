<?php
if (!function_exists('get_Paypal_Adaptive_Gateway_settings')) {

    function get_Paypal_Adaptive_Gateway_settings($name = '', $tab = '') {
        if (empty($tab) && empty($name))
            return '';
        if (empty($tab))
            return get_option($name);
        if (empty($name))
            return get_option("dc_{$tab}_settings_name");
        $settings = get_option("dc_{$tab}_settings_name");
        if (!isset($settings[$name]))
            return '';
        return $settings[$name];
    }

}
if (!function_exists('woocommerce_WCMp_pag_alert_notice')) {

    function woocommerce_WCMp_pag_alert_notice() {
        ?>
        <div id="message" class="error">
            <p><?php printf(__('%sWCMp Paypal Adaptive Gateway is inactive.%s The %sWooCommerce plugin%s must be active for the WCMp Paypal Adaptive Gateway to work. Please %sinstall & activate WooCommerce%s', WCMp_PAYPAL_ADAPTIVE_GATEWAY_TEXT_DOMAIN), '<strong>', '</strong>', '<a target="_blank" href="http://wordpress.org/extend/plugins/woocommerce/">', '</a>', '<a href="' . admin_url('plugins.php') . '">', '&nbsp;&raquo;</a>'); ?></p>
        </div>
        <?php
    }

}

if (!function_exists('do_log_paypal_adaptive_payment')) {

    function do_log_paypal_adaptive_payment($str) {
        global $WCMp_Paypal_Adaptive_Gateway;
        $file = $WCMp_Paypal_Adaptive_Gateway->plugin_path . 'log/paypaladaptive.log';
        if (file_exists($file)) {
            // Open the file to get existing content
            $current = file_get_contents($file);
            if ($current) {
                // Append a new content to the file
                $current .= "$str" . "\r\n";
                $current .= "-------------------------------------\r\n";
            } else {
                $current = "$str" . "\r\n";
                $current .= "-------------------------------------\r\n";
            }
            // Write the contents back to the file
            file_put_contents($file, $current);
        }
    }

}
