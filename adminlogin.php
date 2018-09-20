<?php

if(isset($_POST['adminLogin']))
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
        $email=$_POST['adminEmail'];
    	$p1=$_POST['adminPwd'];
    	$sql = "SELECT * FROM admin WHERE Email='".$email."' AND Password='".$p1."'";
    	$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)==1)
		{
			session_start();
			$_SESSION['admin_email']=$_POST['adminEmail'];
			$_SESSION['admin_password']=$_POST['adminPwd'];			
			$_SESSION['status']="loggedin";
			header("location:dashboard.php?status=loggedin");	
		}
		else
		{
    		echo "<script type='text/javascript'>alert('Invalid Login Credentials'); window.location='adminlogin.html'</script>";           
		}	
 }
?>
