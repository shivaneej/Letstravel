<?php

$razor_api_key = "rzp_test_WsZ1lzrXRw9B4Z";
if(isset($_POST['PayTrip']))
{
	$amt = ($_POST["cost"])*100;
	$tripID = $_POST["tripKaID"];
	$userEmail = $_POST["email"];
}

?>