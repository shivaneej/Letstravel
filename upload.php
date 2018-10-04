<?php 

$servername = 'localhost';
    $username = 'root';
    $password = '';
    $db='letstravel';
    $conn = mysqli_connect($servername,$username,$password,$db);
    
    if (!$conn) 
    {
        die("Connection failed: " . mysqli_connect_error());
    }


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
?>
