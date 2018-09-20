<?php

if(isset($_POST['loginbtn']))
{
	$servername = 'localhost';
    $username = 'root';
    $password = '';
    $db='letstravel';
    $conn = mysqli_connect($servername,$username,$password,$db);

    if (!$conn) 
        {
            die("Connection failed: " . mysqli_connect_error());
        }
        $email=$_POST['userEmail'];
    	$p1=$_POST['userPassword'];
    	$sql = "SELECT * FROM user WHERE Email='".$email."' AND Password='".$p1."'";
    	$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)==1)
		{
			session_start();
			$_SESSION['user_email']=$_POST['userEmail'];
			$_SESSION['user_password']=$_POST['userPassword'];			
			$_SESSION['status']="loggedin";
			header("location:home.php?status=loggedin");	
		}
		else
		{
		    echo "<script type='text/javascript'>alert('Invalid Login Credentials'); window.location='userlogin.html'</script>";          
		}	
 }
?>
