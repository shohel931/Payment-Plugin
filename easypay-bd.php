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


// Plugin activation hook
register_activation_hook(__FILE__, 'easypay_create_payment_page');

function easypay_create_payment_page() {
    $page_check = get_page_by_title('EasyPay Payments');
    if (!isset($page_check->ID)) {
        $page_content = '[easypau_payment_page]';

        $page_id = wp_insert_post(array(
            'post_title' => 'EasyPay Payments',
            'post_type' => 'page',
            'post_name' => 'easypay-payments',
            'post_content' => $page_content,
            'post_status' => 'publish',
            'post_author' => 1,
        ));
    }
}








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
        $this->enabled = ( get_option('easypay_button_option_bkash') == 1 ) ? 'yes' : 'no';

        $this->init_form_fields();
        $this->init_settings();

        add_action('woocommerce_update_options_payment_gateways_' . $this->id, [ $this, 'process_admin_options']);
    }

    public function init_form_fields() {
        $this->form_fields = [
            'enabled' => [
                'title' => 'Enable/Disable',
                'type' => 'checkbox',
                'label' => 'Enable Bkash Payment',
                'default' => get_option('easypay_button_option_bkash') == 1  ? 'yes' : 'no'
            ],
            'number' => [
                'title' => 'Agent/Personal Number',
                'type' => 'number',
                'description' => 'Enter your Bkash Agent or Personal number',
                'default' => get_option('easypay_number_option_bkash'),
                'desc_tip' => true
            ],
            'type' => [
                'title' => 'Type',
                'type' => 'select',
                'description' => 'Select Bkash Account Type',
                'default' => get_option('easypay_select_option_bkash'),
                'options' => [
                    'Agent' => 'Agent',
                    'Personal' => 'Personal',
                ],
            ],
        ];
    }

    public function process_payment($order_id) {
        $order = wc_get_order($order_id);
        $redirect_url = plugins_url('includes/gateway.php', __FILE__);
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
        $this->enabled = ( get_option('easypay_button_option_nagad') == 1 ) ? 'yes' : 'no';

        $this->init_form_fields();
        $this->init_settings();

        add_action('woocommerce_update_options_payment_gateways_' . $this->id, [ $this, 'process_admin_options']);
    }

    public function init_form_fields() {
        $this->form_fields = [
            'enabled' => [
                'title' => 'Enable/Disable',
                'type' => 'checkbox',
                'label' => 'Enable Nagad Payment',
                'default' => get_option('easypay_button_option_nagad') == 1  ? 'yes' : 'no'
            ],
        ];
    }

    public function process_payment($order_id) {
        $order = wc_get_order($order_id);
        return [
            'result' => 'success',
            'redirect' => sitr_url('/')
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
        $this->enabled = ( get_option('easypay_button_option_roket') == 1 ) ? 'yes' : 'no';

        $this->init_form_fields();
        $this->init_settings();

        add_action('woocommerce_update_options_payment_gateways_' . $this->id, [ $this, 'process_admin_options']);
    }

    public function init_form_fields() {
        $this->form_fields = [
            'enabled' => [
                'title' => 'Enable/Disable',
                'type' => 'checkbox',
                'label' => 'Enable Roket Payment',
                'default' => get_option('easypay_button_option_roket') == 1  ? 'yes' : 'no'
            ],
        ];
    }

    public function process_payment($order_id) {
        $order = wc_get_order($order_id);
        return [
            'result' => 'success',
            'redirect' => sitr_url('/')
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
        $this->enabled = ( get_option('easypay_button_option_upay') == 1 ) ? 'yes' : 'no';

        $this->init_form_fields();
        $this->init_settings();

        add_action('woocommerce_update_options_payment_gateways_' . $this->id, [ $this, 'process_admin_options']);
    }

    public function init_form_fields() {
        $this->form_fields = [
            'enabled' => [
                'title' => 'Enable/Disable',
                'type' => 'checkbox',
                'label' => 'Enable Upay Payment',
                'default' => get_option('easypay_button_option_upay') == 1  ? 'yes' : 'no'
            ],
        ];
    }

    public function process_payment($order_id) {
        $order = wc_get_order($order_id);
        return [
            'result' => 'success',
            'redirect' => sitr_url('/')
        ];
    }
}
}






// Hook Register
add_action('woocommerce_thankyou', 'easypay_custom_checkout_page', 10, 1);
function easypay_custom_checkout_page($order_id) {
    if (!$order_id) return;
    $order = wc_get_order($order_id);
    if (!$order) return;



$method = $order->get_payment_method();

$methods = [
    'easypay_bkash' => 'Bkash',
    'easypay_nagad' => 'Nagad',
    'easypay_roket' => 'Roket',
    'easypay_upay' => 'Upay',
];

if (!array_key_exists($method, $methods)) return;
$method_name = $methods[$method];

$key = strtolower($method_name);
$number = get_option("easypay_number_option_{$key}");
$type = get_option("easypay_select_option_{$key}");
$description = get_option("easypay_description_option_{$key}");




?>

<section id="easypay_main_area">
    <div class="easypay_sub_area">
        <div class="easypay_text">
        <h2>EasyPay BD</h2>
        <p>Pay with <?php echo $method_name; ?></p>
        <p id="timeBox">15 : 00 min</p>
        </div>
        <div class="easypay_box">
            <div class="easypay_content">
                <h5>Order ID : <span>#<?php echo $order->get_id(); ?></span></h5>
            </div>
            <div class="easypay_content">
                <h5>Total Pay : <span><?php echo $order->get_total(); ?> Taka.</span></h5>
            </div>
            <div class="easypay_content">
                <h5>Method : <span><?php echo $method_name; ?>.</span></h5>
            </div>
            <div class="easypay_content">
                <h5>Type : <span><?php echo $type; ?> Number.</span></h5>
            </div>
            <div class="easypay_content">
                <h5>Number : <span id="bkashNumber"><?php echo $number; ?><b class="copy_btn" onclick="copyNumber()"><i class="fa-regular fa-copy"></i></b></span><b>Copy</b></h5>
            </div>
            <div class="easypay_content">
                <h5>Description : <span><?php echo $description; ?></span></h5>
            </div>
            <div class="easypay_content">
                <form method="post" enctype="multipart/form-data">
                    <span>Transaction : <input type="text" name="transaction" id="" placeholder="ES987NLG9" required></span><br><br>
                    <span>Upload Image : <input type="file" name="image" id=""></span> <br><br>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    function copyNumber() {
        const number = document.getElementById("bkashNumber").innerText;
        navigator.clipboard.writeText(number).then(() => {
            alert("Number Copied: " + number);
        })
    }

// Time 
let timeLeft = 15 * 60;

function startCountdown() {
    const timer = setInterval(() => {
        let minutes = Math.floor(timeLeft / 60);
        let seconds = timeLeft % 60;

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        document.getElementById("timeBox").innerText = `${minutes} : ${seconds} min`;

        if (timeLeft <= 0) {
            clearInterval(timer);
            window.location.href = "https://shohelrana.top/";
        }

        timeLeft--;
    }, 1000);
}

startCountdown();
</script>
<?php
}


