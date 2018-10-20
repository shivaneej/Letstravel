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
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
  <!--Bootstrap CSS-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" type="text/css" href="override.css">
  <link rel="stylesheet" type="text/css" href="join.css">
</head>
<body class="bg">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand heading" href="home.php">Letstravel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navbarNavDropdown" class="navbar-collapse collapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="home.php?status=loggedin">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="home.php?status=loggedin#Upcoming">Upcoming Trips</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://www.google.com">FAQ</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Hi, 
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
                                                        	
                            	$email=$_SESSION['user_email'];
                                $sql="SELECT FirstName FROM user WHERE Email='".$email."'";
                                $fname = mysqli_query($conn,$sql);                                
                                while ($row=$fname->fetch_assoc()) {                            	
                            	echo $row['FirstName'];
                              }

                              $_SESSION['tripid']=$_POST['tripid'];
                              //echo $_SESSION['tripid'];                                                     
                            ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<!--             <a class="dropdown-item" href="#">Edit Profile</a> -->
            <a class="dropdown-item" href="logout.php">Logout</a>
          </div>
        </li>        
      </ul>
    </div>
  </nav>
  <!--main form-->
    <form action="upload.php" method="POST">
    	<div class="joinForm">
    <div class="topButtons">
      <label class="form-check-label" for="Pcount">Number of Passengers</label>
      <input type="number" name="passengerCount" min="1" id="Pcount" value="1">
       <a id="iniPCount" onclick="tablerows()" class="yellowBtn">Go!</a>
      <a id="addbtn" onclick="addRow()" class="linkBtn">+ Add</a>
    </div>
    <table class="table" id="passengertable">
      <thead class="thead-dark">
        <tr>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Age</th>
          <th scope="col">Gender</th>
          <th scope="col">Contact</th>
          <th scope="col">Aadhar Number</th>
          <th scope="col"><input type="reset" value="Clear" class="linkBtn"></th>
        </tr>
      </thead>
      <tbody>
        <td><?php                            
                              
                                $sql="SELECT FirstName FROM user WHERE Email='".$email."'";
                                $fname = mysqli_query($conn,$sql);                                
                                while ($row=$fname->fetch_assoc()) {                              
                              echo "<input type='text' name='fname0' value='".$row['FirstName']."'>";
                              }
                                  ?></td>
        <td><?php                            
                             
                                $sql="SELECT LastName FROM user WHERE Email='".$email."'";
                                $lname = mysqli_query($conn,$sql);                                
                                while ($row=$lname->fetch_assoc()) {                              
                              echo "<input type='text' name='lname0' value='".$row['LastName']."'>";
                              }
                                  ?></td>
        <td><input name="age0" type='number' min='1'></td>
        <td><select name='gender0'><option>Select</option><option>Male</option><option>Female</option></select></td>
        <td><?php                            
                             
            $sql="SELECT Mobile FROM user WHERE Email='".$email."'";
            $mobile = mysqli_query($conn,$sql);                                
            while ($row=$mobile->fetch_assoc()) 
            {                              
          		echo "<input type='text' name='contact0' maxlength='10' pattern='([0-9]{10})' value='".$row['Mobile']."'>";
          	}
          if(isset($_POST['tripjoined'])) 	
            {	
              $tripid = $_POST["tripid"];	
              $sql = "SELECT locations FROM trip_location WHERE startloc=1 AND tripId='".$tripid."'";	
              $result = mysqli_query($conn,$sql);
              $num=mysqli_num_rows($result);
              for($i=0;$i<$num;$i++)	
              {	
                $row=mysqli_fetch_assoc($result);	
                $startloc = $row["locations"];	
              }
          $sql = "SELECT BasePrice FROM  trip WHERE tripId='".$tripid."'";
          $result = mysqli_query($conn,$sql);
          for($i=0;$i<mysqli_num_rows($result);$i++)
          	{	
                $row=mysqli_fetch_assoc($result);	
                $baseprice = $row["BasePrice"];	
              }	
              	
           }	
              ?></td>
        <td><input type='text' pattern='([0-9]{16})' maxlength='16' name='aadharno0'></td>
        <td><button onclick='delRow(this)' class="delBtn"><i class='fa fa-trash' aria-hidden='true'></i></button></td>
      </tbody>
    </table>
    <div class="form-group row">
      <label for="Locations" class="col-xl-3 col-form-label">From</label>
      <div class="col-xl-9">
        <select name='from_loc' class="form-control selectloc" id="Locations" onchange="javascript:getdata();">
          <option selected="" disabled="">Select Location</option>
          <!--<option>Mumbai</option>
          <option>Delhi</option>
          <option>Bangalore</option>
          <option>Kolkata</option>-->
          <?php                            
                              
            $sql5="SELECT City FROM distance";
            $city = mysqli_query($conn,$sql5);                                
            while ($row5=$city->fetch_assoc()) 
            {                              
          		echo "<option value='".$row5['City']."'>".$row5['City']."</option>";
          	}
          ?>


        </select>
      </div>
    </div>
    <div class="form-group row ">
      <label for="accpref" class="col-xl-3 col-form-label">Accomodation preference</label>
      <div id="accpref" class="col-xl-9">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="accpref" id="3star" value="3star" onchange="javascript:getcost();">
          <label class="form-check-label" for="3star">3-star</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="accpref" id="5star" value="5star" onchange="javascript:getcost();">
          <label class="form-check-label" for="5star">5-star</label>
        </div>
      </div>
    </div>
    <div class="form-group row ">
      <label for="mealpref" class="col-xl-3 col-form-label">Meal preference </label>
      <div id="mealpref" class="col-xl-9">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="mealpref" id="veg" value="veg" onchange="javascript:getcost();">
          <label class="form-check-label" for="veg">Veg</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="mealpref" id="nonveg" value="nonveg" onchange="javascript:getcost();">
          <label class="form-check-label" for="nonveg">Non-Veg</label>
        </div>
      </div>
    </div>
    <div class="form-group row ">
      <label for="travelpref" class="col-xl-3 col-form-label">Travel time preference</label>
      <div id="travelpref" class="col-xl-9">
        <div class="form-check form-check-inline">
           <input class="form-check-input" type="radio" name="travelpref" id="day" value="day">
          <label class="form-check-label" for="day">Day</label>
        </div>
        <div class="form-check form-check-inline">
         <input class="form-check-input" type="radio" name="travelpref" id="night" value="night">
          <label class="form-check-label" for="night">Night</label> 
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="travelpref" id="any" value="any">
          <label class="form-check-label" for="any">Any</label>
        </div>
      </div>
    </div>
    <div class="form-group row price">
      <div class="totalCost"  style="padding: 0%; margin: 0;">
      	<!--+500 for non veg, +5000 for 5 star -->
        <p id="total"></p>
      </div>
      <div class="tnc" style="display: block;">
        <p id="tncText" style="padding: 0%; margin: 0; margin-bottom: 1%;">*The above price is inclusive of travelling, accomodation, taxes and trip cost.</p>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-xl-10" id="tncCheck">
        <input class="" type="checkbox" name="tncCheck" value="agreed">
        <label>I have read the terms and conditions and accept them</label>
      </div>
    </div>
    <div class="form-group row col-md-12" class="foot">
      <div class="form-check form-check-inline col-md-5">
        <a href="home.php?status=loggedin"><button onclick="" class="secondaryBtn">Cancel</button></a>
      </div>
      <div class="form-check form-check-inline col-md-5 confirmBtn">
        <input type="hidden" name="cost" id="costforpayment">
        <input type="hidden" name="tripKaID" id="tripIdForMail" value="<?php echo $tripid;?>">
        <input type="hidden" name="email" id="UseremailForMail" value="<?php echo $email;?>">
        <input class="form-check-input yellowBtn bottomBtn" type="submit" name="JoinTrip" value="Proceed">
      </div>
    </div>
    </form>
  </div>

<!--Bootstrap JS-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<script>
  var passengers = parseInt(document.getElementById("Pcount").value,10);
	var cost2=0;	
  var cost1=0;	
  var cost3=parseInt(<?php echo $baseprice; ?>,10);	
  document.getElementById("total").innerHTML = "Total cost ₹" + (cost1+cost2+cost3)*passengers+"*";
  document.getElementById("costforpayment").value = (cost1+cost2+cost3)*passengers; 
  document.getElementById("price").style.display = "block"; 
  window.onload=function(){
    
     document.getElementById('addbtn').style.display = "none";
     document.getElementById('tncText').style.display = "none";
    }
function tablerows(){
  var count = document.getElementById('Pcount').value;
  var j = parseInt(count);
  for(var i=1;i<j;i++)
  {
    var row = document.getElementById('passengertable').insertRow();
    var firstname = row.insertCell(0);
    var lastname = row.insertCell(1);
    var age = row.insertCell(2);
    var gender = row.insertCell(3);
    var contact = row.insertCell(4);
    var aadhar = row.insertCell(5);
    var deleteRow = row.insertCell(6);
    firstname.innerHTML="<input type='text' name='fname"+i+"'>";
    lastname.innerHTML="<input type='text' name='lname"+i+"'>";
    age.innerHTML = "<input type='number' name='age"+i+"' min='1'>";
    gender.innerHTML = "<select name='gender"+i+"'><option>Select</option><option>Male</option><option>Female</option></select>";
    contact.innerHTML = "<input type='text' name='contact"+i+"' maxlength='10' pattern='([0-9]{10})'>";
    aadhar.innerHTML = "<input type='text' maxlength='16' name='aadharno"+i+"' pattern='([0-9]{16})'>";
    deleteRow.innerHTML = "<button onclick='delRow(this)' class='delBtn'><i class='fa fa-trash' aria-hidden='true'></i></button>";
    
  }
  document.getElementById("iniPCount").style.display = "none";
    document.getElementById("Pcount").readOnly = "true";
    document.getElementById("addbtn").style.display="inline";
    passengers = parseInt(document.getElementById("Pcount").value,10);
  document.getElementById("total").innerHTML = "Total cost ₹" + (cost1+cost2+cost3)*passengers+"*"; 
   document.getElementById("Pcount").value = passengers;
   document.getElementById("costforpayment").value = (cost1+cost2+cost3)*passengers; 

}
  function addRow(){
   var row1 = document.getElementById('passengertable').insertRow();
    var firstname1 = row1.insertCell(0);
    var lastname1 = row1.insertCell(1);
    var age1 = row1.insertCell(2);
    var gender1 = row1.insertCell(3);
    var contact1 = row1.insertCell(4);
    var aadhar1 = row1.insertCell(5);
    var deleteRow1 = row1.insertCell(6);
    firstname1.innerHTML="<input type='text' name='fname"+(passengers)+"'>";
    lastname1.innerHTML="<input type='text' name='lname"+(passengers)+"'>";
    age1.innerHTML = "<input type='number' name='age"+(passengers)+"' min='1'>";
    gender1.innerHTML = "<select name='gender"+(passengers)+"'><option>Select</option><option>Male</option><option>Female</option></select>";
    contact1.innerHTML = "<input type='text' name='contact"+(passengers)+"' maxlength='10' pattern='([0-9]{10})'>";
    aadhar1.innerHTML = "<input type='text' maxlength='16' name='aadharno"+(passengers)+"' pattern='([0-9]{16})'>";
    deleteRow1.innerHTML = "<button onclick='delRow(this)' class='delBtn'><i class='fa fa-trash' aria-hidden='true'></i></button>";
   var cnt =  document.getElementById("Pcount").value;
   var newcnt = parseInt(cnt)+1;
  passengers = newcnt; 
   document.getElementById("Pcount").value = passengers;
  document.getElementById("total").innerHTML = "Total cost ₹" + (cost1+cost2+cost3)*passengers+"*"; 
  document.getElementById("costforpayment").value = (cost1+cost2+cost3)*passengers; 
  }
  function delRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("passengertable").deleteRow(i);
    var cnt =  document.getElementById("Pcount").value;
   var newcnt = parseInt(cnt)-1;
  passengers = newcnt;
  document.getElementById("total").innerHTML = "Total cost ₹" + (cost1+cost2+cost3)*passengers+"*"; 
  document.getElementById("Pcount").value = passengers;
  document.getElementById("costforpayment").value = (cost1+cost2+cost3)*passengers; 
}
    
 function getdata()	
{	
  	
  var selected_locn = document.getElementById("Locations").value;	
  var xhttp = new XMLHttpRequest();	
   xhttp.onreadystatechange = function(){	
     if(xhttp.readyState == 4 && xhttp.status == 200)	
    {	
      var jsobj = JSON.parse(xhttp.response);	
        for(var i=0;i<jsobj.length;i++)	
        {	
          if(selected_locn==jsobj[i].City)	
          {	
            cost1 = parseInt(jsobj[i].<?php echo $startloc; ?>,10);	
            cost1 = cost1*2;	
            console.log(cost1);	
            document.getElementById("total").innerHTML = "Total cost ₹" + (cost1+cost2+cost3)*passengers+"*";	
          }	
        }	
       	
    }	
   };	
    xhttp.open("GET","distance.json",true);	
    xhttp.send();
    document.getElementById("costforpayment").value = (cost1+cost2+cost3)*passengers; 	
}   	
function getcost()	
{	
   var acc_pref = "3star";	
  var meal_pref = "veg";	
  if(document.getElementById("3star").checked)	
  {	
     acc_pref = document.getElementById("3star").value;	
  }	
  if(document.getElementById("5star").checked)	
  {	
     acc_pref = document.getElementById("5star").value;	
  }	
  if(document.getElementById("veg").checked)	
  {	
     meal_pref = document.getElementById("veg").value;	
  }	
  if(document.getElementById("nonveg").checked)	
  {	
     meal_pref = document.getElementById("nonveg").value;	
  }	
   var xhttp = new XMLHttpRequest();	
   xhttp.onreadystatechange = function(){	
     if(xhttp.readyState == 4 && xhttp.status == 200)	
    {	
      var jsobj = JSON.parse(xhttp.response);	
        for(var i=0;i<jsobj.length;i++)	
        {	
          if((meal_pref==jsobj[i].meal_pref) && (acc_pref==jsobj[i].acc_pref))	
          {	
             cost2 = parseInt(jsobj[i].cost,10);	
             console.log(cost2);	
             document.getElementById("total").innerHTML = "Total cost ₹" + (cost1+cost2+cost3)*passengers+"*";	
          }	
        }	
       	
    }	
   };	
    xhttp.open("GET","cost.json",true);	
    xhttp.send();	
    document.getElementById("costforpayment").value = (cost1+cost2+cost3)*passengers; 
    	    
}
</script>
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
