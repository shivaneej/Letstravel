<?php

session_start();

if($_SESSION['status']=='loggedin')
{
  ?>
<!DOCTYPE html>
<html>
<head>
    <title>Letstravel</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.png">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="override.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<!--navbar-->
<div class="row" id="bar">
    <div class="col-sm-10 heading" id="up">Letstravel</div>
    <!--<div class="col-sm-2" id="log"><a id="logout" href="logout.php" name="logout_link">Logout</a></div>-->
    <div class="col-sm-2" id="log">
      <form action="dashboard.php" method="post">
        <input type="submit" name="logout_link" value="Logout" id="logout">
      </form>
       <?php
        if(isset($_POST['logout_link']))
        {
          session_start();
          session_destroy();
          header("Location: adminlogin.html");

        }
      ?>
    </div>

</div>

<!-- create trip Modal -->
<div id="createTripModal" class="modal">
  <!-- Modal content -->
	<div class="modal-content">
    <form action="upload.php" method="POST" enctype="multipart/form-data">
    	<div style="margin-bottom: 6%;">
    		<span class="close" id="closeCreateTrip">&times;</span>
    		<label><h3 style="font-family: 'Montserrat', sans-serif;">Create trip</h3></label>
    	</div>
    	<div class="form-group row">
    		<label class="col-sm-4">Select Location</label>
    		<!--<i class="material-icons md-36 col-sm-1">location_on</i>-->
    		<div class="col-sm-6">      
      			<select name="locs[]" multiple="" class="label ui selection fluid search dropdown" id="tripLocs" onChange="getLocs();">
			      <option value="">Select Locations</option>
			      <!--option value="Delhi">Delhi</option>
			      <option value="Mumbai">Mumbai</option>
			      <option value="Agra">Agra</option>
			      <option value="Chennai">Chennai</option>
			      <option value="Kolkata">Kolkata</option>
			      <option value="Goa">Goa</option>
			      <option value="Pune">Pune</option>
			      <option value="Bangalore">Bangalore</option>-->
                              
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
            $sql5="SELECT Name FROM cities";
            $city = mysqli_query($conn,$sql5);                                
            while ($row5=$city->fetch_assoc()) 
            {                              
              echo "<option value='".$row5['Name']."'>".$row5['Name']."</option>";
            }
          ?>
    			</select>
    		</div>    
  		</div>
      <div class="form-group row">
        <label class="col-sm-4">Select Start Location</label>
        <!--<i class="material-icons md-36 col-sm-1">location_on</i>-->
        <div class="col-sm-6">      
            <select name="start" class="label ui selection fluid dropdown" id="start">
            <option value="" disabled selected>Start Location</option>
          </select>
        </div>    
      </div>
  		<div class="form-group row">
    		<label class="col-sm-4">Start Date</label>
    		<!--<i class="material-icons md-36 col-sm-1">date_range</i>-->
    		<div class="col-sm-5">                      
                                 
                    <div class='input-group date' id='datepicker'>
                        <input type='text' class="form-control" name="startDate" />
                        <span class="input-group-addon">
                        	<span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>                  
                       
    		</div>    
  		</div>
  		<div class="form-group row">
    		<label class="col-sm-4">End Date</label>
    		<!--<i class="material-icons md-36 col-sm-1">date_range</i>-->
    		<div class="col-sm-5">      
                                  
                    <div class='input-group date' id='datepicker1'>
                        <input type='text' class="form-control" name="endDate" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>                  
                
            </div>    
        </div>
        <div class="form-group row">
		    <label class="col-sm-4 ">Base Price</label>
		    <!--<i class="material-icons md-36 col-sm-1">attach_money</i>-->
		    <div class="col-sm-7">      
		        <div class='input-group' >
		            <input type='text' class="form-control" placeholder="Base Price" name="basePrice" style="border-radius: 5px;" />                    
		        </div>
		    </div>    
  		</div> 
  		<div class="form-group row">
    		<label class="col-sm-4">Tour Guide Name</label>
    			<!--<i class="material-icons md-36 col-sm-1">person</i>-->
    			<div class="col-sm-7">      
                	<div class='input-group'>
                    	<input type='text' class="form-control"  placeholder="Tour Guide Name" name="tgName" style="border-radius: 5px;" />                    
                	</div>      
    			</div>    
  		</div> 
  		<div class="form-group row">
    		<label  class="col-sm-4">Tour Guide Contact</label>
    		<!--<i class="material-icons md-36 col-sm-1">call</i>-->
    		<div class="col-sm-7">      
                <div class='input-group'>
                    <input type='text' class="form-control" placeholder="Tour Guide Contact" name="tgCont" style="border-radius: 5px;"/>                    
                </div>      
    		</div>    
  		</div> 
  		<div class="form-group row">
    		<label  class="col-sm-4">Thumbnail</label>
    		<div class="col-sm-8"> 
    			<div class='input-group'>     
        			<input class="upload" type="file" name="tn-uploaded">       
        		</div>
    		</div>    
  		</div>
  		<div class="form-group row">
    		<label class="col-sm-4 col-form-label">Itinerary</label>
    		<div class="col-sm-8">
    			<div class='input-group'>      
        			<input class="upload" type="file" name="it-uploaded">        
        		</div>
    		</div>    
  		</div>
  		<div class="modal-footer">        
	        <button type="submit" class="yellowBtn createBtn" name="create">Create Trip</button>
      	</div>
      </form>
    </div>
</div>
<!--modal ends-->


<div>
<div class="row mx-auto" id="cardsRow2">

  <!--create trip card-->
    <a href="#createTripModal" onclick="javascript:openCreateTripModal();">
        <div class="col-sm-3">
          <div class="createCard">
            <div class="top">
              <i class="material-icons add">add_circle_outline</i>
            </div>
          <div class="container">
            <h4 class="card-title"><b>CREATE A NEW TRIP</b></h4> 
          </div>
        </div>
      </div>
  </a>


<?php 

 $sql="SELECT * FROM trip WHERE Status=1;";
  $result = mysqli_query($conn,$sql);
  $rows = mysqli_num_rows($result);
  for($i=0;$i<$rows;$i++)
  {
    $tripID = mysqli_fetch_assoc($result);
    $sql2='SELECT locations from trip_location where tripId="'.$tripID["TripId"].'"';
    $sql3='SELECT locations from trip_location where tripId="'.$tripID["TripId"].'" AND startLoc=1;';
    $result2 = mysqli_query($conn,$sql2);
    $rows2 = mysqli_num_rows($result2);
    $temp =  mysqli_fetch_assoc($result2);
    $locs = $temp["locations"];
    for($j=1;$j<$rows2;$j++)
    {
      $temp =  mysqli_fetch_assoc($result2);
      $locs=$locs." - ".$temp["locations"];
    }
    $result3 = mysqli_query($conn,$sql3);
    $start = mysqli_fetch_assoc($result3);
    $rows3 = mysqli_num_rows($result3);
    $sloc = $start["locations"];
    ?>

    <a href="#TripModal<?php echo $i;?>" onclick="javascript:openModal('<?php echo $i; ?>');" id="viewTripModal<?php echo $i;?>">
        <div class="col-sm-3">
          <div class="card">
            <img class="card-img-top" src="uploads/<?php echo $tripID['Image']; ?>" alt="Avatar" style="width:100%">
          <div class="card-body">
            <h4 class="card-title"><b><?php echo $locs; ?></b></h4> 
            <p class="card-text">Starting from <?php echo $sloc; ?></p>
          </div> 
          </div>
      </div>
  </a>
        

  <!-- Trip Modal-->
<div id="TripModal<?php echo $i; ?>" class="modal">
  <!--Modal content -->
  <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title"><?php echo $locs; ?></h4>
          <button type="button" data-dismiss="modal" aria-label="Close" class="closeBtn">
              <span aria-hidden="true" class="close" id="closeTrip<?php echo $i; ?>">&times;</span>
          </button>
        </div>   
        <div class="modal-body" id="carouselimg">
            <img class="modal-img" src="uploads/<?php echo $tripID['Image']; ?>">
            <div class="modalText">
              <label><b>Date:</b><?php echo $tripID['StartDate']; ?> to <?php echo $tripID['EndDate']; ?></label><br>
              <a href="uploads/<?php echo $tripID['Itinerary']; ?>" download class="downloadFile">Download itinerary</a><br>
              <label><b>Base Price:</b> ₹<?php echo $tripID['BasePrice']; ?></label><br>
              <label><b>Tour Guide Name:</b><?php echo $tripID["GuideName"]; ?></label><br>
              <label><b>Tour guide Contact:</b><?php echo $tripID["GuideContact"]; ?></label>
          </div>   
        </div>
        <div class="modal-footer">
          <form action="#" method="POST" enctype="multipart/form-data">
            <button type="submit" class="yellowBtn delBtn" value="<?php echo $tripID["TripId"];?>" name="deleteTrip">Delete Trip</button>
            <!--<input type="submit" value="<?php //echo $tripID["TripId"];?>" class="yellowBtn delBtn" name="deleteTrip">-->
          </form>
        </div>                                   
    </div>
</div>
<!--modal ends-->

<?php 
}

if(isset($_POST['deleteTrip']))
            {
                $tripDel = $_POST['deleteTrip'];
                $sqlx = 'UPDATE trip set Status = 0 where tripId="'.$tripDel.'"';
                $resultx = mysqli_query($conn,$sqlx);
                if($resultx == True)
                  echo "<script type='text/javascript'>alert('Trip Deleted Successfully'); window.location='dashboard.php'</script>";
            }
?>
</div>
</div>



<script>

  var tripModal;
  
	var modal = document.getElementById('createTripModal');
	var span = document.getElementById("closeCreateTrip");
	var closeBtn="";
	
	function openCreateTripModal()
  {
	    modal.style.display="block";
	}
  function openModal(val)
  {
    tripModal = document.getElementById("TripModal"+val);
    tripModal.style.display = "block";
    closeBtn=document.getElementById("closeTrip"+val);
    closeBtn.onclick=function()
      {   
        tripModal.style.display="none";
      }
  }
		span.onclick = function() 
  {
	    modal.style.display = "none";    
	}
	window.onclick = function(event) 
  {
	    if (event.target == modal||event.target==tripModal) 
      {
	        modal.style.display = "none";
	        tripModal.style.display="none";
	    }
	}
	$(function () 
  {
    $('#datepicker').datepicker(
    {
      format: "yyyy/mm/dd",
      autoclose: true,
      //todayHighlight: true,
      showOtherMonths: true,
      selectOtherMonths: true,
      autoclose: true,
      changeMonth: true,
      changeYear: true,
      orientation: "button"
    });
	});
	$(function () 
  {
	  $('#datepicker1').datepicker(
    {
      format: "yyyy/mm/dd",
      autoclose: true,
      //todayHighlight: true,
      showOtherMonths: true,
      selectOtherMonths: true,
      autoclose: true,
      changeMonth: true,
      changeYear: true,
      orientation: "button"
	   });
	});
  $(function()
  {
    $('.label.ui.dropdown').dropdown({
      maxSelections: 5
  });
	});
  
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="js/location.js"></script>
</body>
</html>
<?php
}
else
{
  header("location:adminlogin.html"); 
}
//mysqli_close($conn);
?>
