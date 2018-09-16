<?php

session_start();

if($_SESSION['status']=='loggedin')
{
  header("location:join.html"); 
}
else
{
  header("location:userlogin.html"); 
}
?>
