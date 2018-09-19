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
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand heading" href="home.php">Letstravel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navbarNavDropdown" class="navbar-collapse collapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="home.php?status=loggedin">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="home.php?status=loggedin#Upcoming">Upcoming Trips</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#Upcoming">FAQ</a>
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
                                                     
                            ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Edit Profile</a>
            <a class="dropdown-item" href="logout.php">Logout</a>
          </div>
        </li>        
      </ul>
    </div>
  </nav>
  <!--main form-->
  <div class="joinForm">
    <div class="topButtons">
      <label class="form-check-label" for="Pcount">Number of Passengers</label>
      <input type="number" name="passengerCount" min="1" id="Pcount" value="1">
      <button id="iniPCount" onclick="tablerows()" class="yellowBtn">Go!</button>
      <button id="addbtn" onclick="addRow()" class="linkBtn">+ Add</button>
    </div>
    <form>
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
                              echo "<input type='text' value='".$row['FirstName']."'>";
                              }
                                  ?></td>
        <td><?php                            
                             
                                $sql="SELECT LastName FROM user WHERE Email='".$email."'";
                                $lname = mysqli_query($conn,$sql);                                
                                while ($row=$lname->fetch_assoc()) {                              
                              echo "<input type='text' value='".$row['LastName']."'>";
                              }
                                  ?></td>
        <td><input type='number' min='1'></td>
        <td><select><option>Select</option><option>Male</option><option>Female</option></select></td>
        <td><?php                            
                             
                                $sql="SELECT Mobile FROM user WHERE Email='".$email."'";
                                $mobile = mysqli_query($conn,$sql);                                
                                while ($row=$mobile->fetch_assoc()) {                              
                              echo "<input type='number' value='".$row['Mobile']."'>";
                              }
                                  ?></td>
        <td><input type='number' maxlength='16'></td>
        <td><button onclick='delRow(this)' class="delBtn"><i class='fa fa-trash' aria-hidden='true'></i></button></td>
      </tbody>
    </table>
    <div class="form-group row">
      <label for="Locations" class="col-xl-3 col-form-label">From</label>
      <div class="col-xl-9">
        <select class="form-control selectloc" id="Locations">
          <option selected="" disabled="">Select Location</option>
          <option>Mumbai</option>
          <option>Delhi</option>
          <option>Bangalore</option>
          <option>Kolkata</option>
        </select>
      </div>
    </div>
    <div class="form-group row ">
      <label for="accpref" class="col-xl-3 col-form-label">Accomodation preference</label>
      <div id="accpref" class="col-xl-9">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="accpref" id="3star" value="3star">
          <label class="form-check-label" for="3star">3-star</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="accpref" id="5star" value="5star">
          <label class="form-check-label" for="5star">5-star</label>
        </div>
      </div>
    </div>
    <div class="form-group row ">
      <label for="mealpref" class="col-xl-3 col-form-label">Meal preference </label>
      <div id="mealpref" class="col-xl-9">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="mealpref" id="veg" value="veg">
          <label class="form-check-label" for="3star">Veg</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="mealpref" id="nonveg" value="nonveg">
          <label class="form-check-label" for="5star">Non-Veg</label>
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
      <div class="totalCost">
        <p style="padding: 0%; margin: 0;">Total cost ₹35000*</p>
      </div>
      <div class="tnc">
        <p style="padding: 0%; margin: 0; margin-bottom: 1%;">*The above price is inclusive of travelling, accomodation, taxes and trip cost.</p>
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
        <button onclick="" class="secondaryBtn">Cancel</button>
      </div>
      <div class="form-check form-check-inline col-md-5 confirmBtn">
        <input class="form-check-input yellowBtn bottomBtn" type="submit" name="JoinTrip" value="Proceed to pay">
      </div>
    </div>
    </form>
  </div>

<!--Bootstrap JS-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<script>
  window.onload=function(){
    
     document.getElementById('addbtn').style.display = "none";
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
    firstname.innerHTML="<input type='text'>";
    lastname.innerHTML="<input type='text'>";
    age.innerHTML = "<input type='number' min='1'>";
    gender.innerHTML = "<select><option>Select</option><option>Male</option><option>Female</option></select>";
    contact.innerHTML = "<input type='number' size='10'>";
    aadhar.innerHTML = "<input type='number' maxlength='16'>";
    deleteRow.innerHTML = "<button onclick='delRow(this)' class='delBtn'><i class='fa fa-trash' aria-hidden='true'></i></button>";
    document.getElementById("iniPCount").style.display = "none";
    document.getElementById("Pcount").disabled = "true";
    document.getElementById("addbtn").style.display="inline";
    
  }
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
    firstname1.innerHTML="<input type='text'>";
    lastname1.innerHTML="<input type='text'>";
    age1.innerHTML = "<input type='number' min='1'>";
    gender1.innerHTML = "<select><option>Select</option><option>Male</option><option>Female</option></select>";
    contact1.innerHTML = "<input type='number' size='10'>";
    aadhar1.innerHTML = "<input type='number' max='9999999999999999'>";
    deleteRow1.innerHTML = "<button onclick='delRow(this)' class='delBtn'><i class='fa fa-trash' aria-hidden='true'></i></button>";
   var cnt =  document.getElementById("Pcount").value;
   var newcnt = parseInt(cnt)+1;
  document.getElementById("Pcount").value = newcnt;
  }
  function delRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("passengertable").deleteRow(i);
    var cnt =  document.getElementById("Pcount").value;
   var newcnt = parseInt(cnt)-1;
  document.getElementById("Pcount").value = newcnt;
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

