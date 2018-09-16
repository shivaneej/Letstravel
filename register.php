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
    if(isset($_POST['register']))
    {
    	$fname=$_POST['userFirstName'];
    	$lname=$_POST['userLastName'];
    	$email=$_POST['userEmail'];
    	$mob=$_POST['userContact'];
    	$p1=$_POST['userPasswd'];
    	$p2=$_POST['userPasswdConf'];
    	if($p1===$p2)
    	{
    		$check = "SELECT Email FROM user where Email='$email'";
        	$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) 
        	{
         		$message="User already exists!";
    			echo "<script type='text/javascript'>alert('$message');</script>";
                //header( "Location:userlogin.html" );
        	}
        	else
        	{
    	 		$sql = "INSERT INTO user (FirstName,LastName, Email, Password, Mobile) VALUES ('".$fname."','".$lname."','".$email."','".$p1."',".$mob.")";
    	 		if ($conn->query($sql) === TRUE) 
				{
    				echo "Registration Successful!";
                    header( "Location:home.html" );

				} 
				else 
				{
    				echo "Error: " . $sql . "<br>" . $conn->error;
				}
    	 	}
    	}
    	else
    	{
    		$message="Passwords do not match.";
    		echo "<script type='text/javascript'>alert('$message');</script>";
            //header( "Location:register.html" );
    	}
    }

	$conn->close();
?>
