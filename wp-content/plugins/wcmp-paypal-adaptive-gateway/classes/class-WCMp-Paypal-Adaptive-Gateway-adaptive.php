<?php

class WCMp_Adaptive_Payment_Adaptive extends WC_Payment_Gateway {

    public $other_settings;
    public $notify_url;

    public function __construct() {
        global $WCMp_Paypal_Adaptive_Gateway;
        $this->other_settings = get_option('dc_WCMp_Paypal_Adaptive_Gateway_general_settings_name');
        $this->id = 'wcmp_paypal_adaptive_payment';
        $this->method_title = 'Paypal Adaptive';
        $this->method_description = __('Allows payments by Paypal Adaptive.', 'woocommerce');
        $this->has_fields = false;
        $this->icon = $WCMp_Paypal_Adaptive_Gateway->plugin_url . "assets/images/paypal.gif";
        $this->init_form_fields();
        $this->init_settings();
        $this->split_by = $this->get_option('_split_by');
        $this->title = $this->get_option('title');
        $this->description = $this->get_option('description');
        $this->testmode = $this->get_option('testmode');
        $this->notify_url = WC()->api_request_url('WC_Gateway_Paypal');
        $this->api_user_id = $this->get_option('api_user_id');
        $this->api_password = $this->get_option('api_password');
        $this->api_signature = $this->get_option('api_signature');
        $this->api_application_id = $this->get_option('api_application_id');
        $this->store_owner_email = $this->get_option('store_owner_email');
        $this->store_mode = $this->get_option('_store_mode');
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
    }

    function init_form_fields() {
        global $wp_roles, $WCMp_Paypal_Adaptive_Gateway;
        $this->form_fields = array(
            'enabled' => array(
                'title' => __('Enable/Disable', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'type' => 'checkbox',
                'label' => __('PayPal Adaptive Split Payment', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'default' => 'yes'
            ),
            '_store_mode' => array(
                'title' => __('Store Mode', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'type' => 'select',
                'label' => __('Store Mode', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'default' => 'multivendor',
                'options' => array('multivendor' => __('Multi Vendor', $WCMp_Paypal_Adaptive_Gateway->text_domain), 'singlevendor' => __('Single Vendor', $WCMp_Paypal_Adaptive_Gateway->text_domain))
            ),
            '_payment_mode' => array(
                'title' => __('Payment Mode', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'type' => 'select',
                'label' => __('PayPal Adaptive', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'default' => 'parallel',
                'options' => array('parallel' => __('Parallel', $WCMp_Paypal_Adaptive_Gateway->text_domain), 'chained' => __('Chained', $WCMp_Paypal_Adaptive_Gateway->text_domain))
            ),
            '_payment_parallel_fees' => array(
                'title' => __('Payment Fees by', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'type' => 'select',
                'label' => __('Payment Fees by', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'default' => 'EACHRECEIVER',
                'options' => array('SENDER' => __('Sender', $WCMp_Paypal_Adaptive_Gateway->text_domain), 'EACHRECEIVER' => __('Each Receiver', $WCMp_Paypal_Adaptive_Gateway->text_domain))
            ),
            '_payment_chained_fees' => array(
                'title' => __('Payment Fees by', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'type' => 'select',
                'label' => __('Payment Fees by', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'default' => 'EACHRECEIVER',
                'options' => array('PRIMARYRECEIVER' => __('Primary Receiver', $WCMp_Paypal_Adaptive_Gateway->text_domain), 'EACHRECEIVER' => __('Each Receiver', $WCMp_Paypal_Adaptive_Gateway->text_domain))
            ),
            'title' => array(
                'title' => __('Title', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'type' => 'text',
                'description' => __('This controls the title which the user sees during checkout.', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'default' => __('PayPal Adaptive Split Payment', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'desc_tip' => false,
            ),
            'description' => array(
                'title' => __('Description', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'type' => 'textarea',
                'default' => __("Pay with PayPal Adaptive Split Payment. You can pay with your credit card if you don't have a PayPal account", $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'desc_tip' => false,
                'description' => __('This controls the description which the user sees during checkout.', $WCMp_Paypal_Adaptive_Gateway->text_domain),
            ),
            'store_owner_email_title' => array(
                'title' => __('Store Owner', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'type' => 'title',
                'description' => '',
            ),
            'store_owner_email' => array(
                'title' => __('Store Owner Paypal Email', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'type' => 'text',
                'default' => '',
                'desc_tip' => false,
                'description' => __('Please enter your paypal email Id', $WCMp_Paypal_Adaptive_Gateway->text_domain),
            ),
            'apidetails' => array(
                'title' => __('API Authentication', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'type' => 'title',
                'description' => '',
            ),
            'api_user_id' => array(
                'title' => __('API User ID', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'type' => 'text',
                'default' => '',
                'desc_tip' => false,
                'description' => __('Please enter your API User ID associated with your paypal account', $WCMp_Paypal_Adaptive_Gateway->text_domain),
            ),
            'api_password' => array(
                'title' => __('API Password', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'type' => 'text',
                'default' => '',
                'desc_tip' => false,
                'description' => __('Please enter your API Password associated with your paypal account', $WCMp_Paypal_Adaptive_Gateway->text_domain),
            ),
            'api_signature' => array(
                'title' => __('API Signature', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'type' => 'text',
                'default' => '',
                'desc_tip' => false,
                'description' => __('Please enter your API Signature associated with your paypal account', $WCMp_Paypal_Adaptive_Gateway->text_domain),
            ),
            'api_application_id' => array(
                'title' => __('Application ID', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'type' => 'text',
                'default' => '',
                'desc_tip' => false,
                'description' => __('Please enter your Application ID created with your paypal account for sandbox you can use APP-80W284485P519543T as test Application Id', $WCMp_Paypal_Adaptive_Gateway->text_domain),
            ),
            'testing' => array(
                'title' => __('SandBox Testing', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'type' => 'title',
                'description' => '',
            ),
            'testmode' => array(
                'title' => __('PayPal Adaptive sandbox', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'type' => 'checkbox',
                'label' => __('Enable PayPal Adaptive sandbox', $WCMp_Paypal_Adaptive_Gateway->text_domain),
                'default' => 'no',
                'description' => sprintf(__('PayPal Adaptive sandbox can be used to test payments. Sign up for a developer account <a href="%s">here</a>.', $WCMp_Paypal_Adaptive_Gateway->text_domain), 'https://developer.paypal.com/'),
            ),
        );
    }

    public function is_seller_vendor($vendor_id) {
        $capability = get_user_meta($vendor_id, 'wp_capabilities', true);
        if (isset($capability) && is_array($capability) && (!empty($capability))) {
            if (isset($capability['dc_vendor']) && $capability['dc_vendor'] == 1) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function get_commission_amount($product_id = 0, $vendor_id = 0, $variation_id = 0) {
        global $WCMp;
        $data = '';

        if ($product_id > 0 && $vendor_id > 0) {

            $vendor = get_WCMp_product_vendors($product_id);
            if ($vendor->id == $vendor_id) {
                if ($variation_id > 0) {
                    $data = get_post_meta($variation_id, '_product_vendors_commission', true);
                    if (!isset($data)) {
                        $data = get_post_meta($product_id, '_commission_per_product', true);
                    }
                } else {
                    $data = get_post_meta($product_id, '_commission_per_product', true);
                }
                if (isset($data) && $data > 0) {
                    return $data; // Use product commission percentage first
                } else {
                    $vendor_user_id = get_woocommerce_term_meta($vendor_id, 'vendor_user_id', true);
                    $vendor_commission = get_user_meta($vendor_user_id, 'vendor_commission', true);
                    if ($vendor_commission) {
                        return $vendor_commission; // Use vendor user commission percentage
                    } else {
                        return isset($WCMp->vendor_caps->payment_cap['default_commission']) ? $WCMp->vendor_caps->payment_cap['default_commission'] : false;
                    }
                }
            }
        }
        return false;
    }

    function get_item_shipping($vendor_id, $product_id, $qty) {
        global $woocommerce, $wp_roles, $WCMp_Paypal_Adaptive_Gateway, $WCMp;
        $shipping = 10;
        return $shipping * $qty;
    }

    /** Find tax given to  admin or vendor */
    public function tax_given_to($vendor_id) {
        $multivendor_payment_settings = get_option('WCMp_payment_settings_name');
        if (isset($multivendor_payment_settings) && isset($multivendor_payment_settings['give_tax']) && $multivendor_payment_settings['give_tax'] == 'Enable') {
            $give_tax = get_user_meta($vendor_id, '_vendor_give_tax', true);
            if (isset($give_tax) && $give_tax == 'Enable') {
                return 'admin';
            } else {
                return 'vendor';
            }
        } else {
            return 'admin';
        }
    }

    /** Find Shipping given to  admin or vendor */
    public function shipping_given_to($vendor_id) {
        $multivendor_payment_settings = get_option('WCMp_payment_settings_name');
        if (isset($multivendor_payment_settings) && isset($multivendor_payment_settings['give_shipping']) && $multivendor_payment_settings['give_shipping'] == 'Enable') {
            $give_shipping = get_user_meta($vendor_id, '_vendor_give_shipping', true);
            if (isset($give_shipping) && $give_shipping == 'Enable') {
                return 'admin';
            } else {
                return 'vendor';
            }
        } else {
            return 'admin';
        }
    }

    public function get_user_id_from_term_id($term_id) {
        $user = get_users(
                array(
                    'meta_key' => '_vendor_term_id',
                    'meta_value' => $term_id,
                    'number' => 1,
                    'count_total' => false
                )
        );
        $user = reset($user);
        return $user->ID;
    }

    /** Process payment function for paypal adaptive payment gateway  */
    function process_payment($order_id) {
        global $woocommerce, $wp_roles, $WCMp_Paypal_Adaptive_Gateway, $WCMp;
        $order = new WC_Order($order_id);
        $multivendor_payment_settings = get_option('WCMp_payment_settings_name');
        $order_total_amount = $order->order_total;
        $success_url = $this->get_return_url($order);
        $cancel_url = str_replace("&amp;", "&", $order->get_cancel_order_url());
        $api_user_id = $this->api_user_id;
        $api_password = $this->api_password;
        $api_signature = $this->api_signature;
        $api_application_id = $this->api_application_id;
        if ("yes" == $this->testmode) {
            $paypal_pay_action_url = "https://svcs.sandbox.paypal.com/AdaptivePayments/Pay";
            $paypal_pay_auth_without_key_url = "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_ap-payment&paykey=";
        } else {
            $paypal_pay_action_url = "https://svcs.paypal.com/AdaptivePayments/Pay";
            $paypal_pay_auth_without_key_url = "https://www.paypal.com/cgi-bin/webscr?cmd=_ap-payment&paykey=";
        }
        $ipnNotificationUrl = esc_url_raw(add_query_arg(array('ipn' => 'set', 'self_custom' => $order_id), site_url('/')));
        if (isset($this->store_mode) && $this->store_mode == 'multivendor') {
            $headers_array = array("X-PAYPAL-SECURITY-USERID" => $api_user_id,
                "X-PAYPAL-SECURITY-PASSWORD" => $api_password,
                "X-PAYPAL-SECURITY-SIGNATURE" => $api_signature,
                "X-PAYPAL-APPLICATION-ID" => $api_application_id,
                "X-PAYPAL-REQUEST-DATA-FORMAT" => "NV",
                "X-PAYPAL-RESPONSE-DATA-FORMAT" => "JSON",
            );
            if (isset($multivendor_payment_settings) && is_array($multivendor_payment_settings)) {
                $arr_vendor = WCMp_get_vendors_due_from_order($order_id);
                $arr_paypal = array();
                foreach ($arr_vendor as $key => $value) {
                    $user_id = $this->get_user_id_from_term_id($key);
                    $arr_paypal[$key] = array($user_id => get_user_meta($user_id, '_vendor_paypal_email', true));
                }
                $primary_receiver_email = $this->store_owner_email;
            }
            $receivers_list = '';
            if (isset($primary_receiver_email) && $primary_receiver_email != '') {
                $total_vendor_payment = 0;
                foreach ($arr_vendor as $key => $eachvendor) {
                    $userid = $this->get_user_id_from_term_id($key);
                    $useremail = $arr_paypal[$key][$userid];
                    $receivers_list[$userid]['email'] = $useremail;
                    $receivers_list[$userid]['amount'] = $eachvendor['total'];
                }
                $payeerlist = array();
                foreach ($receivers_list as $key => $eachvendor) {
                    if (empty($eachvendor['email'])) {
                        unset($receivers_list[$key]);
                        continue;
                    }
                    $payeerlist[] = $key;
                }

                $total_value = 0;

                foreach ($receivers_list as $key => $eachvendor) {
                    $receivers_list[$key]['amount'] = round($eachvendor['amount'], 2);
                    $total_value += round($eachvendor['amount'], 2);
                }
                $store_owner_value = $order_total_amount - $total_value;
                $receivers_list[1]['email'] = $this->store_owner_email;
                $receivers_list[1]['amount'] = $store_owner_value;
                $paymentfeesby = 'EACHRECEIVER';
                if ("parallel" == $this->get_option('_payment_mode')) {
                    $paymentfeesby = $this->get_option('_payment_parallel_fees');
                } else {
                    if ('chained' == $this->get_option('_payment_mode')) {
                        $paymentfeesby = $this->get_option('_payment_chained_fees');
                    }
                }
                $data_array = array('actionType' => 'PAY',
                    'currencyCode' => get_woocommerce_currency(),
                    'feesPayer' => $paymentfeesby,
                    'returnUrl' => $success_url,
                    'cancelUrl' => $cancel_url,
                    'custom' => $order_id,
                    'ipnNotificationUrl' => $ipnNotificationUrl,
                    'requestEnvelope.errorLanguage' => 'en_US',
                );

                if ("parallel" == $this->get_option('_payment_mode')) {
                    $pay_count = 0;
                    foreach ($receivers_list as $key => $eachvendor) {
                        $data_array['receiverList.receiver(' . $pay_count . ').amount'] = $eachvendor['amount'];
                        $data_array['receiverList.receiver(' . $pay_count . ').email'] = $eachvendor['email'];
                        $pay_count++;
                    }
                } elseif ("chained" == $this->get_option('_payment_mode')) {
                    $pay_count = 0;
                    foreach ($receivers_list as $key => $eachvendor) {
                        if ($eachvendor['email'] == $this->store_owner_email) {
                            $data_array['receiverList.receiver(' . $pay_count . ').amount'] = $order_total_amount;
                            $data_array['receiverList.receiver(' . $pay_count . ').email'] = $this->store_owner_email;
                            $data_array['receiverList.receiver(' . $pay_count . ').primary'] = "true";
                        } else {
                            $data_array['receiverList.receiver(' . $pay_count . ').amount'] = $eachvendor['amount'];
                            $data_array['receiverList.receiver(' . $pay_count . ').email'] = $eachvendor['email'];
                            $data_array['receiverList.receiver(' . $pay_count . ').primary'] = "false";
                        }
                        $pay_count++;
                    }
                }
                $pay_result = wp_remote_request($paypal_pay_action_url, array('method' => 'POST', 'timeout' => 20, 'headers' => $headers_array, 'body' => $data_array));
                if (is_wp_error($pay_result)) {
                    $re = print_r($pay_result->get_error_message(), true);
                    wc_add_notice($re, 'error');
                    return;
                }
                $jso = json_decode($pay_result['body']);
                @$payment_url = $paypal_pay_auth_without_key_url . $jso->payKey;
                if ("Success" == $jso->responseEnvelope->ack) {
                    return array(
                        'result' => 'success',
                        'redirect' => $payment_url
                    );
                } else {
                    $error_code = "<br>Error Code: " . $jso->error[0]->errorId;
                    wc_add_notice(__($jso->error[0]->message, $WCMp_Paypal_Adaptive_Gateway->text_domain) . $error_code, 'error');
                    return;
                }
            }
        } else {
            if (isset($this->store_owner_email) && $this->store_owner_email != '') {
                $primary_receiver_mail = $this->store_owner_email;
            } else {
                $primary_receiver_mail = get_option('admin_email');
            }
            $headers_array = array("X-PAYPAL-SECURITY-USERID" => $api_user_id,
                "X-PAYPAL-SECURITY-PASSWORD" => $api_password,
                "X-PAYPAL-SECURITY-SIGNATURE" => $api_signature,
                "X-PAYPAL-APPLICATION-ID" => $api_application_id,
                "X-PAYPAL-REQUEST-DATA-FORMAT" => "NV",
                "X-PAYPAL-RESPONSE-DATA-FORMAT" => "JSON",
            );
            $primary_receiver_email = '';
            $primary_receiver_percentage = '';
            $receivers_list = '';
            if (isset($this->other_settings['receivers']) && is_array($this->other_settings['receivers']) && (!empty($this->other_settings['receivers']))) {
                $receivers_list = $this->other_settings['receivers'];
            }
            if (isset($this->other_settings['primary_receiver_email']) && $this->other_settings['primary_receiver_percentage']) {
                $primary_receiver_email = $this->other_settings['primary_receiver_email'];
                $primary_receiver_percentage = $this->other_settings['primary_receiver_percentage'];
            }
            if ($primary_receiver_email == '' || $primary_receiver_percentage == '') {
                wc_print_notice(__('Primary paypel email or percentage is not configured Yet!', $WCMp_Paypal_Adaptive_Gateway->text_domain), 'error');
            } else {
                $percentage = $primary_receiver_percentage;
                if (isset($receivers_list) && is_array($receivers_list) && (!empty($receivers_list))) {
                    foreach ($receivers_list as $receiver) {
                        if (isset($receiver['receiver_percentage']) && $receiver['receiver_percentage'] > 0 && isset($receiver['receiver_email']) && $receiver['receiver_email'] != '') {
                            $percentage += $receiver['receiver_percentage'];
                        }
                    }
                }
                if ($percentage != 100) {
                    wc_print_notice(__('Primary paypel email or percentage is not configured Yet!', $WCMp_Paypal_Adaptive_Gateway->text_domain), 'error');
                } else {
                    $primary_receiver_amt = round((($order_total_amount * $primary_receiver_percentage) / 100), 2);
                    foreach ($receivers_list as $receiver) {
                        if (isset($receiver['receiver_percentage']) && $receiver['receiver_percentage'] > 0 && isset($receiver['receiver_email']) && $receiver['receiver_email'] != '') {
                            $secondry_receiver_list[] = array('email' => [$receiver['receiver_email']], 'amt' => round((($order_total_amount * $receiver['receiver_percentage']) / 100), 2));
                        }
                    }
                    $paymentfeesby = 'EACHRECEIVER';
                    if ("parallel" == $this->get_option('_payment_mode')) {
                        $paymentfeesby = $this->get_option('_payment_parallel_fees');
                    } else {
                        if ('chained' == $this->get_option('_payment_mode')) {
                            $paymentfeesby = $this->get_option('_payment_chained_fees');
                        }
                    }
                    $data_array = array('actionType' => 'PAY',
                        'currencyCode' => get_woocommerce_currency(),
                        'feesPayer' => $paymentfeesby,
                        'returnUrl' => $success_url,
                        'cancelUrl' => $cancel_url,
                        'custom' => $order_id,
                        'ipnNotificationUrl' => $ipnNotificationUrl,
                        'requestEnvelope.errorLanguage' => 'en_US',
                    );

                    if ("parallel" == $this->get_option('_payment_mode')) {
                        $pay_count = 0;
                        if ($primary_receiver_email != '' && $primary_receiver_amt > 0) {
                            $data_array['receiverList.receiver(' . $pay_count . ').amount'] = $primary_receiver_amt;
                            $data_array['receiverList.receiver(' . $pay_count . ').email'] = $primary_receiver_email;
                            $pay_count++;
                            foreach ($secondry_receiver_list as $secondry_receiver) {
                                $data_array['receiverList.receiver(' . $pay_count . ').amount'] = $secondry_receiver['amt'];
                                $data_array['receiverList.receiver(' . $pay_count . ').email'] = $secondry_receiver['email'];
                                $pay_count++;
                            }
                        }
                    } elseif ("chained" == $this->get_option('_payment_mode')) {
                        $pay_count = 0;
                        $data_array['receiverList.receiver(' . $pay_count . ').amount'] = $order_total_amount;
                        $data_array['receiverList.receiver(' . $pay_count . ').email'] = $primary_receiver_email;
                        $data_array['receiverList.receiver(' . $pay_count . ').primary'] = "true";
                        $pay_count++;
                        foreach ($secondry_receiver_list as $secondry_receiver) {
                            $data_array['receiverList.receiver(' . $pay_count . ').amount'] = $secondry_receiver['amt'];
                            $data_array['receiverList.receiver(' . $pay_count . ').email'] = $secondry_receiver['email'];
                            $data_array['receiverList.receiver(' . $pay_count . ').primary'] = "false";
                            $pay_count++;
                        }
                    }
                    $pay_result = wp_remote_request($paypal_pay_action_url, array('method' => 'POST', 'timeout' => 20, 'headers' => $headers_array, 'body' => $data_array));
                    if (is_wp_error($pay_result)) {
                        $re = print_r($pay_result->get_error_message(), true);
                        wc_add_notice($re, 'error');
                        return;
                    }
                    $jso = json_decode($pay_result['body']);
                    @$payment_url = $paypal_pay_auth_without_key_url . $jso->payKey;

                    if ("Success" == $jso->responseEnvelope->ack) {
                        return array(
                            'result' => 'success',
                            'redirect' => $payment_url
                        );
                    } else {
                        $error_code = "<br>Error Code: " . $jso->error[0]->errorId;
                        wc_add_notice(__($jso->error[0]->message, $WCMp_Paypal_Adaptive_Gateway->text_domain) . $error_code, 'error');
                        return;
                    }
                }
            }
        }
    }

    function wcmp_vendor_commission_created_callback($commission_id, $vendor_id) {
        $user_id = $this->get_user_id_from_term_id($vendor_id);
        $arr_paypal[$key] = array($user_id => '');
    }

}
