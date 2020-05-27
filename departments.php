<?php 
session_start();
require_once('connection.php');
  if(!isset($_SESSION['username'])){
    header("location:registration.php");
  }
  else{
  echo "Welcome  ".$_SESSION['username'] . "<br/>";
	if(isset($_SESSION['dept']))
		 echo "dept:". $_SESSION['dept'];
  else echo 'No dept yet';	
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(!isset($_SESSION['dept'])){
		$dept = $_POST['dept'];
		// lets now update the database
		$sql = "UPDATE user set department_id='".$dept."' where username ='".$_SESSION['username']."'";
		if(mysqli_query($conn, $sql)){
			echo "Updated Successfully";
			$_SESSION['dept'] = $dept;
		}	
		else
			echo mysqli_error($conn);
	}
}

  

?>
<html>
<head>
    <title>Departments</title>  
   
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>
	<script>
	/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
	</script>
    </head>
<body>

<h2>Choose Department</h2>

<form action ="departments.php" method="post">
<div class="dropdown">
 	
  <?php
	if(!isset($_SESSION['dept'])){
		$query="SELECT * FROM department";
		$res=mysqli_query($conn,$query); ?>
		 <select name="dept">
		 <?php
		while($row = $res->fetch_assoc()){
			
			?>
	
		<option value="<?php echo $row['dept_id'];?>"> <?php echo $row['dept_name']?></option>
	
  
	
	<?php
	}
	?>
	</select>
	<input type="submit" value="select">
	<?php
	
	}
	else{
		$query="SELECT * FROM department where dept_id='".$_SESSION['dept']."'";
		$res=mysqli_query($conn,$query);
		$rows = $res->fetch_assoc();
		 echo 'My Dept is: '. $rows['dept_name'];
  ?>
	Visit the courses <a href="courses.php"> here</a> <br>
	<a href="logout.php"> Logout </a>
	
	<?php
	}
	
  ?>
  
</div> 
</form>

</body>
</html>
