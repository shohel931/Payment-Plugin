<?php 
// Wordpress Load
require_once dirname(__FILE__, 5) . '/wp-load.php';

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// WooCommerce Load
if ( ! class_exists( 'WooCommerce' ) ) {
    exit; // Exit if WooCommerce is not active.
}

// Get Order ID
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
$order = wc_get_order( $order_id );

// if (!$order) {
//     $redirect_url = plugins_url('includes/easypay-bkash-pay.php', __FILE__);
//     exit;
// }

// Admin option get
$type = get_option('easypay_select_option_upay');
$number = get_option('easypay_number_option_upay');
$description = get_option('easypay_description_option_upay');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaction = sanitize_text_field($_POST['transaction']);
    
    // order update
    $order->update_status('processing', 'Payment completed via EasyPay Upay. Transaction ID: ' . $transaction);

    // Empty cart
    WC()->cart->empty_cart();

    // Redirect to thank you page
    wp_safe_redirect(site_url('/processing.php?order_id=' . $order->get_id()));
    exit;
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/easypay-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <title>EasyPay - Upay Pay</title>
    <script src="../assets/easypay-script.js"></script>
</head>
<body>
    


<section id="easypay_main_area">
    <div class="easypay_sub_area">
        <div class="easypay_text">
        <h2>EasyPay BD</h2>
        <p>Pay with Upay</p>
        <p id="timeBox">15 : 00 min</p>
        </div>
        <div class="easypay_box">
            <div class="easypay_content">
                <h5>Order ID : <span>#<?php echo $order ? $order->get_id() : 'Not Found'; ?></span></h5>
            </div>
            <div class="easypay_content">
                <h5>Total Pay : <span><?php echo $order ? $order->get_total() : '0'; ?> Taka.</span></h5>
            </div>
            <div class="easypay_content">
                <h5>Method : <span>Upay</span></h5>
            </div>
            <div class="easypay_content">
                <h5>Type : <span><?php echo esc_html($type); ?> Number.</span></h5>
            </div>
            <div class="easypay_content">
                <h5>Number : <span id="bkashNumber"><?php echo esc_html($number); ?><b class="copy_btn" onclick="copyNumber()"><i class="fa-regular fa-copy"></i></b></span><b>Copy</b></h5>
            </div>
            <div class="easypay_content">
                <h5>Description : <span><?php echo esc_html($description); ?></span></h5>
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



</body>
</html>