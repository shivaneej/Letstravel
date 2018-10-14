<?php

session_start();

if($_SESSION['status']=='loggedin')
{
	?>
<!DOCTYPE html>
<html>
<head>
		<title>Letstravel</title>
	<link rel="shortcut icon" href="images/favicon.png">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500" rel="stylesheet">
	<!--Bootstrap CSS-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="override.css">
	<link rel="stylesheet" type="text/css" href="survey.css">
</head>
<body style="background-color: #000000;">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand heading" href="home.php?status=loggedin"><b>Letstravel</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarNavDropdown" class="navbar-collapse collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="home.php?status=loggedin">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="home.php?status=loggedin#Upcoming">Upcoming Trips</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="www.google.com">FAQ</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown" id="in_nav">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Hi, <?php  
                             $servername = 'localhost';
    						 $username = 'root';
    						 $password = '';
     						 $db='letstravel';
    						 $conn = mysqli_connect($servername,$username,$password,$db);
    						if (!$conn) 	
        					{			
            					die("Connection failed: " . mysqli_connect_error());
        					}                            
                                                        	
                            	$email=$_SESSION['user_email'];
                                $sql="SELECT FirstName FROM user WHERE Email='".$email."'";
                                $fname = mysqli_query($conn,$sql);                                
                                while ($row=$fname->fetch_assoc()) {                            	
                            	echo $row['FirstName'];
                              }
                                                     
                            ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Edit Profile</a>
                        <a class="dropdown-item" href="logout.php" name="logout_link">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>


    <div class="header">
        You could go to one of these places!
    </div>
    <!--recommendation tab-->

    <div class="tab">
        <div class="tabContent">
            

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
    if(isset($_POST['GetResult']))
    {
        //category, budget, group, age_group
        if(!empty($_POST['category']) || !empty($_POST['group']))
        {
            $inner = "";
            $outer = "";
            if(!empty($_POST['category']))
            {
                $inner = "'".$_POST['category'][0]."'";

                for ($i=1; $i<sizeof($_POST['category']) ; $i++) 
                { 
                    $inner = $inner.",'".$_POST['category'][$i]."'";
                }
            }
            if(!empty($_POST['group']))
            {
                $outer = "'".$_POST['group'][0]."'";
                for ($i=1; $i<sizeof($_POST['group']) ; $i++) 
                { 
                    $outer = $outer.",'".$_POST['group'][$i]."'";
                }
            }
            if($inner == "")
                $sql = 'SELECT distinct Location, Link from recom_locs WHERE TripGroup IN ('.$outer.')';
            else if($outer == "")
                $sql = 'SELECT distinct Location, Link from recom_locs WHERE Category IN ('.$inner.')';
            else
                $sql = 'SELECT distinct Location, Link from recom_locs WHERE TripGroup IN ('.$outer.') AND Category IN ('.$inner.')';
            //echo $sql;
            $result = mysqli_query($conn,$sql);  
            $rows = mysqli_num_rows($result);                              
            for($i=0;$i<$rows;$i++) 
            {          
                $loc = mysqli_fetch_assoc($result);                    
                echo '<div class="result">
                        <img src ="images/recommendation/'.$loc['Location'].'.jpg">
                        <div class="info">
                            <h3>'.$loc['Location'].'</h3>
                            <a href="'.$loc['Link'].'">Know More...</a>
                        </div>
                    </div>';
            }
            if($rows==0)
            {
            	echo 
            	'<div class="result" style="margin-left: 20%;">
                <img src="images/error.png" style="width: 20%;">
                <div class="info">
                    <p style="color: #fafafa;">We are sorry! We could not find any location to match your requirements. Click <a href="home.php?status=loggedin">here</a> to browse other trips planned by Letstravel.</p>
                </div>
            </div>';
            }
        }
    }   
        

?>

       </div>
    </div>



    <!--tab ends-->



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="js/animations.js"></script>
</body>
</html>

<?php
}
else
{
  header("location:userlogin.html"); 
}     
 
    

mysqli_close($conn);
?>
