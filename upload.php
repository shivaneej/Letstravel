<?php 
session_start();
$servername = 'localhost';
    $username = 'root';
    $password = '';
    $db='letstravel';
    $conn = mysqli_connect($servername,$username,$password,$db);
    
    if (!$conn) 
    {
        die("Connection failed: " . mysqli_connect_error());
    }


//Admin create trip php code
if(isset($_POST['create'])){

	$startDate=$_POST['startDate'];
	$endDate=$_POST['endDate'];
	$basePrice=$_POST['basePrice'];
	$tgName=$_POST['tgName'];
	$tgCont=$_POST['tgCont'];
	$status=1;
	$createdBy="shivaneej02@gmail.com";

	$thumbnail=$_FILES['tn-uploaded'];
  $itinerary=$_FILES['it-uploaded'];

  $tripId=$thumbnail['name'];

  $tnName=$thumbnail['name'];
  $itName=$itinerary['name'];
  //$multipleLocs=$_POST['locs'];
  $startLoc=$_POST['start'];


  /*foreach ($_POST['locs'] as $multipleLocs) {
    echo $multipleLocs;
    # code...
  }
  echo $startDate." ".$endDate." ".$basePrice." ".$tgName." ".$tgCont." ".$status." ".$createdBy." ".$tripId." ".$startLoc;*/


  $start=0;
	$sql="INSERT INTO trip (TripId,Image,BasePrice,Status,Itinerary,StartDate,EndDate,CreatedBy,GuideName,GuideContact) VALUES ('".$tripId."','".$tnName."',".$basePrice.",".$status.",'".$itName."','".$startDate."','".$endDate."','".$createdBy."','".$tgName."','".$tgCont."')";

  if ($conn->query($sql) === TRUE) 
        {           
                    //echo "inserted";
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        

  foreach ($_POST['locs'] as $multipleLocs) {
    if($multipleLocs==$startLoc){
      $start=1;
    }else{$start=0;}
    $sql2="INSERT INTO trip_location(tripId,locations,startLoc) VALUES ('".$tripId."','".$multipleLocs."',".$start.")";
    if ($conn->query($sql2) === TRUE) 
        {           
                    //echo "inserted";
          echo "<script type='text/javascript'>alert('hello');</script>";
        } 
        else 
        {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
  }

  


  $tnExt=explode('.', $tnName);
  $tnActualExt=strtolower(end($tnExt));

  $itExt=explode('.', $itName);
  $itActualExt=strtolower(end($itExt));

  $allowedTn=array('jpg','jpeg','png');
  $allowedIt=array('pdf','txt','docx','doc');

  $itStatus=0;
  $tnStatus=0;

  if(in_array($tnActualExt, $allowedTn)){
  	if($thumbnail['error']===0){

  		$fileDestTn='uploads/'.$thumbnail['name'];

  		move_uploaded_file($thumbnail['tmp_name'], $fileDestTn);
  		$tnStatus=1;
  	}else{
  		echo "<script type='text/javascript'>alert('Error uploading image file!');window.location='dashboard.php?status=loggedin';</script>";
  	}
  }else{
  	echo "<script type='text/javascript'>alert('You cannot upload files of this type!');window.location='dashboard.php?status=loggedin';</script>";
  }

  if(in_array($itActualExt, $allowedIt)){
  	if($itinerary['error']===0){
  		
  		$fileDestIt='uploads/'.$itinerary['name'];
  		
  		move_uploaded_file($itinerary['tmp_name'], $fileDestIt);
  		$itStatus=1;
  		
  	}else{
  		echo "<script type='text/javascript'>alert('Error uploading text file!');window.location='dashboard.php?status=loggedin';</script>";
  	}
  }else{
  	echo "<script type='text/javascript'>alert('You cannot upload files of this type!');window.location='dashboard.php?status=loggedin';</script>";
  }

  if($tnStatus==1 && $itStatus==1){
  	header("Location: dashboard.php?uploadsuccess");
  }
}

//user join trip php code
if(isset($_POST['JoinTrip'])){

  $email=$_SESSION['user_email'];
  $from_loc=$_POST['from_loc'];
  $accom_pref=$_POST['accpref'];
  $meal_pref=$_POST['mealpref'];
  $travel_pref=$_POST['travelpref'];

  //$tripId=$_SESSION['tripid'];

  $sql3='SELECT TripId from trip where Image="'.$_SESSION['tripid'].'"';
  //$tripId=mysqli_query($conn,$sql3);

  $ans=mysqli_fetch_assoc(mysqli_query($conn,$sql3));
  $tripId=$ans['TripId'];
  


  $i=0;
 $passCount = $_POST['passengerCount'];
  while($passCount!=0){
  $fname=$_POST['fname'.$i];
  $lname=$_POST['lname'.$i];
  $age=(int)$_POST['age'.$i];
  $gender=$_POST['gender'.$i];
  $contact=$_POST['contact'.$i];
  $aadhar=$_POST['aadharno'.$i];
  

  $sql1=  "INSERT into join_trip VALUES('".$email."','".$tripId."','".$fname."','".$lname."',".$age.",'".$gender."',".$contact.",".$aadhar.")";

  if ($conn->query($sql1) === TRUE) 
        {           
                    //echo "inserted";
        } 
        else 
        {
            echo "Error: " . $sql1 . "<br>" . $conn->error;
        }

  $i++;
  $passCount--;
  }

  $sql="INSERT into user_pref VALUES ('".$email."','".$from_loc."','".$accom_pref."','".$meal_pref."','".$travel_pref."')";

  if ($conn->query($sql) === TRUE) 
        {           
                    //echo "inserted";
          
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $cost = (int)$_POST['cost'];
        $tripKaID = $_POST['tripKaID'];
        $email = $_POST['email'];
        ?>

        <form action="payment.php" id="myform" method="post">
        <input type="hidden" name="cost" id="costforpayment" value="<?php echo $cost; ?>">
        <input type="hidden" name="tripKaID" id="tripIdForMail" value="<?php echo $tripKaID;?>">
        <input type="hidden" name="email" id="UseremailForMail" value="<?php echo $email;?>">
        <input class="form-check-input yellowBtn bottomBtn" type="submit" name="PayTrip" value="Confirm Booking" style="background-color: #ffc312;
            border: none;
            width: 30%;
            border-radius: 5px;
            color: white;
            height: 10%;
            margin-left: 35%;
            top: 50%;
            position: absolute;
            font-size: 24px;">
        </form>

        <?php
        


}
?>

