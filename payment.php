<?php


require_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Letstravel</title>
	<meta name="viewport" content="width=device-width">
	<link rel="shortcut icon" href="images/favicon.png">
    <style type="text/css">
        .razorpay-payment-button
        {
           background-color: #ffc312;
            border: none;
            width: 30%;
            border-radius: 5px;
            color: white;
            height: 10%;
            margin-left: 35%;
            top: 50%;
            position: absolute;
            font-size: 24px;
        }
    </style>
</head>
<body> 
	<form action="mail.php" method="POST">
<!-- Note that the amount is in paise -->
<script
    src="https://checkout.razorpay.com/v1/checkout-new.js"
    data-key="<?php echo $razor_api_key ;?>"
    data-amount="<?php echo $amt ;?>"
    data-name="Letstravel"
    data-image="images/favicon.png"
    data-prefill.name=""
    data-prefill.email="support@Letstravel.com"
    data-theme.color="#ffc312"
></script>
<input type="hidden" value="Hidden Element" name="hidden">
<input type="hidden" value="<?php echo $tripID ;?>" name="idKeLiye">
<input type="hidden" value="<?php echo $userEmail ;?>" name="MailKeLiye">
</form>
</body>
</html>