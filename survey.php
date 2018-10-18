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
<body>
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
                        <!-- <a class="dropdown-item" href="#">Edit Profile</a> -->
                        <a class="dropdown-item" href="logout.php" name="logout_link">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>


    <!--header-->
    <div class="parallax">
  		<div class="caption">
    		<span class="surveyText">Confused where to go for your holidays?<br> Answer the questions below and let us help you recommend places you might like!</span>
  		</div>
	</div>

    <!--header ends-->

    <!--form-->
    <form class="surveyForm" method="post" action="result.php">
	  	<div class="form-group category">
	    	<label for="category">When I travel, I prefer...</label>
	    	<div class="form-check">
  				<input class="form-check-input" type="checkbox" id="cat_Heri" value="HS" name="category[]">
  				<label class="form-check-label" for="cat_AA">Heritage Sites</label>
			</div>
			<div class="form-check">
			  <input class="form-check-input" type="checkbox" id="cat_adv" value="AA" name="category[]">
			  <label class="form-check-label" for="cat_adv">Activity and Adventure</label>
			</div>
			<div class="form-check">
			  <input class="form-check-input" type="checkbox" id="cat_BN" value="BN" name="category[]">
			  <label class="form-check-label" for="cat_BN">Beaches and Nature</label>
			</div>
	  	</div>
	  	<div class="form-group budget">
	    	<label for="budget">My Budget</label>
	    	<div class="form-check">
  				<input class="form-check-input" type="checkbox" id="bud1" value="1" name="budget[]">
  				<label class="form-check-label" for="bud1">Less than ₹5000</label>
			</div>
			<div class="form-check">
			  <input class="form-check-input" type="checkbox" id="bud2" value="2" name="budget[]">
			  <label class="form-check-label" for="bud2">₹5000 - ₹20000</label>
			</div>
			<div class="form-check">
			  <input class="form-check-input" type="checkbox" id="bud3" value="3" name="budget[]">
			  <label class="form-check-label" for="bud3">₹20000 and above</label>
			</div>
		</div>

		<div class="form-group accomGrp">
	    	<label for="accomGrp">People Accompanying me are</label>
	    	<div class="form-check">
  				<input class="form-check-input" type="checkbox" id="friends" value="FR" name="group[]">
  				<label class="form-check-label" for="friends">My Friends</label>
			</div>
			<div class="form-check">
			  <input class="form-check-input" type="checkbox" id="family" value="F" name="group[]">
			  <label class="form-check-label" for="family">My Family</label>
			</div>
			<div class="form-check">
			  <input class="form-check-input" type="checkbox" id="partner" value="C" name="group[]">
			  <label class="form-check-label" for="partner">My Partner</label>
			</div>
		</div>

		<div class="form-group age">
	    	<label for="age">Age Group</label>
	    	<div class="form-check">
  				<input class="form-check-input" type="checkbox" id="kids" value="1" name="age_group[]">
  				<label class="form-check-label" for="kids">Less than 18</label>
			</div>
			<div class="form-check">
			  <input class="form-check-input" type="checkbox" id="adults" value="2" name="age_group[]">
			  <label class="form-check-label" for="adults">18 - 45</label>
			</div>
			<div class="form-check">
			  <input class="form-check-input" type="checkbox" id="senior" value="3" name="age_group[]">
			  <label class="form-check-label" for="senior">45+</label>
			</div>
		</div>

		<div class="form-group">
	      	<div class="form-check confirmBtn">
	        	<input class="form-check-input yellowBtn bottomBtn" type="submit" name="GetResult" value="Go!">
	      	</div>
	    </div>
	</form>
    <!--form ends-->



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
