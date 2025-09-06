<?php 
/*
* Plugin Name: EasyPay BD
* Plugin URI: https://wordpress.org/plugins/easypay-bd
* Description: 
* Version: 1.0.0
* Requires at least: 5.2
* Requires PHP: 7.2
* Author: Shohel Rana
* Author URI: https://shohelrana.top
* License: GPLv2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: easypay-bd
*/


// Direct access blocked
if (!defined('ABSPATH')) {
    exit;
}


// Include
require_once plugin_dir_path(__FILE__) . 'includes/menu.php';
require_once plugin_dir_path(__FILE__) . 'includes/gateway.php';

add_action('wp_enqueue_scripts', function() {
    if (function_exists('is_order_received_page') && is_order_received_page() ) {
        wp_enqueue_style('easypay-style', plugins_url('assets/easypay-style.css', __FILE__), [], '1.0');
        wp_enqueue_style('easypay-fa', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css', [], '7.0.1');
    }
});










add_filter('woocommerce_payment_gateways', 'easypay_add_gateway_class');
function easypay_add_gateway_class($gateways) {
    $gateways[] = 'WC_EasyPay_Bkash';
    $gateways[] = 'WC_EasyPay_Nagad';
    $gateways[] = 'WC_EasyPay_Roket';
    $gateways[] = 'WC_EasyPay_Upay';
    return $gateways;
}


add_action('plugins_loaded', 'easypay_register_gateways');
function easypay_register_gateways() {
    if (!class_exists('WC_Payment_Gateway')) return ;

class WC_EasyPay_Bkash extends WC_Payment_Gateway {
    public function __construct() {
        $this->id = 'easypay_bkash';
        $this->method_title = 'EasyPay - Bkash';
        $this->method_description = 'Pay with Bkash using EasyPay BD.';
        $this->title = 'EasyPay - Bkash';

        $this->init_form_fields();
        $this->init_settings();

        $saved = get_option('easypay_button_option_bkash') ;
        if ($saved !== false) {
            $this->enabled = ($saved == 1) ? 'yes' : 'no';
        }

        add_action('woocommerce_update_options_payment_gateways_' . $this->id, [ $this, 'process_admin_options']);
    }

    public function init_form_fields() {
        $this->form_fields = [
            'enabled' => [
                'title' => 'Enable/Disable',
                'type' => 'checkbox',
                'label' => 'Enable Bkash Payment',
                'default' => 'no'
            ],
        ];
    }

    public function process_payment($order_id) {
        $order = wc_get_order($order_id);
        $redirect_url = plugins_url('includes/easypay-bkash-pay.php', __FILE__);
        return [
            'result' => 'success',
            'redirect' => $redirect_url,
        ];
    }
}
}

add_action('plugins_loaded', 'easypay_register_gateways_nagad');
function easypay_register_gateways_nagad() {
    if (!class_exists('WC_Payment_Gateway')) return ;

class WC_EasyPay_Nagad extends WC_Payment_Gateway {
    public function __construct() {
        $this->id = 'easypay_nagad';
        $this->method_title = 'EasyPay - Nagad';
        $this->method_description = 'Pay with Nagad using EasyPay BD.';
        $this->title = 'EasyPay - Nagad';

        $this->init_form_fields();
        $this->init_settings();

        $saved = get_option('easypay_button_option_nagad') ;
        if ($saved !== false) {
            $this->enabled = ($saved == 1) ? 'yes' : 'no';
        }

        add_action('woocommerce_update_options_payment_gateways_' . $this->id, [ $this, 'process_admin_options']);
    }

    public function init_form_fields() {
        $this->form_fields = [
            'enabled' => [
                'title' => 'Enable/Disable',
                'type' => 'checkbox',
                'label' => 'Enable Nagad Payment',
                'default' => 'no'
            ],
        ];
    }

    
    public function process_payment($order_id) {
        $order = wc_get_order($order_id);
        $redirect_url = plugins_url('includes/easypay-nagad-pay.php', __FILE__);
        return [
            'result' => 'success',
            'redirect' => $redirect_url,
        ];
    }
}
}

add_action('plugins_loaded', 'easypay_register_gateways_roket');
function easypay_register_gateways_roket() {
    if (!class_exists('WC_Payment_Gateway')) return ;

class WC_EasyPay_Roket extends WC_Payment_Gateway {
    public function __construct() {
        $this->id = 'easypay_roket';
        $this->method_title = 'EasyPay - Roket';
        $this->method_description = 'Pay with Roket using EasyPay BD.';
        $this->title = 'EasyPay - Roket';

        $this->init_form_fields();
        $this->init_settings();

        $saved = get_option('easypay_button_option_roket') ;
        if ($saved !== false) {
            $this->enabled = ($saved == 1) ? 'yes' : 'no';
        }

        add_action('woocommerce_update_options_payment_gateways_' . $this->id, [ $this, 'process_admin_options']);
    }

    public function init_form_fields() {
        $this->form_fields = [
            'enabled' => [
                'title' => 'Enable/Disable',
                'type' => 'checkbox',
                'label' => 'Enable Roket Payment',
                'default' => 'no'
            ],
        ];
    }

   
    public function process_payment($order_id) {
        $order = wc_get_order($order_id);
        $redirect_url = plugins_url('includes/easypay-roket-pay.php', __FILE__);
        return [
            'result' => 'success',
            'redirect' => $redirect_url,
        ];
    }
}
}

add_action('plugins_loaded', 'easypay_register_gateways_upay');
function easypay_register_gateways_upay() {
    if (!class_exists('WC_Payment_Gateway')) return ;

class WC_EasyPay_Upay extends WC_Payment_Gateway {
    public function __construct() {
        $this->id = 'easypay_upay';
        $this->method_title = 'EasyPay - Upay';
        $this->method_description = 'Pay with Upay using EasyPay BD.';
        $this->title = 'EasyPay - Upay';

        $this->init_form_fields();
        $this->init_settings();

        $saved = get_option('easypay_button_option_upay') ;
        if ($saved !== false) {
            $this->enabled = ($saved == 1) ? 'yes' : 'no';
        }

        add_action('woocommerce_update_options_payment_gateways_' . $this->id, [ $this, 'process_admin_options']);
    }

    public function init_form_fields() {
        $this->form_fields = [
            'enabled' => [
                'title' => 'Enable/Disable',
                'type' => 'checkbox',
                'label' => 'Enable Upay Payment',
                'default' => 'no'
            ],
        ];
    }

    
    public function process_payment($order_id) {
        $order = wc_get_order($order_id);
        $redirect_url = plugins_url('includes/easypay-upay-pay.php', __FILE__);
        return [
            'result' => 'success',
            'redirect' => $redirect_url,
        ];
    }
}
}





