<?php 
require_once( dirname( __FILE__ ) . '/../../../../wp-load.php' );
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/easypay-style.css">
    <title>Payment Successful!</title>
</head>
<body>
    
<section id="easypay_main_area">
    <div class="easypay_sub_area">
        <div class="easypay_text" style="margin-bottom: 10px;">
        <h2>Payment Successful!</h2>
        </div>
        <div class="easypay_box" style="text-align: center; border: none; background: #fff;">
            <div class="easypay_content">
                <img src="<?php echo plugins_url('/assets/success.png', __FILE__); ?>" alt="success" style="width: 100px; height: 100px; margin-bottom: 10px;">
            </div>
            <div class="easypay_content">
                <a href="<?php echo site_url(); ?>" class="bc_btn">Back Home</a>
            </div>
        </div>
    </div>
</section>







</body>
</html>