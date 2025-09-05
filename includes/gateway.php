<?php 



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/easypay-style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyPay BD</title>
</head>
<body>
    
?>
<section id="easypay_main_area">
    <div class="easypay_sub_area">
        <div class="easypay_text">
        <h2>EasyPay BD</h2>
        <p>Pay with Bkash</p>
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
                <h5>Method : <span>Bkash.</span></h5>
            </div>
            <div class="easypay_content">
                <h5>Type : <span><?php echo get_option('easypay_select_option_bkash'); ?> Number.</span></h5>
            </div>
            <div class="easypay_content">
                <h5>Number : <span id="bkashNumber"><?php echo get_option('easypay_number_option_bkash'); ?><b class="copy_btn" onclick="copyNumber()"><i class="fa-regular fa-copy"></i></b></span><b>Copy</b></h5>
            </div>
            <div class="easypay_content">
                <h5>Description : <span><?php echo get_option('easypay_description_option_bkash'); ?></span></h5>
            </div>
            <div class="easypay_content">
                <form action="" method="post">
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
            clearInterval(time);
            window.location.href = "https://shohelrana.top/";
        }

        timeLeft--;
    }, 1000);
}

startCountdown();
</script>

<?php