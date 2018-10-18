<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('config.php');

$servername = 'localhost';
$username = 'root';
$password = '';
$db='letstravel';
$conn = mysqli_connect($servername,$username,$password,$db);
if (!$conn)   
  {     
      die("Connection failed: " . mysqli_connect_error());
  } 

$tripID=$_POST["idKeLiye"];
$sql='SELECT locations from trip_location where tripId="'.$tripID.'"';  
$sql1='SELECT * from trip where TripId="'.$tripID.'"';
$result = mysqli_query($conn,$sql);
$result1 = mysqli_query($conn,$sql1);
$rows = mysqli_num_rows($result);
$temp =  mysqli_fetch_assoc($result);
$locs = $temp["locations"];
for($j=1;$j<$rows;$j++)
{
  $temp =  mysqli_fetch_assoc($result);
  $locs=$locs." - ".$temp["locations"];
}   
$TGname = mysqli_fetch_assoc($result1);    
$tgc = $TGname["GuideContact"];
$tgn = $TGname["GuideName"];    

require("C:/xampp/htdocs/Letstravel/PHPMailer/src/PHPMailer.php");
require("C:/xampp/htdocs/Letstravel/PHPMailer/src/SMTP.php");
require("C:/xampp/htdocs/Letstravel/PHPMailer/src/Exception.php");

    $mail = new PHPMailer;
    $mail->IsSMTP(); // enable SMTP

    //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = 'help.letstravel@gmail.com';
    $mail->Password = 'help@LT123';
    $mail->SetFrom("help.letstravel@gmail.com","Letstravel");
    $mail->Subject = "Your Trip With Letstravel";
    $email = $_POST["MailKeLiye"];
    $sql100 = "SELECT FirstName FROM user WHERE Email='".$email."'";
    $res = mysqli_query($conn,$sql100);                                
    $fname = mysqli_fetch_assoc($res);
    $namee = $fname["FirstName"];
    $mail->Body = "Dear ".$namee.",<br> Congratulations! Your trip with Letstravel to ".$locs." has been succesfully booked. Please keep a watch on your mails since you will recieve further details of your trip (i.e Train details, Accomodation Details, etc) via e-mail. <br><br> Your tour guide for the trip is: <br> <b>Name: </b>".$tgn."<br><b>Contact: </b>".$tgc."<br><br> During your trip, in case of any issue, you can call us on <b>1800-806-806</b> OR <b>1800-444-444</b>. Our team will always be there for your help. <br><br>We hope to make your experience pleasant, amazing and exciting!<br><br>-Best Regards,<br> <i>Team Letstravel</i>";
     //add user email here

    $mail->AddAddress($email); // Add recipients

     if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
     } else {
        echo "Message has been sent";
        header("location: home.php?status=loggedin");
     }
?>