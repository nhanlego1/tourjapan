<?php

class WCMp_Payment_Paypal_Adaptive_Settings_Gneral {

    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;
    private $tab;
    private $subsection;

    /**
     * Start up
     */
    public function __construct($tab, $subsection) {
        $this->tab = $tab;
        $this->subsection = $subsection;
        $this->options = get_option("wcmp_{$this->tab}_{$this->subsection}_settings_name");
        $this->settings_page_init();
    }

    /**
     * Register and add settings
     */
    public function settings_page_init() {
        global $WCMp, $WCMp_Paypal_Adaptive_Gateway;

        $settings_tab_options = array(
            "tab" => "{$this->tab}",
            "ref" => &$this,
            "subsection" => "{$this->subsection}",
            "sections" => array(
                "default_settings_section" => array("title" => __('Configure your Adaptive Payment Settings', $WCMp_Paypal_Adaptive_Gateway->text_domain), // Section one
                    "fields" => array(
                        "primary_receiver_name" => array('title' => __('Primary Receiver Name', $WCMp_Paypal_Adaptive_Gateway->text_domain), 'type' => 'text', 'id' => 'primary_receiver_name', 'label_for' => 'primary_receiver_name', 'name' => 'primary_receiver_name', 'hints' => __('Enter the Primary Receiver Name.', $WCMp_Paypal_Adaptive_Gateway->text_domain)), // Receiver Name
                        "primary_receiver_email" => array('title' => __('Primary Receiver paypal Email', $WCMp_Paypal_Adaptive_Gateway->text_domain), 'type' => 'text', 'id' => 'primary_receiver_email', 'label_for' => 'primary_receiver_email', 'name' => 'primary_receiver_email', 'hints' => __('Enter the Primary Receiver paypal email Id.', $WCMp_Paypal_Adaptive_Gateway->text_domain)), // Receiver Email
                        "primary_receiver_percentage" => array('title' => __('Primary Receiver Percentage', $WCMp_Paypal_Adaptive_Gateway->text_domain), 'type' => 'text', 'id' => 'primary_receiver_percentage', 'label_for' => 'primary_receiver_percentage', 'name' => 'primary_receiver_percentage', 'hints' => __('Enter the Primary Receiver Percentage Only numeric.', $WCMp_Paypal_Adaptive_Gateway->text_domain)), // Receiver Email
                        "primary_description" => array('title' => __('Primary Receiver Details', $WCMp_Paypal_Adaptive_Gateway->text_domain), 'type' => 'textarea', 'cols' => 40, 'id' => 'primary_description', 'label_for' => 'primary_description', 'name' => 'primary_description', 'hints' => __('Enter the Primary Receiver details.', $WCMp_Paypal_Adaptive_Gateway->text_domain)), // Receiver Email
                        "receivers" => array('title' => __('Other Receivers Details', $WCMp_Paypal_Adaptive_Gateway->text_domain), 'type' => 'multiinput', 'id' => 'receivers', 'label_for' => 'receivers', 'name' => 'receivers', 'options' => array(
                                "receiver_name" => array('label' => __('Receiver Name', $WCMp_Paypal_Adaptive_Gateway->text_domain), 'type' => 'text', 'label_for' => 'receiver_name', 'name' => 'receiver_name', 'class' => 'regular-text'),
                                "receiver_email" => array('label' => __('Receiver Paypel Email', $WCMp_Paypal_Adaptive_Gateway->text_domain), 'type' => 'text', 'label_for' => 'receiver_email', 'name' => 'receiver_email', 'class' => 'regular-text'),
                                "receiver_percentage" => array('label' => __('Receiver Percentage', $WCMp_Paypal_Adaptive_Gateway->text_domain), 'type' => 'text', 'label_for' => 'receiver_percentage', 'name' => 'receiver_percentage', 'class' => 'regular-text'),
                                "description" => array('label' => __('Receiver Details', $WCMp_Paypal_Adaptive_Gateway->text_domain), 'type' => 'textarea', 'label_for' => 'description', 'name' => 'description', 'cols' => 40)
                            )
                        )
                    )
                )
            )
        );

        $WCMp->admin->settings->settings_field_withsubtab_init(apply_filters("settings_{$this->tab}_{$this->subsection}_tab_options", $settings_tab_options));
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function wcmp_payment_paypal_adaptive_settings_sanitize($input) {
        global $WCMp_Paypal_Adaptive_Gateway;
        $new_input = array();
        $msg = '';
        $hasError = false;
        if (isset($input['primary_receiver_name']))
            $new_input['primary_receiver_name'] = sanitize_text_field($input['primary_receiver_name']);

        if ($new_input['primary_receiver_name'] == '') {
            $hasError = true;
            $msg .=__('Please Enter the Primary Receiver name <br/>', $WCMp_Paypal_Adaptive_Gateway->text_domain);
        }

        if (isset($input['primary_receiver_email']))
            $new_input['primary_receiver_email'] = sanitize_text_field($input['primary_receiver_email']);

        if ($new_input['primary_receiver_email'] == '') {
            $hasError = true;
            $msg .=__('Please Enter the Primary Receiver email <br/>', $WCMp_Paypal_Adaptive_Gateway->text_domain);
        }

        if (isset($input['primary_receiver_percentage']))
            $new_input['primary_receiver_percentage'] = sanitize_text_field($input['primary_receiver_percentage']);

        if ($new_input['primary_receiver_percentage'] == '') {
            $hasError = true;
            $msg .=__('Please Enter the Primary Receiver Percentage <br/>', $WCMp_Paypal_Adaptive_Gateway->text_domain);
        }


        if (isset($input['primary_description']))
            $new_input['primary_description'] = sanitize_text_field($input['primary_description']);

        if (isset($input['receivers']))
            $new_input['receivers'] = ( $input['receivers'] );

        if ($hasError) {
            add_settings_error(
                    "wcmp_{$this->tab}_{$this->subsection}_settings_name", esc_attr("dc_{$this->tab}_settings_admin_updated"), $msg, 'error'
            );
            return false;
        }

        if (!$hasError) {
            add_settings_error(
                    "wcmp_{$this->tab}_{$this->subsection}_settings_name", esc_attr("dc_{$this->tab}_settings_admin_updated"), __('Patpal Adaptive settings updated', $WCMp_Paypal_Adaptive_Gateway->text_domain), 'updated'
            );
        }

        return $new_input;
    }

    /**
     * Print the Section text
     */
    public function default_settings_section_info() {
        global $WCMp_Paypal_Adaptive_Gateway;
        _e('Receiver settings only applicable for Single Vendor. and sum all receivers percentage must be = 100', $WCMp_Paypal_Adaptive_Gateway->text_domain);
    }

}
