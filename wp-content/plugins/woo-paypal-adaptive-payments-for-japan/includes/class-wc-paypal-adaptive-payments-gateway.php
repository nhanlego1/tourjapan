<?php
/**
 * PayPal Adaptive Payments Gateway.
 *
 * @package  WC4JP_PayPal_Adaptive_Payments_Gateway
 * @category Gateway
 * @author   ArtisanWorkshop and PayPal Japan
 */

class WC4JP_PayPal_Adaptive_Payments_Gateway extends WC_Payment_Gateway {

	/**
	 * Init and hook in the gateway.
	 */
	public function __construct() {
		global $woocommerce;

		$this->id                = 'paypal-adaptive-payments';
		$this->icon              = apply_filters( 'woocommerce_paypal_ap_icon', plugins_url( 'assets/images/paypal.png', plugin_dir_path( __FILE__ ) ) );
		$this->has_fields        = false;
		$this->method_title      = __( 'PayPal Adaptive Payments', 'wc4jp-paypal-adaptive' );
//		$this->order_button_text = __( 'Proceed to PayPal', 'wc4jp-paypal-adaptive' );

		// API URLs.
		$this->api_prod_url        = 'https://svcs.paypal.com/AdaptivePayments/';
		$this->api_sandbox_url     = 'https://svcs.sandbox.paypal.com/AdaptivePayments/';
		$this->payment_prod_url    = 'https://www.paypal.com/jp/cgi-bin/webscr';
		$this->payment_sandbox_url = 'https://www.sandbox.paypal.com/jp/cgi-bin/webscr';
		$this->notify_url          = WC()->api_request_url( 'WC4JP_PayPal_Adaptive_Payments_Gateway' );

		// Load the form fields.
		$this->init_form_fields();

		// Load the settings.
		$this->init_settings();

		// Define user set variables.
		$this->title          = $this->get_option( 'title' );
		$this->description    = $this->get_option( 'description' );
		$this->api_username   = $this->get_option( 'api_username' );
		$this->api_password   = $this->get_option( 'api_password' );
		$this->api_signature  = $this->get_option( 'api_signature' );
		$this->app_id         = $this->get_option( 'app_id' );
		$this->receiver_email = $this->get_option( 'receiver_email' );
		$this->method         = $this->get_option( 'method' );
		$this->invoice_prefix = $this->get_option( 'invoice_prefix', 'WC-' );
		$this->header_image   = $this->get_option( 'header_image', '' );
		$this->sandbox        = $this->get_option( 'sandbox' );
		$this->debug          = $this->get_option( 'debug' );
		$this->order_button_text = $this->get_option( 'order_button_text' );

		add_action( 'woocommere_paypal_adaptive_payments_ipn', array( $this, 'process_ipn' ) );
		add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
		add_action( 'woocommerce_api_WC4JP_PayPal_Adaptive_Payments_gateway', array( $this, 'check_ipn_response' ) );

		// Active logs.
		if ( 'yes' == $this->debug ) {
			if ( class_exists( 'WC_Logger' ) ) {
				$this->log = new WC_Logger();
			} else {
				$this->log = $woocommerce->logger();
			}
		}

		$this->admin_notices();
	}

	/**
	 * Returns a bool that indicates if currency is amongst the supported ones.
	 *
	 * @return bool
	 */
	public function using_supported_currency() {
		if ( ! in_array( get_woocommerce_currency(), apply_filters( 'woocommerce_paypal_ap_supported_currencies', array( 'AUD', 'BRL', 'CAD', 'CZK', 'DKK', 'EUR', 'HKD', 'HUF', 'ILS', 'JPY', 'MYR', 'MXN', 'NOK', 'NZD', 'PHP', 'PLN', 'GBP', 'SGD', 'SEK', 'CHF', 'TWD', 'THB', 'TRY', 'USD' ) ) ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Returns a value indicating the the Gateway is available or not. It's called
	 * automatically by WooCommerce before allowing customers to use the gateway
	 * for payment.
	 *
	 * @return bool
	 */
	public function is_available() {
		// Test if is valid for use.
		$available = parent::is_available() &&
					! empty( $this->api_username ) &&
					! empty( $this->api_password ) &&
					! empty( $this->api_signature ) &&
					! empty( $this->app_id ) &&
					! empty( $this->receiver_email ) &&
					$this->using_supported_currency();

		return $available;
	}

	/**
	 * Displays notifications when the admin has something wrong with the configuration.
	 */
	protected function admin_notices() {
		if ( is_admin() ) {
			// Checks if email is not empty.
			if ( 'yes' == $this->get_option( 'enabled' ) && (
					empty( $this->api_username )
					|| empty( $this->api_password )
					|| empty( $this->api_signature )
					|| empty( $this->app_id )
					|| empty( $this->receiver_email )
				)
			) {
				add_action( 'admin_notices', array( $this, 'plugin_not_configured_message' ) );
			}

			// Checks that the currency is supported
			if ( ! $this->using_supported_currency() ) {
				add_action( 'admin_notices', array( $this, 'currency_not_supported_message' ) );
			}
		}
	}

	public function admin_options() {
		?>
		<h3><?php _e( 'PayPal Adaptive Payments', 'wc4jp-paypal-adaptive' ); ?></h3>
		<p>
			<?php _e( 'PayPal Adaptive Payments lets you split payments between 2 or more recipients. <strong>BE SURE to read the <a href="http://ec.artws.info/documentation/" target="_blank">documentation at wc.artws.info</a> before using this payment gateway!</strong>', 'wc4jp-paypal-adaptive' ); ?><br />
			<?php echo sprintf( __('<a href="%s" target="_blank">PayPal web payment plus detail is here.</a>', 'wc4jp-paypal-adaptive'),'https://www.paypal.com/jp/webapps/mpp/adaptive-payments');?><br />
			<?php echo sprintf( __('If you want to use PayPal Adaptive Payment, you need PayPal business Account. For open PayPal business account is <a href="%s" target="_blank">here.</a>', 'wc4jp-paypal-adaptive'),'https://www.paypal.com/jp/signup/account');?><br />
			<?php echo sprintf( __('PayPal Business account registration flow is <a href="%s" target="_blank">here.</a>', 'wc4jp-paypal-adaptive'),'https://www.paypal.com/jp/webapps/mpp/how-to-signup-business');?><br />
			<?php echo sprintf( __('<a href="%s" target="_blank">For submission of identification documents of PayPal business account</a>', 'wc4jp-paypal-adaptive'),'https://www.paypal.jp/jp/contents/support/faq/faq-008/');?><br />
			<?php echo sprintf( __('The adaptive payment of use requires examination. Detail is <a href="%s" target="_blank">here.</a>', 'wc4jp-paypal-adaptive'),'https://www.paypal.jp/jp/contents/support/contact/');?><br />
			<?php _e('Contact<br />For inquiries about the new Application and introduction (sales representative)<br />Tel：03-6739-7135 Weekdays 9:30 - 18:00（without holiday）<br />※It takes call charges.', 'wc4jp-paypal-adaptive');?>
			<?php echo sprintf( __('<a href="%s" target="_blank">Inquiries from the form, click here</a>', 'wc4jp-paypal-adaptive'),'https://www.paypal.jp/jp/contents/popup/m_contact/');?><br />
			<?php _e('If you already have a PayPal account (Customer Service)', 'wc4jp-paypal-adaptive');?><br />
			<?php _e('Tel：0120-271-888 or 03-6739-7360（for mobile phone and oversea) ※It takes call charges.）<br />9:00～20:00(7 days a week)', 'wc4jp-paypal-adaptive');?><br />
		</p>

		<?php if ( $this->using_supported_currency() ) : ?>
			<table class="form-table">
				<?php $this->generate_settings_html(); ?>
			</table>
		<?php else : ?>		
			<div class="inline error">
				<p>
					<strong><?php _e( 'Gateway Disabled', 'wc4jp-paypal-adaptive' ); ?></strong>: <?php _e( 'PayPal does not support your store currency.', 'wc4jp-paypal-adaptive' ); ?>
				</p>
			</div>
		<?php
		endif;
	}
	/**
	 * Initialise Gateway Settings Form Fields.
	 */
	public function init_form_fields() {

		$this->form_fields = array(
			'enabled' => array(
				'title'   => __( 'Enable/Disable', 'wc4jp-paypal-adaptive' ),
				'type'    => 'checkbox',
				'label'   => __( 'Enable PayPal Adaptive Payments', 'wc4jp-paypal-adaptive' ),
				'default' => 'yes'
			),
			'title' => array(
				'title'       => __( 'Title', 'wc4jp-paypal-adaptive' ),
				'type'        => 'text',
				'description' => __( 'This controls the title which the user sees during checkout.', 'wc4jp-paypal-adaptive' ),
				'default'     => __( 'PayPal', 'wc4jp-paypal-adaptive' ),
				'desc_tip'    => true,
			),
			'description' => array(
				'title'       => __( 'Description', 'wc4jp-paypal-adaptive' ),
				'type'        => 'textarea',
				'description' => __( 'This controls the description which the user sees during checkout.', 'wc4jp-paypal-adaptive' ),
				'default'     => __( 'Pay via PayPal; you can pay with your credit card if you don\'t have a PayPal account', 'wc4jp-paypal-adaptive' )
			),
			'order_button_text' => array(
				'title'       => __( 'Order Button Text', 'wc4jp-paypal-adaptive' ),
				'type'        => 'text',
				'description' => __( 'This controls the order buttom which the user sees during checkout.', 'wc4jp-gmo-pg' ),
				'default'     => __( 'Proceed to PayPal', 'wc4jp-paypal-adaptive' )
			),
			'api_username' => array(
				'title'       => __( 'PayPal API Username', 'wc4jp-paypal-adaptive' ),
				'type'        => 'text',
				'description' => __( 'Please enter your PayPal API username; this is needed in order to take payment.', 'wc4jp-paypal-adaptive' ),
				'default'     => '',
				'desc_tip'    => true,
			),
			'api_password' => array(
				'title'       => __( 'PayPal API Password', 'wc4jp-paypal-adaptive' ),
				'type'        => 'text',
				'description' => __( 'Please enter your PayPal API password; this is needed in order to take payment.', 'wc4jp-paypal-adaptive' ),
				'default'     => '',
				'desc_tip'    => true,
			),
			'api_signature' => array(
				'title'       => __( 'PayPal API Signature', 'wc4jp-paypal-adaptive' ),
				'type'        => 'text',
				'description' => __( 'Please enter your PayPal API signature; this is needed in order to take payment.', 'wc4jp-paypal-adaptive' ),
				'default'     => '',
				'desc_tip'    => true,
			),
			'app_id' => array(
				'title'       => __( 'PayPal Application ID', 'wc4jp-paypal-adaptive' ),
				'type'        => 'text',
				'description' => __( 'Please enter your PayPal Application ID; you need create an application on PayPal.', 'wc4jp-paypal-adaptive' ),
				'default'     => '',
				'desc_tip'    => true,
			),
			'receiver_email' => array(
				'title'       => __( 'Receiver Email', 'wc4jp-paypal-adaptive' ),
				'type'        => 'email',
				'description' => __( 'Input your main receiver email for your PayPal account.', 'wc4jp-paypal-adaptive' ),
				'default'     => '',
				'desc_tip'    => true,
				'placeholder' => 'you@youremail.com'
			),
			'method' => array(
				'title'       => __( 'Payment Method', 'wc4jp-paypal-adaptive' ),
				'type'        => 'select',
				'description' => __( 'Select the payment method: Parallel Payment - payment from a sender that is split directly among 2-6 receivers or Chained Payment - payment from a sender that is indirectly split among 1-9 secondary receivers.', 'wc4jp-paypal-adaptive' ),
				'default'     => 'parallel',
				'desc_tip'    => true,
				'options'     => array(
					'parallel' => __( 'Parallel Payment', 'wc4jp-paypal-adaptive' ),
					'chained'  => __( 'Chained Payment', 'wc4jp-paypal-adaptive' )
				)
			),
			'invoice_prefix' => array(
				'title'       => __( 'Invoice Prefix', 'wc4jp-paypal-adaptive' ),
				'type'        => 'text',
				'description' => __( 'Please enter a prefix for your invoice numbers. If you use your PayPal account for multiple stores ensure this prefix is unique as PayPal will not allow orders with the same invoice number.', 'wc4jp-paypal-adaptive' ),
				'default'     => 'WC-',
				'desc_tip'    => true,
			),
			'design' => array(
				'title'       => __( 'Design', 'wc4jp-paypal-adaptive' ),
				'type'        => 'title',
				'description' => '',
			),
			'header_image' => array(
				'title'       => __( 'Header Image (optional)', 'wc4jp-paypal-adaptive' ),
				'type'        => 'text',
				'description' => __( 'The URL of an image that displays in the header of a payment page. The URL cannot exceed 1,024 characters. The image dimensions are 90 pixels high x 750 pixels wide.', 'wc4jp-paypal-adaptive' ),
				'default'     => '',
				'desc_tip'    => true,
			),
			'testing' => array(
				'title'       => __( 'Gateway Testing', 'wc4jp-paypal-adaptive' ),
				'type'        => 'title',
				'description' => '',
			),
			'sandbox' => array(
				'title'       => __( 'PayPal sandbox', 'wc4jp-paypal-adaptive' ),
				'type'        => 'checkbox',
				'label'       => __( 'Enable PayPal sandbox', 'wc4jp-paypal-adaptive' ),
				'default'     => 'no',
				'description' => sprintf( __( 'PayPal sandbox can be used to test payments. Sign up for a developer account <a href="%s">here</a>.', 'wc4jp-paypal-adaptive' ), 'https://developer.paypal.com/' ),
			),
			'debug' => array(
				'title'       => __( 'Debug Log', 'wc4jp-paypal-adaptive' ),
				'type'        => 'checkbox',
				'label'       => __( 'Enable logging', 'wc4jp-paypal-adaptive' ),
				'default'     => 'no',
				'description' => sprintf( __( 'Log PayPal events, such as IPN requests, inside <code>woocommerce/logs/' . esc_attr( $this->id ) . '-%s.txt</code>', 'wc4jp-paypal-adaptive' ), sanitize_file_name( wp_hash( $this->id ) ) ),
			)
		);
	}

    /**
     *  Payment Field Display checkout Page
     */
	public function payment_fields() {// add ArtisanWorkshop 2015.12.10
		echo __('PayPal is a convenient [digital wallet] on the Internet. If you register your credit card information to PayPal, settlement completion only in ID and password. Without informing the important card information in the shop, you can pay more safely. Establishment of PayPal account, is easy because only to enter the necessary information to select the PayPal in settlement method.', 'wc4jp-paypal-adaptive');
		if ( $this->description ) { ?>
			<p><?php echo $this->description; ?></p>
      	<?php } 
	}


	/**
	 * Generate payment arguments for PayPal.
	 *
	 * @param  WC_Order $order Order data.
	 *
	 * @return array           PayPal payment arguments.
	 */
	protected function generate_payment_args( $order ) {
		$args = array(
			'actionType'         => 'CREATE',
			'currencyCode'       => get_woocommerce_currency(),
			'trackingId'         => $this->invoice_prefix . $order->id,
			'returnUrl'          => str_replace( '&amp;', '&', $this->get_return_url( $order ) ),
			'cancelUrl'          => str_replace( '&amp;', '&', $order->get_cancel_order_url() ),
			'ipnNotificationUrl' => $this->notify_url,
			// 'senderEmail'        => $order->billing_email,
			// 'memo'               => '',
			'requestEnvelope'    => array(
				'errorLanguage' => 'ja_JP',
				'detailLevel'   => 'ReturnAll'
			)
		);

		$receivers  = array();
		$commission = 0;
		if ( sizeof( $order->get_items() ) > 0 ) {
			foreach ( $order->get_items() as $item ) {
				if ( $item['qty'] ) {
					$product_id        = $item['product_id'];
					$product_receivers = get_post_meta( $product_id, '_paypal_adaptive_receivers', true );
					$product_receivers = array_filter( explode( PHP_EOL, $product_receivers ) );

					if ( ! is_array( $product_receivers ) || empty( $product_receivers ) ) {
						continue;
					}

					foreach ( $product_receivers as $receiver ) {
						$receiver = array_map( 'sanitize_text_field', array_filter( explode( '|', $receiver ) ) );
						if ( ! is_array( $receiver ) || empty( $receiver ) ) {
							continue;
						}

						$email          = $receiver[0];
						$line_total     = $order->get_line_total( $item, true );
						$receiver_total = round( $line_total / 100 * $receiver[1], 2 );

						// Sets the total commission.
						$commission += $receiver_total;

						// Adds a receiver or sum the commission amount.
						if ( isset( $receivers[ $email ] ) ) {
							$receivers[ $email ]['amount'] = number_format( $receivers[ $email ]['amount'] + $receiver_total, 2, '.', '' );
						} else {
							$receivers[ $email ] = array(
								'amount' => number_format( $receiver_total, 2, '.', '' ),
								'email'  => $email
							);

							if ( 'chained' == $this->method ) {
								$receivers[ $email ]['primary'] = 'false';
							}
						}
					}
				}
			}
		}

		// Set receiver list.
		if ( $commission == $order->order_total && 'parallel' == $this->method ) {

			$args['receiverList'] = array(
				'receiver' => array_values( $receivers )
			);

		} else if ( 0 < $commission ) {

			// Primary receiver / store owner.
			if ( 'chained' == $this->method ) {
				$primary_receiver = array(
					'amount'  => number_format( $order->order_total, 2, '.', '' ),
					'email'   => $this->receiver_email,
					'primary' => 'true'
				);
			} else {
				$primary_receiver = array(
					'amount' => number_format( $order->order_total - $commission, 2, '.', '' ),
					'email'  => $this->receiver_email,
				);
			}

			// Adds the primary receiver at the beginning of the list.
			array_unshift( $receivers, $primary_receiver );

			$args['receiverList'] = array(
				'receiver' => array_values( $receivers )
			);

		} else {
			// Single receiver.
			$args['receiverList'] = array(
				'receiver' => array(
					array(
						'amount' => number_format( $order->order_total, 2, '.', '' ),
						'email'  => $this->receiver_email
					)
				)
			);
		}

		$args = apply_filters( 'woocommerce_paypal_ap_payment_args', $args, $order );

		return $args;
	}

	/**
	 * Set PayPal payment options.
	 *
	 * @param string $pay_key
	 */
	protected function set_payment_options( $pay_key ) {

		$data = array(
			'payKey'          => $pay_key,
			'requestEnvelope' => array(
				'errorLanguage' => 'ja_JP',
				'detailLevel'   => 'ReturnAll'
			),
			'displayOptions'  => array(
				'businessName' => trim( substr( get_option( 'blogname' ), 0, 128 ) )
			),
			'senderOptions'   => array(
				'referrerCode' => 'ArtisanWorkshop_Cart_AP_JP'

			)
		);

		if ( '' != $this->header_image ) {
			$data['displayOptions']['headerImageUrl'] = $this->header_image;
		}

		// Sets the post params.
		$params = array(
			'body'    => json_encode( $data ),
			'timeout' => 60,
			'headers' => array(
				'X-PAYPAL-SECURITY-USERID'      => $this->api_username,
				'X-PAYPAL-SECURITY-PASSWORD'    => $this->api_password,
				'X-PAYPAL-SECURITY-SIGNATURE'   => $this->api_signature,
				'X-PAYPAL-REQUEST-DATA-FORMAT'  => 'JSON',
				'X-PAYPAL-RESPONSE-DATA-FORMAT' => 'JSON',
				'X-PAYPAL-APPLICATION-ID'       => $this->app_id,
			)
		);

		if ( 'yes' == $this->sandbox ) {
			$url = $this->api_sandbox_url;
		} else {
			$url = $this->api_prod_url;
		}

		if ( 'yes' == $this->debug ) {
			$this->log->add( $this->id, 'Setting payment options with the following data: ' . print_r( $data, true ) );
		}

		$response = wp_safe_remote_post( $url . 'SetPaymentOptions', $params );
		if ( ! is_wp_error( $response ) && 200 == $response['response']['code'] && 'OK' == $response['response']['message'] ) {
			if ( 'yes' == $this->debug ) {
				$this->log->add( $this->id, 'Payment options configured successfully!' . print_r( $response, true ) );
			}
		} else {
			if ( 'yes' == $this->debug ) {
				$this->log->add( $this->id, 'Failed to configure payment options: ' . print_r( $response, true ) );
			}
		}
	}

	/**
	 * Get the payment data.
	 *
	 * @param  WC_Order $order Order data.
	 *
	 * @return array
	 */
	protected function get_payment_data( $order ) {
		$error_message = __( 'An error has occurred while processing your payment, please try again. Or contact us for assistance.', 'wc4jp-paypal-adaptive' );
		$data = $this->generate_payment_args( $order );

		// Sets the post params.
		$params = array(
			'body'    => json_encode( $data ),
			'timeout' => 60,
			'headers' => array(
				'X-PAYPAL-SECURITY-USERID'      => $this->api_username,
				'X-PAYPAL-SECURITY-PASSWORD'    => $this->api_password,
				'X-PAYPAL-SECURITY-SIGNATURE'   => $this->api_signature,
				'X-PAYPAL-REQUEST-DATA-FORMAT'  => 'JSON',
				'X-PAYPAL-RESPONSE-DATA-FORMAT' => 'JSON',
				'X-PAYPAL-APPLICATION-ID'       => $this->app_id,
			)
		);

		if ( 'yes' == $this->sandbox ) {
			$url = $this->api_sandbox_url;
		} else {
			$url = $this->api_prod_url;
		}

		if ( 'yes' == $this->debug ) {
			$this->log->add( $this->id, 'Requesting payment key for order ' . $order->get_order_number() . ' with the following data: ' . print_r( $data, true ) );
		}

		$response = wp_safe_remote_post( $url . 'Pay', $params );

		if ( is_wp_error( $response ) ) {
			if ( 'yes' == $this->debug ) {
				$this->log->add( $this->id, 'WP_Error in generate payment key: ' . $response->get_error_message() );
			}
		} else if ( 200 == $response['response']['code'] && 'OK' == $response['response']['message'] ) {
			$body = json_decode( $response['body'], true );

			if ( isset( $body['payKey'] ) ) {
				$pay_key = esc_attr( $body['payKey'] );

				if ( 'yes' == $this->debug ) {
					$this->log->add( $this->id, 'Payment key successfully created! The key is: ' . $pay_key . print_r( $response, true ));
				}

				// Just set the payment options.
				$this->set_payment_options( $pay_key );

				return array(
					'success' => true,
					'message' => '',
					'key'     => $pay_key
				);
			}

			if ( isset( $body['error'] ) ) {
				if ( 'yes' == $this->debug ) {
					$this->log->add( $this->id, 'Failed to generate the payment key: ' . print_r( $body, true ) );
				}

				foreach ( $body['error'] as $error ) {
					if ( '579042' == $error['errorId'] ) {
						$error_message = sprintf( __( 'Your order has expired, please %s to try again.', 'wc4jp-paypal-adaptive' ), '<a href="' . esc_url( $order->get_cancel_order_url() ) . '">' . __( 'click here', 'wc4jp-paypal-adaptive' ) . '</a>' );
						break;
					} else if ( isset( $error['message'] ) ) {
						$order->add_order_note( sprintf( __( 'PayPal Adaptive Payments error: %s', 'wc4jp-paypal-adaptive' ), esc_html( $error['message'] ) ) );
					}
				}
			}

		} else {
			if ( 'yes' == $this->debug ) {
				$this->log->add( $this->id, 'Error in generate payment key: ' . print_r( $response, true ) );
			}
		}

		return array(
			'success' => false,
			'message' => $error_message,
			'key'     => ''
		);
	}

	/**
	 * Process the payment and return the result.
	 *
	 * @param  int $order_id
	 *
	 * @return array
	 */
	public function process_payment( $order_id ) {
		$order        = new WC_Order( $order_id );
		$payment_data = $this->get_payment_data( $order );

		if ( $payment_data['success'] ) {
			if ( 'yes' == $this->sandbox ) {
				$url = $this->payment_sandbox_url;
			} else {
				$url = $this->payment_prod_url;
			}

			return array(
				'result'   => 'success',
				'redirect' => esc_url_raw( add_query_arg( array( 'cmd' => '_ap-payment', 'paykey' => $payment_data['key'] ), $url ) )
			);
		} else {

			wc_add_notice( $payment_data['message'], 'error' );

			return array(
				'result'   => 'fail',
				'redirect' => ''
			);
		}
	}

	/**
	 * Check for PayPal IPN Response
	 */
	public function check_ipn_response() {
		@ob_clean();

		$ipn_response = ! empty( $_POST ) ? $_POST : false;

		if ( $ipn_response ) {

			header( 'HTTP/1.1 200 OK' );

			do_action( 'woocommere_paypal_adaptive_payments_ipn', $ipn_response );

		} else {

			wp_die( 'PayPal IPN Request Failure', 'PayPal IPN', array( 'response' => 200 ) );

		}
	}

	/**
	 * Process the IPN.
	 *
	 * @param array $posted PayPal IPN POST data.
	 */
	public function process_ipn( $posted ) {
		$posted = stripslashes_deep( $posted );

		if ( ! isset( $posted['tracking_id'] ) ) {
			exit;
		}

		// Extract the order ID.
		$order_id = intval( str_replace( $this->invoice_prefix, '', $posted['tracking_id'] ) );

		if ( 'yes' == $this->debug ) {
			$this->log->add( $this->id, 'Checking IPN response for order #' . $order_id . '...' );
		}

		// Get the order data.
		$order = new WC_Order( $order_id );

		// Checks whether the invoice number matches the order.
		// If true processes the payment.
		if ( $order->id === $order_id ) {
			$status = esc_attr( $posted['status'] );

			if ( 'yes' == $this->debug ) {
				$this->log->add( $this->id, 'Payment status: ' . $status );
			}

			switch ( $status ) {
				case 'CANCELED' :
					$order->update_status( 'cancelled', __( 'Payment canceled via IPN.', 'wc4jp-paypal-adaptive' ) );

					break;
				case 'CREATED' :
					$order->update_status( 'on-hold', __( 'The payment request was received. Funds will be transferred once the payment is approved.', 'wc4jp-paypal-adaptive' ) );

					break;
				case 'COMPLETED' :
					// Check order not already completed.
					if ( $order->status == 'completed' ) {
						if ( 'yes' == $this->debug ) {
							$this->log->add( $this->id, 'Aborting, Order #' . $order->id . ' is already complete.' );
						}
						exit;
					}

					if ( ! empty( $posted['sender_email'] ) ) {
						update_post_meta( $order->id, 'Payer PayPal address', sanitize_text_field( $posted['sender_email'] ) );
					}

					$order->add_order_note( __( 'The payment was successful.', 'wc4jp-paypal-adaptive' ) );
					$order->payment_complete();

					break;
				case 'INCOMPLETE' :
					$order->update_status( 'on-hold', __( 'Some transfers succeeded and some failed for a parallel payment or, for a delayed chained payment, secondary receivers have not been paid.', 'wc4jp-paypal-adaptive' ) );

					break;
				case 'ERROR' :
					$order->update_status( 'failed', __( 'The payment failed and all attempted transfers failed or all completed transfers were successfully reversed.', 'wc4jp-paypal-adaptive' ) );

					break;
				case 'REVERSALERROR' :
					$order->update_status( 'failed', __( 'One or more transfers failed when attempting to reverse a payment.', 'wc4jp-paypal-adaptive' ) );

					break;
				case 'PROCESSING' :
					$order->update_status( 'on-hold', __( 'The payment is in progress.', 'wc4jp-paypal-adaptive' ) );

					break;
				case 'PENDING' :
					$order->update_status( 'pending', __( 'The payment is awaiting processing.', 'wc4jp-paypal-adaptive' ) );

					break;

				default :
					// No action.
					break;
			}
		} else {
			if ( 'yes' == $this->debug ) {
				$this->log->add( $this->id, 'Invalid IPN response for order #' . $order_id . '!' );
			}
		}
	}

	/**
	 * Adds error message when the plugin is not configured properly.
	 *
	 * @return string
	 */
	public function plugin_not_configured_message() {
		$id = 'woocommerce_paypal-adaptive-payments_';
		if (
			isset( $_POST[ $id . 'api_username' ] ) && ! empty( $_POST[ $id . 'api_username' ] )
			&& isset( $_POST[ $id . 'api_password' ] ) && ! empty( $_POST[ $id . 'api_password' ] )
			&& isset( $_POST[ $id . 'api_signature' ] ) && ! empty( $_POST[ $id . 'api_signature' ] )
			&& isset( $_POST[ $id . 'app_id' ] ) && ! empty( $_POST[ $id . 'app_id' ] )
			&& isset( $_POST[ $id . 'receiver_email' ] ) && ! empty( $_POST[ $id . 'receiver_email' ] )
		) {
			return;
		}

		echo '<div class="error"><p><strong>' . __( 'PayPal Adaptive Payments Disabled', 'wc4jp-paypal-adaptive' ) . '</strong>: ' . __( 'You must fill the API Username, API Password, API Signature, Application ID and Receiver Email options.', 'wc4jp-paypal-adaptive' ) . '</p></div>';
	}

	/**
	 * Adds error message when an unsupported currency is used.
	 *
	 * @return string
	 */
	public function currency_not_supported_message() {
		echo '<div class="error"><p><strong>' . __( 'PayPal Adaptive Payments Disabled', 'wc4jp-paypal-adaptive' ) . '</strong>: ' . __( 'PayPal does not support your store currency.', 'wc4jp-paypal-adaptive' ) . '</p></div>';
	}

}
