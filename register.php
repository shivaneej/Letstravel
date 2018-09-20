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
        	$result = mysqli_query($conn, $check);
			if (mysqli_num_rows($result) > 0) 
        	{
    			echo "<script type='text/javascript'>alert('User already exists! Please login to continue.'); window.location='userlogin.html'</script>";
        	}
        	else
        	{
    	 		$sql = "INSERT INTO user (FirstName,LastName, Email, Password, Mobile) VALUES ('".$fname."','".$lname."','".$email."','".$p1."',".$mob.")";
    	 		if ($conn->query($sql) === TRUE) 
				{
                    echo "<script type='text/javascript'>alert('Registration Successful!'); window.location='home.php'</script>";

				} 
				else 
				{
    				echo "Error: " . $sql . "<br>" . $conn->error;
				}
    	 	}
    	}
    	else
    	{
            echo "<script type='text/javascript'>alert('Passwords do not match.'); window.location='register.html'</script>";
    	}
    }

	$conn->close();
?>
