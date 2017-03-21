<?php
/*
  Plugin Name: PayPal Adaptive Split Payment (shared on themelot.net)
  Plugin URI: http://bit.do/ZYMg
  Description:  PayPal Adaptive Split Payment is a WooCommerce Extension Plugin
  Version: 2.4
  Author: Fantastic Plugins
  Author URI:
 */

/*
  Copyright 2015 Fantastic Plugins. All Rights Reserved.
  This Software should not be used or changed without the permission
  of Fantastic Plugins.
 */

function init_paypal_adaptive() {
    if (!class_exists('WC_Payment_Gateway'))
        return;

    class FPPaypalAdaptivePayment extends WC_Payment_Gateway {

        function __construct() {
            $this->id = 'fp_paypal_adaptive';
            $this->method_title = 'PayPal Adaptive Split Payment';
            $this->has_fields = true;
            $this->icon = plugins_url('images/paypal.jpg', __FILE__);

            $this->init_form_fields();
            $this->init_settings();
            $this->split_by = $this->get_option('_split_by');
            $this->title = $this->get_option('title');
            $this->description = $this->get_option('description');
            $this->testmode = $this->get_option('testmode');
            $this->notify_url = esc_url_raw(add_query_arg(array('ipn' => 'set'), site_url('/')));
            $this->security_user_id = $this->get_option('security_user_id');
            $this->security_password = $this->get_option('security_password');
            $this->security_signature = $this->get_option('security_signature');
            $this->security_application_id = $this->get_option('security_application_id');
            add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
            add_action('init', array($this, 'check_ipn'));
            
            //add_action('wp_head', array($this, 'checkme'));
        }

        function init_form_fields() {
            global $wp_roles;
            if (!$wp_roles) {
                $wp_roles = new WP_Roles();
            }

            $this->form_fields = array(
                'enabled' => array(
                    'title' => __('Enable/Disable', 'fppaypaladaptivesplit'),
                    'type' => 'checkbox',
                    'label' => __('PayPal Adaptive Split Payment', 'fppaypaladaptivesplit'),
                    'default' => 'yes'
                ),
//                '_enable_product_level' => array(
//                    'title' => __('Product level Split', 'fppaypaladaptivesplit'),
//                    'type' => 'select',
//                    'label' => __('PayPal Adaptive', 'fppaypaladaptivesplit'),
//                    'default' => 'parallel',
//                    'options' => array('product_level' => __('Enable', 'fppaypaladaptivesplit'), 'cart_level' => __('Disable', 'fppaypaladaptivesplit'))
//                ),
                '_payment_mode' => array(
                    'title' => __('Payment Mode', 'fppaypaladaptivesplit'),
                    'type' => 'select',
                    'label' => __('PayPal Adaptive', 'fppaypaladaptivesplit'),
                    'default' => 'parallel',
                    'options' => array('parallel' => __('Parallel', 'fppaypaladaptivesplit'), 'chained' => __('Chained', 'fppaypaladaptivesplit'))
                ),
                '_payment_parallel_fees' => array(
                    'title' => __('Payment Fees by', 'fppaypaladaptivesplit'),
                    'type' => 'select',
                    'label' => __('Payment Fees by', 'fppaypaladaptivesplit'),
                    'default' => 'EACHRECEIVER',
                    'options' => array('SENDER' => __('Sender', 'fppaypaladaptivesplit'), 'EACHRECEIVER' => __('Each Receiver', 'fppaypaladaptivesplit'))
                ),
                '_payment_chained_fees' => array(
                    'title' => __('Payment Fees by', 'fppaypaladaptivesplit'),
                    'type' => 'select',
                    'label' => __('Payment Fees by', 'fppaypaladaptivesplit'),
                    'default' => 'EACHRECEIVER',
                    'options' => array('PRIMARYRECEIVER' => __('Primary Receiver', 'fppaypaladaptivesplit'), 'EACHRECEIVER' => __('Each Receiver', 'fppaypaladaptivesplit'))
                ),
                'title' => array(
                    'title' => __('Title', 'fppaypaladaptivesplit'),
                    'type' => 'text',
                    'description' => __('This controls the title which the user sees during checkout.', 'fppaypaladaptivesplit'),
                    'default' => __('PayPal Adaptive Split Payment', 'fppaypaladaptivesplit'),
                    'desc_tip' => true,
                ),
                'description' => array(
                    'title' => __('Description', 'fppaypaladaptivesplit'),
                    'type' => 'textarea',
                    'default' => 'Pay with PayPal Adaptive Split Payment. You can pay with your credit card if you don�t have a PayPal account',
                    'desc_tip' => true,
                    'description' => __('This controls the description which the user sees during checkout.', 'fppaypaladaptivesplit'),
                ),
                'apidetails' => array(
                    'title' => __('API Authentication', 'fppaypaladaptivesplit'),
                    'type' => 'title',
                    'description' => '',
                ),
                'security_user_id' => array(
                    'title' => __('API User ID', 'fppaypaladaptivesplit'),
                    'type' => 'text',
                    'default' => '',
                    'desc_tip' => true,
                    'description' => __('Please enter your API User ID associated with your paypal account', 'fppaypaladaptivesplit'),
                ),
                'security_password' => array(
                    'title' => __('API Password', 'fppaypaladaptivesplit'),
                    'type' => 'text',
                    'default' => '',
                    'desc_tip' => true,
                    'description' => __('Please enter your API Password associated with your paypal account', 'fppaypaladaptivesplit'),
                ),
                'security_signature' => array(
                    'title' => __('API Signature', 'fppaypaladaptivesplit'),
                    'type' => 'text',
                    'default' => '',
                    'desc_tip' => true,
                    'description' => __('Please enter your API Signature associated with your paypal account', 'fppaypaladaptivesplit'),
                ),
                'security_application_id' => array(
                    'title' => __('Application ID', 'fppaypaladaptivesplit'),
                    'type' => 'text',
                    'default' => '',
                    'desc_tip' => true,
                    'description' => __('Please enter your Application ID created with your paypal account', 'fppaypaladaptivesplit'),
                ),
                'hide_product_field_user_role' => array(
                    'title' => __('Hide Single Product Page PayPal Adaptive Settings for following User Roles', 'fppaypaladaptivesplit'),
                    'type' => 'multiselect',
                    'css' => 'min-width:350px;',
                    'default' => array(get_role('multi_vendor') != null ? 'multi_vendor' : ''),
                    'options' => $wp_roles->get_names(),
                    'desc_tip' => true,
                    'description' => __('Hide Single Product Field based on User Role', 'fppaypaladaptivesplit'),
                ),
                'receivers_details' => array(
                    'title' => __('Receiver Details', 'fppaypaladaptivesplit'),
                    'type' => 'title',
                    'description' => '',
                ),
                'pri_r_paypal_enable' => array(
                    'title' => __('Enable Receiver 1', 'fppaypaladaptivesplit'),
                    'type' => 'checkbox',
                    'label' => __('', 'fppaypaladaptivesplit'),
                    'default' => 'yes',
                    'disabled' => true
                ),
                'pri_r_paypal_mail' => array(
                    'title' => __('Receiver 1 PayPal Mail', 'fppaypaladaptivesplit'),
                    'type' => 'text',
                    'default' => '',
                    'desc_tip' => true,
                    'description' => __('Please enter the receiver 1 paypal mail', 'fppaypaladaptivesplit'),
                ),
                'pri_r_amount_percentage' => array(
                    'title' => __('Receiver 1 Payment Percentage', 'fppaypaladaptivesplit'),
                    'type' => 'text',
                    'default' => '',
                    'desc_tip' => true,
                    'description' => __('Please enter the receiver 1 Payment Percentage ', 'fppaypaladaptivesplit'),
                ),
                'sec_r1_paypal_enable' => array(
                    'title' => __('Enable Receiver 2', 'fppaypaladaptivesplit'),
                    'type' => 'checkbox',
                    'label' => __('', 'fppaypaladaptivesplit'),
                    'default' => 'yes'
                ),
                'sec_r1_paypal_mail' => array(
                    'title' => __('Receiver 2 PayPal Mail', 'fppaypaladaptivesplit'),
                    'type' => 'text',
                    'default' => '',
                    'desc_tip' => true,
                    'description' => __('Please enter the receiver 2 paypal mail', 'fppaypaladaptivesplit'),
                ),
                'sec_r1_amount_percentage' => array(
                    'title' => __('Receiver 2 Payment Percentage', 'fppaypaladaptivesplit'),
                    'type' => 'text',
                    'default' => '',
                    'desc_tip' => true,
                    'description' => __('Please enter the percentage of payment should be sent to receiver 2', 'fppaypaladaptivesplit'),
                ),
                'sec_r2_paypal_enable' => array(
                    'title' => __('Enable Receiver 3', 'fppaypaladaptivesplit'),
                    'type' => 'checkbox',
                    'label' => __('', 'fppaypaladaptivesplit'),
                    'default' => ''
                ),
                'sec_r2_paypal_mail' => array(
                    'title' => __('Receiver 3 PayPal Mail', 'fppaypaladaptivesplit'),
                    'type' => 'text',
                    'default' => '',
                    'desc_tip' => true,
                    'description' => __('Please enter the  receiver 3 paypal mail', 'fppaypaladaptivesplit'),
                ),
                'sec_r2_amount_percentage' => array(
                    'title' => __('Receiver 3 Payment Percentage', 'fppaypaladaptivesplit'),
                    'type' => 'text',
                    'default' => '',
                    'desc_tip' => true,
                    'description' => __('Please enter how much percentage of payment should be sent to receiver 3', 'fppaypaladaptivesplit'),
                ),
                'sec_r3_paypal_enable' => array(
                    'title' => __('Enable Receiver 4', 'fppaypaladaptivesplit'),
                    'type' => 'checkbox',
                    'label' => __('', 'fppaypaladaptivesplit'),
                    'default' => ''
                ),
                'sec_r3_paypal_mail' => array(
                    'title' => __('Receiver 4 PayPal Mail', 'fppaypaladaptivesplit'),
                    'type' => 'text',
                    'default' => '',
                    'desc_tip' => true,
                    'description' => __('Please enter the receiver 4 paypal mail', 'fppaypaladaptivesplit'),
                ),
                'sec_r3_amount_percentage' => array(
                    'title' => __('Receiver 4 Payment Percentage', 'fppaypaladaptivesplit'),
                    'type' => 'text',
                    'default' => '',
                    'desc_tip' => true,
                    'description' => __('Please enter how much percentage of payment should be sent to receiver 4', 'fppaypaladaptivesplit'),
                ),
                'sec_r4_paypal_enable' => array(
                    'title' => __('Enable Receiver 5', 'fppaypaladaptivesplit'),
                    'type' => 'checkbox',
                    'label' => __('', 'fppaypaladaptivesplit'),
                    'default' => ''
                ),
                'sec_r4_paypal_mail' => array(
                    'title' => __('Receiver 5 PayPal Mail', 'fppaypaladaptivesplit'),
                    'type' => 'text',
                    'default' => '',
                    'desc_tip' => true,
                    'description' => __('Please enter the  receiver 5 paypal mail', 'fppaypaladaptivesplit'),
                ),
                'sec_r4_amount_percentage' => array(
                    'title' => __('Receiver 5 Payment Percentage', 'fppaypaladaptivesplit'),
                    'type' => 'text',
                    'default' => '',
                    'desc_tip' => true,
                    'description' => __('Please enter how much percentage of payment should be sent to receiver 5', 'fppaypaladaptivesplit'),
                ),
                'sec_r5_paypal_enable' => array(
                    'title' => __('Enable Receiver 6', 'fppaypaladaptivesplit'),
                    'type' => 'checkbox',
                    'label' => __('', 'fppaypaladaptivesplit'),
                    'default' => ''
                ),
                'sec_r5_paypal_mail' => array(
                    'title' => __('Receiver 6 PayPal Mail', 'fppaypaladaptivesplit'),
                    'type' => 'text',
                    'default' => '',
                    'desc_tip' => true,
                    'description' => __('Please enter the  receiver 6 paypal mail', 'fppaypaladaptivesplit'),
                ),
                'sec_r5_amount_percentage' => array(
                    'title' => __('Receiver 6 Payment Percentage', 'fppaypaladaptivesplit'),
                    'type' => 'text',
                    'default' => '',
                    'desc_tip' => true,
                    'description' => __('Please enter how much percentage of payment should be sent to  receiver 6', 'fppaypaladaptivesplit'),
                ),
                'testing' => array(
                    'title' => __('Gateway Testing', 'fppaypaladaptivesplit'),
                    'type' => 'title',
                    'description' => '',
                ),
                'testmode' => array(
                    'title' => __('PayPal Adaptive sandbox', 'fppaypaladaptivesplit'),
                    'type' => 'checkbox',
                    'label' => __('Enable PayPal Adaptive sandbox', 'fppaypaladaptivesplit'),
                    'default' => 'no',
                    'description' => sprintf(__('PayPal Adaptive sandbox can be used to test payments. Sign up for a developer account <a href="%s">here</a>.', 'fppaypaladaptivesplit'), 'https://developer.paypal.com/'),
                ),
            );
        }
            function checkme(){
            global $woocommerce;
           
            } 
            
           function process_payment($order_id) {
            global $woocommerce;
            $order = new WC_Order($order_id);
// Reduce stock levels
            //$order->reduce_order_stock();
//adaptive payment option
            $primary_receiver_mail = $this->get_option('pri_r_paypal_mail'); // techstumbling -email
            $order_total_amount = $order->order_total;
            $success_url = $this->get_return_url($order);
            $cancel_url = str_replace("&amp;", "&", $order->get_cancel_order_url());
            $security_user_id = $this->security_user_id;
            $security_password = $this->security_password;
            $security_signature = $this->security_signature;
            $security_application_id = $this->security_application_id;
            if ("yes" == $this->testmode) {
                $paypal_pay_action_url = "https://svcs.sandbox.paypal.com/AdaptivePayments/Pay";
                $paypal_pay_auth_without_key_url = "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_ap-payment&paykey=";
            } else {
                $paypal_pay_action_url = "https://svcs.paypal.com/AdaptivePayments/Pay";
                $paypal_pay_auth_without_key_url = "https://www.paypal.com/cgi-bin/webscr?cmd=_ap-payment&paykey=";
            }
            $ipnNotificationUrl = esc_url_raw(add_query_arg(array('ipn' => 'set', 'self_custom' => $order_id), site_url('/')));
            $headers_array = array("X-PAYPAL-SECURITY-USERID" => $security_user_id,
                "X-PAYPAL-SECURITY-PASSWORD" => $security_password,
                "X-PAYPAL-SECURITY-SIGNATURE" => $security_signature,
                "X-PAYPAL-APPLICATION-ID" => $security_application_id,
                "X-PAYPAL-REQUEST-DATA-FORMAT" => "NV",
                "X-PAYPAL-RESPONSE-DATA-FORMAT" => "JSON",
            );
            $receivers_key_value = array();
            
            foreach ($order->get_items() as $items) {
               
                if ("enable_indiv" == get_post_meta($items['product_id'], "_enable_fp_paypal_adaptive", true)) {
                       
                    if (array_key_exists(get_post_meta($items['product_id'], "_fppap_primary_rec_mail_id", true), $receivers_key_value)) {
                        $previous_amount = $receivers_key_value[get_post_meta($items['product_id'], "_fppap_primary_rec_mail_id", true)];
                        $x_share = ($order->get_line_total($items) * get_post_meta($items['product_id'], "_fppap_primary_rec_percent", true)) / 100;
                        $calculated = $previous_amount + $x_share;
                        $receivers_key_value[get_post_meta($items['product_id'], "_fppap_primary_rec_mail_id", true)] = $calculated;
                    } else {
                        $x_share = ($order->get_line_total($items) * get_post_meta($items['product_id'], "_fppap_primary_rec_percent", true)) / 100;
                        $receivers_key_value[get_post_meta($items['product_id'], "_fppap_primary_rec_mail_id", true)] = $x_share;
                    }
                    for ($i = 1; $i <= 5; $i++) {
                        if ("yes" == get_post_meta($items['product_id'], '_fppap_sec_' . $i . '_enable', true)) {
                            if (array_key_exists(get_post_meta($items['product_id'], '_fppap_sec_' . $i . '_rec_mail_id', true), $receivers_key_value)) {
                                $previous_amount = $receivers_key_value[get_post_meta($items['product_id'], '_fppap_sec_' . $i . '_rec_mail_id', true)];
                                $x_share = ($order->get_line_total($items) * get_post_meta($items['product_id'], '_fppap_sec_' . $i . '_rec_percent', true)) / 100;
                                $calculated = $previous_amount + $x_share;
                                $receivers_key_value[get_post_meta($items['product_id'], '_fppap_sec_' . $i . '_rec_mail_id', true)] = $calculated;
                            } else {
                                $x_share = ($order->get_line_total($items) * get_post_meta($items['product_id'], '_fppap_sec_' . $i . '_rec_percent', true)) / 100;
                                $receivers_key_value[get_post_meta($items['product_id'], '_fppap_sec_' . $i . '_rec_mail_id', true)] = $x_share;
                            }
                        }
                    }
                } elseif ("enable_category" == get_post_meta($items['product_id'], "_enable_fp_paypal_adaptive", true)) {
                    $fppap_product_category = wp_get_post_terms($items['product_id'], 'product_cat');

//                    var_dump(count($fppap_product_category));
//                    exit();
                    $category_count = count($fppap_product_category);
                    if ($category_count > 0 && 1 >= $category_count) {
                        $categ_meta = get_metadata('woocommerce_term', $fppap_product_category[0]->term_id);
                        for ($i = 1; $i <= 6; $i++) {
                            if ("yes" == $categ_meta['_fppap_rec_' . $i . '_enable'][0]) {
                                if (array_key_exists($categ_meta['_fppap_rec_' . $i . '_mail_id'][0], $receivers_key_value)) {
                                    $previous_amount = $receivers_key_value[$categ_meta['_fppap_rec_' . $i . '_mail_id'][0]];
                                    $x_share = ($order->get_line_total($items) * $categ_meta['_fppap_rec_' . $i . '_percent'][0]) / 100;
                                    $calculated = $previous_amount + $x_share;
                                    $receivers_key_value[$categ_meta['_fppap_rec_' . $i . '_mail_id'][0]] = $calculated;
                                } else {
                                    $x_share = ($order->get_line_total($items) * $categ_meta['_fppap_rec_' . $i . '_percent'][0]) / 100;
                                    $receivers_key_value[$categ_meta['_fppap_rec_' . $i . '_mail_id'][0]] = $x_share;
                                }
                            }
                        }
                    } else {
                        $percentagecalculator = array();
                        if (is_array($fppap_product_category)) {
                            foreach ($fppap_product_category as $each_product_category) {
                                //var_dump($each_product_category->term_id);
                                $categ_meta = get_metadata('woocommerce_term', $each_product_category->term_id);
                                for ($i = 1; $i <= 6; $i++) {
                                    if ("yes" == @$categ_meta['_fppap_rec_' . $i . '_enable'][0]) {
                                        if (array_key_exists(@$categ_meta['_fppap_rec_' . $i . '_mail_id'][0], $receivers_key_value)) {
                                            $previous_amount = @$receivers_key_value[$categ_meta['_fppap_rec_' . $i . '_mail_id'][0]];
                                            $x_share = ($order->get_line_total($items) * $categ_meta['_fppap_rec_' . $i . '_percent'][0]) / 100;
                                            $calculated = $previous_amount + $x_share;
                                            @$receivers_key_value[$categ_meta['_fppap_rec_' . $i . '_mail_id'][0]] = $calculated;
                                        } else {
                                            $x_share = ($order->get_line_total($items) * $categ_meta['_fppap_rec_' . $i . '_percent'][0]) / 100;
                                            @$receivers_key_value[$categ_meta['_fppap_rec_' . $i . '_mail_id'][0]] = $x_share;
                                        }
                                        @$percentagecalculator[$each_product_category->term_id] += $categ_meta['_fppap_rec_' . $i . '_percent'][0];
                                    }
                                }
                                if (@$percentagecalculator[$each_product_category->term_id] == 100) {
                                    break;
                                }
                            }
                        }
                    }
                } elseif (("disable" == get_post_meta($items['product_id'], "_enable_fp_paypal_adaptive", true)) || ("" == get_post_meta($items['product_id'], "_enable_fp_paypal_adaptive", true))) {
                    if (array_key_exists($this->get_option('pri_r_paypal_mail'), $receivers_key_value)) {
                        $previous_amount = $receivers_key_value[$this->get_option('pri_r_paypal_mail')];
                        $x_share = ($order->get_line_total($items) * $this->get_option('pri_r_amount_percentage')) / 100;
                        $calculated = $previous_amount + $x_share;
                        $receivers_key_value[$this->get_option('pri_r_paypal_mail')] = $calculated;
                    } else {
                        $x_share = ($order->get_line_total($items) * $this->get_option('pri_r_amount_percentage')) / 100;
                        $receivers_key_value[$this->get_option('pri_r_paypal_mail')] = $x_share;
                    }

                    for ($i = 1; $i <= 5; $i++) {
                        if ("yes" == $this->get_option('sec_r' . $i . '_paypal_enable')) {
                            if (array_key_exists($this->get_option('sec_r' . $i . '_paypal_mail'), $receivers_key_value)) {
                                $previous_amount = $receivers_key_value[$this->get_option('sec_r' . $i . '_paypal_mail')];
                                $x_share = ($order->get_line_total($items) * $this->get_option('sec_r' . $i . '_amount_percentage')) / 100;
                                $calculated = $previous_amount + $x_share;
                                $receivers_key_value[$this->get_option('sec_r' . $i . '_paypal_mail')] = $calculated;
                            } else {
                                $x_share = ($order->get_line_total($items) * $this->get_option('sec_r' . $i . '_amount_percentage')) / 100;
                                $receivers_key_value[$this->get_option('sec_r' . $i . '_paypal_mail')] = $x_share;
                            }
                        }
                    }
                } 
                        
            }

// return false;
//individual product split
//            if ("parallel" == $this->get_option('_payment_mode')) {
//Primary user percent is needed because in parallel we'll specify each person's percent as it goes to each one seperatly
            $primary_user_percentage = $this->get_option('pri_r_amount_percentage');
            $primary_user_amount = round((($order_total_amount * $primary_user_percentage) / 100), 2); // rounding to avoid paypal float problem 589023
//getting user email,amount and setting percent
            for ($user = 1; $user <= 5; $user++) {
                ${'secondary_user' . $user . '_mail'} = $this->get_option('sec_r' . $user . '_paypal_mail');
                ${'secondary_user' . $user . '_percentage'} = $this->get_option('sec_r' . $user . '_amount_percentage');
                ${'secondary_user' . $user . '_amount'} = round((($order_total_amount * ${'secondary_user' . $user . '_percentage'}) / 100), 2);
            }



            $paymentfeesby = 'EACHRECEIVER';
            if ("parallel" == $this->get_option('_payment_mode')) {
                $paymentfeesby = $this->get_option('_payment_parallel_fees');
            } else {
                if ('chained' == $this->get_option('_payment_mode')) {
                    $paymentfeesby = $this->get_option('_payment_chained_fees');
                }
            }

//setting default and primary user datas
            $data_array = array('actionType' => 'PAY',
                'currencyCode' => get_woocommerce_currency(),
                'feesPayer' => $paymentfeesby,
                'returnUrl' => $success_url,
                'cancelUrl' => $cancel_url,
                'custom' => $order_id,
                'ipnNotificationUrl' => $ipnNotificationUrl,
                'requestEnvelope.errorLanguage' => 'en_US',
            );
//calculating cart total
            $manual_cart_total_amount = array_sum($receivers_key_value);

//getting the percentage for individual based on the cart total
            $receivers_key_percent = array();
            foreach ($receivers_key_value as $key => $value) {
                $receivers_key_percent[$key] = ($value / $manual_cart_total_amount) * 100;
            }

//setting the amount based on percentage above calculated
            $receivers_mail_amount = array();
            foreach ($receivers_key_percent as $receiver => $percent) {
                $receivers_mail_amount[$receiver] = round((($order->order_total * $percent) / 100), 2);
            }

//calculating order total
            $manual_order_total_amount = array_sum($receivers_mail_amount);
//sorting for high order, so we can compensate if the order total is not equal
            //arsort($receivers_mail_amount);

            if ($manual_order_total_amount > $order->order_total) {
                $amount_to_compensate = $manual_order_total_amount - $order->order_total;
                $first_person_count = 0;
                foreach ($receivers_mail_amount as $mail => $amount) {
                    if ($first_person_count == 0) {
                        $receivers_mail_amount[$mail] = $receivers_mail_amount[$mail] - $amount_to_compensate;
                    }
                    $first_person_count++;
                }
            } elseif ($manual_order_total_amount < $order->order_total) {
                $amount_to_compensate = $order->order_total - $manual_order_total_amount;
                $first_person_count = 0;
                foreach ($receivers_mail_amount as $mail => $amount) {
                    if ($first_person_count == 0) {
                        $receivers_mail_amount[$mail] = $receivers_mail_amount[$mail] + $amount_to_compensate;
                    }
                    $first_person_count++;
                }
            }

            if ("parallel" == $this->get_option('_payment_mode')) {
                $pay_count = 0;
                foreach ($receivers_mail_amount as $mail => $amount) {
                    $data_array['receiverList.receiver(' . $pay_count . ').amount'] = $amount;
                    $data_array['receiverList.receiver(' . $pay_count . ').email'] = $mail;
                    $pay_count++;
                }
            } elseif ("chained" == $this->get_option('_payment_mode')) {
                $pay_count = 0;
                $total_amount = array_sum($receivers_mail_amount); //calculate total here too, so if compensated it will be added here correctly
                // arsort($receivers_mail_amount);

                foreach ($receivers_mail_amount as $mail => $amount) {
                    if ($pay_count == 0) {
                        $data_array['receiverList.receiver(' . $pay_count . ').amount'] = $total_amount; // this is a primary user so total amount
                        $data_array['receiverList.receiver(' . $pay_count . ').email'] = $mail;
                        $data_array['receiverList.receiver(' . $pay_count . ').primary'] = "true";
                    } else {
                        $data_array['receiverList.receiver(' . $pay_count . ').amount'] = $amount;
                        $data_array['receiverList.receiver(' . $pay_count . ').email'] = $mail;
                        $data_array['receiverList.receiver(' . $pay_count . ').primary'] = "false";
                    }
                    $pay_count++;
                }
            }


            $pay_result = wp_remote_request($paypal_pay_action_url, array('method' => 'POST', 'timeout' => 20, 'headers' => $headers_array, 'body' => $data_array));


            if (is_wp_error($pay_result)) {
// Error happened by wp function. Might be due to timeout
                $re = print_r($pay_result->get_error_message(), true);
               /// $woocommerce->add_error(__('Payment error:', 'fppaypaladaptivesplit') . $re);
                wc_add_notice($re, 'error');

                return;
            }
            $jso = json_decode($pay_result['body']);

            @$payment_url = $paypal_pay_auth_without_key_url . $jso->payKey;

            if ("Success" == $jso->responseEnvelope->ack) {
//redirect to paypal
                return array(
                    'result' => 'success',
                    'redirect' => $payment_url
                );
            } else {

// No pay key obtained. Something wrong with admin setup
                $error_code = "<br>Error Code: " . $jso->error[0]->errorId;
                wc_add_notice(__($jso->error[0]->message, 'fppaypaladaptivesplit') . $error_code, 'error');
                return;
            }
        }

    }

    add_action('woocommerce_thankyou', 'fp_adaptive_split_thankyou', 10, 1);

    function fp_adaptive_split_thankyou($order_id) {
        $order = new WC_Order($order_id);

        if ($order->payment_method == 'fp_paypal_adaptive') {
            $order->update_status('on-hold', __('Awaiting IPN Response to make the Status to Processing', 'fppaypaladaptivesplit'));
        }
    }

    function add_fp_payment($methods) {
        $methods[] = 'FPPaypalAdaptivePayment';
        return $methods;
    }

    add_filter('woocommerce_payment_gateways', 'add_fp_payment');

    function fppap_add_validation_script() {
        global $woocommerce;
        if (isset($_GET['section'])) {
            if ($_GET['section'] == 'fppaypaladaptivepayment') {
                ?>
                <script type="text/javascript">
                    jQuery(document).ready(function () {
                <?php if ((float) $woocommerce->version <= (float) ('2.2.0')) { ?>
                            jQuery('#woocommerce_fp_paypal_adaptive_hide_product_field_user_role').chosen();
                    <?php
                } else {
                    ?>
                            jQuery('#woocommerce_fp_paypal_adaptive_hide_product_field_user_role').select2();
                    <?php
                }
                ?>
                        var currentstatemode = jQuery('#woocommerce_fp_paypal_adaptive__payment_mode').val();
                        if (currentstatemode === 'parallel') {
                            jQuery('#woocommerce_fp_paypal_adaptive__payment_parallel_fees').parent().parent().parent().show();
                            jQuery('#woocommerce_fp_paypal_adaptive__payment_chained_fees').parent().parent().parent().hide();
                        } else {
                            jQuery('#woocommerce_fp_paypal_adaptive__payment_chained_fees').parent().parent().parent().show();
                            jQuery('#woocommerce_fp_paypal_adaptive__payment_parallel_fees').parent().parent().parent().hide();
                        }
                        jQuery('#woocommerce_fp_paypal_adaptive__payment_mode').change(function () {
                            var presentstate = jQuery(this).val();
                            if (presentstate === 'parallel') {
                                jQuery('#woocommerce_fp_paypal_adaptive__payment_parallel_fees').parent().parent().parent().show();
                                jQuery('#woocommerce_fp_paypal_adaptive__payment_chained_fees').parent().parent().parent().hide();
                            } else {
                                jQuery('#woocommerce_fp_paypal_adaptive__payment_chained_fees').parent().parent().parent().show();
                                jQuery('#woocommerce_fp_paypal_adaptive__payment_parallel_fees').parent().parent().parent().hide();
                            }
                        });
                        jQuery('#woocommerce_fp_paypal_adaptive_pri_r_paypal_enable').attr('checked', 'checked');
                        var fppap_enable = [];
                        for (var i = 1; i <= 5; i++) {
                            fppap_enable[i] = jQuery('#woocommerce_fp_paypal_adaptive_sec_r' + i + '_paypal_enable');
                        }


                        //console.log(fppap_enable);
                        //enable/disable event handle for secondary receiver
                        for (var k = 1; k <= 5; k++) {
                            if (fppap_enable[k].is(":checked")) {
                                fppap_enable[k].parent().parent().parent().parent().next().css('display', 'table-row');
                                fppap_enable[k].parent().parent().parent().parent().next().next().css('display', 'table-row');
                            } else {
                                fppap_enable[k].parent().parent().parent().parent().next().css('display', 'none');
                                fppap_enable[k].parent().parent().parent().parent().next().next().css('display', 'none');
                            }
                        }

                        fppap_enable[1].change(function () {
                            if (fppap_enable[1].is(":checked")) {
                                fppap_enable[1].parent().parent().parent().parent().next().css('display', 'table-row');
                                fppap_enable[1].parent().parent().parent().parent().next().next().css('display', 'table-row');
                            } else {
                                fppap_enable[1].parent().parent().parent().parent().next().css('display', 'none');
                                fppap_enable[1].parent().parent().parent().parent().next().next().css('display', 'none');
                            }
                        });
                        fppap_enable[2].change(function () {
                            if (fppap_enable[2].is(":checked")) {
                                fppap_enable[2].parent().parent().parent().parent().next().css('display', 'table-row');
                                fppap_enable[2].parent().parent().parent().parent().next().next().css('display', 'table-row');
                            } else {
                                fppap_enable[2].parent().parent().parent().parent().next().css('display', 'none');
                                fppap_enable[2].parent().parent().parent().parent().next().next().css('display', 'none');
                            }
                        });
                        fppap_enable[3].change(function () {
                            if (fppap_enable[3].is(":checked")) {
                                fppap_enable[3].parent().parent().parent().parent().next().css('display', 'table-row');
                                fppap_enable[3].parent().parent().parent().parent().next().next().css('display', 'table-row');
                            } else {
                                fppap_enable[3].parent().parent().parent().parent().next().css('display', 'none');
                                fppap_enable[3].parent().parent().parent().parent().next().next().css('display', 'none');
                            }
                        });
                        fppap_enable[4].change(function () {
                            if (fppap_enable[4].is(":checked")) {
                                fppap_enable[4].parent().parent().parent().parent().next().css('display', 'table-row');
                                fppap_enable[4].parent().parent().parent().parent().next().next().css('display', 'table-row');
                            } else {
                                fppap_enable[4].parent().parent().parent().parent().next().css('display', 'none');
                                fppap_enable[4].parent().parent().parent().parent().next().next().css('display', 'none');
                            }
                        });
                        fppap_enable[5].change(function () {
                            if (fppap_enable[5].is(":checked")) {
                                fppap_enable[5].parent().parent().parent().parent().next().css('display', 'table-row');
                                fppap_enable[5].parent().parent().parent().parent().next().next().css('display', 'table-row');
                            } else {
                                fppap_enable[5].parent().parent().parent().parent().next().css('display', 'none');
                                fppap_enable[5].parent().parent().parent().parent().next().next().css('display', 'none');
                            }
                        });
                        function validateEmail(email)
                        {
                            var x = email;
                            var atpos = x.indexOf("@");
                            var dotpos = x.lastIndexOf(".");
                            if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length)
                            {
                                return false;
                            } else {
                                return true;
                            }
                        }
                        //validation for 100% on submit and email validation etc
                        jQuery('#mainform').submit(function () {
                            var fppap_pri_percent = jQuery('#woocommerce_fp_paypal_adaptive_pri_r_amount_percentage');
                            var fppap_mail = [];
                            for (var i = 1; i <= 5; i++) {
                                fppap_mail[i] = jQuery('#woocommerce_fp_paypal_adaptive_sec_r' + i + '_paypal_mail');
                            }
                            var fppap_percent = [];
                            for (var i = 1; i <= 5; i++) {
                                fppap_percent[i] = jQuery('#woocommerce_fp_paypal_adaptive_sec_r' + i + '_amount_percentage');
                            }

                            var fppap_total_percent = 0; //declare

                            for (var j = 1; j <= 5; j++) {
                                if (fppap_enable[j].is(":checked")) {

                                    if (!validateEmail(fppap_mail[j].val())) {
                                        alert("Please Check Email address for enabled Receiver");
                                        return false;
                                    }
                                    if (fppap_percent[j].val().length == 0) {
                                        alert("Percentage should not be empty for enabled Receiver");
                                        return false;
                                    } else {
                                        fppap_total_percent = fppap_total_percent + parseFloat(fppap_percent[j].val());
                                    }
                                }
                            }
                            fppap_total_percent = fppap_total_percent + parseFloat(fppap_pri_percent.val());
                            if (fppap_total_percent != 100) {
                                alert("The Sum of enabled Receiver percentages should be equal to 100");
                                return false;
                            }


                        });
                    });</script>
                <?php
            }
        }
        if (isset($_GET['taxonomy'])) {
            if ($_GET['taxonomy'] == 'product_cat' && $_GET['post_type'] == 'product') {
                ?>
                <script type="text/javascript">
                    jQuery(document).ready(function () {
                        var fppap_enable = [];
                        for (var i = 1; i <= 6; i++) {
                            fppap_enable[i] = jQuery('#_fppap_rec_' + i + '_enable');
                        }


                        function validateEmail(email)
                        {
                            var x = email;
                            var atpos = x.indexOf("@");
                            var dotpos = x.lastIndexOf(".");
                            if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length)
                            {
                                return false;
                            } else {
                                return true;
                            }
                        }
                        //validation for 100% on submit and email validation etc
                        jQuery('#edittag').submit(function () {

                            var fppap_mail = [];
                            for (var i = 1; i <= 6; i++) {
                                fppap_mail[i] = jQuery('#_fppap_rec_' + i + '_mail_id');
                            }
                            var fppap_percent = [];
                            for (var i = 1; i <= 6; i++) {
                                fppap_percent[i] = jQuery('#_fppap_rec_' + i + '_percent');
                            }

                            var fppap_total_percent = 0; //declare

                            for (var j = 1; j <= 6; j++) {
                                if (fppap_enable[j].is(":checked")) {

                                    if (!validateEmail(fppap_mail[j].val())) {
                                        alert("Please Check Email address for enabled Receiver");
                                        return false;
                                    }
                                    if (fppap_percent[j].val().length == 0) {
                                        alert("Percentage should not be empty for enabled Receiver");
                                        return false;
                                    } else {
                                        fppap_total_percent = fppap_total_percent + parseFloat(fppap_percent[j].val());
                                    }
                                }
                            }
                            console.log(fppap_total_percent);
                            //fppap_total_percent = fppap_total_percent + parseFloat(fppap_pri_percent.val());
                            if (fppap_total_percent != 100) {
                                alert("The Sum of enabled Receiver percentages should be equal to 100");
                                return false;
                            }


                        });


                    });</script>
                <?php
            }
        }
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'edit') {
                ?>
                <script type="text/javascript">
                    jQuery(document).ready(function () {
                        jQuery('#_fppap_primary_1_enable').attr('checked', 'checked');
                        jQuery('#_fppap_primary_1_enable').attr("disabled", true);
                        var fppap_enable = [];
                        for (var i = 1; i <= 5; i++) {
                            fppap_enable[i] = jQuery('#_fppap_sec_' + i + '_enable');
                        }

                        if (jQuery('#_enable_fp_paypal_adaptive').val() != "enable_indiv") {
                            jQuery('.fppap_split_indiv').css('display', 'none');
                        } else {
                            jQuery('.fppap_split_indiv').css('display', 'block');
                        }

                        jQuery('#_enable_fp_paypal_adaptive').change(function () {
                            if (jQuery(this).val() != "enable_indiv") {
                                jQuery('.fppap_split_indiv').css('display', 'none');
                            } else {
                                jQuery('.fppap_split_indiv').css('display', 'block');
                            }
                        });
                        //console.log(fppap_enable);
                        //enable/disable event handle for secondary receiver
                        for (var k = 1; k <= 5; k++) {
                            if (fppap_enable[k].is(":checked")) {
                                fppap_enable[k].parent().next().css('display', 'block');
                                fppap_enable[k].parent().next().next().css('display', 'block');
                            } else {
                                fppap_enable[k].parent().next().css('display', 'none');
                                fppap_enable[k].parent().next().next().css('display', 'none');
                            }
                        }

                        fppap_enable[1].change(function () {
                            if (fppap_enable[1].is(":checked")) {
                                fppap_enable[1].parent().next().css('display', 'block');
                                fppap_enable[1].parent().next().next().css('display', 'block');
                            } else {
                                fppap_enable[1].parent().next().css('display', 'none');
                                fppap_enable[1].parent().next().next().css('display', 'none');
                            }
                        });
                        fppap_enable[2].change(function () {
                            if (fppap_enable[2].is(":checked")) {
                                fppap_enable[2].parent().next().css('display', 'block');
                                fppap_enable[2].parent().next().next().css('display', 'block');
                            } else {
                                fppap_enable[2].parent().next().css('display', 'none');
                                fppap_enable[2].parent().next().next().css('display', 'none');
                            }
                        });
                        fppap_enable[3].change(function () {
                            if (fppap_enable[3].is(":checked")) {
                                fppap_enable[3].parent().next().css('display', 'block');
                                fppap_enable[3].parent().next().next().css('display', 'block');
                            } else {
                                fppap_enable[3].parent().next().css('display', 'none');
                                fppap_enable[3].parent().next().next().css('display', 'none');
                            }
                        });
                        fppap_enable[4].change(function () {
                            if (fppap_enable[4].is(":checked")) {
                                fppap_enable[4].parent().next().css('display', 'block');
                                fppap_enable[4].parent().next().next().css('display', 'block');
                            } else {
                                fppap_enable[4].parent().next().css('display', 'none');
                                fppap_enable[4].parent().next().next().css('display', 'none');
                            }
                        });
                        fppap_enable[5].change(function () {
                            if (fppap_enable[5].is(":checked")) {
                                fppap_enable[5].parent().next().css('display', 'block');
                                fppap_enable[5].parent().next().next().css('display', 'block');
                            } else {
                                fppap_enable[5].parent().next().css('display', 'none');
                                fppap_enable[5].parent().next().next().css('display', 'none');
                            }
                        });
                        function validateEmail(email)
                        {
                            var x = email;
                            var atpos = x.indexOf("@");
                            var dotpos = x.lastIndexOf(".");
                            if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length)
                            {
                                return false;
                            } else {
                                return true;
                            }
                        }
                        //validation for 100% on submit and email validation etc
                        jQuery('#post').submit(function () {

                            var fppap_pri_percent = jQuery('#_fppap_primary_rec_percent');
                            var fppap_mail = [];
                            for (var i = 1; i <= 5; i++) {
                                fppap_mail[i] = jQuery('#_fppap_sec_' + i + '_rec_mail_id');
                            }
                            var fppap_percent = [];
                            for (var i = 1; i <= 5; i++) {
                                fppap_percent[i] = jQuery('#_fppap_sec_' + i + '_rec_percent');
                            }

                            var fppap_total_percent = 0; //declare
                            if (jQuery('#_enable_fp_paypal_adaptive').length > 0) {
                                if (jQuery('#_enable_fp_paypal_adaptive').val() == 'enable_indiv') {
                                    for (var j = 1; j <= 5; j++) {
                                        if (fppap_enable[j].is(":checked")) {

                                            if (!validateEmail(fppap_mail[j].val())) {
                                                alert("Please Check Email address for enabled Receiver");
                                                return false;
                                            }
                                            if (fppap_percent[j].val().length == 0) {
                                                alert("Percentage should not be empty for enabled Receiver");
                                                return false;
                                            } else {
                                                fppap_total_percent = fppap_total_percent + parseFloat(fppap_percent[j].val());
                                            }
                                        }
                                    }
                                    fppap_total_percent = fppap_total_percent + parseFloat(fppap_pri_percent.val());
                                    if (fppap_total_percent != 100) {
                                        alert("The Sum of enabled Receiver percentages should be equal to 100");
                                        return false;
                                    }
                                }
                            }

                        });
                    });
                </script>
                <?php
            }
        }
    }

    add_action('admin_head', 'fppap_add_validation_script');
}

add_action('plugins_loaded', 'init_paypal_adaptive');

//Plugin Translation
function fppap_translate_file() {
    load_plugin_textdomain('fppaypaladaptivesplit', false, dirname(plugin_basename(__FILE__)) . '/languages');
}

add_action('plugins_loaded', 'fppap_translate_file');

//IPN handler function
function fppap_check_ipn() {
    if (isset($_GET['ipn'])) {
        $paypal_adaptive_payment = new FPPaypalAdaptivePayment();
        if ("yes" == $paypal_adaptive_payment->testmode) {
            $paypal_ipn_url = "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_notify-validate";
        } elseif ("no" == $paypal_adaptive_payment->testmode) {
            $paypal_ipn_url = "https://www.paypal.com/cgi-bin/webscr?cmd=_notify-validate";
        }
        $ipn_post = !empty($_POST) ? $_POST : false;
        if ($ipn_post) {
            header('HTTP/1.1 200 OK');
            $self_custom = $_GET['self_custom'];
            $received_post = file_get_contents("php://input"); // adaptive payment ipn message is different from normal paypal so we handle like this
            $posted_response = wp_remote_request($paypal_ipn_url, array('method' => 'POST', 'timeout' => 20, 'body' => $received_post));
            $received_raw_post_array = explode('&', $received_post);
            $post_maded = array(); // making post from raw
            foreach ($received_raw_post_array as $keyval) {
                $keyval = explode('=', $keyval);
                if (count($keyval) == 2)
                    $post_maded[urldecode($keyval[0])] = urldecode($keyval[1]);
            }
            if (strcmp($posted_response['body'], "VERIFIED") == 0) {
                $received_order_id = $self_custom;
                $payment_status = $post_maded['transaction[0].status']; // first user status
                if ($payment_status == 'Completed') {
                    $order = new WC_Order($received_order_id);
                    if (isset($order->id)) { // if order exist
                        $total = 0;
                        if ($paypal_adaptive_payment->get_option('_payment_mode') == 'parallel') {
                            for ($i = 0; $i <= 5; $i++) {
                                if (isset($post_maded["transaction[$i].amount"])) {
                                    $total = $total + preg_replace("/[^0-9,.]/", "", $post_maded["transaction[$i].amount"]);
                                }
                            }
                        } else {
                            $total = preg_replace("/[^0-9,.]/", "", $post_maded["transaction[0].amount"]);
                        }
                        if ($total == $order->order_total) { //checking order total with payment as suggested by paypal ipn documentaion to avoid fraud pay
                            $order->payment_complete();
                        }
                        update_post_meta($order->id, 'Transaction ID', $post_maded['transaction[0].id']); // adding transaction ID to order for future reference
                    }
                }
            }
        }
    }
}

add_action('init', 'fppap_check_ipn');

function fppap_display_product_meta() {
    global $woocommerce, $post;
    $currency_label = get_woocommerce_currency_symbol();
    $paypal_adaptive_payment = new FPPaypalAdaptivePayment();
    $gethidedroles = $paypal_adaptive_payment->settings['hide_product_field_user_role'];
    $getcurrentuser = wp_get_current_user();
    $getcurrentroles = $getcurrentuser->roles;
    $array_intersect_roles = array_intersect((array) $gethidedroles, (array) $getcurrentroles);

    if ($array_intersect_roles) {
        echo '<div class="options_group" style="display:none;">';
    } else {
        echo '<div class="options_group">';
    }

    woocommerce_wp_select(
            array(
                'id' => '_enable_fp_paypal_adaptive',
                'label' => __('Adaptive Payment', 'fppaypaladaptivesplit'),
                'options' => array(
                    'disable' => __('Use Global Settings', 'fppaypaladaptivesplit'),
                    'enable_category' => __('Use Category Settings', 'fppaypaladaptivesplit'),
                    'enable_indiv' => __('Use Product Settings', 'fppaypaladaptivesplit'),
                )
            )
    );
    woocommerce_wp_checkbox(
            array(
                'id' => '_fppap_primary_1_enable',
                'wrapper_class' => 'fppap_split_indiv',
                'label' => __('Enable Receiver 1', 'fppaypaladaptivesplit'),
                'description' => __('Enable Receiver 1', 'fppaypaladaptivesplit')
            )
    );
    woocommerce_wp_text_input(
            array(
                'id' => '_fppap_primary_rec_mail_id',
                'wrapper_class' => 'fppap_split_indiv',
                'label' => __('Receiver 1 PayPal Mail', 'fppaypaladaptivesplit'),
                'placeholder' => 'Receiver 1 PayPal Mail',
                'desc_tip' => 'true',
                'description' => __('Enter Receiver 1 PayPal Mail', 'fppaypaladaptivesplit')
            )
    );
    woocommerce_wp_text_input(
            array(
                'id' => '_fppap_primary_rec_percent',
                'wrapper_class' => 'fppap_split_indiv',
                'label' => __('Receiver 1 Payment Percentage', 'fppaypaladaptivesplit'),
                'placeholder' => 'Receiver 1 Payment Percentage',
                'desc_tip' => 'true',
                'description' => __('Enter Receiver 1 Payment Percentage', 'fppaypaladaptivesplit')
            )
    );
    woocommerce_wp_checkbox(
            array(
                'id' => '_fppap_sec_1_enable',
                'wrapper_class' => 'fppap_split_indiv',
                'label' => __('Enable Receiver 2', 'fppaypaladaptivesplit'),
                'description' => __('Enable Receiver 2', 'fppaypaladaptivesplit')
            )
    );
    woocommerce_wp_text_input(
            array(
                'id' => '_fppap_sec_1_rec_mail_id',
                'wrapper_class' => 'fppap_split_indiv',
                'label' => __('Receiver 2 PayPal Mail', 'fppaypaladaptivesplit'),
                'placeholder' => 'Receiver 2 PayPal Mail',
                'desc_tip' => 'true',
                'description' => __('Enter Receiver 2 PayPal Mail', 'fppaypaladaptivesplit')
            )
    );
    woocommerce_wp_text_input(
            array(
                'id' => '_fppap_sec_1_rec_percent',
                'wrapper_class' => 'fppap_split_indiv',
                'label' => __('Receiver 2 Payment Percentage', 'fppaypaladaptivesplit'),
                'placeholder' => 'Receiver 2 Payment Percentage',
                'desc_tip' => 'true',
                'description' => __('Enter Receiver 2 Payment Percentage', 'fppaypaladaptivesplit')
            )
    );
    woocommerce_wp_checkbox(
            array(
                'id' => '_fppap_sec_2_enable',
                'wrapper_class' => 'fppap_split_indiv',
                'label' => __('Enable Receiver 3', 'fppaypaladaptivesplit'),
                'description' => __('Enable Receiver 3', 'fppaypaladaptivesplit')
            )
    );
    woocommerce_wp_text_input(
            array(
                'id' => '_fppap_sec_2_rec_mail_id',
                'wrapper_class' => 'fppap_split_indiv',
                'label' => __('Receiver 3 PayPal Mail', 'fppaypaladaptivesplit'),
                'placeholder' => 'Receiver 3 PayPal Mail',
                'desc_tip' => 'true',
                'description' => __('Enter Receiver 3 PayPal Mail', 'fppaypaladaptivesplit')
            )
    );
    woocommerce_wp_text_input(
            array(
                'id' => '_fppap_sec_2_rec_percent',
                'wrapper_class' => 'fppap_split_indiv',
                'label' => __('Receiver 3 Payment Percentage', 'fppaypaladaptivesplit'),
                'placeholder' => 'Receiver 3 Payment Percentage',
                'desc_tip' => 'true',
                'description' => __('Enter Receiver 3 Payment Percentage', 'fppaypaladaptivesplit')
            )
    );
    woocommerce_wp_checkbox(
            array(
                'id' => '_fppap_sec_3_enable',
                'wrapper_class' => 'fppap_split_indiv',
                'label' => __('Enable Receiver 4', 'fppaypaladaptivesplit'),
                'description' => __('Enable Receiver 4', 'fppaypaladaptivesplit')
            )
    );
    woocommerce_wp_text_input(
            array(
                'id' => '_fppap_sec_3_rec_mail_id',
                'wrapper_class' => 'fppap_split_indiv',
                'label' => __('Receiver 4 PayPal Mail', 'fppaypaladaptivesplit'),
                'placeholder' => 'Receiver 4 PayPal Mail',
                'desc_tip' => 'true',
                'description' => __('Enter Receiver 4 PayPal Mail', 'fppaypaladaptivesplit')
            )
    );
    woocommerce_wp_text_input(
            array(
                'id' => '_fppap_sec_3_rec_percent',
                'wrapper_class' => 'fppap_split_indiv',
                'label' => __('Receiver 4 Payment Percentage', 'fppaypaladaptivesplit'),
                'placeholder' => 'Receiver 4 Payment Percentage',
                'desc_tip' => 'true',
                'description' => __('Enter Receiver 4 Payment Percentage', 'fppaypaladaptivesplit')
            )
    );
    woocommerce_wp_checkbox(
            array(
                'id' => '_fppap_sec_4_enable',
                'wrapper_class' => 'fppap_split_indiv',
                'label' => __('Enable Receiver 5', 'fppaypaladaptivesplit'),
                'description' => __('Enable Receiver 5', 'fppaypaladaptivesplit')
            )
    );
    woocommerce_wp_text_input(
            array(
                'id' => '_fppap_sec_4_rec_mail_id',
                'wrapper_class' => 'fppap_split_indiv',
                'label' => __('Receiver 5 PayPal Mail', 'fppaypaladaptivesplit'),
                'placeholder' => 'Receiver 5 PayPal Mail',
                'desc_tip' => 'true',
                'description' => __('Enter Receiver 5 PayPal Mail', 'fppaypaladaptivesplit')
            )
    );
    woocommerce_wp_text_input(
            array(
                'id' => '_fppap_sec_4_rec_percent',
                'wrapper_class' => 'fppap_split_indiv',
                'label' => __('Receiver 5 Payment Percentage', 'fppaypaladaptivesplit'),
                'placeholder' => 'Receiver 5 Payment Percentage',
                'desc_tip' => 'true',
                'description' => __('Enter Receiver 5 Payment Percentage', 'fppaypaladaptivesplit')
            )
    );
    woocommerce_wp_checkbox(
            array(
                'id' => '_fppap_sec_5_enable',
                'wrapper_class' => 'fppap_split_indiv',
                'label' => __('Enable Receiver 6', 'fppaypaladaptivesplit'),
                'description' => __('Enable Receiver 6', 'fppaypaladaptivesplit')
            )
    );
    woocommerce_wp_text_input(
            array(
                'id' => '_fppap_sec_5_rec_mail_id',
                'wrapper_class' => 'fppap_split_indiv',
                'label' => __('Receiver 6 PayPal Mail', 'fppaypaladaptivesplit'),
                'placeholder' => 'Receiver 6 PayPal Mail',
                'desc_tip' => 'true',
                'description' => __('Enter Receiver 6 PayPal Mail', 'fppaypaladaptivesplit')
            )
    );
    woocommerce_wp_text_input(
            array(
                'id' => '_fppap_sec_5_rec_percent',
                'wrapper_class' => 'fppap_split_indiv',
                'label' => __('Receiver 6 Payment Percentage', 'fppaypaladaptivesplit'),
                'placeholder' => 'Receiver 6 Payment Percentage',
                'desc_tip' => 'true',
                'description' => __('Enter Receiver 6 Payment Percentage', 'fppaypaladaptivesplit')
            )
    );

    echo '</div>';
}

function fppap_save_product_meta($post_id) {
    $primary_rec = $_POST['_fppap_primary_rec_mail_id'];
    $primary_rec_percent = $_POST['_fppap_primary_rec_percent'];
    for ($i = 1; $i <= 5; $i++) {
        ${'sec_rec_' . $i . 'mail'} = $_POST['_fppap_sec_' . $i . '_rec_mail_id'];
        ${'sec_rec_' . $i . '_percent'} = $_POST['_fppap_sec_' . $i . '_rec_percent'];
    }
    if (!empty($primary_rec)) {
        update_post_meta($post_id, '_fppap_primary_rec_mail_id', esc_attr($primary_rec));
    }
    if (!empty($primary_rec_percent)) {
        update_post_meta($post_id, '_fppap_primary_rec_percent', esc_attr($primary_rec_percent));
    }
    for ($i = 1; $i <= 5; $i++) {
        if (!empty(${'sec_rec_' . $i . 'mail'})) {
            update_post_meta($post_id, '_fppap_sec_' . $i . '_rec_mail_id', esc_attr(${'sec_rec_' . $i . 'mail'}));
        }
        if (!empty(${'sec_rec_' . $i . '_percent'})) {
            update_post_meta($post_id, '_fppap_sec_' . $i . '_rec_percent', esc_attr(${'sec_rec_' . $i . '_percent'}));
        }
        $enable_sec_rec = isset($_POST['_fppap_sec_' . $i . '_enable']) ? 'yes' : 'no';
        update_post_meta($post_id, '_fppap_sec_' . $i . '_enable', $enable_sec_rec);
    }
    $fp_adaptive_enable = isset($_POST['_enable_fp_paypal_adaptive']) ? 'yes' : 'no';
    update_post_meta($post_id, '_enable_fp_paypal_adaptive', esc_attr($fp_adaptive_enable));

    $fp_adaptive_select = $_POST['_enable_fp_paypal_adaptive'];
    if (!empty($fp_adaptive_select)) {
        update_post_meta($post_id, '_enable_fp_paypal_adaptive', esc_attr($fp_adaptive_select));
    }
}

add_action('woocommerce_product_options_general_product_data', 'fppap_display_product_meta');
add_action('woocommerce_process_product_meta', 'fppap_save_product_meta');

function fpap_remove_previous_add_new_product($product_id, $quantity) {
    global $woocommerce;
//check if already an individual split is present or not
//if present then don't allow the adding
    $check_already = "no";
    foreach ($woocommerce->cart->get_cart() as $items) {
        if ("enable_indiv" == get_post_meta($items['product_id'], "_enable_fp_paypal_adaptive", true)) {
            wc_add_notice('Sell Individually Product is already in cart', 'error');
            $check_already = "yes";
            return false;
        }
    }

    if ($check_already == "no") {
//remove previous cart content, if adding is a individual split
        if ("enable_indiv" == get_post_meta($product_id, "_enable_fp_paypal_adaptive", true)) {
            $woocommerce->cart->empty_cart();
        }
    }
    return array($item_details, $product_id, $variation_id);
}

//add_filter('woocommerce_add_to_cart_validation', 'fpap_remove_previous_add_new_product', 10, 2);

function fppap_cart_validation_for_rec_limit() {
    global $woocommerce;
    $count = 0;
    $receivers = array();
    foreach ($woocommerce->cart->get_cart() as $items) {
//check from individual product
        if ("enable_indiv" == get_post_meta($items['product_id'], "_enable_fp_paypal_adaptive", true)) {
//check if already present or not
            if (!in_array(get_post_meta($items['product_id'], "_fppap_primary_rec_mail_id", true), $receivers)) {
                $receivers[] = get_post_meta($items['product_id'], "_fppap_primary_rec_mail_id", true);
                $count = $count + 1;
            }
            for ($i = 1; $i <= 5; $i++) {
                if ("yes" == get_post_meta($items['product_id'], '_fppap_sec_' . $i . '_enable', true)) {
//check if already present or not
                    if (!in_array(get_post_meta($items['product_id'], '_fppap_sec_' . $i . '_rec_mail_id', true), $receivers)) {
                        $receivers[] = get_post_meta($items['product_id'], '_fppap_sec_' . $i . '_rec_mail_id', true);
                        $count++;
                    }
                }
            }
        } elseif ("enable_category" == get_post_meta($items['product_id'], "_enable_fp_paypal_adaptive", true)) {
            $fppap_product_category = wp_get_post_terms($items['product_id'], 'product_cat');
            $categ_meta = get_metadata('woocommerce_term', $fppap_product_category[0]->term_id);
            for ($i = 1; $i <= 6; $i++) {
                if ("yes" == $categ_meta['_fppap_rec_' . $i . '_enable'][0]) {
                    if (!in_array($categ_meta['_fppap_rec_' . $i . '_mail_id'][0], $receivers)) {
                        $receivers[] = $categ_meta['_fppap_rec_' . $i . '_mail_id'][0];
                        $count++;
                    }
                }
            }
        } elseif (("disable" == get_post_meta($items['product_id'], "_enable_fp_paypal_adaptive", true)) || (" " == get_post_meta($items['product_id'], "_enable_fp_paypal_adaptive", true))) {
            $fppap = new FPPaypalAdaptivePayment();
            if (!in_array($fppap->get_option('pri_r_paypal_mail'), $receivers)) {
                $receivers[] = $fppap->get_option('pri_r_paypal_mail');
                $count++;
            }

            for ($i = 1; $i <= 5; $i++) {
                if ("yes" == $fppap->get_option('sec_r' . $i . '_paypal_enable')) {
                    if (!in_array($fppap->get_option('sec_r' . $i . '_paypal_mail'), $receivers)) {
                        $receivers[] = $fppap->get_option('sec_r' . $i . '_paypal_mail');
                        $count++;
                    }
                }
            }
        }
    }
    if ($count > 6) {
        wc_add_notice('Please change or reduce cart products to make a successful sale. As it reached more than 6 paypal receivers', 'error');
    } else {
// wc_add_notice('ok', 'error');
    }
}

add_action('woocommerce_checkout_process', 'fppap_cart_validation_for_rec_limit');

function fppap_category_new_fields() {
    $term = '';
    for ($i = 1; $i <= 6; $i++) {
        ?>
        <div class = "form-field">
            <?php
            if (isset($term->term_id)) {
                $term_value = $term->term_id;
            } else {
                $term_value = "";
            }
            ?>
            <label for = "<?php echo 'receiver_' . $i . ''; ?>">Enable Receiver <?php echo $i; ?></label>
            <input style="width: auto;" id = "<?php echo '_fppap_rec_' . $i . '_enable'; ?>" type = "checkbox" aria-required = "false" size = "40" value = "<?php echo get_woocommerce_term_meta($term_value, '_fppap_rec_' . $i . '_enable', true); ?>"<?php checked("yes", get_woocommerce_term_meta($term_value, '_fppap_rec_' . $i . '_enable', true)); ?> name = "<?php echo '_fppap_rec_' . $i . '_enable'; ?>">
            <p class = "description">Enable Receiver <?php echo $i; ?></p>

        </div>
        <div class = "form-field">

            <label for = "<?php echo 'receiver_' . $i . '_mail'; ?>">Receiver <?php echo $i; ?> Email</label>
            <input id = "<?php echo '_fppap_rec_' . $i . '_mail_id'; ?>" type = "text" aria-required = "false" size = "40" value = "<?php echo get_woocommerce_term_meta($term_value, '_fppap_rec_' . $i . '_mail_id', true); ?>" name = "<?php echo '_fppap_rec_' . $i . '_mail_id'; ?>">
            <p class = "description">Receiver <?php echo $i; ?> Mail.</p>

        </div>
        <div class = "form-field">

            <label for = "<?php echo 'receiver_' . $i . '_percent'; ?>">Receiver <?php echo $i; ?> Payment Percentage</label>
            <input id = "<?php echo '_fppap_rec_' . $i . '_percent'; ?>" type = "text" aria-required = "false" size = "40" value = "<?php echo get_woocommerce_term_meta($term_value, '_fppap_rec_' . $i . '_percent', true); ?>" name = "<?php echo '_fppap_rec_' . $i . '_percent'; ?>">
            <p class = "description">Receiver <?php echo $i; ?> Payment Percentage</p>

        </div>



        <?php
    }
}

add_action('product_cat_add_form_fields', 'fppap_category_new_fields');

function fppap_category_edit_fields($term, $taxonomy) {

    for ($i = 1; $i <= 6; $i++) {
        ?>
        <tr class = "form-field">
            <th scope = "row">
                <label for = "<?php echo 'receiver_' . $i . ''; ?>">Enable Receiver <?php echo $i; ?></label>
            </th>
            <td align="left">
                <input style="width: auto;" id = "<?php echo '_fppap_rec_' . $i . '_enable'; ?>" type = "checkbox" aria-required = "false" size = "40" value = "<?php echo get_woocommerce_term_meta($term->term_id, '_fppap_rec_' . $i . '_enable', true); ?>"<?php checked("yes", get_woocommerce_term_meta($term->term_id, '_fppap_rec_' . $i . '_enable', true)); ?> name = "<?php echo '_fppap_rec_' . $i . '_enable'; ?>">
                <p class = "description">Enable Receiver <?php echo $i; ?></p>
            </td>
        </tr>
        <tr class = "form-field">
            <th scope = "row">
                <label for = "<?php echo 'receiver_' . $i . '_mail'; ?>">Receiver <?php echo $i; ?> Email</label>
            </th>
            <td>
                <input id = "<?php echo '_fppap_rec_' . $i . '_mail_id'; ?>" type = "text" aria-required = "false" size = "40" value = "<?php echo get_woocommerce_term_meta($term->term_id, '_fppap_rec_' . $i . '_mail_id', true); ?>" name = "<?php echo '_fppap_rec_' . $i . '_mail_id'; ?>">
                <p class = "description">Receiver <?php echo $i; ?> Mail.</p>
            </td>
        </tr>
        <tr class = "form-field">
            <th scope = "row">
                <label for = "<?php echo 'receiver_' . $i . '_percent'; ?>">Receiver <?php echo $i; ?> Payment Percentage</label>
            </th>
            <td>
                <input id = "<?php echo '_fppap_rec_' . $i . '_percent'; ?>" type = "text" aria-required = "false" size = "40" value = "<?php echo get_woocommerce_term_meta($term->term_id, '_fppap_rec_' . $i . '_percent', true); ?>" name = "<?php echo '_fppap_rec_' . $i . '_percent'; ?>">
                <p class = "description">Receiver <?php echo $i; ?> Payment Percentage</p>
            </td>
        </tr>

        <?php
    }
}

add_action('product_cat_edit_form_fields', 'fppap_category_edit_fields', 10, 2);

function fppap_category_save($term_id, $tt_id, $taxonomy) {
    for ($i = 1; $i <= 6; $i++) {
        if (isset($_POST['_fppap_rec_' . $i . '_mail_id'])) {
            update_woocommerce_term_meta($term_id, '_fppap_rec_' . $i . '_mail_id', esc_attr($_POST['_fppap_rec_' . $i . '_mail_id']));
        }
        if (isset($_POST['_fppap_rec_' . $i . '_percent'])) {
            update_woocommerce_term_meta($term_id, '_fppap_rec_' . $i . '_percent', esc_attr($_POST['_fppap_rec_' . $i . '_percent']));
        }

        $enable_sec_rec = isset($_POST['_fppap_rec_' . $i . '_enable']) ? 'yes' : 'no';
        update_woocommerce_term_meta($term_id, '_fppap_rec_' . $i . '_enable', $enable_sec_rec);
    }
}

add_action('edit_term', 'fppap_category_save', 10, 3);
add_action('created_term', 'fppap_category_save', 10, 3);
?>