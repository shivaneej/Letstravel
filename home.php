
<!DOCTYPE html>
<html>
<head>
	<title>Letstravel</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="shortcut icon" href="images/favicon.png">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500" rel="stylesheet">
	<!--Bootstrap CSS-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/override.css">
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="-10">
	<!--navigation bar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand heading" href="#">Letstravel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarNavDropdown" class="navbar-collapse collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#Home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Upcoming">Upcoming Trips</a>
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
                            session_start();
                            if($_SESSION['status']=='loggedin')
                            {                            	
                            	$email=$_SESSION['user_email'];
                                $sql="SELECT FirstName FROM user WHERE Email='".$email."'";
                                $fname = mysqli_query($conn,$sql);                                
                                while ($row=$fname->fetch_assoc()) {                            	
                            	echo $row['FirstName'];
                              }
                            }                         
                            ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Edit Profile</a>
                        <a class="dropdown-item" href="logout.php" name="logout_link">Logout</a>
                    </div>
                </li>
                <li class="nav-item" id="outl_nav">
                    <a class="nav-link" href="userlogin.html">Login</a>
                </li>
                <li class="nav-item" id="outr_nav">
                    <a class="nav-link" href="register.html">Sign Up</a> 
                </li>
            </ul>
        </div>
    </nav>


    <!--carousel-->
    <div id="Home">
    	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  			<div class="carousel-inner">
    			<div class="carousel-item active">
      				<img class="d-block w-100" src="images/slideshow/beach.png" alt="Andaman and Nicobar">
    			</div>
	    		<div class="carousel-item">
	      			<img class="d-block w-100" src="images/slideshow/taj.png" alt="Taj Mahal">
	    		</div>
	    		<div class="carousel-item">
	      			<img class="d-block w-100" src="images/slideshow/munnar.png" alt="Munnar">
	    		</div>
	    		<div class="carousel-item">
	      			<img class="d-block w-100" src="images/slideshow/chadar.png" alt="Chadar Trek">
	    		</div>
	    		<div class="carousel-item">
	      			<img class="d-block w-100" src="images/slideshow/udaipur.png" alt="Udaipur">
	    		</div>
	    		<div class="carousel-item">
	      			<img class="d-block w-100" src="images/slideshow/climbing.png" alt="Treks">
	    		</div>
	    		<div class="carousel-item">
	      			<img class="d-block w-100" src="images/slideshow/para.png" alt="Sports">
	    		</div>
	    		<div class="carousel-item">
	      			<img class="d-block w-100" src="images/slideshow/dal.png" alt="Srinagar">
	    		</div>
	    		<div class="carousel-item">
	      			<img class="d-block w-100" src="images/slideshow/ladakh.png" alt="Leh Ladakh">
	    		</div>
	    		<div class="carousel-item">
	      			<img class="d-block w-100" src="images/slideshow/lotus.png" alt="Lotus Temple">
	    		</div>
    		
  			</div>
  			<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    			<span class="sr-only">Previous</span>
  			</a>
  			<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
		   		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		   		<span class="sr-only">Next</span>
  			</a>
		</div>

		<div class="survey">
			<div class="surveyText"> Can't decide where to go on your holiday? Take a quick survey and get instant recommendation of places in India to visit!</div>
			<div class="surveyBtn"><button class="yellowBtn">Take Survey</button></div>
		</div>
	</div> <!--home ends-->

	<!--upcoming section-->
	<div class="sectionHeader" id="Upcoming">
		<div class="header">
			<div class="headingText">Upcoming Trips</div>
			<div class="viewAllBtn"><button class="secondaryBtn" type="button" data-toggle="collapse" data-target="#AllTrips" aria-expanded="false" aria-controls="AllTrips">View All</button></div>
		</div>
		<div id ="cards" class="row mx-auto">
			<a href="#" data-toggle="modal" data-target="#tripDetails" class="toggle">
				<div class="col-sm-3">
					<div class="card" style="width: 18rem;">
  						<img class="card-img-top" src="images/couple.jpg" alt="Card image cap">
  						<div class="card-body">
    						<h5 class="card-title">LOCATION</h5>
    						<p class="card-text">Starting from ₹8000</p>
  						</div>
					</div>
				</div>
			</a>
      <a href="#" data-toggle="modal" data-target="#tripDetails" class="toggle">
				<div class="col-sm-3">
					<div class="card" style="width: 18rem;">
	  					<img class="card-img-top" src="images/bg.jpg"Card image cap">
	  					<div class="card-body">
	    					<h5 class="card-title">LOCATION</h5>
	    					<p class="card-text">Starting from ₹8000</p>
	  					</div>
					</div>
				</div>
      </a>
      <a href="#" data-toggle="modal" data-target="#tripDetails" class="toggle">
				<div class="col-sm-3">
					<div  id ="tripCard" class="card" style="width: 18rem;">
	  					<img class="card-img-top" src="images/bg.jpg"Card image cap">
	  					<div class="card-body">
	    					<h5 class="card-title">LOCATION</h5>
	    					<p class="card-text">Starting from ₹6500</p>
	  					</div>
					</div>
				</div>
      </a>
      <a href="#" data-toggle="modal" data-target="#tripDetails" class="toggle">
			  <div class="col-sm-3">
					<div  id ="tripCard" class="card" style="width: 18rem;">
	  					<img class="card-img-top" src="images/bg.jpg" alt="Card image cap">
	  					<div class="card-body">
	    					<h5 class="card-title">LOCATION</h5>
	    					<p class="card-text">Starting from ₹8000</p>
	  					</div>
					</div>
				</div>
      </a>
		</div>
		<div class="collapse" id="AllTrips">
		<div id ="cards" class="row mx-auto">
      <a href="#" data-toggle="modal" data-target="#tripDetails" class="toggle">
			<div class="col-sm-3">
				<div class="card" style="width: 18rem;">
  					<img class="card-img-top" src="images/bg.jpg" alt="Card image cap">
  					<div class="card-body">
    					<h5 class="card-title">LOCATION</h5>
    					<p class="card-text">Starting from ₹8000</p>
  					</div>
				</div>
			</div>
    </a>
    <a href="#" data-toggle="modal" data-target="#tripDetails" class="toggle">
			<div class="col-sm-3">
				<div class="card" style="width: 18rem;">
  					<img class="card-img-top" src="images/bg.jpg"Card image cap">
  					<div class="card-body">
    					<h5 class="card-title">LOCATION</h5>
    					<p class="card-text">Starting from ₹8000</p>
  					</div>
				</div>
			</div>
    </a>
    <a href="#" data-toggle="modal" data-target="#tripDetails" class="toggle">
			<div class="col-sm-3">
				<div  id ="tripCard" class="card" style="width: 18rem;">
  					<img class="card-img-top" src="images/bg.jpg"Card image cap">
  					<div class="card-body">
    					<h5 class="card-title">LOCATION</h5>
    					<p class="card-text">Starting from ₹6500</p>
  					</div>
				</div>
			</div>
    </a>
    <a href="#" data-toggle="modal" data-target="#tripDetails" class="toggle">
		  <div class="col-sm-3">
				<div  id ="tripCard" class="card" style="width: 18rem;">
  					<img class="card-img-top" src="images/bg.jpg" alt="Card image cap">
  					<div class="card-body">
    					<h5 class="card-title">LOCATION</h5>
    					<p class="card-text">Starting from ₹8000</p>
  					</div>
				</div>
			</div>
    </a>

		</div>
	</div>

    </div>

    <!--modal-->
    <div class="modal fade" id="tripDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title">Location</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
        			</button>
      			</div>
      			<div class="modal-body" id="carouselimg">
          			<img class="img-fluid" src="images/couple.jpg">
           			<div class="modalText">
           				<label><b>Date:</b> 26th December, 2018 to 4th January, 2019</label><br>
           				<label><b>Description:</b> Ambitioni dedisse scripsisse iudicaretur. Cras mattis iudicium purus sit amet fermentum. Donec sed odio operae, eu vulputate felis rhoncus. Praeterea iter est quasdam res quas ex communi. At nos hinc posthac, sitientis piros Afros. </label><br>
           				<a href="download.txt" download class="downloadFile">Download itinerary</a><br>
           				<label><b>Price:</b> ₹21000*</label>
           				<p id="terms">* The charges mentioned above includes only the base price of the trip for the mentioned location, exclusive of accommodation and travel charges from your city. </p>
       				</div>
           
      			</div>
      			<div class="modal-footer">
        			<a href="join.php"><button type="button" class="yellowBtn joinBtn">Join Now</button></a>
      			</div>
    		</div>
  		</div>
	</div>
    <!--modal ends-->
	
    <!--footer-->
    	<footer class="page-footer font-small pt-4">
    	<div class="container-fluid text-center text-md-left">
      		<div class="row">
        		<div class="col-md-6 mt-md-0 mt-3">
          			<h6 class="footerText">Contact Us</h6>
          			<p class="footerText"><i class="fa fa-envelope icon" aria-hidden="true"></i> help@letstravel.com</p>
          			<p class="footerText"><i class="fa fa-phone icon" aria-hidden="true"></i> 1800-676-333 (9:00 am to 9:00 pm)</p>	
        		</div>
        		<hr class="clearfix w-100 d-md-none pb-3">
        		<div class="col-md-3 mb-md-0 mb-3">
          		</div>
         	 	<div class="col-md-3 mb-md-0 mb-3">
            		<ul class="list-unstyled">
             			<li><a href="#!" class=" footerText">About Us</a></li>
              			<li><a href="#!" class=" footerText">Terms and Conditions</a></li>
              			<li><a href="#!" class=" footerText">Privacy Policy</a></li>
            		</ul>
          		</div>
      		</div>
    	</div>
    	
    	<div class="text-center py-3">
    		<a class="social-icon" href="https://www.facebook.com/"><i class="fa fa-facebook mr-md-5 mr-3 social-icon"> </i></a>
          	<a class="social-icon" href="https://www.twitter.com/"><i class="fa fa-twitter mr-md-5 mr-3 social-icon"> </i></a>
       		<a class="social-icon" href="https://www.instagram.com/"><i class="fa fa-instagram mr-md-5 mr-3 social-icon"> </i></a>
    	</div>
    	<div class="footer-copyright text-center py-3 madeby">
    		Made by<font style="color: #ffc312;"> Grusha Dharod, Vicky Daiya & Shivanee Jaiswal</font>
    	</div>
  	</footer>
<!--Bootstrap JS-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script type="text/javascript">
  window.onload=function(){
    if(window.location.href.indexOf("status=loggedin")!=-1)
    {
      document.getElementById('in_nav').style.display = "block";
      document.getElementById('outl_nav').style.display = "none";
      document.getElementById('outr_nav').style.display = "none";
    }
    else
    {
      document.getElementById('in_nav').style.display = "none";
      document.getElementById('outl_nav').style.display = "block";
      document.getElementById('outr_nav').style.display = "block";
    }
  }


</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="js/animations.js"></script>
</body>
</html>


