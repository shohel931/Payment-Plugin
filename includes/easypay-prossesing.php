<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/easypay-style.css">
    <title>Document</title>
</head>
<body>
    
<section id="easypay_main_area">
    <div class="easypay_sub_area">
        <div class="easypay_text">
        <h2>Payment Successful!</h2>
        </div>
        <div class="easypay_box">
            <div class="easypay_content">
                <h5>Order ID : <span>#<?php echo $order ? $order->get_id() : ''; ?></span></h5>
            </div>
            <div class="easypay_content">
                <button href="<?php echo home_url(); ?>">Back Home</button>
            </div>
        </div>
    </div>
</section>


</body>
</html>